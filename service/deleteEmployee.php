<?php
require('DBConfig.php');

$id = "";
if (!empty($_POST["empId"])) {
    $id = test_input($_POST["empId"]);
}

$sql = "DELETE FROM employees WHERE id=".$id;

if ($conn->query($sql) === TRUE) {
    echo "Record deleted successfully";
} else {
    echo "Error deleting record: " . $conn->error;
}

$conn->close();