# moneyDispenser

Retrieve unlimited money from console

#### Installation
```
composer install
```

#### Usage
```
php bin/console money:retrieve 180
```

Sample output:
```
$ php bin/console money:retrieve 180
Here is your 180:
[100 PLN, 50 PLN, 20 PLN, 10 PLN]

```

#### Testing
```
php vendor/bin/phpunit
```


#### API
App can be run as a local server with
```
bin/console server:run
```
and then API docs are available under http://127.0.0.1:8000/api/doc
