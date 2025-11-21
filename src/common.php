<?php

function strife_get_value_from_request(): float
{
    $path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    $lowerPath = strtolower($path);

    $labels = [
        'colourful'      => 4,
        'controversial'  => 12,
        'underpressure' => 21,
        'troubled'       => 29,
        'beleaguered'    => 42,
        'embattled'      => 59,
        'former'         => 75,
        'disgraced'      => 99,
    ];

    $value = null;

    foreach ($labels as $label => $mapped) {
        if (strpos($lowerPath, $label) !== false) {
            $value = $mapped;
            break;
        }
    }

    if ($value === null) {
        $segments = explode('/', trim($path, '/'));

        for ($i = count($segments) - 1; $i >= 0; $i--) {
            $seg = $segments[$i];
            if ($seg === '') {
                continue;
            }
            if (preg_match('/^\d+(?:\.\d+)?\.?(png|svg)?$/', $seg)) {
                $value = (float)$seg;
                break;
            }
        }
    }

    if ($value === null) {
        $value = 16.0;
    }

    if ($value < 0) {
        $value = 0;
    } elseif ($value > 100) {
        $value = 100;
    }

    return round($value);
}

function strife_render_svg(?float $value = null): string
{
    if ($value === null) {
        $value = strife_get_value_from_request();
    }

    $angle = ($value / 100.0) * 180.0 - 90.0;

    $angleAttr = htmlspecialchars((string)$angle, ENT_QUOTES, 'UTF-8');

    return <<<SVG
<svg xmlns="http://www.w3.org/2000/svg"
     width="800" height="480" viewBox="0 0 800 480">
    <defs>
        <style><![CDATA[
            @import url('https://fonts.cdnfonts.com/css/impact');

            svg {
                font-family: 'Impact', sans-serif;
            }
        ]]></style>

        <pattern id="disgracedStripes" patternUnits="userSpaceOnUse"
                 width="25" height="25" patternTransform="rotate(60)">
            <rect width="25" height="25" fill="#b71c1c"/>
            <line x1="0" y1="0" x2="0" y2="25" stroke="#000000" stroke-width="25"/>
        </pattern>
    </defs>

    <!-- 1: COLOURFUL (180→165) -->
    <path d="
        M 40.00,380.00
        A 360,360 0 0 1 52.27,286.83
        L 293.75,351.53
        A 110,110 0 0 0 290.00,380.00
        Z"
          fill="#4caf50" stroke="#000000" stroke-width="6"/>

    <!-- 2: CONTROVERSIAL (165→150) -->
    <path d="
        M 52.27,286.83
        A 360,360 0 0 1 88.23,200.00
        L 304.74,325.00
        A 110,110 0 0 0 293.75,351.53
        Z"
          fill="#81c784" stroke="#000000" stroke-width="6"/>

    <!-- 3: UNDER PRESSURE (150→135) -->
    <path d="
        M 88.23,200.00
        A 360,360 0 0 1 145.44,125.44
        L 322.22,302.22
        A 110,110 0 0 0 304.74,325.00
        Z"
          fill="#4fc3f7" stroke="#000000" stroke-width="6"/>

    <!-- 4: TROUBLED (135→120) -->
    <path d="
        M 145.44,125.44
        A 360,360 0 0 1 220.00,68.23
        L 345.00,284.74
        A 110,110 0 0 0 322.22,302.22
        Z"
          fill="#2196f3" stroke="#000000" stroke-width="6"/>

    <!-- 5: BELEAGUERED (120→90) -->
    <path d="
        M 220.00,68.23
        A 360,360 0 0 1 400.00,20.00
        L 400.00,270.00
        A 110,110 0 0 0 345.00,284.74
        Z"
          fill="#ffeb3b" stroke="#000000" stroke-width="6"/>

    <!-- 6: EMBATTLED (90→60) -->
    <path d="
        M 400.00,20.00
        A 360,360 0 0 1 580.00,68.23
        L 455.00,284.74
        A 110,110 0 0 0 400.00,270.00
        Z"
          fill="#ffb74d" stroke="#000000" stroke-width="6"/>

    <!-- 7: FORMER (60→30) -->
    <path d="
        M 580.00,68.23
        A 360,360 0 0 1 711.77,200.00
        L 495.26,325.00
        A 110,110 0 0 0 455.00,284.74
        Z"
          fill="#f44336" stroke="#000000" stroke-width="6"/>

    <!-- 8: DISGRACED (30→0) -->
    <path d="
        M 711.77,200.00
        A 360,360 0 0 1 760.00,380.00
        L 510.00,380.00
        A 110,110 0 0 0 495.26,325.00
        Z"
          fill="url(#disgracedStripes)" stroke="#000000" stroke-width="6"/>

    <!-- Labels -->
    <g text-anchor="middle"
       dominant-baseline="middle">
        <text x="140" y="355" font-size="32">COLOURFUL</text>

        <text x="182" y="294" font-size="32"
              transform="rotate(22.5 185.29 291.06)">
            CONTROVERSIAL
        </text>

        <text x="210" y="243.5" font-size="32"
              transform="rotate(37.5 218.72 240.90)">
            UNDER PRESSURE
        </text>

        <text x="255" y="202.5" font-size="36"
              transform="rotate(52.5 261.99 200.15)">
            TROUBLED
        </text>

        <text x="330" y="167.5" font-size="40"
              transform="rotate(75 342.70 166.14)">
            BELEAGUERED
        </text>

        <text x="470" y="167.5" font-size="45"
              transform="rotate(-75 457.30 166.14)">
            EMBATTLED
        </text>

        <text x="570" y="220" font-size="45"
              transform="rotate(-45 562.71 217.29)">
            FORMER
        </text>

        <text x="635" y="350" font-size="45" fill="#FFFFFF">
            DISGRACED
        </text>
    </g>

    <!-- Needle -->
    <g fill="#ffffff" stroke="#000000" stroke-width="3"
       transform="translate(400 380) rotate({$angleAttr}) scale(0.65)">
        <path d="
            M -15 0
            A 15 15 0 0 0 15 0
            L 15 -210
            L 0 -270
            L -15 -210
            Z"/>
    </g>

    <text x="400" y="455"
          font-size="55"
          text-anchor="middle">
        POLITICAL STRIFE SCALE
    </text>
</svg>
SVG;
}

