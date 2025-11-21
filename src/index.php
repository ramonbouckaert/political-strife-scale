<?php
require __DIR__ . '/common.php';

$value = strife_get_value_from_request();

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Political Strife Scale</title>
    <style>
        html, body {
            height: 100%;
	        margin: 0;
            font-family: Arial Narrow, Arial, sans-serif; 
        }
        body, .scale {
            display: flex;
	        align-items: center;
            flex-direction: column;
	    }
        body {
            justify-content: space-around;
	    }
        .scale {
            width: 200px;
        }
        img {
            max-width: 100%;
            height: auto;
        }
        input[type="range"] {
            width: 200px;
            margin: 0;
        }
        .scale-labels {
            display: flex;
	        justify-content: space-between;
            width: 200px;
	    }
        .scale-labels span {
	        display: inline-block;
            font-size: 11px;
            writing-mode: vertical-lr;
            transform: translate(-5.5px) rotate(-45deg);
            transform-origin: top right;
	        white-space: nowrap;
            width: 0;
            flex-grow: 1;
            align-content: end;
        }
        .wider {
            flex-grow: 2 !important;
        }
        .scale-labels span a {
            text-decoration: none;
            color: inherit;
        }
        .footer {
            font-size: 11px;
        }
    </style>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta property="og:title" content="Political Strife Scale">
    <meta property="og:description" content="A highly scientific gauge of exactly how cooked things are for you right now.">
    <meta property="og:type" content="website">
    <meta property="og:url" content="https://politicalstrifescale.com/<?= $value ?>">

    <meta property="og:image" content="https://politicalstrifescale.com/<?= $value ?>.png">
    <meta property="og:image:width" content="800">
    <meta property="og:image:height" content="480">
    <meta property="og:image:alt" content="A semicircular dial showing levels from Colourful to Disgraced, with a needle pointing at the current level.">

    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="Political Strife Scale">
    <meta name="twitter:description" content="A highly scientific gauge of exactly how cooked things are for you right now.">
    <meta name="twitter:image" content="https://politicalstrifescale.com/<?= $value ?>.png">
    <meta name="twitter:image:alt" content="A semicircular dial showing levels from Colourful to Disgraced, with a needle pointing at the current level.">
</head>
<body>
    <img
        alt="Political Strife Scale"
	src="<?= $value ?>.png"
        width=800
        height=480
    >
    <div class="scale">
        <label for="temp">Generate a new image:</label><br />
        <input type="range" id="new_position" name="new_position" list="markers" step="1" value="<?= $value ?>" />

        <datalist id="markers">
            <option value="0">Colourful</option>
            <option value="9">Controversial</option>
            <option value="18">Under Pressure</option>
            <option value="27">Troubled</option>
            <option value="44">Beleaguered</option>
            <option value="61">Embattled</option>
            <option value="80">Former</option>
            <option value="100">Disgraced</option>
        </datalist>

        <div class="scale-labels">
            <span><a href="/colourful">Colourful</a></span>
            <span><a href="/controversial">Controversial</a></span>
            <span><a href="/underpressure">Under Pressure</a></span>
            <span><a href="/troubled">Troubled</a></span>
            <span class="wider"><a href="/beleaguered">Beleaguered</a></span>
            <span class="wider"><a href="/embattled">Embattled</a></span>
            <span class="wider"><a href="/former">Former</a></span>
            <span class="wider"><a href="/disgraced">Disgraced</a></span>
        </div>
    </div>

    <script>
        const slider = document.getElementById('new_position');

        slider.addEventListener('change', () => {
            const value = slider.value;
            if (value !== '') {
                window.location.href = window.location.origin + "/" + encodeURIComponent(value);
            }
        });
</script>
<footer class="footer">
  &copy; 2025 Ramon Bouckaert. All rights reserved. Source code available <a href="https://github.com/ramonbouckaert/political-strife-scale">here</a>.
</footer>
</body>
</html>

