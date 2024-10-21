<!-- Anna Escribano -->
<?php include "partials/_head.vista.php"; ?>

<body>
    <?php include "view/partials/_nav.vista.php"; ?>
    <main class="container">
        <form action="" method="post">
            <input type="hidden" name="user_id" value="<?php echo $_GET["id"]; ?>" />
            <label class="form-label">Contrasenya</label>
            <input name="password" type="password" class="form-control" required>
            <label class="form-label">Repetir contrasenya</label>
            <input name="passwordRepeat" type="password" class="form-control" required>

            <button type="submit" class="btn btn-primary">Canvia</button>
        </form>
    </main>

</body>