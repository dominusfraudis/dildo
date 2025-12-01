#!/usr/bin/perl -w
# DOMINUS FRAUDIS - Advanced Hash Cracking Suite
# by 1nv4d3r - NULLSEC PHILIPPINES

use Digest::MD5 qw/md5_hex/;
use Digest::SHA qw/sha1_hex sha256_hex sha512_hex/;
use MIME::Base64;
use File::Spec;
use File::Basename;
use Time::HiRes qw(time usleep);
use URI::Escape;

# --- Cross-Platform Console Setup ---
BEGIN {
    # Check if we are on Windows
    if ($^O eq 'MSWin32') {
        eval {
            require Win32::Console;
            # Attempt to set up Win32 console features (color codes 2, 4, 6, etc.)
            $::CONSOLE = Win32::Console->new(STD_OUTPUT_HANDLE);
            $::ATTR = $::CONSOLE->Attr();
            
            $::FG_GREEN     = 2;
            $::FG_RED       = 4;
            $::FG_YELLOW    = 6;
            $::FG_WHITE     = 7;
            $::FG_CYAN      = 3;
            $::COLOR_RESET  = $::ATTR;
        };
        # If Win32::Console fails or throws errors like "Argument "STD_OUTPUT_HANDLE" isn't numeric...", 
        # we fall through and use standard ANSI escape codes for compatibility.
        if ($@) {
            $::CONSOLE = undef;
        }
    }
    
    # If not Windows, or Win32::Console failed, use standard ANSI escape codes
    unless (defined $::CONSOLE) {
        $::CONSOLE = undef;
        $::ATTR = 0;
        $::FG_GREEN     = "\e[32m";
        $::FG_RED       = "\e[31m";
        $::FG_YELLOW    = "\e[33m";
        $::FG_WHITE     = "\e[37m";
        $::FG_CYAN      = "\e[36m";
        $::COLOR_RESET  = "\e[0m";
    }
}

no warnings 'uninitialized';

# Clean Banner
my @BANNER_LINES = (
    "==========================================================",
    "  DOMINUS FRAUDIS - Advanced Hash Cracking Suite v4.7",
    "               by 1nv4d3r - NULLSEC PH",
    "=========================================================="
);

# Wordlist directory
my $WORDLIST_DIR = "wordlists";

# --- Color/Console Utility Functions ---
sub set_color {
    my $color = shift;
    if (defined $::CONSOLE) { $::CONSOLE->Attr($color); }
    else { print $color; }
}

sub reset_color {
    if (defined $::CONSOLE) { $::CONSOLE->Attr($::ATTR) if defined $::CONSOLE->Attr(); }
    else { print $::COLOR_RESET; }
}

sub clear_screen {
    if ($^O eq 'MSWin32') {
        system('cls');
    } else {
        print "\e[2J\e[H";
    }
}

sub display_permanent_banner {
    set_color($::FG_CYAN);
    foreach my $line (@BANNER_LINES) {
        print $line . "\n";
    }
    reset_color();
}

# --- Enhanced Hash Detection ---

sub detect_hash_type {
    my $hash = shift;
    $hash =~ s/\s+//g;
    
    return "MD5"    if $hash =~ /^[a-f0-9]{32}$/i && length($hash) == 32;
    return "SHA1"   if $hash =~ /^[a-f0-9]{40}$/i && length($hash) == 40;
    return "SHA256" if $hash =~ /^[a-f0-9]{64}$/i && length($hash) == 64;
    return "SHA512" if $hash =~ /^[a-f0-9]{128}$/i && length($hash) == 128;

    return "BCRYPT" if $hash =~ /^\$2[abxy]\$\d{2}\$[A-Za-z0-9\.\/]{53}$/; 
    return "ARGON2" if $hash =~ /^\$argon2/;
    
    return "UNKNOWN";
}

sub display_hash_info {
    my ($hash, $hash_type) = @_;
    
    set_color($::FG_YELLOW);
    print "\n[*] Hash Analysis Results:\n";
    print "    Type: $hash_type\n";
    print "    Length: " . length($hash) . " characters\n";
    
    if ($hash_type =~ /^(BCRYPT|ARGON2)$/) {
        print "    WARNING: Advanced hash (Slow in Perl, recommend Hashcat/JTR)\n";
        print "    Status: Crackable with dedicated resources\n";
    }
    elsif ($hash_type eq "MD5") {
        print "    Info: Fast, cryptographically broken\n";
        print "    Status: Easily crackable\n";
    }
    elsif ($hash_type eq "SHA1") {
        print "    Info: Weakened, theoretical attacks exist\n";
        print "    Status: Crackable with dedicated resources\n";
    }
    elsif ($hash_type eq "UNKNOWN") {
        print "    Warning: Hash format not recognized\n";
    }
    reset_color();
}

# --- REAL Hash Cracking Functions ---

sub generate_hash {
    my ($password, $hash_type) = @_;
    
    if ($hash_type eq "MD5") {
        return md5_hex($password);
    }
    elsif ($hash_type eq "SHA1") {
        return sha1_hex($password);
    }
    elsif ($hash_type eq "SHA256") {
        return sha256_hex($password);
    }
    elsif ($hash_type eq "SHA512") {
        return sha512_hex($password);
    }
    else {
        return undef;
    }
}

# --- CRITICALLY REWRITTEN PARALLEL (Round-Robin) WORDLIST PROCESSING ---
sub multi_wordlist_cracking {
    my ($hash, $hash_type) = @_;
    
    my @wordlist_paths = get_wordlists_from_dir();
    unless (@wordlist_paths) {
        print "[-] No wordlists found in $WORDLIST_DIR/\n";
        return (0, "");
    }
    
    set_color($::FG_CYAN);
    print "[+] Starting Round-Robin attack with " . scalar(@wordlist_paths) . " wordlists\n";
    print "[+] Hash type: $hash_type\n";
    reset_color();
    
    my $global_start = time();
    
    # 1. Open all wordlists and prepare structure
    my @active_wordlists;
    foreach my $path (@wordlist_paths) {
        my $name = basename($path);
        my $fh; 
        if (open($fh, '<', $path)) {
            push @active_wordlists, {
                fh => $fh,
                attempts => 0,
                name => $name
            };
        } else {
            print "[-] Warning: Could not open wordlist $path - $!\n";
        }
    }
    
    unless (@active_wordlists) {
        print "[-] All wordlists failed to open.\n";
        return (0, "");
    }

    # 2. Main Round-Robin Loop
    my $current_index = 0;
    my $total_attempts = 0;
    my $last_update = time();
    
    while (@active_wordlists) {
        my $handle_count = scalar @active_wordlists;
        # Ensure index wraps around if it exceeds the bounds
        $current_index = $current_index % $handle_count;

        my $wl_ref = $active_wordlists[$current_index];
        my $name = $wl_ref->{name};
        my $fh = $wl_ref->{fh};

        # CRITICAL FIX: Direct, scalar read from the simple file handle
        my $line = <$fh>; 
         
        if (defined $line) {
            chomp $line;
            $line =~ s/[\r\n]//g;
            
            if (length($line) > 0) {
                $total_attempts++;
                $wl_ref->{attempts}++;

                my $test_hash = generate_hash($line, $hash_type);
                if ($test_hash && $test_hash eq $hash) {
                    # SUCCESS: Close all file handles and clean up
                    foreach my $h (@active_wordlists) { close $h->{fh}; }
                    my $elapsed = time() - $global_start;
                    
                    print "\r" . (" " x 80) . "\r";
                    set_color($::FG_GREEN);
                    
                    # FINAL SYNTAX FIX: Eliminate the exclamation point from the string
                    print "[+] SUCCESS: Hash cracked in " . $name . "\n";
                    print "[+] Password: " . $line . "\n";
                    printf "[+] Total Time: %.2fs | Total Attempts: %d\n", $elapsed, $total_attempts;
                    
                    reset_color();
                    
                    return (1, $line);
                }
            }
            
            # Move to the next wordlist in the array (Round-Robin)
            $current_index++;
            
        } else {
            # End of file: close and remove from the active list
            close $fh;
            
            print "\r" . (" " x 80) . "\r";
            set_color($::FG_YELLOW);
            printf "[*] Wordlist finished: %s (%d attempts)\n", $name, $wl_ref->{attempts} || 0;
            reset_color();
            
            # Remove the finished wordlist reference from the array
            splice(@active_wordlists, $current_index, 1);
            
            # If we remove an element, the index naturally points to the next correct element,
            # so we let the while loop re-evaluate the count and the index.
        }
        
        # Update progress *in-line*
        if (time() - $last_update >= 0.05) { 
            my $elapsed = time() - $global_start;
            my $speed = $elapsed > 0 ? int($total_attempts / $elapsed) : 0;
            
            # Safely determine the name of the wordlist being processed
            my $display_name = @active_wordlists > 0 
                ? $active_wordlists[$current_index % scalar(@active_wordlists)]->{name} 
                : "All Finished";
            
            printf "\r[+] Processing: %s | Active: %d | Attempts: %d | Speed: %d/s",
                $display_name, scalar(@active_wordlists), $total_attempts, $speed;
            
            print " " x 15 . "\r"; 
            
            $last_update = time();
         }
    }
    
    # FAILURE: Clean up and report
    my $total_elapsed = time() - $global_start;
    print "\r" . (" " x 80) . "\r";
    set_color($::FG_RED);
    print "\n[-] FAILED: Hash not found in any wordlist after $total_attempts attempts.\n";
    printf "[-] Total time taken: %.2fs\n", $total_elapsed;
    reset_color();
    
    return (0, "");
}

# --- Single Wordlist Cracking ---
sub crack_single_wordlist {
    my ($hash, $hash_type, $wordlist_path) = @_;
    
    # Use the three-argument open for safety
    open(my $fh, '<', $wordlist_path) or return (0, 0, 0, 0);
    
    my $attempts = 0;
    my $start_time = time();
    my $last_update = $start_time;
    
    while (my $line = <$fh>) {
        chomp $line;
        $line =~ s/[\r\n]//g;
        next if length($line) == 0;
        
        $attempts++;
        
        my $test_hash = generate_hash($line, $hash_type);
        if ($test_hash && $test_hash eq $hash) {
            close $fh;
            my $elapsed = time() - $start_time;
            print "\r" . (" " x 80) . "\r"; 
            return (1, $line, $attempts, $elapsed);
        }
        
        my $current_time = time();
        if ($current_time - $last_update >= 0.1) {
            my $elapsed = $current_time - $start_time;
            my $speed = $elapsed > 0 ? int($attempts / $elapsed) : 0;
            printf "\rAttempts: %d | Speed: %d/s | Testing: %s", $attempts, $speed, substr($line, 0, 30);
            $last_update = $current_time;
        }
    }
    
    close $fh;
    my $elapsed = time() - $start_time;
    print "\r" . (" " x 80) . "\r";
    return (0, "", $attempts, $elapsed);
}

# --- Brute-Force Attack Core ---
sub bruteforce_attack_core {
    my ($hash, $hash_type, $min_len, $max_len, $charset) = @_;

    my $char_count = length($charset);
    my $total_attempts = 0;
    my $global_start = time();
    my $last_update = $global_start;

    for my $len ($min_len .. $max_len) {
        set_color($::FG_YELLOW);
        print "\r" . (" " x 80) . "\r";
        print "[*] Starting Length $len (Estimated Combinations: " . ($char_count ** $len) . ")\n";
        reset_color();
        
        my @indices = (0) x $len;
        my $max_val = $char_count - 1;
        
        while (1) {
            my $password = "";
            for (my $i = 0; $i < $len; $i++) {
                $password .= substr($charset, $indices[$i], 1);
            }
            
            $total_attempts++;
            
            my $test_hash = generate_hash($password, $hash_type);
            if ($test_hash && $test_hash eq $hash) {
                my $elapsed = time() - $global_start;
                print "\r" . (" " x 80) . "\r";
                set_color($::FG_GREEN);
                print "[+] SUCCESS: Hash cracked via BRUTE-FORCE!\n";
                print "[+] Password: $password\n";
                printf "[+] Total Time: %.2fs | Total Attempts: %d\n", $elapsed, $total_attempts;
                reset_color();
                return 1;
            }
            
            my $current_time = time();
            if ($current_time - $last_update >= 0.1) {
                my $elapsed = $current_time - $global_start;
                my $speed = $elapsed > 0 ? int($total_attempts / $elapsed) : 0;
                printf "\rAttempts: %d | Speed: %d/s | Current: %s", $total_attempts, $speed, $password;
                $last_update = $current_time;
            }

            my $carry = 1;
            for (my $i = $len - 1; $i >= 0 && $carry; $i--) {
                $indices[$i]++;
                $carry = 0;
                if ($indices[$i] > $max_val) {
                    $indices[$i] = 0;
                    $carry = 1;
                }
            }
            
            last if $carry;
        }
    }
    
    my $total_elapsed = time() - $global_start;
    print "\r" . (" " x 80) . "\r";
    set_color($::FG_RED);
    print "\n[-] FAILED: Hash not found via brute-force\n";
    printf "[-] Total attempts: %d | Total time: %.2fs\n", $total_attempts, $total_elapsed;
    reset_color();
    return 0;
}

sub bruteforce_attack {
    my ($hash, $hash_type) = @_;
    
    my $min_len;
    my $max_len;
    my $charset;

    set_color($::FG_CYAN);
    print "\n" . "=" x 60 . "\n";
    print "                 BRUTE-FORCE ATTACK\n";
    print "=" x 60 . "\n";
    reset_color();

    print "Choose attack mode:\n";
    print "  1. NUMERIC (0-9) [1-6 chars]\n";
    print "  2. LOWERCASE + NUMBERS (a-z0-9) [1-8 chars]\n";
    print "  3. ALL ALPHANUMERIC (a-zA-Z0-9) [1-6 chars]\n";
    print "  4. CUSTOM SETUP\n";
    print "  5. Back to Main Menu\n";
    print "\nChoose option (1-5): ";
    
    my $choice = <STDIN>;
    chomp($choice);

    if ($choice == 1) {
        $min_len = 1; $max_len = 6; $charset = "0123456789";
        print "[+] Mode: NUMERIC (0-9)\n";
    }
    elsif ($choice == 2) {
        $min_len = 1; $max_len = 8; $charset = "abcdefghijklmnopqrstuvwxyz0123456789";
        print "[+] Mode: LOWERCASE + NUMBERS\n";
    }
    elsif ($choice == 3) {
        $min_len = 1; $max_len = 6; $charset = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        print "[+] Mode: ALL ALPHANUMERIC\n";
    }
    elsif ($choice == 4) {
        print "\nEnter MIN length: ";
        $min_len = <STDIN>; chomp $min_len; $min_len = int($min_len) || 1;
        print "Enter MAX length: ";
        $max_len = <STDIN>; chomp $max_len; $max_len = int($max_len) || 8;
        print "Enter characters to use: ";
        $charset = <STDIN>; chomp $charset;
        $charset ||= "abcdefghijklmnopqrstuvwxyz0123456789";
    }
    elsif ($choice == 5) {
        return;
    }
    else {
        print "[-] Invalid option!\n";
        return;
    }

    set_color($::FG_YELLOW);
    print "\n[+] Attack Parameters:\n";
    print "  Length Range: $min_len - $max_len\n";
    print "  Character Set: " . substr($charset, 0, 50) . (length($charset) > 50 ? "..." : "") . "\n";
    print "  Character Count: " . length($charset) . "\n";
    reset_color();
    
    print "\nPress Enter to begin brute-force...";
    <STDIN>;

    bruteforce_attack_core($hash, $hash_type, $min_len, $max_len, $charset);
}

# --- File System Functions ---

sub ensure_wordlist_dir {
    unless (-d $WORDLIST_DIR) {
        mkdir $WORDLIST_DIR or do {
            print "[-] ERROR: Cannot create wordlist directory!\n";
            return 0;
        };
        print "[+] Created wordlist directory: $WORDLIST_DIR\n";
    }
    return 1;
}

sub get_wordlists_from_dir {
    my @wordlists;
    my $dir = shift || $WORDLIST_DIR;
    
    if (-d $dir) {
        opendir(my $dh, $dir) or return @wordlists;
        while (my $file = readdir($dh)) {
            next if $file =~ /^\./;
            my $full_path = File::Spec->catfile($dir, $file);
            if (-f $full_path && $file =~ /\.(txt|lst|wordlist|dic)$/i) {
                push @wordlists, $full_path;
            }
        }
        closedir($dh);
    }
    
    return @wordlists;
}

# --- Encoding/Decoding Functions ---

sub detect_encoded_type {
    my $text = shift;
    
    return "HEX"     if $text =~ /^[0-9a-fA-F]+$/ && length($text) % 2 == 0 && length($text) > 2;
    # Adjusted Base64 detection to be more permissive, as strict length is not guaranteed for all base64 variants
    # The regex checks for valid characters.
    return "BASE64"  if $text =~ /^[A-Za-z0-9+\/=]+$/; 
    return "URL"     if $text =~ /%[0-9A-Fa-f]{2}/;
    return "PLAINTEXT";
}

sub encode_decode_menu {
    my $text = shift;
    
    my $detected_type = detect_encoded_type($text);
    
    set_color($::FG_CYAN);
    print "\n[*] Detected input type: $detected_type\n";
    reset_color();
    
    print "\nEncoding/Decoding Options:\n";
    print "  1. Encode to Base64\n";
    print "  2. Decode from Base64\n";
    print "  3. Encode to Hex (ASCII -> Hex)\n";
    print "  4. Decode from Hex (Hex -> ASCII)\n";
    print "  5. URL Encode\n";
    print "  6. URL Decode\n";
    print "  7. Back to main menu\n";
    print "Choose option (1-7): ";
    
    my $choice = <STDIN>;
    chomp($choice);
    
    my $result;
    
    if ($choice == 1) { 
        $result = encode_base64($text, '');
        print "[+] Base64: $result\n";
    }
    elsif ($choice == 2) { 
        eval { $result = decode_base64($text) };
        print $@ ? "[-] Invalid Base64!\n" : "[+] Decoded: $result\n";
    }
    elsif ($choice == 3) { 
        $result = unpack('H*', $text);
        print "[+] Hex: $result\n";
    }
    elsif ($choice == 4) { 
        eval { $result = pack('H*', $text) };
        print $@ ? "[-] Invalid Hex (must be even length and valid hex digits)!\n" : "[+] Decoded: $result\n";
    }
    elsif ($choice == 5) {
        $result = uri_escape($text);
        print "[+] URL Encoded: $result\n";
    }
    elsif ($choice == 6) {
        $result = uri_unescape($text);
        print "[+] URL Decoded: $result\n";
    }
    elsif ($choice == 7) { 
        return; 
    }
    else { 
        print "[-] Invalid choice!\n"; 
    }
    
    return undef;
}

# --- Main Menu System ---

sub main_menu {
    clear_screen(); 
    display_permanent_banner();
    
    set_color($::FG_WHITE);
    print "\n" . "=" x 60 . "\n";
    print "              PARALLEL CRACKING SUITE v4.7\n";
    print "=" x 60 . "\n";
    
    print "\nMain Operations:\n";
    print "  1. PARALLEL Multi-Wordlist Attack (Round-Robin)\n";
    print "  2. Single Wordlist Cracking\n";
    print "  3. Brute-Force Attack\n";
    print "  4. Encoding/Decoding Tools\n";
    print "  5. Hash Analysis\n";
    print "  6. Exit\n";
    print "\nChoose option (1-6): ";
    reset_color();
    
    my $choice = <STDIN>;
    chomp($choice);
    
    return $choice;
}

# --- Main Execution Loop ---

MAIN_LOOP: while (1) {
    my $choice = main_menu();
    
    if ($choice == 1) { 
        ensure_wordlist_dir();
        print "\nEnter hash to crack: ";
        my $hash = <STDIN>;
        chomp($hash);
        
        my $hash_type = detect_hash_type($hash);
        display_hash_info($hash, $hash_type);
        
        if ($hash_type eq "UNKNOWN") {
            print "[-] Cannot crack unknown hash type\n";
        } else {
            multi_wordlist_cracking($hash, $hash_type);
        }
    }
    elsif ($choice == 2) { 
        print "\nEnter hash to crack: ";
        my $hash = <STDIN>;
        chomp($hash);
        
        print "Enter path to wordlist: ";
        my $wordlist_path = <STDIN>;
        chomp($wordlist_path);

        my $hash_type = detect_hash_type($hash);
        display_hash_info($hash, $hash_type);
        
        if (-f $wordlist_path) {
            my ($success, $result, $attempts, $elapsed) = crack_single_wordlist($hash, $hash_type, $wordlist_path);
            
            if ($success) {
                set_color($::FG_GREEN);
                print "\n[+] SUCCESS: Hash cracked!\n";
                print "[+] Password: $result\n";
                printf "[+] Time: %.2fs | Attempts: %d\n", $elapsed, $attempts;
                reset_color();
            } else {
                set_color($::FG_RED);
                print "\n[-] FAILED: Hash not found in wordlist\n";
                printf "[-] Attempts: %d | Time: %.2fs\n", $attempts, $elapsed;
                reset_color();
            }
        } else {
            print "[-] Wordlist file not found: $wordlist_path\n";
        }
    }
    elsif ($choice == 3) { 
        print "\nEnter hash to crack: ";
        my $hash = <STDIN>;
        chomp($hash);
        
        my $hash_type = detect_hash_type($hash);
        display_hash_info($hash, $hash_type);
        
        if ($hash_type eq "UNKNOWN") {
            print "[-] Cannot brute-force unknown hash type\n";
        } else {
            bruteforce_attack($hash, $hash_type);
        }
    }
    elsif ($choice == 4) { 
        print "\nEnter text to encode/decode: ";
        my $text = <STDIN>;
        chomp($text);
        encode_decode_menu($text);
    }
    elsif ($choice == 5) { 
        print "\nEnter hash to analyze: ";
        my $hash = <STDIN>;
        chomp($hash);
        
        my $type = detect_hash_type($hash);
        display_hash_info($hash, $type);
    }
    elsif ($choice == 6) { 
        print "\n$::COLOR_RESET\nDOMINUS FRAUDIS Terminated.\n";
        last MAIN_LOOP;
    }
    else {
        print "[-] Invalid option!\n";
    }
    
    print "\nPress Enter to continue...";
    <STDIN>;
}

reset_color();
exit 0;