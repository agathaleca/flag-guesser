# flag-guesser

An online quiz to test your flags knowledge.  

## Installation Procedure 

* On Windows : Please make sure you have [Wampserver](https://www.wampserver.com/) (for Php 7.4.9 or greater and MySQL) and the latest version of [composer](https://getcomposer.org/) properly installed.  
On Linux :
Please make sure you have [Php 7.4.9 or greater](https://www.php.net), [MySQL](https://www.mysql.com/) and the latest version of [composer](https://getcomposer.org/) properly installed.  

* You can verify by running  
```php -v
composer -V
```

* Clone this project.  
```git clone git@github.com:LucasLev/flag-guesser.git```  

* Move to flag-guesser/symfony-flag-guesser and install doctrine support.  
```
composer require symfony/orm-pack
composer require --dev symfony/maker-bundle
```     

* Then modify the database connection information in the flag-guesser/symfony-flag-guesser/env file.  
db_name must be the name of the database that will be created and linked to the website.  
```DATABASE_URL="mysql://db_user:db_password@127.0.0.1:3306/db_name?serverVersion=5.7"```  

* Create the database.  
```php bin/console doctrine:database:create```  

* Execute all migrations to create database's tables.  
```php bin/console doctrine:migrations:migrate```  

* On Windows : In your web browser, move to [phpmyadmin](http://localhost/phpmyadmin/) and import the flag-guesser/flagsDATAbase.csv file in the "flag" table of the created database.   
On Linux : In your MySQL terminal, move to the database :  
```USE database_name;```  
```  
LOAD data local infile ' [absolute path to flagssansutf.csv] '  
into table flag  
fields terminated by ','  
enclosed by '"'  
lines terminated by '\r\n'  
ignore 1 rows; 
```  

* Then run symfony's php server. (You might need to install the runtime extension, follow symfony's instructions.)  
```php bin/console server:run```  

* You can now locally play at this address in your web browser :  
```127.0.0.1:8000```  

Made with ❤ by Agathe Leca, Lucas Lévesque et Valentin Porchet
