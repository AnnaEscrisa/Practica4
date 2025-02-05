<!-- Anna Escribano -->
<?php ob_start(); ?>
<main>
    <form action="" method="post" enctype="multipart/form-data">
        <label class="form-label">Codi:</label>
        <input type="file" name="imatge" class="form-control" placeholder="Codi QR">
        <input type="submit" value="Enviar" class="btn btn-primary">
    </form>
    </main>
<?php
$content = ob_get_clean();
include "view/layout.php";
?>