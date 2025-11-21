<?php
require __DIR__ . '/common.php';

$svg = strife_render_svg();

$binary = 'resvg';

$which = @shell_exec('command -v ' . escapeshellarg($binary));
if ($which === null || trim($which) === '') {
    http_response_code(500);
    header('Content-Type: text/plain; charset=utf-8');
    echo "resvg binary not found on PATH\n";
    echo "Tried command: command -v {$binary}\n";
    exit;
}

$resourcesDir = __DIR__;

$descriptorspec = [
    0 => ['pipe', 'r'],
    1 => ['pipe', 'w'],
    2 => ['pipe', 'w'],
];

$cmd = $binary
    . ' --resources-dir ' . escapeshellarg($resourcesDir)
    . ' -w 800 -h 480 - -c';

$process = proc_open($cmd, $descriptorspec, $pipes);

if (!is_resource($process)) {
    http_response_code(500);
    header('Content-Type: text/plain; charset=utf-8');
    echo "Failed to start resvg process\n";
    echo "Command: {$cmd}\n";
    exit;
}

fwrite($pipes[0], $svg);
fclose($pipes[0]);

// Read PNG
$pngData = stream_get_contents($pipes[1]);
fclose($pipes[1]);

// Read stderr
$stderr = stream_get_contents($pipes[2]);
fclose($pipes[2]);

$returnCode = proc_close($process);

if ($returnCode !== 0 || $pngData === '' || $pngData === false) {
    http_response_code(500);
    header('Content-Type: text/plain; charset=utf-8');

    echo "resvg failed\n";
    echo "Command: {$cmd}\n";
    echo "Exit code: {$returnCode}\n\n";

    echo "----- STDERR -----\n";
    echo $stderr . "\n\n";

    echo "----- FIRST 500 BYTES OF SVG -----\n";
    echo substr($svg, 0, 500) . (strlen($svg) > 500 ? "\n...\n" : "") . "\n";
    exit;
}

header('Content-Type: image/png');
header('Cache-Control: public, max-age=300');
echo $pngData;

