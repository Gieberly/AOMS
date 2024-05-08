<?php

function countRejectedAccounts($startYear, $endYear) {
    global $conn;
    $count = 0;
    $sql = "SELECT SUM(count) AS count FROM (
                SELECT COUNT(*) AS count FROM users WHERE lstatus='Rejected' AND created_date BETWEEN '{$startYear}-01-01' AND '{$endYear}-12-31'
                UNION ALL
                SELECT COUNT(*) AS count FROM users_archive WHERE lstatus='Rejected' AND created_date BETWEEN '{$startYear}-01-01' AND '{$endYear}-12-31'
            ) AS combined_counts";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        // Fetch the result row
        $row = mysqli_fetch_assoc($result);
        $count = $row['count'];
    } else {
        // Handle the case where the query failed
        echo "Error: " . mysqli_error($conn);
    }

    // Free result set
    mysqli_free_result($result);

    // Return the count of rejected accounts
    return $count;
}

function countApplicants($startYear, $endYear) {
    global $conn;

    // Initialize count variable
    $count = 0;

    // SQL query to count applicants from both users and user_archive tables within the specified period
    $sql = "SELECT SUM(count) AS count FROM (
                SELECT COUNT(*) AS count FROM users WHERE userType='Student' AND created_date BETWEEN '{$startYear}-01-01' AND '{$endYear}-12-31'
                UNION ALL
                SELECT COUNT(*) AS count FROM users_archive WHERE userType='Student' AND created_date BETWEEN '{$startYear}-01-01' AND '{$endYear}-12-31'
            ) AS combined_counts";

    // Perform the query
    $result = mysqli_query($conn, $sql);

    // Check if query was successful
    if ($result) {
        // Fetch the result row
        $row = mysqli_fetch_assoc($result);
        $count = $row['count'];
    } else {
        // Handle the case where the query failed
        echo "Error: " . mysqli_error($conn);
    }

    // Free result set
    mysqli_free_result($result);

    // Return the count of applicants
    return $count;
}

function countPersonnel($startYear, $endYear) {
    global $conn;
    $count = 0;
    // SQL query to count personnel from both users and user_archive tables within the specified period
    $sql = "SELECT SUM(count) AS count FROM (
                SELECT COUNT(*) AS count FROM users WHERE userType='Personnel' AND created_date BETWEEN '{$startYear}-01-01' AND '{$endYear}-12-31'
                UNION ALL
                SELECT COUNT(*) AS count FROM users_archive WHERE userType='Personnel' AND created_date BETWEEN '{$startYear}-01-01' AND '{$endYear}-12-31'
            ) AS combined_counts";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        $row = mysqli_fetch_assoc($result);
        $count = $row['count'];
    } else {
        echo "Error: " . mysqli_error($conn);
    }
    mysqli_free_result($result);
    return $count;
}

function countPersonnelPending($startYear, $endYear) {
    global $conn;
    $count = 0;
    $sql = "SELECT SUM(count) AS count FROM (
                SELECT COUNT(*) AS count FROM users WHERE lstatus='Pending' AND created_date BETWEEN '{$startYear}-01-01' AND '{$endYear}-12-31'
                UNION ALL
                SELECT COUNT(*) AS count FROM users_archive WHERE lstatus='Pending' AND created_date BETWEEN '{$startYear}-01-01' AND '{$endYear}-12-31'
            ) AS combined_counts";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        $row = mysqli_fetch_assoc($result);
        $count = $row['count'];
    } else {
        echo "Error: " . mysqli_error($conn);
    }
    mysqli_free_result($result);
    return $count;
}

function countRemainingSlots() {
    global $conn;
    $count = 0;
    $sql = "SELECT SUM(Remaining_Slots) AS Total_Remaining_Slots FROM programs";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        $row = mysqli_fetch_assoc($result);
        $count = $row['Total_Remaining_Slots'];
    } else {
        echo "Error: " . mysqli_error($conn);
    }
    mysqli_free_result($result);
    return $count;
}

function countALLSlots() {
    global $conn;
    $count = 0;
    $sql = "SELECT SUM(Number_of_Available_Slots) AS Total_Available_Slots FROM programs";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        $row = mysqli_fetch_assoc($result);
        $count = $row['Total_Available_Slots'];
    } else {
        echo "Error: " . mysqli_error($conn);
    }
    mysqli_free_result($result);
    return $count;
}
function countALLAdmitted() {
    global $conn;

    // Initialize count variable
    $count = 0;

    // SQL query to count remaining slots
    $sql = "SELECT SUM(Admitted_Total) AS Total_Admitted FROM programs";

    // Perform the query
    $result = mysqli_query($conn, $sql);

    // Check if query was successful
    if ($result) {
        // Fetch the result row
        $row = mysqli_fetch_assoc($result);
        // Assign the total remaining slots to the count variable
        $count = $row['Total_Admitted'];
    } else {
        // Handle the case where the query failed
        echo "Error: " . mysqli_error($conn);
    }

    // Free result set
    mysqli_free_result($result);

    // Return the total remaining slots
    return $count;
}
function countNotAdmitted() {
    global $conn;

    // Initialize count variable
    $count = 0;

    // SQL query to count remaining slots
    $sql = "SELECT SUM(Not_Admitted_Total) AS Total_Not_Admitted FROM programs";

    // Perform the query
    $result = mysqli_query($conn, $sql);

    // Check if query was successful
    if ($result) {
        // Fetch the result row
        $row = mysqli_fetch_assoc($result);
        // Assign the total remaining slots to the count variable
        $count = $row['Total_Not_Admitted'];
    } else {
        // Handle the case where the query failed
        echo "Error: " . mysqli_error($conn);
    }

    // Free result set
    mysqli_free_result($result);

    // Return the total remaining slots
    return $count;
}
function getLatestAdmissionPeriod($conn) {
    // Initialize an empty array to store the result
    $latestPeriod = array();

    // Query to fetch the latest admission period
    $query = "SELECT id, sem, start_year, end_year FROM admission_period ORDER BY start_year DESC LIMIT 1";

    // Execute the query
    $result = $conn->query($query);

    // Check if the query was successful
    if ($result && $result->num_rows > 0) {
        // Fetch the result as an associative array
        $latestPeriod = $result->fetch_assoc();
    }

    // Return the latest admission period data
    return $latestPeriod;
}
// Generate dropdown content using the latest admission period data
function generateAdmissionPeriodDropdown($conn) {
    $query = "SELECT id, sem, start_year, end_year FROM admission_period ORDER BY start_year DESC";
    $result = $conn->query($query);

    $dropdownData = array();

    if ($result->num_rows > 0) {
        while ($optionData = $result->fetch_assoc()) {
            $id = $optionData['id'];
            $option = $optionData['start_year'];
            $option2 = $optionData['end_year'];
            $sem = $optionData['sem'];
            ?>
            <a class="dropdown-item academic-year" href="#" data-id="<?php echo $id; ?>"><?php echo $option.', '.$option2.', '.$sem; ?></a>
            <?php
            // Store data for later use if needed
            $dropdownData[] = array(
                'id' => $id,
                'start_year' => $option,
                'end_year' => $option2,
                'sem' => $sem
            );
        }
    } else {
        ?>
        <a class="dropdown-item academic-year" href="#">No admission periods available</a>
        <?php
    }

    return $dropdownData;
}
function archiveAndTruncateTables($conn, $tableMappings) {
    $archivedData = [];

    foreach ($tableMappings as $tableName => $archiveTableName) {

        // Truncate the table
        $truncateQuery = "TRUNCATE TABLE $tableName";
        $truncateResult = mysqli_query($conn, $truncateQuery);

        if (!$truncateResult) {
            // Truncation failed
            return false;
        }

        // Store metadata about the truncation process
        $archivedData[] = [
            'origin' => $tableName,
            'archive_table' => $archiveTableName,
            'archive_datetime' => date('Y-m-d H:i:s'), // Store the current date and time
        ];

        // Check if the table contains a 'userType' column
        $userTypeQuery = "SHOW COLUMNS FROM $tableName LIKE 'userType'";
        $userTypeResult = mysqli_query($conn, $userTypeQuery);
        $userTypeExists = mysqli_num_rows($userTypeResult) > 0;

        if ($userTypeExists) {
            // Delete rows where 'userType' is 'Student'
            $deleteQuery = "DELETE FROM $tableName WHERE userType = 'Student'";
            $deleteResult = mysqli_query($conn, $deleteQuery);

            if (!$deleteResult) {
                // Deletion failed
                return false;
            }

            // Store metadata about the deletion process
            $archivedData[] = [
                'origin' => $tableName,
                'archive_table' => $archiveTableName,
                'archive_datetime' => date('Y-m-d H:i:s'), // Store the current date and time
            ];
        }
    }
    foreach ($archivedData as $data) {
        $origin = $data['origin'];
        $archiveTable = $data['archive_table'];
        $archiveDateTime = $data['archive_datetime'];

        $logQuery = "INSERT INTO archive_log (origin, archive_table, archive_datetime) VALUES ('$origin', '$archiveTable', '$archiveDateTime')";
        $logResult = mysqli_query($conn, $logQuery);

        if (!$logResult) {
            // Logging failed
            return false;
        }
    }

    return true;
}

function deleteAndArchiveStudents($conn, $tableName, $archiveTableName) {
    // Sanitize table names
    $tableName = mysqli_real_escape_string($conn, $tableName);
    $archiveTableName = mysqli_real_escape_string($conn, $archiveTableName);
    
    // Insert deleted rows into archive table
    $archiveQuery = "INSERT INTO $archiveTableName SELECT * FROM $tableName WHERE userType = 'Student'";
    $archiveResult = mysqli_query($conn, $archiveQuery);

    // Check if archiving was successful
    if (!$archiveResult) {
        return false; // Archiving failed
    }

    // Delete rows where userType is 'Student'
    $deleteQuery = "DELETE FROM $tableName WHERE userType = 'Student'";
    $deleteResult = mysqli_query($conn, $deleteQuery);

    // Check if deletion was successful
    if ($deleteResult) {
        return true; // Deletion successful
    } else {
        return false; // Deletion failed
    }
}
function copyData($conn) {
    // Copy data from archive_users back to users, replacing rows if they have the same email
    $sql = "INSERT INTO users (last_name, name, mname, email, password, userType, status, lstatus, Department, Designation, verification_code, token, token_expire, created_date, state)
            SELECT last_name, name, mname, email, password, userType, status, lstatus, Department, Designation, verification_code, token, token_expire, created_date, state
            FROM users_archive
            ON DUPLICATE KEY UPDATE
                last_name = VALUES(last_name),
                name = VALUES(name),
                mname = VALUES(mname),
                password = VALUES(password),
                userType = VALUES(userType),
                status = VALUES(status),
                lstatus = VALUES(lstatus),
                Department = VALUES(Department),
                Designation = VALUES(Designation),
                verification_code = VALUES(verification_code),
                token = VALUES(token),
                token_expire = VALUES(token_expire),
                created_date = VALUES(created_date),
                state = VALUES(state)";

    if (mysqli_query($conn, $sql)) {
        // Data copied successfully
        //Delete Data feom users archive
        $deleteSql = "DELETE FROM users_archive";
        if (mysqli_query($conn, $deleteSql)) {
        $res = [
            'status' => 200,
            'message' => 'Data copied from archive_users to users table successfully'
        ];
        } else {
        // Error deleting data from users_archive
        $res = [
            'status' => 500,
            'message' => 'Error deleting data from users_archive: ' . mysqli_error($conn)
        ];
        }
    } else {
        // Error copying data
        $res = [
            'status' => 500,
            'message' => 'Error copying data from archive_users to users table: ' . mysqli_error($conn)
        ];
    }

    return $res;
}

function deleteAllData($conn) {
    // Delete data from admission_data_archive table
    $deleteAdmissionSql = "DELETE FROM admission_data_archive";
    if (mysqli_query($conn, $deleteAdmissionSql)) {
        $res = [
            'status' => 200,
            'message' => 'All data deleted successfully from admission_data_archive'
        ];
    } else {
        $res = [
            'status' => 500,
            'message' => 'Error deleting data from admission_data_archive: ' . mysqli_error($conn)
        ];
        return $res;
    }

    $deleteUsersSql = "DELETE FROM users_archive";
    if (mysqli_query($conn, $deleteUsersSql)) {
        $res['message'] .= ', All data deleted successfully from users_archive';
    } else {
        $res = [
            'status' => 500,
            'message' => 'Error deleting data from users_archive: ' . mysqli_error($conn)
        ];
    }

    return $res;
}

function restoreFromArchive($conn, $id) {
    $select_query = "SELECT * FROM users_archive WHERE id='$id'";
    $select_result = mysqli_query($conn, $select_query);
    $user_data = mysqli_fetch_assoc($select_result);

    if($user_data) {
        $insert_query = "INSERT INTO users (id, last_name, name, mname, email, password, userType, status, lstatus, Department, Designation, verification_code, token, token_expire, created_date, state)
                         VALUES ('{$user_data['id']}', '{$user_data['last_name']}', '{$user_data['name']}', '{$user_data['mname']}', '{$user_data['email']}', '{$user_data['password']}', '{$user_data['userType']}', '{$user_data['status']}', '{$user_data['lstatus']}', '{$user_data['Department']}', '{$user_data['Designation']}', '{$user_data['verification_code']}', 
                         '{$user_data['token']}', '{$user_data['token_expire']}', '{$user_data['created_date']}', '{$user_data['state']}')";
        $insert_result = mysqli_query($conn, $insert_query);

        if($insert_result) {
            $delete_query = "DELETE FROM users_archive WHERE id='$id'";
            $delete_result = mysqli_query($conn, $delete_query);

            if($delete_result) {
                return true; 
            } else {
                return false; 
            }
        } else {
            return false; 
        }
    } else {
        return false; 
    }
}

function deleteData($conn, $id) {
    $delete_query = "SELECT * FROM users_archive WHERE id='$id'";
    $delete_result = mysqli_query($conn, $delete_query);
    if(mysqli_num_rows($delete_result) > 0) {
        $delete_query = "DELETE FROM users_archive WHERE id = '$id'";
        $delete_result = mysqli_query($conn, $delete_query);
        if($delete_result) {
            return true; 
        } else {
            return false; 
        }
    } else {
        return false; 
    }
}
function deleteApplicant($conn, $id) {
    $delete_query = "SELECT * FROM admission_data_archive WHERE id='$id'";
    $delete_result = mysqli_query($conn, $delete_query);
    if(mysqli_num_rows($delete_result) > 0) {
        $delete_query = "DELETE FROM  admission_data_archive WHERE id = '$id'";
        $delete_result = mysqli_query($conn, $delete_query);
        if($delete_result) {
            return true; 
        } else {
            return false; 
        }
    } else {
        return false; 
    }
}

function restoreApplicant($conn, $id) {
    $select_query = "SELECT * FROM admission_data_archive WHERE id='$id'";
    $select_result = mysqli_query($conn, $select_query);
    $staff_data = mysqli_fetch_assoc($select_result);

    if($staff_data) {
        $insert_query = "INSERT INTO admission_data
        (applicant_number, Last_Name, Name, Middle_Name, birthplace, college, degree_applied, Gr11_GWA, Gr12_GWA, Interview_Result, OSS_Admission_Test_Score, Endorsed, Personnel_Result, Admission_Result, Confirmed_Slot)
        VALUES ('{$staff_data['applicant_number']}', '{$staff_data['Last_Name']}', '{$staff_data['Name']}', '{$staff_data['Middle_Name']}', '{$staff_data['birthplace']}', '{$staff_data['college']}', 
        '{$staff_data['degree_applied']}', '{$staff_data['Gr11_GWA']}', '{$staff_data['Gr12_GWA']}', '{$staff_data['Interview_Result']}', '{$staff_data['OSS_Admission_Test_Score']}', '{$staff_data['Endorsed']}',
         '{$staff_data['Personnel_Result']}', '{$staff_data['Admission_Result']}', '{$staff_data['Confirmed_Slot']}')";
        $insert_result = mysqli_query($conn, $insert_query);

        if($insert_result) {
            $delete_query = "DELETE FROM admission_data_archive WHERE id='$id'";
            $delete_result = mysqli_query($conn, $delete_query);

            if($delete_result) {
                return true; 
            } else {
                return false; 
            }
        } else {
            return false; 
        }
    } else {
        return false; 
    }
}

function logAction($action, $email, $userType, $ipAddress, $conn)
{
    $action = mysqli_real_escape_string($conn, $action);
    $email = mysqli_real_escape_string($conn, $email);
    $userType = mysqli_real_escape_string($conn, $userType);
    $ipAddress = mysqli_real_escape_string($conn, $ipAddress);

    $query = "INSERT INTO audit_trail (action, email, userType, ip_address) VALUES ('$action', '$email', '$userType', '$ipAddress')";

    if (mysqli_query($conn, $query)) {
        return "Action logged: $action";
    } else {
        return "Error: " . mysqli_error($conn);
    }
}

    

?>
