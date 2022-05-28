# purge_log

### Установка
```
composer require efko/purge-log
```

### В корне проекта создать bin/console
```php
require_once dirname(__DIR__).'/vendor/autoload.php';

use Efko\PurgeLog\Application;
use Efko\PurgeLog\Command\ClearLog;

$containerBuilder = require_once dirname(__DIR__) . '/vendor/efko/purge-log/config/bootstrap.php';

$application = new Application($containerBuilder);

$application->add(new ClearLog());

$application->run();
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

### В консоле выполнить 
```
symfony console clear config.php
```