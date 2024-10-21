<!-- Anna Escribano -->
<?php include "partials/_head.vista.php"; ?>

<body>
    <?php include "view/partials/_nav.vista.php"; ?>
    <main class="container">

        <form action="" method="post">
            <label class="form-label">Usuari</label>
            <input name="usuari" class="form-control" type="text" value="<?php echo $usuari ?>" type="text">
            <p>Si hi ha un correu associat a aquest usuari, se li enviarà un codi de confirmació</p>
            <div class="<?php echo isset($_COOKIE['emailSent']) ? '' : 'hidden' ?>">
         
                <label class="form-label">Codi</label>
                <input type="text" class="form-control" name="codiPost">
            </div>
            <input type="submit" name='recuperaSubmit' class="btn btn-primary" value="Envia codi"></input>
        </form>

    </main>

</body>