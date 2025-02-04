<!-- Anna Escribano -->
<?php ob_start(); ?>
<main class="home_main">
    <section class="hm_menu">
    <p> <a href="admin">Admin </a> > <?= $pageTitle ?> </p>
        <div class="icons">
            <form action="" method="POST">
                <div class="dropdown">
                    <div class="button button-lil" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <svg xmlns="http://www.w3.org/2000/svg" aria-label="Selecciona l'ordre dels elements" width="24" height="24" viewBox="0 0 24 24" fill="none">
                        <title>Selecciona l'ordre dels elements</title>    
                        <path
                                d="M2 4H15V6H2V4ZM2 11H15V13H2V11ZM3 18H2V20H13V18H3ZM19 21.414L19.707 20.707L22.707 17.707L23.414 17L22 15.586L21.293 16.293L20 17.586V4H18V17.586L16.707 16.293L16 15.586L14.586 17L15.293 17.707L18.293 20.707L19 21.414Z"
                                fill="black" />
                        </svg>
                    </div>
                    <ul class="dropdown-menu">
                        <li><button type="submit" class="dropdown-item" name="selectOrder" value="id">Id</button>
                        </li>
                        <li><button type="submit" class="dropdown-item" name="selectOrder" value="user">User</button></li>
                        <li><button type="submit" class="dropdown-item" name="selectOrder" value="mail">Mail</button>
                        </li>
                    </ul>
                </div>
            </form>
        </div>
    </section>


    <section class="cards_container">
        <?php if (!empty($usuarisMostrats)):
            foreach ($usuarisMostrats[$paginesData['currentPage'] - 1] as $key => $value): ?>
                <?php if ($value['user'] != 'Admin' && $value['user'] != 'Anon'): ?>
                    <div class="grid_card">
                    <article class="article_card"
                        onclick="showSidebar(<?= htmlspecialchars(json_encode($value)) ?>, 'user')">

                        <img src="public/img/users/<?= $value['image'] ?>"
                            alt="<?= $value['image'] == 'none.webp' ? 'Imatge no disponible' : "Imatge d'usuari " . $value['user'] ?>"></div>
                        
                            <div class="ac_banner">
                            <h4 class="a_title"> <?= $value['user'] ?></h4>
                        </div>

                    </article>
                </div>
                    
                    <!-- <article class="card">
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
                            <button class="btn btn-danger"
                                onclick="openDeleteModal(`profile?isDelete=true&id=<?= $value['id'] ?>`, 'usuari')">Eliminar</button>
                        </div>
                    </article> -->
                <?php endif; ?>
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
        if (!empty($usuarisMostrats)): ?>

            <a href="home?page=<?= $paginesData['previousPage'] ?>"
                class="button button-lil <?= $paginesData['previousClass'] ?>">
                ←
            </a>
            <a class="button button-lil" href="#"> <?= $paginesData['currentPage'] ?></a>
            <a class="button button-lil <?= $paginesData['nextClass'] ?>" href="home?page=<?= $paginesData['nextPage'] ?>">
                →
            </a>
        <?php endif; ?>

    </section>
</main>

<?php
$content = ob_get_clean();
include "view/layout.php";
?>