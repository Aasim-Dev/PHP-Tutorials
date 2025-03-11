<?php
// Setting a cookie
setcookie('user', "Aasim", time() + 3600, "/");

// Retrieving a cookie
if(isset($_COOKIE['user'])) {
    echo "Hello, " . $_COOKIE['user'];
} else {
    echo "Hello, guest!";
}

?>