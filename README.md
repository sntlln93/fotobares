<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://fototobares.com/logo.svg" width="400"></a></p>

## About this project

This project consist in a fullstack application that allows the client to manage his bussiness; including sales, employees, payments, deliveries an production.

## Installation
First clone this repo and cd into project folder
```
git clone https://github.com/sntlln933/fotobares.git
cd fotobares
```

Then create the enviroment variables file from existing .env.example
```
cp .env.example .env
```

Make sure you have an Google Maps API Key and put it in .env file
```
...
MAP_KEY=your_key_goes_here
```

Install composer dependencies
```
composer install
```

At this point you should be able to start laravel with
```
./vendor/bin/sail up
```

Optionally you can setup an alias
```
alias sail='[ -f sail ] && bash sail || bash vendor/bin/sail'
```

Generate a key for the project and run the migrations
```
sail artisan key:generate
sail artisan migrate --seed
```

## Starting the container in the background
Similar to docker-compose, you can start sail in the background 
```
sail up -d
```

## Sail commands
Because your using docker through laravel sails the commands will be a little different. Here are some examples
```
sail artisan tinker
sail artisan make:controller DoSomething
sail composer dump-autoload
sail mysql -u sail -p
```

## Problems you may encounter
If you did every step of the process and still cant start up the server try rebuilding the image with
```
sail build --no-cache
```
Keep in mind that sail needs to be up (`sail up -d`). After rebuilding the image you need to restart the container
```
sail stop && sail up
```

## Installing dependencies from sail container
```
docker run --rm \
    -u "$(id -u):$(id -g)" \
    -v $(pwd):/var/www/html \
    -w /var/www/html \
    laravelsail/php81-composer:latest \
    composer install --ignore-platform-reqs
```