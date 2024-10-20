<?php
include_once "header.php"


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forsat</title>
    <link rel="stylesheet" href="assets/css/styles.css">
</head>
<body>
    <!-- Header with navigation bar -->
    <header>
        <div class="navbar">
            <a href="index.html" class="logo"><img src="/assets/image/logo.png" alt="test" width="60px" height="50px"></a>
            <nav>
                <ul class="nav-menu">
                    <li><a href="index.html">Home</a></li>
                    <li class="dropdown">
                        <a href="#" class="dropbtn">Jobs</a>
                        <div class="dropdown-content">
                            <a href="jobs.html">All Jobs</a>
                            <a href="post-job.html">Post Job</a>
                            <a href="recruit.html">Recruit</a>
                            <a href="recruiters.html">Recruiters</a>
                        </div>
                    </li>
                    <li><a href="profile.html">Profile</a></li>
                </ul>
                <ul class="auth-menu">
                    <li><a href="signup.html"><button class="button-64" role="button"><span class="text">Sign Up</span></button></a></li>
                    <li>/</li>
                    <li><a href="login.html"><button class="button-64" role="button"><span class="text">Login</span></button></a></li>
                </ul>
            </nav>
        </div>
    </header>

   
           <!-- Main content with sidebar -->
    <main>
        <!-- Sidebar -->
        <aside class="sidebar">
            <ul class="sidebar-links">
                <li><a href="#formateur">Formateur</a></li>
                <li><a href="#purchases">Purchases</a></li>
                <li><a href="#commercial">Commercial</a></li>
                <li><a href="#web-dev">Sale</a></li>
                <li><a href="#sales">Sales</a></li>
                <li><a href="#management">Management</a></li>
                <li><a href="#accounting">Accounting</a></li>
                <li><a href="#finance">Finance</a></li>
                <li><a href="#management-accounting">Management Accounting</a></li>
                <li><a href="#information-technology">Information Technology</a></li>
                <li><a href="#new-technologies">New Technologies</a></li>
                <li><a href="#informatics">Informatics</a></li>
                <li><a href="#management-directorate-general">Management Directorate-General</a></li>
                <li><a href="#marketing-communication">Marketing, Communication</a></li>
                <li><a href="#health-social-professions">Health and Social Professions</a></li>
                <li><a href="#services-field">Services in the Field</a></li>
                <li><a href="#services">Services</a></li>
                <li><a href="#construction-trades">Construction Trades</a></li>
                <li><a href="#production-maintenance">Production, Maintenance</a></li>
                <li><a href="#research-development">Research and Development</a></li>
                <li><a href="#project-management">Project Management</a></li>
                <li><a href="#hr-training">HR Training</a></li>
                <li><a href="#hr">HR</a></li>
                <li><a href="#secretariat">Secretariat</a></li>
                <li><a href="#assistantship">Assistantship</a></li>
                <li><a href="#telemarketing">Telemarketing</a></li>
                <li><a href="#helplines">Helplines</a></li>
                <li><a href="#tourism-hotels-restaurants">Tourism, Hotels, Restaurants</a></li>
                <li><a href="#transport-logistics">Transport, Logistics</a></li>
            </ul>
        </aside>

        <!-- Main Content Area -->
        <div class="sections-container">
            <div class="welcome-section">
                <h1 class="welcome-text">Welcome to Forsat</h1>
                <p class="subtext">Forsat is here to give you a chance</p>
            </div>

            <!-- Content Sections -->
            <div class="section" id="section2">
                <h1>Engaged for employment in Algeria and Africa</h1>
                <div class="content-flex">
                    <img src="assets/image/office worker.png" alt="Main Content Image" class="main-content-image">
                    <p id="typewriter" class="typewriter-text"></p>
                </div>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer>
        <div class="footer-content">
            <hr>
            <p>© 2024 Tous droits réservés, Forsat</p>
        </div>
    </footer>

    <script src="assets/js/scripts.js"></script>
</body>
</html>
