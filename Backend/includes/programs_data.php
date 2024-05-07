<?php
include '../config.php';

function subtractAndShowResult($conn, $table1, $table2, $column1, $column2) {
    // Retrieve value from table 1
    $sql1 = "SELECT SUM($column1) AS sum1 FROM $table1";
    $result1 = $conn->query($sql1);
    $row1 = $result1->fetch_assoc();
    $value1 = $row1['sum1'];

    // Retrieve value from table 2
    $sql2 = "SELECT SUM($column2) AS sum2 FROM $table2";
    $result2 = $conn->query($sql2);
    $row2 = $result2->fetch_assoc();
    $value2 = $row2['sum2'];

    // Subtract values
    $result = $value1 - $value2;

    // Display result
    echo "Result: " . $result;
}


?>
