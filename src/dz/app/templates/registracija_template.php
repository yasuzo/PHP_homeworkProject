
<?php 
    foreach ($messages as $message) {
        send_message($message);
    }
?>
<form action="?controller=registracija" method="post">
    <label for="username">Korisnicko ime:</label>
    <input type="text" name="username">
    <label for="pass1">Lozinka:</label>
    <input type="password" name="pass1">
    <label for="pass2">Ponovljena lozinka:</label>
    <input type="password" name="pass2">
    <input type="submit" value="Registriraj me">
</form>