<?php
require('DBConfig.php');

$firstName = $middleName = $lastName = $Err = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["Fname"])) {
        $Err = "First Name is required";
    } else {
        $firstName = test_input($_POST["Fname"]);
    }
    if (!empty($_POST["Mname"])) {
        $middleName = test_input($_POST["Mname"]);
    }
    if (!empty($_POST["Lname"])) {
        $lastName = test_input($_POST["Lname"]);
    }
}

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

$stmt = $conn->prepare("INSERT INTO employees (first_name, middle_name, last_name) 
    VALUES (:firstname, :middlename, :lastname)");
$stmt->bindParam(':firstname', $firstName);
$stmt->bindParam(':middlename', $middleName);
$stmt->bindParam(':lastname', $lastName);
$stmt->execute();

echo "Employee added successfully!!";

$stmt->close();
$conn->close();
?>