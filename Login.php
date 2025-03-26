<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" type = "text/css" href="style.css">
</head>

<body class="body">
    <div id = "form">
        <h1>Login</h1>
        <form name= "form" action="ActionLogin.php" method="POST">
            <label>Username: </label><br>
            <input type = "text" class="input" id ="Username" name= "Username"><br><br>
            <label>Password: </label><br>
            <input type = "password" class="input"id ="Password" name= "Password"><br><br>
            <input type = "submit" id ="btn" value="login" name= "Submit"><br><br>
        </form>
    </div>

    <footer style="position: fixed; bottom: 0; ">
        <p>&copy; 2025 OraclePanjaitans. All rights never reserved.</p>
    </footer>

</body>
</html>