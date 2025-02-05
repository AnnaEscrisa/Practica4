<!-- Anna Escribano -->
<?php ob_start(); ?>
<main class="home_main">
    <form action="" method="post" class="form_section">
        <div class="form-group">
            <label class="form-label">Usuari</label>
            <input name="usuari" class="form-control" type="text" value="<?= $user['user'] ?>">
        </div>
        <input name="id" class="form-control" type="text" value="<?= $user['id'] ?>" hidden required>


        <div class="form-group">
            <label for="">Nom</label>
            <input name="nom" type="text" class="form-control" value="<?= $user['name'] ?>">
        </div>
        <div class="form-group">
            <label for="">Email</label>
            <input name="email" type="email" class="form-control" value="<?= $user['email'] ?>">
        </div>



        <button type="submit" class="button">Edita</button>
    </form>
</main>

<?php
$content = ob_get_clean();
include "view/layout.php";
?>