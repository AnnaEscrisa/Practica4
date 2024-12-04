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

            </aside>
        </div>

        <div class="grid_main">
            <main>
                <form action="" method="post" class="home-form">
                    <label for="">Buscar article: </label>
                    <input class="form-control" type="text" name="buscadorArticle" placeholder="Nom de l'article">
                    <button class="btn btn-primary" type="submit">Buscar</button>
                </form>
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
                                <article class="article_card ac_outline_evocation"
                                    style="background-image: url('public/img/articles/<?= $value['image'] ?>')">

                                    <div class="ac_banner">
                                        <h3 class="a_title"> <?= $value['titol'] ?></h3>
                                    </div>

                                    <div class="card-body footer ">
                                        <a class="btn btn-primary <?= $hiddenButton ?>"
                                            href="articles_form?id=<?= $value['id'] ?>&isEdit=true">Edit</a>
                                        <button class="btn btn-danger <?= $hiddenButton ?>"
                                            onclick="new bootstrap.Modal(document.getElementById('modal-delete')).show();">Eliminar</button>

                                    </div>

                                </article>
                            </div>
                            <?php
                            $item = 'article';
                            $ruta = "articles_form?isDelete=true&id=" . $value['id'];
                            include "view/partials/_modal-delete.vista.php"; ?>
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
                            class="btn btn-primary <?= $paginesData['previousClass'] ?>">
                            Anterior
                        </a>
                        <a class="btn btn-primary" href="#"> <?= $paginesData['currentPage'] ?></a>
                        <a class="btn btn-primary <?= $paginesData['nextClass'] ?>"
                            href="home?page=<?= $paginesData['nextPage'] ?>">
                            Següent
                        </a>

                    <? endif ?>
                </section>
            </main>
        </div>

        <div class="grid_aside_right">
            <aside class="aside_right">
                <!-- obrirem modal amb info de article -->

            </aside>
        </div>

    </div>

</body>

</html>