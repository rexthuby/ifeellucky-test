## About this app

This application was made as a test task for the **NuxGame** company. The description of the task can be found in the file "Test Task PHP Developer.pdf"

## Technologies used

* PHP+Laravel 10
* Ts+Vue3
* Tailwind
* Mysql+Redis

## How to run a project locally on linux



1. In linux terminal input: `git clone https://github.com/rexthuby/ifeellucky-test.git`
2. `cd ifeellucky-test`
3. `cp .env.example .env`
4. `sudo composer update`
5. `sudo npm install`
6. `php artisan key:generate`
7. `sudo chmod 777 -R ./`
8. `docker-compose build`
9. `docker-compose up -d`
10. `docker exec -it ifeel_backend bash`
11. now in container terminal run `php artisan migrate`
12. `exit`
13. in linux terminal `sudo chmod 777 -R ./`
14. `docker-compose restart`
15. in browser go to [localhost](http://localhost)

#### How to run test

1. `docker-compose up -d`
2. `docker exec -it ifeel_backend bash`
3. `php artisan test`
