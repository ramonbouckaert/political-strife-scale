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
        .btn {
            appearance: none;
            -webkit-appearance: none;

            display: inline-block;
            padding: 0.35em 0.9em;
            border: 1px solid #d0d0d0;
            border-radius: 4px;

            background: #f3f3f3;
            color: #000;
            font: 400 13px system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
            text-decoration: none;
            text-align: center;

            box-shadow: 0 1px 0 rgba(0, 0, 0, 0.06);
            cursor: pointer;
        }
        .btn:hover {
            background: #e9e9e9;
            border-color: #c0c0c0;
        }
        .btn:active {
            background: #dcdcdc;
            box-shadow: inset 0 1px 2px rgba(0, 0, 0, 0.18);
        }
        .btn:focus-visible {
            outline: 2px solid #2684ff;
            outline-offset: 2px;
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
            text-align: center;
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
    <div>
        <a href="<?= $value ?>.png" download="strife.png" class="btn">Download PNG</a>
        <a href="<?= $value ?>.svg" download="strife.svg" class="btn">Download SVG</a>
    </div>
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
            <span style="color: #4caf50"><a href="/colourful">Colourful</a></span>
            <span style="color: #81c784"><a href="/controversial">Controversial</a></span>
            <span style="color: #4fc3f7"><a href="/underpressure">Under Pressure</a></span>
            <span style="color: #2196f3"><a href="/troubled">Troubled</a></span>
            <span class="wider" style="color: #d6c100"><a href="/beleaguered">Beleaguered</a></span>
            <span class="wider" style="color: #ffa31a"><a href="/embattled">Embattled</a></span>
            <span class="wider" style="color: #f44336"><a href="/former">Former</a></span>
            <span class="wider" style="color: #b71c1c"><a href="/disgraced">Disgraced</a></span>
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
  &copy; 2025 Ramon Bouckaert.<br />Images generated by this site are free to use for any purpose, including commercial use, with no attribution required.<br />Source code available <a href="https://github.com/ramonbouckaert/political-strife-scale">here</a>.
</footer>
</body>
</html>

