<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View CGPA Details</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h2>CGPA Details</h2>

    <?php
    // Database connection parameters
    $host = 'localhost'; // Your database host (usually 'localhost')
    $username = 'root'; // Your database username
    $password = ''; // Your database password
    $database = 'mark'; // Your database name

    try {
        // Connect to MySQL database
        $conn = new PDO("mysql:host=$host;dbname=$database", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Prepare SQL statement to fetch all records from cgpa_results table
        $stmt = $conn->query("SELECT * FROM details");

        if ($stmt->rowCount() > 0) {
            // Display records in a table
            echo '<table>';
            echo '<tr><th>ID</th><th>Student Name</th><th>Operating system</th><th>Computer networks</th><th>Statistics</th><th>DBMS</th><th>JAVA</th></th><th>CGPA</th><th>Created At</th></tr>';

            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo '<tr>';
                echo '<td>' . htmlspecialchars($row['id']) . '</td>';
                echo '<td>' . htmlspecialchars($row['studentname']) . '</td>';
                echo '<td>' . htmlspecialchars($row['subject1']) . '</td>';
                echo '<td>' . htmlspecialchars($row['subject2']) . '</td>';
                echo '<td>' . htmlspecialchars($row['subject3']) . '</td>';
                echo '<td>' . htmlspecialchars($row['subject4']) . '</td>';
                echo '<td>' . htmlspecialchars($row['subject5']) . '</td>';
                echo '<td>' . htmlspecialchars($row['cgpa']) . '</td>';
                echo '<td>' . htmlspecialchars($row['created_at']) . '</td>';
                echo '</tr>';
            }

            echo '</table>';
        } else {
            echo '<p>No records found.</p>';
        }

        // Close connection
        $conn = null;
    } catch(PDOException $e) {
        // Handle database connection errors
        echo 'Error: ' . $e->getMessage();
    }
    ?>

</body>
</html>
