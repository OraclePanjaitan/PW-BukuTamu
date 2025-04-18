<?php
session_start(); 

$username = $_POST['Username'];
$password = $_POST['Password'];

$db = fopen('db.txt', 'r');

function get_all_lines($db) {
    while (!feof($db)) {
        yield trim(fgets($db));
    }
}

$found = false;
foreach (get_all_lines($db) as $line) {
    list($file_username, $file_password) = explode('|', $line);

    if ($file_username === $username && $file_password === $password) {
        $_SESSION['email'] = $username;
        echo '<script>
            alert("Login successful!");
            window.location.href = "BukuTamu.php";
        </script>';
        $found = true;
        break;
    }
}

fclose($db);

if (!$found) {
    echo '<script>
        alert("Invalid username or password!");
        window.location.href = "Login.php";
    </script>';
}
?>