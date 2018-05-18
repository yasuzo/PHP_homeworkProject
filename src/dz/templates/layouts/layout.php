
<html>
<head>
    <meta charset="utf-8" />
    <title><?=$title?></title>
</head>
<body>
    <?php require_once 'helper_functions.php';
        if(is_authenticated()): ?>
            <form action="prijava.php?odjavi-me" method="post">
                <input type="submit" value="Odjava">
            </form>
    <?php else: ?>
            <form action="prijava.php" method="get">
                <input type="submit" value="Prijava">
            </form>
    <?php endif; ?>

    <?php require_once $template; ?>
</body>
</html>