#!/bin/bash

# Start MariaDB service
service mysql start

# Wait for MariaDB to start
sleep 10

# Function to initialize the database and create a user
initialize_db() {
    mysql -u root -e "CREATE DATABASE brandb;"
    mysql -u root -e "CREATE USER 'bran'@'%' IDENTIFIED BY 'bran';"
    mysql -u root -e "GRANT ALL PRIVILEGES ON *.* TO 'bran'@'%' WITH GRANT OPTION;"
    mysql -u root -e "FLUSH PRIVILEGES;"

    # Create a file to mark that the database has been initialized
    touch /var/lib/mysql/db_initialized
}

if [ ! -f /var/lib/mysql/db_initialized ]; then
    initialize_db
fi

if [ ! -f /var/www/html/bran/bran-config.php ]; then
    touch /var/www/html/bran/bran-config.php
    chown www-data:www-data /var/www/html/bran/bran-config.php
fi

# Start Apache in the foreground
apache2ctl -D FOREGROUND
