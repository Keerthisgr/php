<?php
require_once '../includes/auth.php';
require_once '../includes/functions.php';
redirectIfNotLoggedIn();

if (!isset($_GET['id'])) {
    header("Location: view_students.php");
    exit();
}

$student_id = intval($_GET['id']);
$student = getStudentById($student_id);

if (!$student) {
    header("Location: view_students.php");
    exit();
}
?>

<?php include '../includes/header.php'; ?>
<h2>Student Profile</h2>

<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h4 class="mb-0"><?php echo htmlspecialchars($student['full_name']); ?></h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <h5>Personal Information</h5>
                        <table class="table table-bordered">
                            <tr>
                                <th>Student ID:</th>
                                <td><?php echo htmlspecialchars($student['student_id']); ?></td>
                            </tr>
                            <tr>
                                <th>Full Name:</th>
                                <td><?php echo htmlspecialchars($student['full_name']); ?></td>
                            </tr>
                            <tr>
                                <th>Gender:</th>
                                <td><?php echo htmlspecialchars($student['gender']); ?></td>
                            </tr>
                            <tr>
                                <th>Email:</th>
                                <td><?php echo htmlspecialchars($student['email']); ?></td>
                            </tr>
                            <tr>
                                <th>Phone:</th>
                                <td><?php echo htmlspecialchars($student['phone']); ?></td>
                            </tr>
                            <tr>
                                <th>Blood Group:</th>
                                <td><?php echo htmlspecialchars($student['blood_group']); ?></td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-md-6">
                        <h5>Academic Information</h5>
                        <table class="table table-bordered">
                            <tr>
                                <th>Course:</th>
                                <td><?php echo htmlspecialchars($student['course']); ?></td>
                            </tr>
                            <tr>
                                <th>Subject:</th>
                                <td><?php echo htmlspecialchars($student['subject']); ?></td>
                            </tr>
                            <tr>
                                <th>Admission Date:</th>
                                <td><?php echo date('M d, Y', strtotime($student['admission_date'])); ?></td>
                            </tr>
                            <tr>
                                <th>Registered On:</th>
                                <td><?php echo date('M d, Y H:i', strtotime($student['created_at'])); ?></td>
                            </tr>
                        </table>
                    </div>
                </div>
                
                <div class="row mt-3">
                    <div class="col-12">
                        <h5>Address</h5>
                        <div class="card">
                            <div class="card-body">
                                <?php echo nl2br(htmlspecialchars($student['address'])); ?>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="mt-3">
                    <a href="view_students.php" class="btn btn-secondary">Back to List</a>
                    <a href="dashboard.php" class="btn btn-primary">Dashboard</a>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include '../includes/footer.php'; ?>