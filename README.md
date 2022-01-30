# Lara CW

Api Cloudways

<p><img src="https://github.com/rockbuzz/lara-cw/workflows/Main/badge.svg"/></p>

## Requirements

PHP >=7.3

## Install

```bash
$ composer require rockbuzz/lara-cw
```

## Usage

.env

```php
 // Turn auto deploy on or off, default: true
CW_ENABLED

// Define the deployment environment, default: staging
CW_ENV=

// Defines the uri that webhooks will use, default: _deploy
CW_DEPLOY_URI=

// Set authentication and repository values
CW_API_KEY=
CW_API_URL=
CW_EMAIL=
CW_SERVER_ID=
CW_APP_ID=
CW_DEPLOY_PATH=
CW_GIT_URL=
CW_BRANCH_NAME=
```

add uri in csrf middleware

```php
<?php

namespace App\Http\Middleware;

use Symfony\Component\HttpFoundation\Cookie;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    //... 

    public function __construct()
    {
        $this->except += config('cw.deploy_uri');
    }

    //...
}
```

## Optional

```php
$ php artisan vendor:publish --provider="Rockbuzz\LaraCW\ServiceProvider" --tag="config"
```
## License

The Lara CW is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).