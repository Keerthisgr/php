<?php
require_once '../includes/auth.php';
require_once '../includes/functions.php';
redirectIfNotLoggedIn();

$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    try {
        $full_name = sanitizeInput($_POST['full_name']);
        $student_id = sanitizeInput($_POST['student_id']);
        $gender = sanitizeInput($_POST['gender']);
        $address = sanitizeInput($_POST['address']);
        $email = sanitizeInput($_POST['email']);
        $phone = sanitizeInput($_POST['phone']);
        $blood_group = sanitizeInput($_POST['blood_group']);
        $admission_date = sanitizeInput($_POST['admission_date']);
        $course = sanitizeInput($_POST['course']);
        $subject = sanitizeInput($_POST['subject']);
        
        // Validation
        if (empty($full_name) || empty($student_id) || empty($email) || empty($phone)) {
            throw new Exception('All fields are required.');
        }
        
        if (!validateEmail($email)) {
            throw new Exception('Invalid email format.');
        }
        
        if (!validatePhone($phone)) {
            throw new Exception('Invalid phone number.');
        }
        
        if (!validateStudentId($student_id)) {
            throw new Exception('Invalid Student ID format.');
        }
        
        // Check if student ID or email already exists
        $database = new Database();
        $db = $database->getConnection();
        
        $check_query = "SELECT id FROM students WHERE student_id = :student_id OR email = :email";
        $check_stmt = $db->prepare($check_query);
        $check_stmt->bindParam(':student_id', $student_id);
        $check_stmt->bindParam(':email', $email);
        $check_stmt->execute();
        
        if ($check_stmt->rowCount() > 0) {
            throw new Exception('Student ID or Email already exists.');
        }
        
        // Insert student
        $query = "INSERT INTO students (full_name, student_id, gender, address, email, phone, blood_group, admission_date, course, subject) 
                  VALUES (:full_name, :student_id, :gender, :address, :email, :phone, :blood_group, :admission_date, :course, :subject)";
        
        $stmt = $db->prepare($query);
        $stmt->bindParam(':full_name', $full_name);
        $stmt->bindParam(':student_id', $student_id);
        $stmt->bindParam(':gender', $gender);
        $stmt->bindParam(':address', $address);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':phone', $phone);
        $stmt->bindParam(':blood_group', $blood_group);
        $stmt->bindParam(':admission_date', $admission_date);
        $stmt->bindParam(':course', $course);
        $stmt->bindParam(':subject', $subject);
        
        if ($stmt->execute()) {
            $success = 'Student profile created successfully!';
            $_POST = array(); // Clear form
        } else {
            throw new Exception('Failed to create student profile.');
        }
        
    } catch (Exception $e) {
        $error = $e->getMessage();
    }
}
?>

<?php include '../includes/header.php'; ?>
<h2>Create Student Profile</h2>

<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-body">
                <?php if ($error): ?>
                    <div class="alert alert-danger"><?php echo $error; ?></div>
                <?php endif; ?>
                
                <?php if ($success): ?>
                    <div class="alert alert-success"><?php echo $success; ?></div>
                <?php endif; ?>
                
                <form method="POST" action="">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="full_name" class="form-label">Full Name *</label>
                                <input type="text" class="form-control" id="full_name" name="full_name" 
                                       value="<?php echo $_POST['full_name'] ?? ''; ?>" required>
                            </div>
                            
                            <div class="mb-3">
                                <label for="student_id" class="form-label">Student ID *</label>
                                <input type="text" class="form-control" id="student_id" name="student_id" 
                                       value="<?php echo $_POST['student_id'] ?? ''; ?>" required>
                            </div>
                            
                            <div class="mb-3">
                                <label for="gender" class="form-label">Gender *</label>
                                <select class="form-select" id="gender" name="gender" required>
                                    <option value="">Select Gender</option>
                                    <option value="Male" <?php echo ($_POST['gender'] ?? '') == 'Male' ? 'selected' : ''; ?>>Male</option>
                                    <option value="Female" <?php echo ($_POST['gender'] ?? '') == 'Female' ? 'selected' : ''; ?>>Female</option>
                                    <option value="Other" <?php echo ($_POST['gender'] ?? '') == 'Other' ? 'selected' : ''; ?>>Other</option>
                                </select>
                            </div>
                            
                            <div class="mb-3">
                                <label for="email" class="form-label">Email *</label>
                                <input type="email" class="form-control" id="email" name="email" 
                                       value="<?php echo $_POST['email'] ?? ''; ?>" required>
                            </div>
                            
                            <div class="mb-3">
                                <label for="phone" class="form-label">Phone *</label>
                                <input type="tel" class="form-control" id="phone" name="phone" 
                                       value="<?php echo $_POST['phone'] ?? ''; ?>" required>
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="blood_group" class="form-label">Blood Group *</label>
                                <select class="form-select" id="blood_group" name="blood_group" required>
                                    <option value="">Select Blood Group</option>
                                    <option value="A+">A+</option>
                                    <option value="A-">A-</option>
                                    <option value="B+">B+</option>
                                    <option value="B-">B-</option>
                                    <option value="AB+">AB+</option>
                                    <option value="AB-">AB-</option>
                                    <option value="O+">O+</option>
                                    <option value="O-">O-</option>
                                </select>
                            </div>
                            
                            <div class="mb-3">
                                <label for="admission_date" class="form-label">Admission Date *</label>
                                <input type="date" class="form-control" id="admission_date" name="admission_date" 
                                       value="<?php echo $_POST['admission_date'] ?? ''; ?>" required>
                            </div>
                            
                            <div class="mb-3">
                                <label for="course" class="form-label">Course *</label>
                                <select class="form-select" id="course" name="course" required>
                                    <option value="">Select Course</option>
                                    <option value="BE">BE</option>
                                    <option value="M Tech">M Tech</option>
                                    <option value="BSc">BSc</option>
                                    <option value="MSc">MSc</option>
                                </select>
                            </div>
                            
                            <div class="mb-3">
                                <label for="subject" class="form-label">Subject *</label>
                                <select class="form-select" id="subject" name="subject" required>
                                    <option value="">Select Subject</option>
                                    <option value="CSE">CSE</option>
                                    <option value="EC">EC</option>
                                    <option value="EEE">EEE</option>
                                    <option value="ME">ME</option>
                                    <option value="IS">IS</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label for="address" class="form-label">Address *</label>
                        <textarea class="form-control" id="address" name="address" rows="3" required><?php echo $_POST['address'] ?? ''; ?></textarea>
                    </div>
                    
                    <button type="submit" class="btn btn-primary">Create Student Profile</button>
                    <a href="dashboard.php" class="btn btn-secondary">Cancel</a>
                </form>
            </div>
        </div>
    </div>
</div>
<?php include '../includes/footer.php'; ?>