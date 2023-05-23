<!DOCTYPE html>
<html>
<head>
   <title>Student List</title>
   <style>
      body {
         font-family: Arial, sans-serif;
      }

      table {
         width: 100%;
         border-collapse: collapse;
      }

      th, td {
         padding: 8px;
         text-align: left;
         border-bottom: 1px solid #ddd;
      }

      th {
         background-color: #f2f2f2;
      }

      form {
         display: inline;
      }

      .delete-button {
         background-color: #f44336;
         color: white;
         border: none;
         padding: 6px 12px;
         text-align: center;
         text-decoration: none;
         display: inline-block;
         font-size: 14px;
         cursor: pointer;
         border-radius: 4px;
      }

      .delete-button:hover {
         background-color: #d32f2f;
      }
   </style>
</head>
<body>
   <?php
// Connect to the database
$host = "localhost"; // replace with your host
$username = "root"; // replace with your database username
$password = ""; // replace with your database password
$database = "test"; // replace with your database name

$conn = new mysqli($host, $username, $password, $database);
if ($conn->connect_error) {
   die("Connection failed: " . $conn->connect_error);
}

// Check if delete button is clicked
if (isset($_POST['delete'])) {
   $id = $_POST['delete'];

   // Delete the record from the "students" table
   $deleteSql = "DELETE FROM students WHERE id = $id";
   if ($conn->query($deleteSql) === TRUE) {
      echo "Record deleted successfully";
   } else {
      echo "Error deleting record: " . $conn->error;
   }
}

// Fetch data from the "students" table
$sql = "SELECT id, full_name, mobile_number, email, address, dob, TIMESTAMPDIFF(YEAR, dob, CURDATE()) AS age FROM students";
$result = $conn->query($sql);

// Display the data in an HTML table
if ($result->num_rows > 0) {
   echo '<table>';
   echo '<tr><th>Full Name</th><th>Mobile Number</th><th>Email</th><th>Address</th><th>Age</th><th>Action</th></tr>';

   while ($row = $result->fetch_assoc()) {
      echo '<tr>';
      echo '<td>' . $row['full_name'] . '</td>';
      echo '<td>' . $row['mobile_number'] . '</td>';
      echo '<td>' . $row['email'] . '</td>';
      echo '<td>' . $row['address'] . '</td>';
      echo '<td>' . $row['age'] . '</td>';
      echo '<td>';
      echo '<form method="post" action="">';
      echo '<input type="hidden" name="delete" value="' . $row['id'] . '">';
      echo '<button type="submit">Delete</button>';
      echo '</form>';
      echo '</td>';
      echo '</tr>';
   }

   echo '</table>';
} else {
   echo 'No records found';
}

// Close the database connection
$conn->close();
?>

</body>
</html>
