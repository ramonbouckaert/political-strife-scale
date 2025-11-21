# Political Strife Scale
![An example Political Strife Scale](example.png?raw=true)

A tiny web app that generates a shareable "political strife" meter image based on a slider position from 0 to 100. A hosted instance of this can be found at [https://politicalstrifescale.com/].

## How it works
- `index.php` renders a HTML file that contains the image, slider control and labels.
- Requests to `/{value}` are routed to a PHP script (e.g. `svg.php` or `png.php`) which:
    - Parses the numeric value.
    - Produces the political strife meter as an SVG with the correct needle position.
    - If necessary, renders that SVG into a PNG image using the `resvg` CLI tool.
- Common logic is kept in `common.php`
- Web server should be configured so URLs like `/42.png` or `42.svg` are rewritten to point to the correct script, falling back to `index.php`.

## Running locally
1. Clone the repository:
    ```bash
    git clone https://github.com/your-username/political-strife-scale.git
    cd political-strife-scale/src
    ```
2. Install `resvg` on your system:
    ```bash
   sudo apt install resvg // or
   sudo cargo install resvg
    ```
3. Ensure the Impact font is also installed on your system - it is needed for resvg to rasterise the text in the image:
    ```bash
    sudo apt install ttf-mscorefonts-installer
    ```
4. Start a simple PHP dev server (adjust if you’re using something else):
    ```bash
    php -S localhost:8000 dev-router.php
    ```
5. Open in your browser
    ```
    http://localhost:8000
    ```
   Move the slider, watch the URL change, and the generated image update.

### Deployment
- Copy `index.php`, `common.php`, `svg.php` and `png.php` into your webroot.
- Configure your web server (e.g. Caddy) with rewrites such that paths to URLs like `/42.png` or `42.svg` are sent to `png.php` and `svg.php` respectively, and everything else falls back to `index.php`.
  Example Caddyfile is provided below:
    ```caddyfile
    your-domain.com {
        root * /path/to/webroot
    
        @getsvg path_regexp getsvg ^/(.*\/)?([^/]+)\.svg$
        rewrite @getsvg /svg.php/{re.getsvg.2}
    
        @getpng path_regexp getpng ^/(.*\/)?([^/]+)\.png$
        rewrite @getpng /png.php/{re.getpng.2}

        php_fastcgi unix//run/php/php.sock {
            try_files {path} {path}.php {path}/index.php index.php
        }
    
        file_server
    }
    ```
