## DbtoExcel
PHP script to simplify the process of converting database table to excel sheet.

### # Requirements
* PHP 7.0 or higher
* Composer for installation

### # Install
via composer
```
composer require exceldb/dbtoexcel
```

### # Example
``` php
// don't forget to import vendor/autoload.php
require('vendor/autoload.php');

// Database information
$extract = new Database\Excel\ExtractExcel([
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
$extract->execute(); // Execute the script.
```

### # Description

The **TableToExcel** class constructor takes one parameter, which is an *(array)* of the database information.

`table()`<br/><br/>
This method used to specify the database table you need to extract, it takes one parameter *(string)* which is the name of the table.

`columns()`<br/><br/>
Used to specify the columns you need to extract from the database table, it takes one parameter *(string)* which is the column's names.

To extract all columns just add __asterisk (*)__ or leave the parameter empty while if you want to extract specific columns you can write the columns names following by comma separator.. see the example below.

``` php
use ExtractDatabaseToExcel\TableToExcel;

$extract = new TableToExcel([
      'driver' => 'mysql',
      'host' => '127.0.0.1',
      'username' => 'root',
      'password' => '',
      'database' => 'test',
      'port' => '3306',
      'charset' => 'utf8'
]);

$extract->table('users');
$extract->columns('username, email, age'); // Extract specific columns
$extract->execute();
```

`execute()`<br/><br/>
This is the last method you should invoke to execute the script, the method will convert the data and download the excel file.
