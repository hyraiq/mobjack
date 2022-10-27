# mobjack
Backend technical challenge for ProcurePro

## Prerequisites

1. Docker
2. Code editor (we recommend PhpStorm EAP, it's free and will be automatically configured with this repository)
   1. Configure interpreter
   2. Configure test framework
   3. Configure database access
3. Postman -> install our postman collection

## Setup

1. `docker compose build`
2. `docker compose up`
3. `docker compose run php make create-db`
4. `docker compose run php make migrate`
5. `docker compose run php make test-db`
6. `docker compose run php make fixtures`

## Usage

Running tests:

Either use `docker compose run php make test` or click the play button in the test file in PhpStorm.

Running psalm:

`docker compose run php make psalm`

Using postman:

TODO

## Tasks

TODO
