<?php
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../includes/auth.php';
require_once __DIR__ . '/../includes/functions.php';
redirectIfNotLoggedIn();
?>

<?php include __DIR__ . '/../includes/header.php'; ?>

<div class="row mb-4">
    <div class="col-12">
        <div class="card text-white bg-secondary">
            <div class="card-body text-center py-3">
                <h2 class="mb-0">Welcome, <?php echo $_SESSION['admin_username']; ?>!</h2>
            </div>
        </div>
    </div>
</div>

<div class="row mb-4">
    <div class="col-md-6">
        <div class="card text-white" style="background: linear-gradient(135deg, #c4bb6eff 0%, #b5c65fff 100%);">
            <div class="card-body text-center py-4">
                <h5 class="card-title">Total Students</h5>
                <?php
                $database = new Database();
                $db = $database->getConnection();
                $stmt = $db->query("SELECT COUNT(*) as total FROM students");
                $result = $stmt->fetch(PDO::FETCH_ASSOC);
                ?>
                <h1 class="display-4"><?php echo $result['total']; ?></h1>
            </div>
        </div>
    </div>
    

    <div class="col-md-6">
        <div class="card">
            <div class="card-body text-center py-4">
                <h5 class="card-title">Quick Actions</h5>
                <div class="d-grid gap-2">
                    <a href="create_student.php" class="btn btn-primary btn-lg">Create New Student</a>
                    <a href="view_students.php" class="btn btn-success btn-lg">View All Students</a>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="row mt-4">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h5>Recent Students</h5>
            </div>
            <div class="card-body">
                <?php
                $database = new Database();
                $db = $database->getConnection();
                $stmt = $db->query("SELECT * FROM students ORDER BY created_at DESC LIMIT 5");
                $students = $stmt->fetchAll(PDO::FETCH_ASSOC);
                
                if (empty($students)): ?>
                    <p class="text-muted">No students found. <a href="create_student.php">Create your first student</a></p>
                <?php else: ?>
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Student ID</th>
                                    <th>Name</th>
                                    <th>Course</th>
                                    <th>Subject</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($students as $student): ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($student['student_id']); ?></td>
                                    <td><?php echo htmlspecialchars($student['full_name']); ?></td>
                                    <td><?php echo htmlspecialchars($student['course']); ?></td>
                                    <td><?php echo htmlspecialchars($student['subject']); ?></td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<?php include __DIR__ . '/../includes/footer.php'; ?>