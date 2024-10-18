<?php 
session_start();
require_once 'config/database.php';
require_once 'lang/' . ($_SESSION['lang'] ?? 'en') . '.php';

function lang($key) {
    global $lang;
    return $lang[$key] ?? $key;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $password = $_POST['password'];

    if ($email && $password) {
        $sql = "SELECT * FROM users WHERE email = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$email]);
        $user = $stmt->fetch();

        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_role'] = $user['role'];
            header('Location: index.php');
            exit;
        } else {
            $error_message = lang('invalid_credentials');
        }
    } else {
        $error_message = lang('fill_all_fields');
    }
}
?>

<!DOCTYPE html>
<html lang="<?php echo $_SESSION['lang'] ?? 'en'; ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo lang('login'); ?> - Forsat</title>
    <link rel="stylesheet" href="assets/css/styles.css">
</head>
<body>
    <header>
        <!-- Add header content -->
    </header>

    <main>
        <h1><?php echo lang('login'); ?></h1>
        
        <?php if (isset($error_message)): ?>
            <p class="error"><?php echo $error_message; ?></p>
        <?php endif; ?>

        <form action="login.php" method="POST">
            <label for="email"><?php echo lang('email'); ?></label>
            <input type="email" id="email" name="email" required>

            <label for="password"><?php echo lang('password'); ?></label>
            <input type="password" id="password" name="password" required>

            <button type="submit"><?php echo lang('login'); ?></button>
        </form>
    </main>

    <footer>
        <!-- Add footer content -->
    </footer>

    <script src="assets/js/scripts.js"></script>
</body>
</html>
