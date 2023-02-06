## DbtoExcel
PHP script to simplify the process of converting database table to excel sheet.

#### Requirements

* PHP 7.0 or higher
* Composer for installation

#### Quick Start

Installation via composer
```
composer require extract/database-to-excel
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

> The **TableToExcel** class constructor takes one parameter, which is an *array* of the database information.

`table()`
> This method used to specify the database table you need to extract, it takes one parameter *(string)* which is the name of the table.

`columns()`
> Used to specify the columns you need to extract from the database table, it takes one parameter *(string)* which is the column's names.

> To extract all columns just add __asterisk (*)__ or leave the parameter empty while if you want to extract specific columns you can write the columns names following by comma separator.. see the example below.

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
> This is the last method you must invoke to execute the script and download the Excel file.
