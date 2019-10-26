#!/usr/bin/make -f

ROOT_DIR:=$(shell dirname $(realpath $(lastword $(MAKEFILE_LIST))))

help:
	@echo ""
	@echo "usage: make COMMAND"
	@echo ""
	@echo "Commands:"
	@echo "  app-init                   Install project"
	@echo "  app-run                    Run app"
	@echo "  app-restart                Restart app"
	@echo "  app-stop                   Stop app"
	@echo "  app-cache-clear            Clear app cache"
	@echo "  app-validate               Validate application and security_check"
	@echo "  phpunit-init               Prepare env for testing"
	@echo "  phpunit-run                Start phpunit tests"
	@echo "  database-migrate           Apply app migrations"
	@echo "  database-diff              Show diff in migrations"
	@echo "  database-rollback          Rollback to previous migration version"
	@echo "  database-load              Load fixtures with data purge"

app-init:
	docker-compose up -d app_cli
	docker-compose exec -T app_cli sh -c "/var/www/bin/setup-init.sh"

app-run:
	docker-compose up -d

app-restart:
	docker-compose restart

app-stop:
	docker-compose down -v

app-cache-clear:
	docker-compose up -d app_cli
	docker-compose exec -T app_cli sh -c "bin/console cache:clear"

app-validate:
	docker-compose up -d app_cli
	docker-compose exec -T app_cli sh -c "composer install --prefer-dist --no-scripts --optimize-autoloader && \
		composer validate && \
		bin/console doctrine:schema:validate --skip-sync && \
		vendor/bin/security-checker security:check"

phpunit-init:
	docker-compose up -d app_cli
	docker-compose exec -T app_cli sh -c "bin/setup-test.sh"

phpunit-run:
	docker-compose up -d app_cli
	docker-compose exec -T app_cli sh -c "vendor/bin/simple-phpunit -c phpunit.xml"

database-migrate:
	docker-compose up -d app_cli
	docker-compose exec -T app_cli sh -c "bin/console doctrine:migration:migrate -n"

database-diff:
	docker-compose up -d app_cli
	docker-compose exec -T app_cli sh -c "bin/console doctrine:migration:diff --formatted"

database-rollback:
	docker-compose up -d app_cli
	docker-compose exec -T app_cli sh -c "bin/console doctrine:migration:migrate prev -n"

database-load:
	docker-compose up -d app_cli
	docker-compose exec -T app_cli sh -c "bin/console doctrine:fixtures:load -n"
