<?php
session_start();
require_once 'config/database.php';

// Set default language if not set
if (!isset($_SESSION['lang'])) {
    $_SESSION['lang'] = 'en';
}

// Handle language change
if (isset($_GET['lang']) && in_array($_GET['lang'], ['en', 'fr'])) {
    $_SESSION['lang'] = $_GET['lang'];
}

// Include language file
$lang_file = 'lang/' . $_SESSION['lang'] . '.php';
if (file_exists($lang_file)) {
    $lang = include $lang_file;
} else {
    die("Language file not found");
}

// Function to safely get language strings
function lang($key) {
    global $lang;
    return $lang[$key] ?? $key;
}

// Fetch jobs for display
$sql = "SELECT * FROM jobs ORDER BY created_at DESC LIMIT 10";
$stmt = $pdo->query($sql);
$jobs = $stmt->fetchAll();

?>
<!DOCTYPE html>
<html lang="<?php echo $_SESSION['lang']; ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forsat - <?php echo lang('home'); ?></title>
    <link rel="stylesheet" href="assets/css/styles.css">
</head>
<body>
    <header>
        <nav>
            <a href="?lang=en">English</a> | 
            <a href="?lang=fr">Français</a>
            <!-- Add other navigation items -->
        </nav>
    </header>

    <main>
        <h1><?php echo lang('welcome'); ?></h1>
        <ul>
            <li><a href="signup.php"><?php echo lang('create_account'); ?></a></li>
            <li><a href="jobs.php"><?php echo lang('view_jobs'); ?></a></li>
            <?php if (isset($_SESSION['user_id'])): ?>
                <?php if ($_SESSION['user_role'] === 'recruiter'): ?>
                    <li><a href="post_job.php"><?php echo lang('post_job'); ?></a></li>
                <?php endif; ?>
                <li><a href="logout.php"><?php echo lang('logout'); ?></a></li>
            <?php else: ?>
                <li><a href="login.php"><?php echo lang('login'); ?></a></li>
            <?php endif; ?>
        </ul>

        <h2><?php echo lang('recent_jobs'); ?></h2>
        <ul>
            <?php foreach ($jobs as $job): ?>
                <li>
                    <h3><?php echo htmlspecialchars($job['title']); ?></h3>
                    <p><?php echo htmlspecialchars($job['company']); ?> - <?php echo htmlspecialchars($job['location']); ?></p>
                    <a href="apply.php?job_id=<?php echo $job['id']; ?>"><?php echo lang('apply'); ?></a>
                </li>
            <?php endforeach; ?>
        </ul>
    </main>

    <footer>
        <!-- Add footer content -->
    </footer>

    <script src="assets/js/scripts.js"></script>
</body>
</html>