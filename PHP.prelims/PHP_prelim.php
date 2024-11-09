
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Enrollment and Grade Processing System</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="styles.css">
    </head>
<body>
<br>
<h3 class="text-center">Student Enrollment and Grade Processing System</h3>

<?php
// Initialize variables
$studentInfoSubmitted = false;
$gradesSubmitted = false;
$firstName = $lastName = $age = $gender = $course = $email = "";
$prelim = $midterm = $final = $averageGrade = 0;
$gradeStatus = "";

// Check if the student info form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submitStudentInfo'])) {
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $age = $_POST['age'];
    $gender = $_POST['gender'];
    $course = $_POST['course'];
    $email = $_POST['email'];
    $studentInfoSubmitted = true;
}

// Check if the grades form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submitGrades'])) {
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $age = $_POST['age'];
    $gender = $_POST['gender'];
    $course = $_POST['course'];
    $email = $_POST['email'];
    
    $prelim = $_POST['prelim'];
    $midterm = $_POST['midterm'];
    $final = $_POST['final'];
    $averageGrade = ($prelim + $midterm + $final) / 3;
    $gradeStatus = $averageGrade >= 75 ? "Passed" : "Failed";
    $gradesSubmitted = true;
}
?>

<!-- Student Enrollment Form -->
<?php if (!$studentInfoSubmitted): ?>
    <form method="post" class="form-group">
        <h4>Student Enrollment Form</h4>
        <label for="firstName" class="form-label">First Name</label>
        <input type="text" id="firstName" name="firstName" class="form-control" required>

        <label for="lastName" class="form-label">Last Name</label>
        <input type="text" id="lastName" name="lastName" class="form-control" required>

        <label for="age" class="form-label">Age</label>
        <input type="number" id="age" name="age" class="form-control" required>

        <label class="form-label">Gender</label><br>
        <div class="form-check form-check-inline">
            <input type="radio" id="male" name="gender" value="Male" class="form-check-input" checked>
            <label for="male" class="form-check-label">Male</label>
        </div>
        <div class="form-check form-check-inline">
            <input type="radio" id="female" name="gender" value="Female" class="form-check-input">
            <label for="female" class="form-check-label">Female</label>
        </div><br>

        <label for="course" class="form-label">Course</label>
        <select id="course" name="course" class="form-control" required>
            <option value="BSA">BSA</option>
            <option value="BSIT" selected>BSIT</option>
            <option value="BSTM">BSTM</option>
            <option value="BSCRIM">BSCRIM</option>
        </select>

        <label for="email" class="form-label">Email</label>
        <input type="email" id="email" name="email" class="form-control" required><br>

        <button type="submit" name="submitStudentInfo" class="btn btn-primary">Submit Student Information</button>
    </form>
<?php endif; ?>

<!-- Grades Form -->
<?php if ($studentInfoSubmitted && !$gradesSubmitted): ?>
    <form method="post" class="form-group">
        <h4>Enter Grades for <?php echo htmlspecialchars($firstName . " " . $lastName); ?></h4>
        
        <!-- Hidden fields to pass student info -->
        <input type="hidden" name="firstName" value="<?php echo htmlspecialchars($firstName); ?>">
        <input type="hidden" name="lastName" value="<?php echo htmlspecialchars($lastName); ?>">
        <input type="hidden" name="age" value="<?php echo htmlspecialchars($age); ?>">
        <input type="hidden" name="gender" value="<?php echo htmlspecialchars($gender); ?>">
        <input type="hidden" name="course" value="<?php echo htmlspecialchars($course); ?>">
        <input type="hidden" name="email" value="<?php echo htmlspecialchars($email); ?>">
        
        <label for="prelim" class="form-label">Prelim</label>
        <input type="number" id="prelim" name="prelim" class="form-control" min="0" max="100" required>

        <label for="midterm" class="form-label">Midterm</label>
        <input type="number" id="midterm" name="midterm" class="form-control" min="0" max="100" required>

        <label for="final" class="form-label">Final</label>
        <input type="number" id="final" name="final" class="form-control" min="0" max="100" required><br>

        <button type="submit" name="submitGrades" class="btn btn-success">Submit Grades</button>
    </form>
<?php endif; ?>

<!-- Display Student Details and Grades -->
<?php if ($gradesSubmitted): ?>
    <div class="student-details">
        <h4>Student Details</h4>
        <p><strong>First Name:</strong> <?php echo htmlspecialchars($firstName); ?></p>
        <p><strong>Last Name:</strong> <?php echo htmlspecialchars($lastName); ?></p>
        <p><strong>Age:</strong> <?php echo htmlspecialchars($age); ?></p>
        <p><strong>Gender:</strong> <?php echo htmlspecialchars($gender); ?></p>
        <p><strong>Course:</strong> <?php echo htmlspecialchars($course); ?></p>
        <p><strong>Email:</strong> <?php echo htmlspecialchars($email); ?></p>

        <h4>Grades</h4>
        <p><strong>Prelim:</strong> <?php echo htmlspecialchars($prelim); ?></p>
        <p><strong>Midterm:</strong> <?php echo htmlspecialchars($midterm); ?></p>
        <p><strong>Final:</strong> <?php echo htmlspecialchars($final); ?></p>
        <p><strong>Average Grade:</strong> 
            <?php echo number_format($averageGrade, 2); ?> - 
            <span class="<?php echo $gradeStatus == 'Passed' ? 'text-success' : 'text-danger'; ?>">
                <?php echo $gradeStatus; ?>
            </span>
        </p>
    </div>
<?php endif; ?>


</body>
</html>
