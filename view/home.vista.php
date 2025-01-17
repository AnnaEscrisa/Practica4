<?php ob_start(); ?>
<main class="home_main">

    <section class="hm_menu">
        <p> <a href="home">Pocions</a> > <?= $pageTitle ?> </p>

        <!-- <form action="" method="POST">
            <button type="button" class="button button-lil" onclick="openOrderDropdown()">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                    <path
                        d="M2 4H15V6H2V4ZM2 11H15V13H2V11ZM3 18H2V20H13V18H3ZM19 21.414L19.707 20.707L22.707 17.707L23.414 17L22 15.586L21.293 16.293L20 17.586V4H18V17.586L16.707 16.293L16 15.586L14.586 17L15.293 17.707L18.293 20.707L19 21.414Z"
                        fill="black" />
                </svg>
            </button>

            <select name="selectOrder" id="order_dropdown" class="hidden" onchange="this.form.submit();">
                <option selected></option>
                <option value="titol" <?= $ordenacio_art == 'titol' ? 'selected' : '' ?>>Titol</option>
                <option value="id" <?= $ordenacio_art == 'id' ? 'selected' : '' ?>>Id</option>
                <option value="name" <?= $ordenacio_art == 'name' ? 'selected' : '' ?>>Autor</option>
            </select>
        </form> -->
        <form action="" method="POST">
            <div class="dropdown">
                <div class="dropdown-toggle button button-lil" type="button" data-bs-toggle="dropdown"
                    aria-expanded="false">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                        <path
                            d="M2 4H15V6H2V4ZM2 11H15V13H2V11ZM3 18H2V20H13V18H3ZM19 21.414L19.707 20.707L22.707 17.707L23.414 17L22 15.586L21.293 16.293L20 17.586V4H18V17.586L16.707 16.293L16 15.586L14.586 17L15.293 17.707L18.293 20.707L19 21.414Z"
                            fill="black" />
                    </svg>
                </div>
                <ul class="dropdown-menu">
                    <li><button type="submit" class="dropdown-item" name="selectOrder" value="titol">Titol</button></li>
                    <li><button type="submit" class="dropdown-item" name="selectOrder" value="id">Id</button></li>
                    <li><button type="submit" class="dropdown-item" name="selectOrder" value="name">Autor</button></li>
                </ul>
            </div>
        </form>

    </section>

    <section class="cards_container">
        <?php

        if ($articlesMostrats):
            foreach ($articlesMostrats[$paginesData['currentPage'] - 1] as $key => $value): ?>

                <div class="grid_card">
                    <article class="article_card" style="background-image: url('public/img/articles/<?= $value['image'] ?>')"
                        onclick="showSidebar(<?= htmlspecialchars(json_encode($value)) ?>)">

                        <div class="ac_banner">
                            <h3 class="a_title"> <?= $value['titol'] ?></h3>
                        </div>

                    </article>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>No hi ha articles per mostrar</p>
        <?php endif; ?>
    </section>
    <section class="pages">
        <form action="" method="POST">
            <select name="selectPagines" onchange="this.form.submit();">
                <option value="5" <?= $max_articles == 5 ? 'selected' : '' ?>>5</option>
                <option value="10" <?= $max_articles == 10 ? 'selected' : '' ?>>10</option>
                <option value="15" <?= $max_articles == 15 ? 'selected' : '' ?>>15</option>
            </select>
        </form>

        <? if ($articlesMostrats): ?>
            <a href="home?page=<?= $paginesData['previousPage'] ?>"
                class="button button-lil <?= $paginesData['previousClass'] ?>">
                ←
            </a>
            <a class="button button-lil" href="#"> <?= $paginesData['currentPage'] ?></a>
            <a class="button button-lil <?= $paginesData['nextClass'] ?>" href="home?page=<?= $paginesData['nextPage'] ?>">
                →
            </a>

        <? endif ?>
    </section>
    <?php
    include "view/partials/_modal-delete.vista.php"; ?>
</main>

<?php
$content = ob_get_clean();
include "view/layout.php";
?>