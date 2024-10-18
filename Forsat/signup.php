<?php 
session_start();
require_once 'config/database.php';
require_once 'lang/' . ($_SESSION['lang'] ?? 'en') . '.php';

function lang($key) {
    global $lang;
    return $lang[$key] ?? $key;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
    $firstname = filter_input(INPUT_POST, 'firstname', FILTER_SANITIZE_STRING);
    $lastname = filter_input(INPUT_POST, 'lastname', FILTER_SANITIZE_STRING);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $password = $_POST['password'];
    $phone = filter_input(INPUT_POST, 'phone', FILTER_SANITIZE_STRING);
    $role = filter_input(INPUT_POST, 'role', FILTER_SANITIZE_STRING);
    $remember = isset($_POST['remember']) ? 1 : 0;

    if ($username && $firstname && $lastname && $email && $password && $phone && $role) {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        
        $sql = "INSERT INTO users (username, firstname, lastname, email, password, phone, role) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        $result = $stmt->execute([$username, $firstname, $lastname, $email, $hashed_password, $phone, $role]);

        if ($result) {
            if ($remember) {
                $token = bin2hex(random_bytes(16));
                setcookie('remember_token', $token, time() + 30 * 24 * 60 * 60, '/', '', true, true);
                
                $sql = "UPDATE users SET remember_token = ? WHERE email = ?";
                $stmt = $pdo->prepare($sql);
                $stmt->execute([$token, $email]);
            }
            
            $_SESSION['user_id'] = $pdo->lastInsertId();
            $_SESSION['user_role'] = $role;
            header('Location: index.php');
            exit;
        } else {
            $error_message = lang('registration_failed');
        }
    } else {
        $error_message = lang('fill_all_fields');
    }
}
?>

