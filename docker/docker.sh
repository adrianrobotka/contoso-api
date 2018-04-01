#!/bin/bash

# ------------------ Methods --------------------------
function scriptUsage
{
	echo "Usage: $0 [METHOD]"
	echo "Methods:"
	echo "  mseed	migrate and seed database"
	echo "  reset		drop database database"
	echo "  hardreset	drop database database"
	echo "  compose	run composer install (on docker)"
	echo "  serve|up	run laravel dev server (on docker)"
	echo "  init		set .env"
	echo "  sql		mysql cli"
	echo "  cmd		bash to laravel"
	echo "  up		docker-compose *MAGIC* up (daemon)"
	echo "  down		docker-compose *MAGIC* down"
	echo "  build		docker-compose *MAGIC* build"
	echo "  repo		update serverbox repo in storage"
}

function composerUpdate
{
	docker run --rm -v $(pwd)/..:/app composer/composer update
}

function composerDump
{
	docker run --rm -v $(pwd)/..:/app composer/composer dump
}

function initLaravel
{
	docker exec -i -t contoso_app_1 cp .env.example .env
	docker exec -i -t contoso_app_1 php artisan key:generate
}

function mSeedLaravel
{
	docker exec -i -t contoso_app_1 php artisan migrate
	docker exec -i -t contoso_app_1 php artisan db:seed
}

function cmdLaravel
{
	docker exec -i -t contoso_app_1 bash
}

function resetLaravel
{
	docker exec -i -t contoso_app_1 php artisan migrate:reset
}

function hardResetLaravel
{
    docker-compose down
    docker volume rm contoso_dbdata
}

function sql
{
    mysql -P 33061 -h127.0.0.1 -uhomestead -psecret homestead
}

# ------------------ Main --------------------------
if [ "$1" = "" ]; then
	scriptUsage

elif [ "$1" = "init" ]; then
	initLaravel

elif [ "$1" = "mseed" ]; then
	mSeedLaravel

elif [ "$1" = "cmd" ]; then
	cmdLaravel

elif [ "$1" = "dump" ]; then
	composerDump

elif [ "$1" = "reset" ]; then
	resetLaravel

elif [ "$1" = "hardreset" ]; then
	hardResetLaravel

elif [ "$1" = "compose" ]; then
	composerUpdate

elif [ "$1" = "serve" ]; then
	docker-compose --project-name contoso up

elif [ "$1" = "up" ]; then
	docker-compose --project-name contoso up -d

elif [ "$1" = "down" ]; then
	docker-compose --project-name contoso down

elif [ "$1" = "build" ]; then
	docker-compose --project-name contoso build

elif [ "$1" = "sql" ]; then
	sql

elif [ "$1" = "repo" ]; then
	updateRepo

else
	echo "Unknown command: $1"
	scriptUsage
	
fi
