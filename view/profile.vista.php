<!-- Anna Escribano -->
<?php ob_start(); ?>
<main>
    <form action="" class="form_section form_section_h">
        <section class="form_main">
            <?php foreach (array_filter($user, function ($value, $key) {
                return $key !== 'id' && $key !== 'password' && $key !== 'isAdmin';
            }, ARRAY_FILTER_USE_BOTH) as $key => $value):
                ?>
                <div class="form-group">
                    <label class="form-label"><?= $key == 'isSocial' ? 'Accés social' : $key ?></label>
                    <input class="form-control unselectable"
                        value="<?= $key == 'isSocial' ? ($value == 1 ? 'Sí' : 'No') : $value ?>">
                </div>

            <?php endforeach; ?>
            <a class="button" href="profile?isEdit=true">Editar dades</a>
        </section>
        <img src="public/img/users/none.webp" alt="">
    </form>
    <?php if (!$_SESSION['social']): ?>
        <section class="form_section">
            <a class="button" href="new_pass">Canviar contrasenya</a>
        </section>
    <?php endif; ?>

</main>
<?php
$content = ob_get_clean();
include "view/layout.php";
?>