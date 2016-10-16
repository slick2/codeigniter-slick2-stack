#!/bin/bash

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
# TODO: if the password is blank we should not prompt password
mysql -u $username -p $pass  -e "create database ${database}"; 
echo "Running migration file"
php public/index.php cli/MigrateCli
echo "Installation done"

