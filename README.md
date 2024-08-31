# Klarna's API Integration

Klarna's API Integration is lightweight API that's integrated with the Klarna gateway for a simple checkout and webhook handling

## Requirements
`php > 8.2` \
`composer` \
`Docker & Daemon` \
`Klarna Account`

## Installation

- Clone the project

```bash
https://github.com/EssaadaniYounes/klarna-s-integration.git
```
- Install and update packages
```bash
composer update
```
- Create .env file and copy the content of the .env.example into it
```bash
cp .env.example .env
```
Replace the variables with your values. Preferably before you do this to have a Klarna account and grap the username & password from it.\
you can found them here 
[Klarna Users](https://portal.playground.klarna.com/users/).
## Running the App
Run the following command to create MySQL and your app containers
```bash
./vendor/bin/sail up -d
```
Probably in windows you'll get this error
```bash
🛑/bin/bash: C:\..\vendor\bin\/../laravel/sail/bin/sail: No such file or directory
```
To solve it use this command instead
```bash
bash ./vendor/laravel/sail/bin/sail up -d
```
Now the images are pulled and the containers are running.

Use this command to run the migration and seeders
```
./vendor/bin/sail artisan migrate:fresh --seed
```
If it say Sail isn't running this probably only for windows users. So go to your docker desktop and containers tab. Expand the `laravel.test` container and go to `Exec` tab.
then run
```
php artisan migrate:fresh --seed
```
Now everything should work fine visit [http://localhost:8000/api/v1/products](http://localhost:8000/api/v1/products) and you can see a list of four product!
## Testing
If you want to test only the API\
In your terminal run the following command
```
./vendor/bin/sail artisan test
```
If it didn't work again for windows just follow pervious steps and write the `php artisan test` command and see tests running.

In the other hand to test it with the front-end we require to clone this [Project](https://github.com/EssaadaniYounes/klarna-intergration-client.git). and follow it's instruction to run it.
