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

// Pagination
$jobs_per_page = 10;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $jobs_per_page;

// Search functionality
$search = isset($_GET['search']) ? $_GET['search'] : '';
$search_condition = $search ? "WHERE title LIKE :search OR company LIKE :search OR location LIKE :search" : "";

// Fetch jobs
$stmt = $pdo->prepare("SELECT * FROM jobs $search_condition ORDER BY created_at DESC LIMIT :offset, :limit");
if ($search) {
    $stmt->bindValue(':search', "%$search%", PDO::PARAM_STR);
}
$stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
$stmt->bindValue(':limit', $jobs_per_page, PDO::PARAM_INT);
$stmt->execute();
$jobs = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Get total number of jobs for pagination
$total_stmt = $pdo->prepare("SELECT COUNT(*) FROM jobs $search_condition");
if ($search) {
    $total_stmt->bindValue(':search', "%$search%", PDO::PARAM_STR);
}
$total_stmt->execute();
$total_jobs = $total_stmt->fetchColumn();
$total_pages = ceil($total_jobs / $jobs_per_page);
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

        <!-- Search form -->
        <form action="all_jobs.php" method="GET">
            <input type="text" name="search" placeholder="<?php echo lang('search_jobs'); ?>" value="<?php echo htmlspecialchars($search); ?>">
            <button type="submit"><?php echo lang('search'); ?></button>
        </form>

        <?php if (empty($jobs)): ?>
            <p><?php echo lang('no_jobs_available'); ?></p>
        <?php else: ?>
            <?php foreach ($jobs as $job): ?>
                <div class="job">
                    <h2><?php echo htmlspecialchars($job['title']); ?></h2>
                    <p><strong><?php echo lang('company'); ?>:</strong> <?php echo htmlspecialchars($job['company']); ?></p>
                    <p><strong><?php echo lang('location'); ?>:</strong> <?php echo htmlspecialchars($job['location']); ?></p>
                    <p><?php echo nl2br(htmlspecialchars($job['description'])); ?></p>
                    <p><strong><?php echo lang('requirements'); ?>:</strong> <?php echo nl2br(htmlspecialchars($job['requirements'])); ?></p>
                    <p><strong><?php echo lang('posted_on'); ?>:</strong> <?php echo date('F j, Y', strtotime($job['created_at'])); ?></p>
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

            <!-- Pagination -->
            <div class="pagination">
                <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                    <a href="?page=<?php echo $i; ?>&search=<?php echo urlencode($search); ?>" <?php echo $i === $page ? 'class="active"' : ''; ?>><?php echo $i; ?></a>
                <?php endfor; ?>
            </div>
        <?php endif; ?>
    </main>

    <footer>
        <!-- Add footer content -->
    </footer>

    <script src="assets/js/scripts.js"></script>
</body>
</html>
