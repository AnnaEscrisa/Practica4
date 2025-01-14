<!-- Anna Escribano -->
<?php include "partials/_head.vista.php"; ?>

<body>
    <?php showMessage($tipus, $missatge, $displayEliminar); ?>
    <?php include "view/partials/_nav.vista.php"; ?>
    <main class="container">
        <form action="" method="post">
            <input type="hidden" name="user_id" value="<?php echo $_GET["id"] ?? $_SESSION['user_id']; ?>" />
            <?php if ($permis == 'permis_logat'): ?>
                <label class="form-label">Antiga Contrasenya</label>
                <input name="oldPassword" type="password" class="form-control" required>
            <?php endif; ?>
            <label class="form-label">Nova Contrasenya</label>
            <input name="password" type="password" class="form-control" required>
            <label class="form-label">Repetir contrasenya</label>
            <input name="passwordRepeat" type="password" class="form-control" required>

            <button type="submit" class="button">Canvia</button>
        </form>
    </main>
