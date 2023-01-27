.PHONY: create-db
create-db:
	bin/console doctrine:database:create

.PHONY: drop-db
drop-db:
	bin/console doctrine:database:drop --force

.PHONY: migrate
migrate:
	bin/console doctrine:migrations:migrate --no-interaction

.PHONY: cache
cache:
	bin/console cache:clear

.PHONY: test
test:
	vendor/bin/phpunit

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

.PHONY: tw-compile
tw-compile:
	npx tailwindcss -i ./public/assets/src/tailwind.css -o public/assets/dist/tailwind.css
