
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
        <?php if(get_scripts_name() !== 'prijava.php'): ?>
            <form action="prijava.php" method="get">
                <input type="submit" value="Prijava">
            </form>
        <?php endif; ?>
        <?php if(get_scripts_name() !== 'registracija.php'): ?>
            <a href='registracija.php'><button>Registracija</button></a><br><br>
        <?php endif; ?>
    <?php endif; ?>

    <?= $buffer ?>

    <?php require_once $template; ?>

    <?php if(get_scripts_name() !== 'index.php'): ?>
        <br><a href='index.php'>&lt;Natrag</a>
    <?php endif; ?>
</body>
</html>