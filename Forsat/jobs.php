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

// Fetch all jobs
$stmt = $pdo->query("SELECT * FROM jobs ORDER BY created_at DESC");
$jobs = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="<?php echo $_SESSION['lang']; ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo lang('all_jobs'); ?> - Forsat</title>
    <link rel="stylesheet" href="assets/css/styles.css">
</head>
<body>
    <header>
        <nav>
            <a href="?lang=en">English</a> | 
            <a href="?lang=fr">Français</a>
            <a href="index.php"><?php echo lang('home'); ?></a>
            <!-- Add other navigation items as needed -->
        </nav>
    </header>

    <main>
        <h1><?php echo lang('all_jobs'); ?></h1>

        <?php if (empty($jobs)): ?>
            <p><?php echo lang('no_jobs_available'); ?></p>
        <?php else: ?>
            <?php foreach ($jobs as $job): ?>
                <div class="job">
                    <h2><?php echo htmlspecialchars($job['title']); ?></h2>
                    <p><?php echo htmlspecialchars($job['description']); ?></p>
                    <p><strong><?php echo lang('requirements'); ?>:</strong> <?php echo htmlspecialchars($job['requirements']); ?></p>
                    <p><strong><?php echo lang('location'); ?>:</strong> <?php echo htmlspecialchars($job['location']); ?></p>
                    <p><strong><?php echo lang('company'); ?>:</strong> <?php echo htmlspecialchars($job['company']); ?></p>
                    <?php if (isset($_SESSION['user_id']) && $_SESSION['user_role'] === 'jobseeker'): ?>
                        <form action="apply.php" method="POST">
                            <input type="hidden" name="job_id" value="<?php echo $job['id']; ?>">
                            <button type="submit"><?php echo lang('apply'); ?></button>
                        </form>
                    <?php elseif (!isset($_SESSION['user_id'])): ?>
                        <p><?php echo lang('login_to_apply'); ?> <a href="login.php"><?php echo lang('login'); ?></a></p>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </main>

    <footer>
        <!-- Add footer content -->
    </footer>

    <script src="assets/js/scripts.js"></script>
</body>
</html>
