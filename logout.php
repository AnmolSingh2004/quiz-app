<?php
# anmol singh
# logout page

# include auth so session is started
require_once 'includes/auth.php';

# destroy the current user session
session_destroy();

# send user back to home page
header('Location: index.php');
exit;
?>
