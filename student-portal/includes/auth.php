<?php
session_start();
require_once __DIR__ . '/functions.php';
require_once __DIR__ . '/../config/database.php';

function isLoggedIn() {
    return isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true;
}

function redirectIfNotLoggedIn() {
    if (!isLoggedIn()) {
        header("Location: login.php");
        exit();
    }
}

function login($username, $password) {
    $database = new Database();
    $db = $database->getConnection();
    
    $query = "SELECT id, username, password FROM admin WHERE username = :username";
    $stmt = $db->prepare($query);
    $stmt->bindParam(':username', $username);
    $stmt->execute();
    
    if ($stmt->rowCount() == 1) {
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($password === $row['password']) {
            $_SESSION['admin_logged_in'] = true;
            $_SESSION['admin_id'] = $row['id'];
            $_SESSION['admin_username'] = $row['username'];
            return true;
        }
    }
    return false;
}
?>