<!-- Anna Escribano -->
<?php include "view/partials/_head.vista.php"; ?>

<body>
    <?php showMessage($tipus, $missatge, $displayEliminar); ?>
    <?php include "view/partials/_nav.vista.php"; ?>
    <main class="container">

        <section class="userCards">
            <?php if (!empty($usuarisMostrats)):
                foreach ($usuarisMostrats[$paginesData['currentPage'] - 1] as $key => $value): ?>
                    <?php if ($value['user'] != 'Admin' && $value['user'] != 'Anon') : ?>
                    <article class="card">
                        <h2 class="card-title"><?= $value['user'] ?></h2>
                        <div>
                            <p class="card-text"><?= $value['name'] ?></p>
                            <p class="card-text"><?= $value['email'] ?></p>
                            <?php if ($value['isSocial']): ?>
                                Accés a través de xarxes socials
                            <?php endif; ?>
                        </div>
                        <div class="card-body footer ">
                            <a class="btn btn-primary" href="profile?id=<?= $value['id'] ?>&isEdit=true">Editar</a>
                            <button class="btn btn-danger" onclick="openDeleteModal(`profile?isDelete=true&id=<?=$value['id']?>`, 'usuari')">Eliminar</button>
                        </div>
                    </article>
                    <?php endif;?>
                <?php endforeach; ?>
            <?php else: ?>
                No hi ha usuaris per mostrar
            <?php endif; ?>
        </section>
        <?php include "view/partials/_modal-delete.vista.php"; ?>
        <section class="pages">
            <form action="" method="POST">
                <select name="selectPagines" onchange="this.form.submit();">
                    <option value="5" <?= $max_users == 5 ? 'selected' : '' ?>>5</option>
                    <option value="10" <?= $max_users == 10 ? 'selected' : '' ?>>10</option>
                    <option value="15" <?= $max_users == 15 ? 'selected' : '' ?>>15</option>
                </select>
            </form>
            <?php
            if (!empty($usuarisMostrats)) {

                echo '
                <a href="admin?page=' . $paginesData['previousPage'] . '"
                    class="btn btn-primary ' . $paginesData['previousClass'] . '">
                            Anterior
                    </a>
                <a class="btn btn-primary"
                    href="#" >' .
                    $paginesData['currentPage']
                    . '</a>
                 <a class="btn btn-primary ' . $paginesData['nextClass'] . '"
                    href= "admin?page=' . $paginesData['nextPage'] . '" >
                        Següent
                </a>';
            }

            ?>
        </section>
    </main>