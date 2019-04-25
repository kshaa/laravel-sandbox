# DOCKER LEMP (Laravel)
Forked from [atillay/docker-lemp](https://github.com/atillay/docker-lemp)

# Services
- Nginx
- PHP 7.2-fpm (+ laravel installer + initscript)
- MySQL
- PHPMyAdmin
- Maildev

## :rocket: Quickstart 
- Install and launch Docker  
- `cp .env.dist .env`  
- `docker-compose up`

| Service      | Path                    |
| ------------ | ----------------------- |
| Website      | `http://localhost:8080` | 
| PhpMyAdmin   | `http://localhost:8081` |
| Mail catcher | `http://localhost:8082` |
| Logs         | `log/`                  |

## :whale: Docker images
https://github.com/atillay/docker-images/tree/master/lemp

## :tent: Use a virtual host
- On your machine, run `$ sudo nano /etc/hosts` and add `127.0.0.1   myhost.local`
- Change the server name in `docker/nginx/nginx.conf#L3` to `myhost.local`
- Modify `.env` and set `SERVER_PORT=80`
- Run `$ docker-compose up`
- If it fails make sure no service like Apache is running on port 80 

## About MySQL credentials
If you change mysql credentials in .env you have to re-create mysql container:
- Database will be deleted, make a dump with PhpMyAdmin
- Remove container and volume : `$ docker-compose rm -fv mysql`
- Run : `docker-compose up` 
- Re-import your database on PhpMyAdmin

# Laravel
```
docker-compose build # Build Laravel Dockerfile
docker-compose up -d # Run all containers
docker-compose run php createapp myapp # Create app
docker-compose run php artisan [...] # Run Laravel Artisan CLI commands
```