<?php
$nameErr = $emailErr = $genderErr = $websiteErr = "";
$name = $email = $gender = $comment = $website = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty($_POST["name"])) {
    $nameErr = "Name is required";
  } else {
    $name = test_input($_POST["name"]);
    if (!preg_match("/^[a-zA-Z-' ]*$/",$name)) {
      $nameErr = "Only letters and white space allowed";
    }
  }
  
  if (empty($_POST["email"])) {
    $emailErr = "Email is required";
  } else {
    $email = test_input($_POST["email"]);
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $emailErr = "Invalid email format";
    }
  }
  
  if (empty($_POST["comment"])) {
    $comment = "";
  } else {
    $comment = test_input($_POST["comment"]);
  }

}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>

<html>
<head>
    <title>Buku Tamu</title>
    <link rel="stylesheet" type = "text/css" href="style.css">
</head>

<body>  
<div>
    <form method="post" action="login.php">
        <button type="submit" id ="btn_logout" name="logout" value="Logout">Logout</button>
    </form>
</div>

<table class="box">
    <td>
        <h1>Buku Tamu</h1>
        <p><span class="error">* required field</span></p>    

        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
            <p>
                Name <span class="error">* <?php echo $nameErr;?></span>
                <br>
                <input type="text" name="name" value="<?php echo $name;?>">
                <br><br>
            </p>  
            <p>
                E-mail <span class="error">* <?php echo $emailErr;?></span>
                <br>
                <input type="text" name="email" value="<?php echo $email;?>">
                
                <br><br>
            </P>
            <p>
                Comment <br>
                <textarea name="comment" rows="5" cols="40"><?php echo $comment;?></textarea>
                <br><br>
            </p>  
            
            <div >
                <button type="submit" id ="btn_submit" name="submit" value="Submit">Submit</button>
            </div>
        </form>
    </td>
    
</table>

<table class = "box">
    <td>
    <?php
        echo "<h2>Message</h2>";

        if (isset($_POST['submit']) && empty($nameErr) && empty($emailErr)) {
            $file = fopen("BukuTamu.txt", "a") or die("File Cannot Open");

            $data = $name . "|" . $email . "|" . $comment . "\n";
            fputs($file, $data) or die("Write Operation failed");
            
            fclose($file);
            echo "<p style='color: green;'>Data successfully saved to BukuTamu.txt!</p>";

        } elseif (isset($_POST['submit'])) {
            echo "<p style='color: red;'>Please correct the errors before submitting.</p>";
        }
    ?>
    </td>
</table>

<table  class = "box" >
    <td>
    <h2>Daftar Buku Tamu</h2>
        <?php
        echo "<tr>";
        echo "<td> Name";
        echo "<td> E-Mail";
        echo "<td> Comment";
        echo "</tr>";
        $count = 1;
        $data = fopen('BukuTamu.txt', 'r');

        function get_all_lines($data) {
            while (!feof($data)) {
                $line = trim(fgets($data));
                if (!empty($line)) { 
                    yield $line;
                }
            }
        }

        foreach (get_all_lines($data) as $line) {
            if (!empty($line)) { 
                list($file_nama, $file_email, $file_comment) = explode('|', $line);

                echo "<tr>";
                echo "<td>" . $count. ". " .htmlspecialchars($file_nama) . "</td>";
                echo "<td>" . htmlspecialchars($file_email) . "</td>";
                echo "<td>" . htmlspecialchars($file_comment) . "</td>";
                echo "</tr>";
                $count++;
            }
        }

        fclose($data); // Close the file after reading
        ?>
    </td>
</table>
    
</body>
</html>