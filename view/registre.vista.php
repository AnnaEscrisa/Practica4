<!-- Anna Escribano -->
<?php ob_start(); ?>

<main class="container">
    <form action="" method="post">
        <label class="form-label">Usuari</label>
        <input name="usuari" class="form-control" type="text" required>
        <label class="form-label">Contrasenya</label>
        <input name="password" type="password" class="form-control" required>
        <label class="form-label">Repetir contrasenya</label>
        <input name="passwordRepeat" type="password" class="form-control" required>
        <label for="">Nom</label>
        <input name="nom" type="text" class="form-control" required>
        <label for="">Email</label>
        <input name="email" type="email" class="form-control" required>

        <button type="submit">Registra't</button>
    </form>
</main>

<?php
$content = ob_get_clean();
include "view/layout.php";
?>