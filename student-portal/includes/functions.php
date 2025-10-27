<?php
function sanitizeInput($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

// Validate email format
function validateEmail($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
}

// Validate phone number
function validatePhone($phone) {
    return preg_match('/^[6-9][0-9]{9}$/', $phone);
}

// Validate student ID 
function validateStudentId($student_id) {
    return preg_match('/^[A-Za-z0-9]{3,}$/', $student_id);
}

// Validate name
function validateName($name) {
    return preg_match('/^[A-Z][a-zA-Z\s\.]{2,}$/', $name);
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