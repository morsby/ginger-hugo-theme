<?php
session_start();

# Load other files
include('../../php/config.php');
include('../../php/functions.php');

/*
END OF HEADER
BEGIN HTML
 */

printHeader();


if ($_SESSION["auth"] == 0) {
    printLogin();
} else {
    $result = $db->query('SELECT * FROM gastebog ORDER BY id DESC');
    printMessages($result,$admin = true);
}

printFooter();

?>
