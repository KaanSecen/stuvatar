include .env
export APP_PORT
export APP_URL

SAIL_DIR := ./vendor/bin/sail

install-first:
	docker run --rm \
        -u "$(id -u):$(id -g)" \
        -v $(pwd):/var/www/html \
        -w /var/www/html \
        laravelsail/php81-composer:latest \
        composer install --ignore-platform-reqs
install:
	@make build
	@make up
	@make composer-install
down:
	$(SAIL_DIR) down
build:
	$(SAIL_DIR) build --no-cache
up:
	$(SAIL_DIR) up -d
	sleep 5
	open $(APP_URL)
create-admin:
	$(SAIL_DIR) php artisan make:filament-user
upgrade-filament:
	@make composer-update
	$(SAIL_DIR) php artisan filament:upgrade
composer-install:
	$(SAIL_DIR) composer install
composer-update:
	$(SAIL_DIR) composer update
composer-require:
	@read -p "Enter package name: " package; \
	if ! $(SAIL_DIR) composer require $$package; then \
		echo "Package $$package not found."; \
	fi
composer-remove:
	@read -p "Enter package name: " package; \
	if ! $(SAIL_DIR) composer remove $$package; then \
		echo "Package $$package not found."; \
	fi
migrate-seed:
	$(SAIL_DIR) php artisan migrate
	$(SAIL_DIR) php artisan db:seed
migrate:
	$(SAIL_DIR) php artisan migrate
migrate-fresh:
	$(SAIL_DIR) php artisan migrate:fresh
seed:
	$(SAIL_DIR) php artisan db:seed
cache-clear:
	$(SAIL_DIR) php artisan cache:clear
view-clear:
	$(SAIL_DIR) php artisan view:clear
route-clear:
	$(SAIL_DIR) php artisan route:clear
config-clear:
	$(SAIL_DIR) php artisan config:clear
clear-all:
	@make cache-clear
	@make view-clear
	@make route-clear
	@make config-clear
link:
	$(SAIL_DIR) php artisan storage:link
test:
	$(SAIL_DIR) php artisan test
build-production:
	$(SAIL_DIR) build --no-cache --env=prod
logs:
	$(SAIL_DIR) tail -f storage/logs/laravel.log
