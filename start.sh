#!/usr/bin/bash

echo "Install slick2-stack, be sure you have comoser and bower installed"
echo "Installing codeigniter..."
composer update
echo "Installing components..."
bower update
echo "Create the database"
echo -n "Enter database name >"
read database
echo -n "Enter database user name >"
read username
echo -n "Enter password"
read pass
mysql -u $username -p $pass  -e "create database ${database}"; 
php index.php cli/MigrateCli

