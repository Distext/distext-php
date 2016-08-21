# Distext client for PHP

Installation:
composer require distext/distext

Usage:
```php
<?php

require_once __DIR__ . '/vendor/autoload.php';

$distext = new \Wavy\Distext\Distext('pasteYourApiKeyHere');

try {
    $distext->send('0123456789', 'your message here');
} catch(\Exception $e) {
    echo 'Unable to send message: ' . $e->getMessage();
}
```

To launch tests:
vendor/bin/phpunit --bootstrap vendor/autoload.php tests