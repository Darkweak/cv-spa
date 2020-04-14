.PHONY: build build-client build-server cache composer-install composer-update copy-files help install migration-create migration-diff repopulate-db up update update-db

CONFIG_DIR=api/config
DC=docker-compose
DC_UP=$(DC) up -d --remove-orphans
DC_EXEC=$(DC) exec
BIN_CONSOLE=$(DC_EXEC) php bin/console
COPY_FILES_CLIENT=cp ./client/tsconfig.bak ./client/tsconfig.json
PREPARE_BUILD=$(COPY_FILES_CLIENT) && $(DC_EXEC) client yarn && $(DC_EXEC) ssr yarn

help:
	@grep -E '(^[0-9a-zA-Z_-]+:.*?##.*$$)|(^##)' $(MAKEFILE_LIST) | awk 'BEGIN {FS = ":.*?## "}; {printf "\033[32m%-25s\033[0m %s\n", $$1, $$2}' | sed -e 's/\[32m##/[33m/'

build: ## Build
	$(DC) build
	$(DC_UP)

build-client: ## Build project
	$(MAKE) up
	$(PREPARE_BUILD) build
	rm -rf client/public/dist
	$(DC_EXEC) client yarn build
	$(MAKE) build-server
	$(MAKE) cache
	$(MAKE) up

build-server: ## Build server project
	$(PREPARE_BUILD) server-build
	$(DC_EXEC) ssr yarn server-build
	$(MAKE) up

cache: ## Clear cache
	$(BIN_CONSOLE) cache:clear

composer-install: ## Install composer packages
	$(DC_EXEC) php composer install

composer-update: ## Update composer
	$(DC_EXEC) php composer update

copy-files: ## Setup for build project
	cp .env.dist .env
	$(MAKE) up
	$(MAKE) build

create-db: ## Create database
	$(BIN_CONSOLE) doctrine:database:create

deploy: up-prod build update install cache up ## Deploy command

drop-db: ## Drop database
	$(BIN_CONSOLE) doctrine:database:drop --force

install: composer-install migration-migrate ## Install and setup project

jwt: ## Generate JWT
	mkdir -p $(CONFIG_DIR)/jwt
	echo "$(jwt)" | openssl genpkey -out $(CONFIG_DIR)/jwt/private.pem -pass stdin -aes256 -algorithm rsa -pkeyopt rsa_keygen_bits:4096
	echo "$(jwt)" | openssl pkey -in $(CONFIG_DIR)/jwt/private.pem -passin stdin -out $(CONFIG_DIR)/jwt/public.pem -pubout
	chmod 777 $(CONFIG_DIR)/jwt/*

migration-down: ## Remove migration
	$(BIN_CONSOLE) doctrine:migrations:execute --down $(migration)

migration-diff: ## Make the diff
	$(BIN_CONSOLE) doctrine:migrations:diff

migration-generate: ## Create new migration
	$(BIN_CONSOLE) doctrine:migrations:generate

migration-migrate: ## Execute unlisted migrations
	$(BIN_CONSOLE) doctrine:migrations:migrate --quiet

reset-db: drop-db create-db migration-migrate ## Reset database

up: ## Start containers
	$(DC_UP)

up-dev: ## Start containers dev
	cp .env.dev .env
	cp docker-compose.yml.dev docker-compose.yml
	$(MAKE) up

up-prod: ## Start containers prod
	cp .env.prod .env
	cp docker-compose.yml.prod docker-compose.yml
	$(MAKE) up

update: ## Update containers composer packages then re-up containers
	$(DC) pull
	$(MAKE) composer-update
	$(MAKE) up

update-db: ## Update database schema force
	$(BIN_CONSOLE) doctrine:schema:update --force
