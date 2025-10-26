<?php
function sanitizeInput($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

function validateEmail($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}

function validatePhone($phone) {
    return preg_match('/^[0-9]{10,15}$/', $phone);
}

function validateStudentId($student_id) {
    return preg_match('/^[A-Z0-9]{5,20}$/', $student_id);
}

function getStudents($search = '') {
    $database = new Database();
    $db = $database->getConnection();
    
    $query = "SELECT * FROM students";
    $params = [];
    
    if (!empty($search)) {
        $query .= " WHERE full_name LIKE :search OR student_id LIKE :search OR email LIKE :search";
        $params[':search'] = "%$search%";
    }
    
    $query .= " ORDER BY created_at DESC";
    $stmt = $db->prepare($query);
    $stmt->execute($params);
    
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function getStudentById($id) {
    $database = new Database();
    $db = $database->getConnection();
    
    $query = "SELECT * FROM students WHERE id = :id";
    $stmt = $db->prepare($query);
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    
    return $stmt->fetch(PDO::FETCH_ASSOC);
}
?>