# Lara CW

Api Cloudways

<p><img src="https://github.com/rockbuzz/lara-cw/workflows/Main/badge.svg"/></p>

## Requirements

PHP >=7.4

## Install

```bash
$ composer require rockbuzz/lara-cw
```

## Usage

.env

```php

// Define the deployment environment, default: staging
CW_ENV=

// Defines the uri and middleware that webhooks will use, default: _deploy
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

## Optional

```php
$ php artisan vendor:publish --provider="Rockbuzz\LaraCW\ServiceProvider" --tag="config"
```
## License

The Lara CW is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).