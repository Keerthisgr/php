<?php
require_once '../includes/auth.php';
require_once '../includes/functions.php';
redirectIfNotLoggedIn();

$search = '';
if (isset($_GET['search'])) {
    $search = sanitizeInput($_GET['search']);
}

$students = getStudents($search);
?>

<?php include '../includes/header.php'; ?>
<h2>Students List</h2>

<div class="card">
    <div class="card-header">
        <div class="row">
            <div class="col-md-6">
                <form method="GET" class="d-flex">
                    <input type="text" name="search" class="form-control me-2" placeholder="Search by name, student ID, or email" value="<?php echo $search; ?>">
                    <button type="submit" class="btn btn-primary">Search</button>
                </form>
            </div>
            <div class="col-md-6 text-end">
                <a href="create_student.php" class="btn btn-success">Add New Student</a>
            </div>
        </div>
    </div>
    <div class="card-body">
        <?php if (empty($students)): ?>
            <div class="alert alert-info">No students found.</div>
        <?php else: ?>
            <div class="table-responsive">
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Student ID</th>
                            <th>Full Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Course</th>
                            <th>Subject</th>
                            <th>Admission Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($students as $student): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($student['student_id']); ?></td>
                            <td><?php echo htmlspecialchars($student['full_name']); ?></td>
                            <td><?php echo htmlspecialchars($student['email']); ?></td>
                            <td><?php echo htmlspecialchars($student['phone']); ?></td>
                            <td><?php echo htmlspecialchars($student['course']); ?></td>
                            <td><?php echo htmlspecialchars($student['subject']); ?></td>
                            <td><?php echo date('M d, Y', strtotime($student['admission_date'])); ?></td>
                            <td>
                                <a href="student_profile.php?id=<?php echo $student['id']; ?>" class="btn btn-sm btn-info">View</a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>
    </div>
</div>
<?php include '../includes/footer.php'; ?>