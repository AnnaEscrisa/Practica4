<!-- Anna Escribano -->
<?php include "view/partials/_head.vista.php"; ?>

<body>
    <?php showMessage($tipus, $missatge, $displayEliminar); ?>
    <?php include "view/partials/_nav.vista.php"; ?>
    <main class="container">
        <form action="" method="post" enctype="multipart/form-data">
            <label class="form-label">Codi:</label>
            <input type="file" name="imatge" class="form-control" placeholder="Codi QR">
            <input type="submit" value="Enviar" class="btn btn-primary">
        </form>
    </main>
