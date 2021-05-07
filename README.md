# Laravel Webshop

![CI](https://github.com/github/docs/actions/workflows/ci.yml/badge.svg)

A webshop built with Laravel. Primarily built to learn some more about Laravel and to try out PHP 8.

## Development environment

This project comes with a `docker-compose.yml` file for development. This composer file includes the following services:

- Php 8.0 fpm
- Nginx
- PostgreSQL
- Redis

Run `docker compose up` to start the services.

### Utility scripts

The make interacting with the php container a bit easier, some utility scripts have been included in the 
`dev/scripts` folder.

- `./dev/scripts/composer ...` Run a composer command in the php container.
- `./dev/scripts/artisan ...` Run an artisan command in the php container.
- `./dev/scripts/download-vendor` Download the vendor files from the php container to the host system. (Useful for 
  autocompletion in IDE's)
