<?php
    // $servername = "127.0.0.1";
    // $username = "root";
    // $password = "";
    // $dbname = "php-simple-crud";

    // $conn = new mysqli($servername, $username, $password, $dbname);

    // if ($conn->connect_error) {
    //     die("Connection failed: " . $conn->connect_error);
    // }

    // return $conn;

    $servername = "127.0.0.1";
    $username = "root";
    $password = "";
    $dbname = "php_simple_crud";

    $conn = new mysqli($servername, $username, $password);
    $sql_createdb = "CREATE DATABASE IF NOT EXISTS $dbname";
    $sql_createtb = "CREATE TABLE IF NOT EXISTS notes (
        id INT AUTO_INCREMENT PRIMARY KEY,
        title VARCHAR(100),
        content VARCHAR(200),
        priority VARCHAR(15)
        )";

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    echo "<br />";

    if ($conn->query($sql_createdb) === TRUE) {
        echo "Database CREATED successfully";
    } else {
      echo "Error creating database: " . $conn->error;
    }

    echo "<br />";

    if ($conn->select_db($dbname) === TRUE) {
        echo "Database SELECTED successfully";
      } else {
        echo "Error creating database: " . $conn->error;
      }
  
    echo "<br />";


    if ($conn->query($sql_createtb) === TRUE) {
      echo "Table created successfully";
    } else {
      echo "Error creating table: " . $conn->error;
    }



    
    echo "<br />";


    return $conn;
?>