Basic Symfony 4.2 application
## Installation guide
 - git clone git@github.com:Kreyo/sf-test.git
 - composer install
 - edit the DATABASE_URL setting in .env file
 - php bin/console doctrine:database:create
 - php bin/console doctrine:migrations:migrate
 - php bin/console server:run
 
## Test credentials
 - test@example.com / password
