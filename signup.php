<?php
$registration_success = 0;
$user_registered = 0;
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include 'connect.php';

    $name = $_POST['name'];
    $email = $_POST['email'];
    $course = $_POST['course'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM course_table WHERE name='$name' AND email='$email' AND course='$course' AND password='$password'";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        $num = mysqli_num_rows($result);
        if ($num > 0) {
            $user_registered = 1;
        } else {
            $sql = "INSERT INTO course_table (name, email, course, password) VALUES ('$name', '$email', '$course', '$password')";
            $result = mysqli_query($conn, $sql);
            if ($result) {
                $registration_success = 1;
            } else {
                die(mysqli_error($conn));
            }
        }
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Course Registration</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <?php
    if (isset($user_registered) && $user_registered) {
        echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
        <strong>Sorry</strong> You are already registered for this course.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';
    }

    ?>
    <div class="main">
        <h1>COURSE REGISTRATION</h1>

        <form action="registration_handler.php" method="post">
            <label for="name">
                Name:
            </label>
            <input type="text" id="name" name="name" placeholder="Enter your Name" required>

            <br />

            <label for="email">
                Email:
            </label>
            <input type="email" id="email" name="email" placeholder="Enter your Email" required>

            <br />

            <label for="course">
                Course:
            </label>
            <select id="course" name="course" required>
                <option value="">Select Course</option>
                <option value="course1">Course 1</option>
                <option value="course2">Course 2</option>
                <option value="course3">Course 3</option>
            </select>

            <br />
            <label for="password">
                Password:
            </label>
            <input type="password" id="password" name="email" placeholder="Enter your password" required>

            <br />

            <div class="wrap">
                <button type="submit">
                    Register
                </button>
            </div>
            <div class="form-section">
                <p>Already have an account? <a href="login.php">Log in</a> </p>
            </div>
        </form>
        <?php
        if (isset($registration_success) && $registration_success) {
            echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong>Success</strong> You have successfully registered for the course.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>';
        }
        ?>
    </div>
</body>

</html>