<?php

session_start();
echo'<h3>Logging out you. Please wait...</h3>';

// session_abort();
// session_unset();
session_destroy();

header("Location: /forum");
exit;

?>