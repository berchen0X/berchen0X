<?php
include_once "header.php";
?>


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
    <title><?php echo lang('forsat'); ?></title>
    <link rel="stylesheet" href="assets/css/styles.css">
</head>
<body>
    <!-- Header with navigation bar -->
    <header>
        <div class="navbar">
            <a href="index.php" class="logo"><img src="/assets/image/logo.png" alt="<?php echo lang('logo_alt'); ?>" width="60px" height="50px"></a>
            <nav>
                <ul class="nav-menu">
                    <li><a href="index.php"><?php echo lang('home'); ?></a></li>
                    <li class="dropdown">
                        <a href="#" class="dropbtn"><?php echo lang('jobs'); ?></a>
                        <div class="dropdown-content">
                            <a href="jobs.php"><?php echo lang('all_jobs'); ?></a>
                            <a href="post-job.php"><?php echo lang('post_job'); ?></a>
                            <a href="recruit.php"><?php echo lang('recruit'); ?></a>
                            <a href="recruiters.php"><?php echo lang('recruiters'); ?></a>
                        </div>
                    </li>
                    <li><a href="profile.php"><?php echo lang('profile'); ?></a></li>
                </ul>
                <ul class="auth-menu">
                    <li><a href="signup.php"><button class="button-64" role="button"><span class="text"><?php echo lang('sign_up'); ?></span></button></a></li>
                    <li>/</li>
                    <li><a href="login.php"><button class="button-64" role="button"><span class="text"><?php echo lang('login'); ?></span></button></a></li>
                </ul>
            </nav>
        </div>
    </header>

    <!-- Main content with sidebar -->
    <main>
        <!-- Sidebar -->
        <aside class="sidebar">
            <ul class="sidebar-links">
                <?php
                $categories = [
                    'formateur', 'purchases', 'commercial', 'web_dev', 'sales', 'management',
                    'accounting', 'finance', 'management_accounting', 'information_technology',
                    'new_technologies', 'informatics', 'management_directorate_general',
                    'marketing_communication', 'health_social_professions', 'services_field',
                    'services', 'construction_trades', 'production_maintenance',
                    'research_development', 'project_management', 'hr_training', 'hr',
                    'secretariat', 'assistantship', 'telemarketing', 'helplines',
                    'tourism_hotels_restaurants', 'transport_logistics'
                ];
                foreach ($categories as $category) {
                    echo "<li><a href=\"#$category\">" . lang($category) . "</a></li>";
                }
                ?>
            </ul>
        </aside>

        <!-- Main Content Area -->
        <div class="sections-container">
            <div class="welcome-section">
                <h1 class="welcome-text"><?php echo lang('welcome_to_forsat'); ?></h1>
                <p class="subtext"><?php echo lang('forsat_tagline'); ?></p>
            </div>

            <!-- Content Sections -->
            <div class="section" id="section2">
                <h1><?php echo lang('engaged_for_employment'); ?></h1>
                <div class="content-flex">
                    <img src="assets/image/office worker.png" alt="<?php echo lang('main_content_image_alt'); ?>" class="main-content-image">
                    <p id="typewriter" class="typewriter-text"></p>
                </div>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer>
        <div class="footer-content">
            <hr>
            <p><?php echo lang('copyright_notice'); ?></p>
        </div>
    </footer>

    <script src="assets/js/scripts.js"></script>
</body>
</html>