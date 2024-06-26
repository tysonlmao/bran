<?php   
// Set the error mode to PDO::ERRMODE_EXCEPTION
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// Create the users table
$query = "CREATE TABLE IF NOT EXISTS users (
    id INT(11) NOT NULL AUTO_INCREMENT,
    email TINYTEXT NOT NULL,
    username VARCHAR(32) NOT NULL,
    password TINYTEXT NOT NULL,
    user_join TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    role ENUM('new_user', 'user', 'admin') NOT NULL DEFAULT 'new_user',
    PRIMARY KEY (id)
);";

$pdo->exec($query);

// Create the user_data table
$query = "CREATE TABLE IF NOT EXISTS user_data (
    id INT(11) NOT NULL AUTO_INCREMENT,
    user_id INT(11) NOT NULL,
    nickname VARCHAR(32),
    pfp_path VARCHAR(255) DEFAULT NULL,
    bran_total INT(11) DEFAULT 0,
    bran_daily INT(11) DEFAULT 500,
    theme ENUM('light', 'dark', 'system') DEFAULT 'system',
    theme_accent VARCHAR(7),
    PRIMARY KEY (id),
    FOREIGN KEY (user_id) REFERENCES users(id)
);";

$pdo->exec($query);

// create bran_options table and set default values
$query = "CREATE TABLE IF NOT EXISTS bran_options (
    option_name VARCHAR(255) NOT NULL,
    option_value VARCHAR(255) NOT NULL,
    PRIMARY KEY (option_name)
);";

$pdo->exec($query);