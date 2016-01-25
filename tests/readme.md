## Launching tests

To launch tests you need to add Yii 2 to /basic directory (download basic template). So the directory structure 
has to look like this:

![folderStructure.png](/tests/docs/folderStructure.png "folder structure")

Then you need to configure Yii to use database 'simpleactiverecord'. For this edit file /basic/config/db.php. 
Line for dsn has to be something like this:
```php
    'dsn' => 'mysql:host=localhost;dbname=simpleactiverecord',
```

After that you can launch tests using terminal command:
```
$ phpunit  tests/unit/SimpleActiveRecordTest.php
```
The output should be like this:
```
PHPUnit 4.8.16 by Sebastian Bergmann and contributors.

............

Time: 1.36 seconds, Memory: 11.00Mb

OK (12 tests, 364 assertions)
```

## Code Coverage

![codeCoverage.png](/tests/docs/codeCoverage.png "code coverage screenshot")


## Class diagram

![UML.png](/tests/docs/UML.png "UML diagram")
