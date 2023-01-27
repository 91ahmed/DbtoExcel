## Extract Database Table to Excel Sheet
This is a PHP library to simplify the process of extracting database tables into an Excel file.

#### Requirements

* PHP 7.0 or higher
* Composer for installation

#### Quick Start

Installation via composer
```
composer require extract/database-to-excel
```

Don't forget to require vendor/autoload in your PHP file.
``` php
require('vendor/autoload.php');
```

#### Simple Example
``` php
require('vendor/autoload.php');

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

$extract->table('users');
$extract->columns('*');
$extract->execute();
```

#### Description

> The **TableToExcel** class constructor takes one parameter, which is an array of the database connection information.

`table()`
> This method used to specify the database table you need to extract, it takes one parameter which is the name of the table.

`columns()`
> Used to specify the columns you need to extract from the database table, it takes one parameter which is the column's names.

> To extract all columns just add __asterisk (*)__ or leave the parameter empty and to extract specific columns see the example below.

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

$extract->table('users');
$extract->columns('username, email, age'); // Extract specific columns
$extract->execute();
```

`execute()`
> This is the last method you must invoke to execute the scripta and download the Excel file.
