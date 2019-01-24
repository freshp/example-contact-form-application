[![Build Status](https://travis-ci.org/freshp/example-contact-form-application.svg?branch=master)](https://travis-ci.org/freshp/example-contact-form-application)

### Execute manual test of the formhandling
1. start built in php server
```
php -S localhost:8000 -t example/
```
2. with the browser you can test the form

## build js and css files with gulp
1. install npm
    ```
    npm install
    ```
2. install gulp for cli
    ```
    npm install -g gulp-cli
    ```
3. run gulp
    ```
    gulp
    ``` 
    * if gulp is installed from another user, please use [npx](https://www.npmjs.com/package/npx) and run:
        ```
        npx gulp
        ``` 
        
## Checks
Run each command in the project root directory.

### Execute PHPUnit tests
```
./vendor/bin/phpunit.phar -c ./phpunit.xml --debug --verbose
```

### Execute PHPSTAN checks

```
./vendor/bin/phpstan.phar analyse -l max src/
```
