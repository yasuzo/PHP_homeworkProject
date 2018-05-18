<?php
session_start();
if(isset($_SESSION['user'])){
    header('Location: index.php');
    die();
}
if($_SERVER['REQUEST_METHOD'] === 'POST'){
    
}


?>


<html>
<body>
    <form action="registracija.php" method="post">
        <label for="username">Korijsnicko ime:</label>
        <input type="text" name="username">
        <label for="pass1">Lozinka:</label>
        <input type="password" name="pass1">
        <label for="pass2">Ponovljena lozinka:</label>
        <input type="password" name="pass2">
        <input type="submit" value="send">
    </form>
</body>
</html>