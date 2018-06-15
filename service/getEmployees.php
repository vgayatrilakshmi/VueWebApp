<?php
require('DBConfig.php');

$sql = "SELECT id, first_name, middle_name, last_name FROM employees";
$results = $conn->query($sql);
$conn->close();
return $results;
?>