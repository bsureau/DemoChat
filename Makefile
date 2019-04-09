.PHONY: help welcome build install install-dependencies db start stop goodbye
.DEFAULT_GOAL: help

include .env.dist

help:
	@grep -h -E '(^[a-zA-Z_-]+:.*?##.*$$)|(^##)' $(MAKEFILE_LIST) | awk 'BEGIN {FS = ":.*?## "}; {printf "\033[32m%-30s\033[0m %s\n", $$1, $$2}' | sed -e 's/\[32m##/[33m/'

##
#############################
###     HELP - MAKEFILE     #
#############################
##
##Project
##----------
##

build:
	@printf '\n##################################\n'
	@printf '#    BUILDING DOCKER SERVICES    #\n'
	@printf '##################################\n\n'
	docker-compose build --no-cache

start: ## Start the project
	@printf '\n##################################\n'
	@printf '#    START DOCKER CONTAINERS     #\n'
	@printf '##################################\n\n'
	docker-compose up -d

db:
	@printf '\n##################################\n'
	@printf '#             INIT DB            #\n'
	@printf '##################################\n'
	docker-compose exec php-fpm bin/console doctrine:database:create --if-not-exists
	docker-compose exec php-fpm bin/console doctrine:schema:update --force

install-dependencies:
	@printf '\n##################################\n'
	@printf '#      INSTALL DEPENDENCIES      #\n'
	@printf '##################################\n'
	docker run --rm --interactive --tty \
            --volume $(PWD)/api:/app \
            composer install

stop: ## Stop the project
	@printf '\n##################################\n'
	@printf '#     STOP DOCKER CONTAINERS     #\n'
	@printf '##################################\n\n'
	docker-compose stop

restart: stop start ## Restart the project

install: welcome .env build start install-dependencies db goodbye ## Install the project

welcome:
	@printf '##################################\n'
	@printf '#     INSTALLING DEMO CHAT       #\n'
	@printf '##################################\n'

goodbye:
	@printf '\nPROJECT IS NOW INSTALLED...\n\n'
	@printf '##################################\n'
	@printf '#         READY TO TEST!         #\n'
	@printf '##################################\n\n'

##
##

.env: .env.dist
	@if [ !  -f ".env" ]; \
	then \
		echo "cp .env.dist api/.env"; \
		cp .env.dist api/.env; \
		echo "cp .env.dist .env"; \
		cp .env.dist .env; \
	fi

##
