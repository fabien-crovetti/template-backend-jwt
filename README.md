
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

### Create data tables:
``./bin/console doctrine:migrations:migrate``

### Load fixtures :
``./bin/console doctrine:fixtures:load``


## Usage

### Create user command :
``./bin/console app:create-user userEmail userPassword``

### Générate JWT TOKEN :
``curl -X POST -H "Content-Type: application/json" http://localhost:8222/api/login_check -d '{"username":"userEmail","password":"userPassword"}'``

### Use TOKEN  :
add :
``Authorization: Bearer {jwtToken}``
on header request
