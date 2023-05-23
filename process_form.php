<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
   // Retrieve form data
   $full_name = $_POST["full_name"];
   $mobile_number = $_POST["mobile_number"];
   $email = $_POST["email"];
   $address = $_POST["address"];
   $date_of_birth = $_POST["date_of_birth"];

   // Calculate age from date of birth
   $dob = new DateTime($date_of_birth);
   $current_date = new DateTime();
   $age = $current_date->diff($dob)->y;

   // Connect to the database
   $host = "localhost"; // replace with your host
   $username = "root"; // replace with your database username
   $password = ""; // replace with your database password
   $database = "test"; // replace with your database name

   $conn = new mysqli($host, $username, $password, $database);
   if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
   }

   // Insert data into the "students" table
   $sql = "INSERT INTO students (full_name, mobile_number, email, address, dob, age) VALUES ('$full_name', '$mobile_number', '$email', '$address', '$date_of_birth', '$age')";

   if ($conn->query($sql) === TRUE) {
      echo "New record created successfully";
   } else {
      echo "Error: " . $sql . "<br>" . $conn->error;
   }

   // Close the database connection
   $conn->close();
}
?>
