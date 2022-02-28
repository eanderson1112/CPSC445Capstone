<?php
session_start();
session_destroy();
// Redirect to the login page:
header('Location: index.php');
session_destroy();
