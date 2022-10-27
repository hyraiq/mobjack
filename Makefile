.PHONY: create-db
create-db:
	bin/console doctrine:database:create

.PHONY: migrate
migrate:
	bin/console doctrine:migrations:migrate

.PHONY: cache
cache:
	bin/console cache:clear

.PHONY: psalm
psalm:
	vendor/bin/psalm

.PHONY: fixtures
fixtures:
	bin/console hautelook:fixtures:load --no-bundles --no-interaction

.PHONY: test-db
test-db:
	bin/console doctrine:database:drop --env test --force
	bin/console doctrine:database:create --env test
	bin/console doctrine:schema:create --env test

.PHONY: test-cache
test-cache:
	bin/console cache:clear --env test
