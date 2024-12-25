<!-- Anna Escribano -->
<?php include "partials/_head.vista.php"; ?>

<body>
    <?php showMessage($tipus, $missatge, $displayEliminar); ?>
    <?php include "view/partials/_nav.vista.php"; ?>
    <main class="container">

        <form action="" method="post">
            <label class="form-label">Usuari</label>
            <input name="usuari" class="form-control" type="text" type="text">
            <p>Si hi ha un correu associat a aquest usuari, se li enviarà un codi de confirmació</p>
            <input type="submit" class="btn btn-primary" value="Envia mail"></input>
        </form>

    </main>