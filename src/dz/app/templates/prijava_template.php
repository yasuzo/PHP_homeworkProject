
<?php 
    foreach ($messages as $message) {
        send_message($message);
    }
?>
<form action="?controller=prijava" method="post">
    <label for="username">Korisnicko ime:</label>
    <input type="text" name="username">
    <label for="password">Lozinka:</label>
    <input type="password" name="password">
    <input type="submit" value="Ulogiraj me">
</form>