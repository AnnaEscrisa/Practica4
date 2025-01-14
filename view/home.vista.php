<?php ob_start(); ?>
<main class="home_main">

    <form action="" method="POST">
        <select name="selectOrder" onchange="this.form.submit();">
            <option value="titol" <?= $ordenacio_art == 'titol' ? 'selected' : '' ?>>Titol</option>
            <option value="id" <?= $ordenacio_art == 'id' ? 'selected' : '' ?>>Id</option>
            <option value="name" <?= $ordenacio_art == 'name' ? 'selected' : '' ?>>Autor</option>
        </select>
    </form>
    <section class="cards_container">
        <?php

        if ($articlesMostrats):
            foreach ($articlesMostrats[$paginesData['currentPage'] - 1] as $key => $value): ?>

                <!--! afegir escola a article, i fer una clase per cada una -->
                <div class="grid_card">
                    <article class="article_card"
                        style="background-image: url('public/img/articles/<?= $value['image'] ?>')"
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