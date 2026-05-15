<?php
# anmol singh
# authentication helper functions for the quiz app

# start a session if one has not already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

# check if the user is logged in
function is_logged_in() {

    # user is logged in if user_id exists in the session
    return isset($_SESSION['user_id']);
}

# protect pages that require a login
function require_login() {

    # if user is not logged in, send them to login page
    if (!is_logged_in()) {

        header('Location: login.php');
        exit;
    }
}

# get the current user's name
function current_user_name() {

    # return name from session or User if missing
    return $_SESSION['name'] ?? 'User';
}
?>
