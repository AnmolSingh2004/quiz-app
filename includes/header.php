<?php
# anmol singh
# header and navigation bar for every page

# load authentication functions
require_once __DIR__ . '/auth.php';

# get current page name for active navigation button
$currentPage = basename($_SERVER['PHP_SELF']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <!-- basic page settings -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- page title -->
    <title>Quiz App</title>

    <!-- main stylesheet -->
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>

<!-- top navigation area -->
<header class="site-header">

    <div class="container nav-wrap">

        <!-- site logo -->
        <a class="logo" href="index.php">Quiz App</a>

        <!-- navigation buttons -->
        <nav>

            <!-- home link -->
            <a class="<?php echo $currentPage == 'index.php' ? 'active' : ''; ?>" href="index.php">Home</a>

            <!-- leaderboard link -->
            <a class="<?php echo $currentPage == 'leaderboard.php' ? 'active' : ''; ?>" href="leaderboard.php">Leaderboard</a>

            <?php if (is_logged_in()): ?>

                <!-- profile link only appears when logged in -->
                <a class="<?php echo $currentPage == 'profile.php' ? 'active' : ''; ?>" href="profile.php">Profile</a>

                <!-- logout link only appears when logged in -->
                <a href="logout.php">Logout</a>

            <?php else: ?>

                <!-- login link for users who are not logged in -->
                <a class="<?php echo $currentPage == 'login.php' ? 'active' : ''; ?>" href="login.php">Login</a>

                <!-- signup button for new users -->
                <a class="btn small" href="signup.php">Sign Up</a>

            <?php endif; ?>

        </nav>

    </div>

</header>

<!-- main page content starts here -->
<main class="container">
