<?php
if (isset($_SESSION['userID'])) {
    echo "User is logged in with userID: " . $_SESSION['userID'];
} else {
    echo "No active session. Please log in.";
}
?>