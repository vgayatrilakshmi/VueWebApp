<?php
require('DBConfig.php');
$firstName = $middleName = $lastName = $id = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!empty($_POST["Fname"])) {
        $firstName = test_input($_POST["Fname"]);
    }
    if (!empty($_POST["Mname"])) {
        $middleName = test_input($_POST["Mname"]);
    }
    if (!empty($_POST["Lname"])) {
        $lastName = test_input($_POST["Lname"]);
    }
    if (!empty($_POST["empId"])) {
        $id = test_input($_POST["empId"]);
    }
}
function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
$sql = "UPDATE employees SET first_name=:firstname, middle_name=:middlename, last_name=:lastnaem WHERE emp_id=:id";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':firstname', $firstName);
$stmt->bindParam(':middlename', $middleName);
$stmt->bindParam(':lastname', $lastName);
$stmt->execute();

if ($conn->query($sql) === TRUE) {
    echo "Record updated successfully";
} else {
    echo "Error updating record: " . $conn->error;
}

$conn->close();