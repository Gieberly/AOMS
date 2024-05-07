<?php
 include '../config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $classification = $_POST['classification'];
    $start_year = $_POST['start_year'];
    $end_year = $_POST['end_year'];
    $sem = $_POST['sem'];
    $name = $_POST['name'];
    
    // File upload
    $fileName = $_FILES['file']['name'];
    $fileTmpName = $_FILES['file']['tmp_name'];
    $fileSize = $_FILES['file']['size'];
    $fileError = $_FILES['file']['error'];

    if ($fileError === UPLOAD_ERR_OK) {
        // Read the file content
        $fileContent = file_get_contents($fileTmpName);

        // Prepare SQL statement to insert data into database
        $sql = "INSERT INTO files (classification, start_year, end_year, sem, file_name,file) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssss", $classification, $start_year, $end_year, $sem, $fileName, $fileContent);
        
        // Execute SQL statement
        if ($stmt->execute()) {
            echo "File uploaded and data inserted successfully!";
        } else {
            echo "Error inserting data into database: " . $conn->error;
        }
    } else {
        echo "Error uploading file.";
    }
}
?>
