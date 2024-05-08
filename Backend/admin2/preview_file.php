<?php
function previewFile($file_id) {
    include("../config.php"); // Include database connection
    
    // Fetch file data from the database
    $sql = "SELECT file_name, file FROM files WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $file_id);
    $stmt->execute();
    $stmt->store_result();
    
    // Check if file exists
    if ($stmt->num_rows > 0) {
        // Bind result variables
        $stmt->bind_result($file_name, $file_data);
        $stmt->fetch();
        
        // Set appropriate headers for file preview
        $file_extension = pathinfo($file_name, PATHINFO_EXTENSION);
        $content_type = ''; // Default content type
        
        // Determine content type based on file extension
        switch(strtolower($file_extension)) {
            case 'pdf':
                $content_type = 'application/pdf';
                break;
            case 'jpg':
            case 'jpeg':
                $content_type = 'image/jpeg';
                break;
            // Add more cases for other file types as needed
            default:
                // Default content type if not recognized
                $content_type = 'application/octet-stream';
        }
        
        // Set content headers
        header('Content-Type: ' . $content_type);
        header('Content-Disposition: inline; filename="' . $file_name . '"');
        
        // Output file data for preview
        echo $file_data;

        // Close statement and connection
        $stmt->close();
        $conn->close();

        // Respond with success message
        $res = [
            'status' => 200,
            'message' => 'File previewed successfully.'
        ];
        echo json_encode($res);
    } else {
        // File not found
        $res = [
            'status' => 404,
            'message' => 'File not found.'
        ];
        echo json_encode($res);
    }
}

// Example usage:
$file_id = $_GET['file_id']; // Assuming file ID is provided via query parameter
previewFile($file_id);



?>
