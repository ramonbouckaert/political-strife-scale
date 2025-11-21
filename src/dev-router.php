<?php
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$docRoot = __DIR__;

if (preg_match('#^/(.*?/)?([^/]+)\.svg$#', $uri, $m)) {
    require $docRoot . '/svg.php';
    return false;
}

if (preg_match('#^/(.*?/)?([^/]+)\.png$#', $uri, $m)) {
    require $docRoot . '/png.php';
    return false;
}

return false;