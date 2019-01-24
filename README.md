### Execute manual test of the formhandling
1. start built in php server
```
php -S localhost:8000 -t example/
```
2. with the browser you can test the form

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
