# Application template

## Features

* [Clean architecture](https://blog.cleancoder.com/uncle-bob/2012/08/13/the-clean-architecture.html) structure
* Symfony 5
* docker-compose configuration with separate fpm container
* Performance improvements for dev: separate cache and logs volumes, vendor folder excluded from mounting

## Running

* Use docker-compose 
* Access [http://localhost:5000/](http://localhost:5000/)


## // todo:

* ~~github~~
* production: separate image targets
* production: make cache-warmup with root user instead of having cache folder www-data writable.
* entire deployment pipeline
* production: not depend on .env file
* install phpunit-speedtrap
* figure out a way for easy composer commands since no longer mounting /vendor folder