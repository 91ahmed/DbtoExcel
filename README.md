## Extract Database Table to Excel Sheet
This is a PHP library to simplify the process of extracting database tables into an Excel file.

#### Install
```
composer require extract/database-to-excel
```

#### Simple Example
``` php
use ExtractDatabaseToExcel\TableToExcel;

$extract = new TableToExcel([
   'driver' => 'mysql',
   'host' => '127.0.0.1',
   'username' => 'root',
   'password' => '',
   'database' => 'test',
   'port' => '3306',
   'charset' => 'utf8',
   'sslmode' => 'disable'
]);

$extract->table('users'); // Specify the database table.
$extract->columns('*'); // Specify the columns you need to extract.
$extract->execute(); // Execute the script
```

> The **TableToExcel** class takes one parameter, which is an array of database configuration.

