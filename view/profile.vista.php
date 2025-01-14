<!-- Anna Escribano -->
<?php ob_start(); ?>
<main>
    <?php foreach (array_filter($user, function ($value, $key) {
        return $key !== 'id' && $key !== 'password' && $key !== 'isAdmin';
    }, ARRAY_FILTER_USE_BOTH) as $key => $value):
        ?>
        <h4><?= $key == 'isSocial' ? 'Accés social' : $key ?></h4>
        <p><?= $key == 'isSocial' ? ($value == 1 ? 'Sí' : 'No') : $value ?></p>
    <?php endforeach; ?>
</main>
<?php
$content = ob_get_clean();
include "view/layout.php";
?>