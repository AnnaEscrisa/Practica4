<!-- Anna Escribano -->
<?php include "view/partials/_head.vista.php"; ?>

<body>
    <?php showMessage($tipus, $missatge, $displayEliminar); ?>
    <div class="container_home">
        <div class="grid_nav">
            <?php include "view/partials/_nav.vista.php"; ?>
        </div>

        <div class="grid_aside_left">
            <aside class="aside_left">
                <?php include "view/partials/_lsidebar-profile.vista.php"; ?>
            </aside>
        </div>

        <div class="grid_main">
            <main>
                <?php foreach (array_filter($user, function ($value, $key) {
                    return $key !== 'id' && $key !== 'password' && $key !== 'isAdmin';
                }, ARRAY_FILTER_USE_BOTH) as $key => $value):
                    ?>
                    <h4><?= $key =='isSocial' ? 'Accés social': $key ?></h4>
                    <p><?= $key =='isSocial' ? ($value == 1 ? 'Sí' : 'No') : $value ?></p>
                <?php endforeach; ?>
            </main>
        </div>

        <div class="grid_aside_right">
            <aside class="aside_right">

            </aside>
        </div>

    </div>

