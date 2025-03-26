<?php
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
            window.location.href = "Login.php"; // Redirect back to the login page
            alert("Login failed: Invalid username or password!");
        </script>';
    }
?>