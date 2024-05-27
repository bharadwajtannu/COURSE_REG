<?php
require 'connect.php'; // Assuming this file contains database connection code

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect form data
    $name = $_POST['name'];
    $email = $_POST['email'];
    $course = $_POST['course'];

    // Prepare SQL statement to insert data into course_table
    $sql = "INSERT INTO course_table (name, email, course) VALUES (?, ?, ?)";

    // Prepare the statement
    $stmt = $con->prepare($sql);

    // Bind parameters and execute the statement
    $stmt->bind_param("sss", $name, $email, $course);
    $stmt->execute();

    // Check if data is inserted successfully
    if ($stmt->affected_rows > 0) {
        echo "Course registration successful! Thank you for registering.";
        // You can perform further actions here if needed
    } else {
        echo "Error: " . $con->error;
    }

    // Close the statement
    $stmt->close();
} else {
    // Redirect back to the registration form if accessed directly
    header("Location: registration_form.html");
    exit;
}
?>