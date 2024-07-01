<?php

if (isset($_POST['name'])) {
    $server = "localhost";
    $username = "root";
    $password = "";

    // Create a connection
    $con = mysqli_connect($server, $username, $password);

    // Check connection
    if (!$con) {
        die("Connection to the database failed: " . mysqli_connect_error());
    }

    // Select the database
    $db_selected = mysqli_select_db($con, 'trip');
    if (!$db_selected) {
        die("Can't use trip: " . mysqli_error($con));
    }

    // Retrieve form data with checks
    $name = isset($_POST['name']) ? $_POST['name'] : '';
    $age = isset($_POST['age']) ? $_POST['age'] : '';
    $gender = isset($_POST['gender']) ? $_POST['gender'] : '';
    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $phone = isset($_POST['phone']) ? $_POST['phone'] : '';
    $other = isset($_POST['other']) ? $_POST['other'] : '';

    // Escape special characters in a string for use in an SQL statement
    $name = mysqli_real_escape_string($con, $name);
    $age = mysqli_real_escape_string($con, $age);
    $gender = mysqli_real_escape_string($con, $gender);
    $email = mysqli_real_escape_string($con, $email);
    $phone = mysqli_real_escape_string($con, $phone);
    $other = mysqli_real_escape_string($con, $other);

    // Create SQL query
    $sql = "INSERT INTO `trip` (`name`, `age`, `gender`, `email`, `phone`, `other`, `dt`) VALUES ('$name', '$age', '$gender', '$email', '$phone', '$other', current_timestamp())";

    // Execute SQL query
    if ($con->query($sql) === TRUE) {
        echo "Successfully inserted";
    } else {
        echo "Error: $sql<br>" . $con->error;
    }

    // Close the connection
    $con->close();

}
?>