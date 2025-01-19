<!-- Anna Escribano -->
<?php ob_start(); ?>

<main class="main_login">
    <form action="" method="post" class="form_section">

        <div class="hstack">
            <div class="form-group">
                <label class="form-label">Usuari</label>
                <input name="usuari" class="form-control" type="text" required>
            </div>

            <div class="form-group">
                <label class="form-label">Nom</label>
                <input name="nom" type="text" class="form-control" required>
            </div>
        </div>

        <div class="form-group">
            <label class="form-label">Contrasenya</label>
            <input name="password" type="password" class="form-control" required>
        </div>

        <div class="form-group">
            <label class="form-label">Repetir contrasenya</label>
            <input name="passwordRepeat" type="password" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="form-label">Email</label>
            <input name="email" type="email" class="form-control" required>
        </div>
        <button type="submit" class="button button-lil">Registrar-se</button>
    </form>
</main>

<?php
$content = ob_get_clean();
include "view/layout.php";
?>