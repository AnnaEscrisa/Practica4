<!-- Anna Escribano -->
<?php include "partials/_head.vista.php"; ?>

<body>
    <?php showMessage($tipus, $missatge, $displayEliminar); ?>
    <?php include "view/partials/_nav.vista.php"; ?>
    <main class="login_main">
        <form action="" method="post">
            <label class="form-label">Usuari</label>
            <input name="usuari" class="form-control" type="text" value="<?= $_COOKIE['recorda'] ?? '' ?>">
            <label class="form-label">Contrasenya</label>
            <input name="password" type="password" class="form-control">
            <label class="form-label" for="">Recorda l'usuari</label>
            <input type="checkbox" name="recorda">
            <?php if (isset($_COOKIE['intentsLogin']) && $_COOKIE['intentsLogin'] >= 3): ?> 
                <div class='g-recaptcha' data-sitekey="<?= CAPTCHA_KEY ?>"></div>;
            <?php endif ?>

            <input type="submit" name="loginSubmit" class="btn btn-primary" value="Entra"></input>
        </form>
        <p> <a href="recuperacio">Has oblidat la contrasenya? </a> </p>
        <p> No tens compte d'usuari? <a href="registre">Registra't</a> </p>
        <p> Iniciar sessio amb <a href="login?github=true">GitHub</a> </p>
    </main>
    
</body>