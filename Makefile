# Simple Makefile with help
# thanks to https://gist.github.com/mpneuried/0594963ad38e68917ef189b4e6a269db

default_php_version:=7.4
php_version:=$(PHP_VERSION)
ifndef PHP_VERSION
	php_version:=$(default_php_version)
endif

docker:=docker run --rm -u=$(shell id -u):$(shell id -g) -e COMPOSER_HOME=/tmp -v tmpfs:/tmp -v $(CURDIR):/app -w /app elegant-bro/money:$(php_version)

.PHONY: help

help: ## This help.
	@awk 'BEGIN {FS = ":.*?## "} /^[a-zA-Z_-]+:.*?## / {printf "\033[36m%-30s\033[0m %s\n", $$1, $$2}' $(MAKEFILE_LIST)

.DEFAULT_GOAL := help

build: ## build selected version of elegant-bro/money docker image
	docker build --build-arg VERSION=$(php_version) --tag elegant-bro/money:$(php_version) ./docker/

build-nc: ## Build the container without caching
	docker build --no-cache --build-arg VERSION=$(php_version) --tag elegant-bro/money:$(php_version) ./docker/

exec: build ## fall into running container
	docker run --rm -ti -u=$(shell id -u):$(shell id -g) -e COMPOSER_HOME=/tmp -v tmpfs:/tmp -v $(CURDIR):/app:rw -w /app elegant-bro/money:$(php_version) sh

install: build ## install library dependencies
	$(docker) composer install

install-no-dev: build ## install library production dependencies
	$(docker) composer install --no-dev

static-check: build install ## run static analyser - phpstan
	$(docker) vendor/bin/phpstan analyse

style-check: build install ## run code style checker - phpcs
	$(docker) vendor/bin/phpcs -p --standard=PSR12 src

style-fix: build install ## run code style fix - phpcbf
	$(docker) vendor/bin/phpcbf -p --standard=PSR12 src

unit: build install  ## run unit testing with coverage report
	$(docker) -dzend_extension=xdebug.so -dxdebug.mode=coverage  vendor/bin/phpunit

coverage: build install unit ## check coverage to be 100%
	$(docker) php check-coverage.php coverage.xml 100

all: build install style-check unit coverage
