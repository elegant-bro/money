[![Build Status](https://travis-ci.com/elegant-bro/money.svg?branch=master)](https://travis-ci.com/elegant-bro/money)


# Tests
Install dependencies

`docker run --rm -ti -v $PWD:/app composer install`

Run tests

`docker run --rm -ti -v $PWD:/app -w /app php:7.1-cli-alpine vendor/bin/phpunit`

Test code style
`docker run --rm -ti -v $PWD:/app -w /app php:7.1-cli-alpine vendor/bin/ecs --level psr12 check src`
