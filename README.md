# purge_log

### Установка
```
composer require efko/purge-log
```

###  В корне проекта создать config.php
```php
return [
    'table1' => [
        'name' => 'vap_common_file',
        'condition' => 'id < 10'
    ],
    'table2' => [
        'name' => 'vap_auth_assignment',
        'condition' => 'item_name = "administrator"'
    ],
];
```
### Настроить подключение к БД
```
/vendor/efko/purge-log/config/parameters.dist.yml
```

### В консоле выполнить 
```
symfony console clear 'paht/to/file/config.php
```