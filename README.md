# Project  - Starter Kit - Symfony 4.4.2



This starter kit repository.

It's symfony website-skeleton project with some additional tools to validate code standards.

* GrumPHP, as pre-commit hook, will run 2 tools when `git commit` is run :
  
    * PHP_CodeSniffer to check PSR2 
    * PHPStan will check PHP recommendation
     
  If tests fail, the commit is canceled and a warning message is displayed to developper.

### Prerequisites
1. git installed


### Get starter kit

1. Clone this project
2. Remove `.git` folder to remove history
3. `git init`
4. Link to your project repository you'll give to your students : `git remote add origin ...`
5. `git add .`
6. `git commit -m "Init project repository"`
7. `git push -u origin master`




### Configure you repository - Settings options



## Getting Started for Projects

### Prerequisites

1. Check composer is installed
2. Check yarn & node are installed

### Install

1. Clone this project
2. Run `composer install`
3. Run `yarn install`

### Working

1. Run `php bin/console server:run` to launch your local php web server
2. Run `yarn run dev --watch` to launch your local server for assets

### Testing

1. Run `./bin/phpcs` to launch PHP code sniffer
2. Run `./bin/phpstan analyse src --level 5` to launch PHPStan


### Database

1. copie .env rename to .env.local
2. check for use sqlite in .env.local
3. check driver in doctrine.yaml
4. exemple:
   >  doctrine: <br>
           &nbsp; dbal:<br>
         &nbsp;&nbsp;# configure these for your database server <br>
         &nbsp;&nbsp;# configure these for sqlite <br>
        &nbsp;&nbsp;#driver: 'pdo_sqlite' <br>
        &nbsp;&nbsp;#server_version: '5.7'<br>
        &nbsp;&nbsp;driver: 'pdo_mysql'<br>
        &nbsp;&nbsp;server_version: '5.7'<br>
        &nbsp;&nbsp;charset: utf8mb4<br>
        &nbsp;&nbsp;default_table_options:<br>
            &nbsp;&nbsp;&nbsp;&nbsp;charset: utf8mb4<br>
            &nbsp;&nbsp;&nbsp;&nbsp;collate: utf8mb4_unicode_ci


## Deployment
enable database:
* create database
1. php bin/console d:d:c
* make migration:
2. php bin/console m:m
* migration migrate:
3. php bin/console d:m:m
* load fixtures:
4. php bin/console d:f:l

after this you can login with:


| name | login       | password     | 
| :------: | :------------- | :----------: | 
|admin|  admin@admin.fr | admin   | 
| user |  user@user.fr   | user | \| 

## Built With

* [Symfony](https://github.com/symfony/symfony)
* [GrumPHP](https://github.com/phpro/grumphp)

* [PHP_CodeSniffer](https://github.com/squizlabs/PHP_CodeSniffer)
* [PHPStan](https://github.com/phpstan/phpstan)
* not installed here [Travis CI](https://github.com/marketplace/travis-ci)

## Contributing

Please read [CONTRIBUTING.md](https://gist.github.com/PurpleBooth/b24679402957c63ec426) for details on our code of conduct, and the process for submitting pull requests to us.

## Versioning


## Authors

Augustin stephane

## License

MIT License



