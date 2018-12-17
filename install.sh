#!/bin/bash

echo "Install slick2-stack, be sure you have composer and yarn installed"
echo "Installing codeigniter..."
# We need to check first if there is composer
composer=`which composer`
if [ -f  $composer ]
then
	composer update
else
	exit
fi
echo "Installing components..."
# initiate yarn
yarn
echo "Create the database"
echo -n "Enter database name:"
read database
echo -n "Enter database user name:"
read username
echo -n "Enter password:"
read pass
# TODO: if the password is blank we should not prompt password
mysql -u $username -p$pass  -e "create database ${database}"; 
# create the db config file
sed s/dbusername/$username/ <./application/config/database.sample.php>./application/config/database.php
sed -i s/dbpassword/$pass/ ./application/config/database.php
sed -i s/dbname/$database/ ./application/config/database.php
# run the migration file
echo "Running migration file"
php public_html/index.php cli/MigrateCli
echo "Installation done"

