<?php
session_start();

?>

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