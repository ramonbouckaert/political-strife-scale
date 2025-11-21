<?php
require __DIR__ . '/common.php';

header('Content-Type: image/svg+xml; charset=utf-8');
echo strife_render_svg();

