<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Enrollment and Grade Processing System</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/prelim.css">

</head>
<body>
<br>
<h3 class="center" >Student Enrollment and Grade Processing System</h3>

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
    <form method="post">
        <h4>Student Enrollment Form</h4>
        <label for="firstName">First Name</label><br>
        <input type="text" id="firstName" name="firstName" required><br>

        <label for="lastName">Last Name</label><br>
        <input type="text" id="lastName" name="lastName" required><br>

        <label for="age">Age</label><br>
        <input type="number" id="age" name="age" required><br>

        <label>Gender</label><br>
        <div class="gender-container">
            <label for="male">Male</label>
            <input type="radio" id="male" name="gender" value="Male" checked>
            
            <label for="female">Female</label>
            <input type="radio" id="female" name="gender" value="Female">
        </div>


        <label for="course">Course</label>
        <select id="course" name="course" required>
            <option value="BSA">BSA</option>
            <option value="BSIT" selected>BSIT</option>
            <option value="BSTM">BSTM</option>
            <option value="BSCRIM">BSCRIM</option>
        </select><br>

        <label for="email">Email</label><br>
        <input type="email" id="email" name="email" required><br><br>

        <button type="submit" name="submitStudentInfo" class="submit-btn" style="background-color: #007bff; color: white;">Submit Student Information</button><br><br>
    </form>
<?php endif; ?>

<!-- Grades Form -->
<?php if ($studentInfoSubmitted && !$gradesSubmitted): ?>
    <form method="post">
        <h4>Enter Grades for <?php echo htmlspecialchars($firstName . " " . $lastName); ?></h4>
        
        <!-- Hidden fields to pass student info -->
        <input type="hidden" name="firstName" value="<?php echo htmlspecialchars($firstName); ?>">
        <input type="hidden" name="lastName" value="<?php echo htmlspecialchars($lastName); ?>">
        <input type="hidden" name="age" value="<?php echo htmlspecialchars($age); ?>">
        <input type="hidden" name="gender" value="<?php echo htmlspecialchars($gender); ?>">
        <input type="hidden" name="course" value="<?php echo htmlspecialchars($course); ?>">
        <input type="hidden" name="email" value="<?php echo htmlspecialchars($email); ?>">
        
        <label for="prelim">Prelim</label><br>
        <input type="number" id="prelim" name="prelim" required><br>

        <label for="midterm">Midterm</label><br>
        <input type="number" id="midterm" name="midterm" required><br>

        <label for="final">Final</label><br>
        <input type="number" id="final" name="final" required><br><br>

        <button type="submit" name="submitGrades" class="submit-btn" style="background-color: #28a745; color: white;">Submit Grades</button>
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