# Setup guide

## Prerequisites

1. [Install Docker](https://docs.docker.com/engine/install/)
2. Fork this repo (please do so in a private repository, they're free now!)
3. Choose a code editor 
   - We recommend the [PhpStorm EAP](https://www.jetbrains.com/phpstorm/nextversion/)
   - It's free, and we share configuration in this repository to get you up and running quickly
   - But feel free to use whatever you're comfortable with
4. _(optional)_ [Install Postman](https://learning.postman.com/docs/getting-started/installation-and-updates/) to easily test the API manually

## Setup

To get setup and ready to go, run the following commands in the root of the repository.

```shell
# Build the necessary docker containers
# It might take a few minutes, so grab a coffee (or a beer, it's 5 o'clock somewhere!)
$ docker composer build

# Start the docker containers so that you can access the environment
$ docker compose up

# Create the database (but not the schema)
$ docker compose run make create-db

# Run the database migrations to create the schema
$ docker compose run make migrate

# Load some fixtures into the database so that you have something to play with
$ docker compose run php make fixtures

# Create the test database and schema (fixtures are loaded and refreshed automatically for tests)
$ docker compose run make test-db
```

You can now access the application at <http://localhost:8080>!

## Usage

### CLI

```shell
# Get into interactive PHP
$ docker compose run php

# Get a shell into a PHP container
$ docker compose run php sh

# Run the entire test suite
$ docker compose run make test

# Run Psalm static analysis
$ docker compose run make psalm
```

### Xdebug

Xdebug is configured to connect to your IDE over port 9000. Once you set a breakpoint, you will probably have to:
1. Enable xdebug in your IDE (tell it to start listening for connections)
   ![Enable xdebug in PhpStorm](/resources/phpstorm-listen-xdebug.png)
2. Set the XDEBUG_SESSION GET parameter (not necessary for tests)

Now you should be able to run the code with either PhpUnit or by hitting an endpoint. At this point, your IDE might 
ask you to set up path mappings or servers. You need to map the repository root to `/var/www/html`. This is how it's
configured in PhpStorm:

![PhpStorm path mapping](/resources/phpstorm-path-mapping.png)

See the following sections for more details on using Xdebug.

### Postman

To get started quickly you can import the [Mobjack Postman collection](/resources/postman.json) by following
[this guide](https://learning.postman.com/docs/getting-started/importing-and-exporting-data/).

The Postman collection contains endpoints to create, patch and list subcontractors. You can easily tweak the request
data to manually test your implementation.

If you want to use Xdebug with Postman, you can enable the XDEBUG_SESSION GET parameter on each request:

![Using xdebug with Postman](/resources/postman-xdebug.png)

### PhpStorm

TODO: how to configure the interpreter, test framework and database access

PhpStorm allows you to run individual tests easily. Just open a PhpUnit test, click the green "play" button on the left
hand side, then choose the "Run ..." option.
![Running tests in PhpStorm](/resources/phpstorm-tests.png)

![Running tests in PhpStorm](/resources/phpstorm-run-test.png)

If you want to use Xdebug, choose the "Debug ..." option.

![Running tests with in PhpStorm](/resources/phpstorm-debug-test.png)
