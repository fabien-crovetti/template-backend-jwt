
## Template Backend JWT

Quick start for Symfony backend project with JWT authentication

## Description

- Docker
- Php 8.2
- Symfony
    - jwt-refresh-token-bundle
    - jwt-authentication-bundle
    - nelmio api-doc-bundle
    - doctrine fixtures
- MariaDB 

## Getting started

### Run docker :
``docker compose up --build``

### Enter the docker container :
``docker exec -it template_backend_jwt_php bash``

### Create data tables :
``./bin/console doctrine:migrations:migrate``

### Load fixtures :
``./bin/console doctrine:fixtures:load``

### Generate JWT keypair :
``./bin/console lexik:jwt:generate-keypair``

### Create user command :
``./bin/console app:create-user userEmail userPassword``

### Générate JWT TOKEN :
``curl -X POST -H "Content-Type: application/json" http://localhost:8222/api/login_check -d '{"username":"userEmail","password":"userPassword"}'``


## Usage

> All route in ``/api`` endpoint are protected with authentication.
>
> Others routes can be used without authentication.

### Get no auth route content :
``curl -X GET -H "Content-Type: application/json" http://localhost:8222/time``


### Use TOKEN to get protected route content :
add :
``Authorization: Bearer {jwtToken}``
on header request

``curl -X GET -H "Content-Type: application/json" http://localhost:8222/api/user -H "Authorization: Bearer {token}"``
