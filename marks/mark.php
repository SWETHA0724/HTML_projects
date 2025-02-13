<?php
// Database connection parameters
$host = 'localhost'; // Your database host (usually 'localhost')
$username = 'root'; // Your database username
$password = ''; // Your database password
$database = 'mark'; // Your database name

// Function to calculate CGPA based on average marks
function calculateCGPA($averageMarks) {
    $gradePoints = [
        'A+' => 4.0,
        'A'  => 4.0,
        'A-' => 3.7,
        'B+' => 3.3,
        'B'  => 3.0,
        'B-' => 2.7,
        'C+' => 2.3,
        'C'  => 2.0,
        'C-' => 1.7,
        'D+' => 1.3,
        'D'  => 1.0,
        'F'  => 0
    ];

    // Determine CGPA based on average marks
    if ($averageMarks >= 90) {
        return $gradePoints['A+'];
    } elseif ($averageMarks >= 80) {
        return $gradePoints['A'];
    } elseif ($averageMarks >= 75) {
        return $gradePoints['A-'];
    } elseif ($averageMarks >= 70) {
        return $gradePoints['B+'];
    } elseif ($averageMarks >= 65) {
        return $gradePoints['B'];
    } elseif ($averageMarks >= 60) {
        return $gradePoints['B-'];
    } elseif ($averageMarks >= 55) {
        return $gradePoints['C+'];
    } elseif ($averageMarks >= 50) {
        return $gradePoints['C'];
    } elseif ($averageMarks >= 45) {
        return $gradePoints['C-'];
    } elseif ($averageMarks >= 40) {
        return $gradePoints['D+'];
    } elseif ($averageMarks >= 0) {
        return $gradePoints['F'];
   
    }
}

// Process form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Initialize variables for marks and student name
    $marks = [];
    $totalSubjects = 5;

    // Collect student name and marks from POST data
    $studentName = isset($_POST['studentName']) ? $_POST['studentName'] : '';
    for ($i = 1; $i <= $totalSubjects; $i++) {
        $marks[$i] = isset($_POST['subject'.$i]) ? floatval($_POST['subject'.$i]) : 0;
    }

    // Calculate average marks
    $totalMarks = array_sum($marks);
    $averageMarks = $totalMarks / $totalSubjects;

    // Calculate CGPA
    $cgpa = calculateCGPA($averageMarks);

    // Store the CGPA, marks, and student name into the database
    try {
        $conn = new PDO("mysql:host=$host;dbname=$database", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Prepare SQL statement to insert data
        $stmt = $conn->prepare("INSERT INTO details (studentname, subject1, subject2, subject3, subject4, subject5, cgpa) 
                                VALUES (:studentName, :subject1, :subject2, :subject3, :subject4, :subject5, :cgpa)");

        // Bind parameters
        $stmt->bindParam(':studentName', $studentName);
        $stmt->bindParam(':subject1', $marks[1]);
        $stmt->bindParam(':subject2', $marks[2]);
        $stmt->bindParam(':subject3', $marks[3]);
        $stmt->bindParam(':subject4', $marks[4]);
        $stmt->bindParam(':subject5', $marks[5]);
        $stmt->bindParam(':cgpa', $cgpa);

        // Execute the statement
        $stmt->execute();

        // Close connection
        $conn = null;

        // Redirect back to index.php with success message
        header("Location:view.php");
        exit;
    } catch(PDOException $e) {
        // Handle database connection errors
       
    }
}