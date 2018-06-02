
<html>
<head>
    <meta charset="utf-8" />
    <title><?= $title ?></title>
</head>
<body>
    <?php if($authenticated): ?>
            <form action="?controller=prijava&odjavi-me" method="post">
                <input type="submit" value="Odjava">
            </form>
    <?php else: ?>
        <?php if($title !== 'Prijava'): ?>
            <a href='?controller=prijava'><button>Prijava</button></a><br><br>
        <?php endif; ?>
        <?php if($title !== 'Registracija'): ?>
            <a href='?controller=registracija'><button>Registracija</button></a><br><br>
        <?php endif; ?>
    <?php endif; ?>
    
    <?= $body; ?>

    <?php if($title !== 'Index'): ?>
        <br><a href='?controller=index'>&lt;Natrag</a>
    <?php endif; ?>
</body>
</html>