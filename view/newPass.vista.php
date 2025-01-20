<!-- Anna Escribano -->
<?php ob_start(); ?>
<main class="main_login">
    <form action="" method="post" class="form_section">
        <input type="hidden" name="user_id" value="<?php echo $_GET["id"] ?? $_SESSION['user_id']; ?>" />
        <div class="form-group">
            <?php if ($permis == 'permis_logat'): ?>
                <label class="form-label">Antiga Contrasenya</label>
                <input name="oldPassword" type="password" class="form-control" required>
            <?php endif; ?>
        </div>
        <div class="form-group">
            <label class="form-label">Nova Contrasenya</label>
            <input name="password" type="password" class="form-control" required>
        </div>
        <div class="form-group">
            <label class="form-label">Repetir contrasenya</label>
            <input name="passwordRepeat" type="password" class="form-control" required>
        </div>
        <button type="submit" class="button">Canvia</button>
    </form>
</main>
<?php
$content = ob_get_clean();
include "view/layout.php";
?>