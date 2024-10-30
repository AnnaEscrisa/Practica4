<!-- Anna Escribano -->
<?php include "partials/_head.vista.php"; ?>

<body>
    <?php include "view/partials/_nav.vista.php"; ?>
    <main class="container">
        <form action="" method="post">
            <label class="form-label">Usuari</label>
            <input name="usuari" class="form-control" type="text" value="<?php echo $_COOKIE['recorda'] ?? '' ?>">
            <label class="form-label">Contrasenya</label>
            <input name="password" type="password" class="form-control">
            <label class="form-label" for="">Recorda l'usuari</label>
            <input type="checkbox" name="recorda">
            <?php if (isset($_COOKIE['intentsLogin']) && $_COOKIE['intentsLogin'] >= 3) {
                echo "<div class='g-recaptcha' data-sitekey=$publickey> </div>";
            }
            ?>

            <input type="submit" name="loginSubmit" class="btn btn-primary" value="Entra"></input>
        </form>
        <p> <a href="recupera.php">Has oblidat la contrasenya? </a> </p>
        <p> No tens compte d'usuari? <a href="registre.php">Registra't</a> </p>
    </main>
    
</body>