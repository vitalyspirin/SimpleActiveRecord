## Launching tests

To launch tests you can clone the project and install all dependencies:
```
git clone https://github.com/vitalyspirin/yii2-simpleactiverecord.git
cd yii2-simpleactiverecord/
composer global require "fxp/composer-asset-plugin:^1.2.0"
composer install
```


Then you need to configure Yii to access database 'simpleactiverecord'. For this edit file /tests/setup/config/db.php setting up
appropriate user, password and dsn (if database 'simpleactiverecord' doesn't exist it will be created automatically).

After that you can launch tests:
```
composer test
```
The output should be like this:
```
> vendor/bin/phpunit --configuration tests tests/unit/
PHPUnit 4.8.27 by Sebastian Bergmann and contributors.

...............

Time: 2.95 seconds, Memory: 11.75MB

OK (15 tests, 649 assertions)
```

## Code Coverage

If you want to get code coverage then you can run tests in this way:
```
composer test2
```

![codeCoverage.png](/tests/docs/codeCoverage.png "code coverage screenshot")


## Class diagram

![UML.png](/tests/docs/UML.png "UML diagram")
