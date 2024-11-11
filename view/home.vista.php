<!-- Anna Escribano -->
<?php include "view/partials/_head.vista.php"; ?>

<body>
    <div class="container_home">
        <div class="grid_nav">
            <?php include "view/partials/_nav.vista.php"; ?>
        </div>

        <div class="grid_aside_left">
            <aside class="aside_left"></aside>
        </div>

        <div class="grid_main">
            <main>
                <form action="index.php" method="post" class="home-form">
                    <label for="">Buscar article: </label>
                    <input class="form-control" type="text" name="buscadorArticle" placeholder="Id de l'article">
                    <button class="btn btn-primary" type="submit">Buscar</button>
                </form>
                <section class="cards_container">
                    <?php

                    if (!empty($articlesMostrats)):
                        foreach ($articlesMostrats[$paginesData['currentPage'] - 1] as $key => $value): ?>

                            <!--! afegir escola a article, i fer una clase per cada una -->
                            <div class="grid_card">
                                <article class="article_card ac_outline_evocation" style="background-image: url('public/img/articles/aa02191259d39fac8072ddba2f9485b3.jpg')">

                                    <div class="ac_banner">
                                        <h3 class="a_title"> <?= $value['titol'] ?></h3>
                                    </div>

                                    <!-- <div class="card-body footer ">
                                <a class="btn btn-primary <?= $hiddenButton ?>"
                                    href="form.php?id= <?= $value['id'] ?>&isEdit=true">Edit</a>
                                <a class="btn btn-danger <?= $hiddenButton ?>"
                                    href="form.php?id=' <?= $value['id'] ?>&isDelete=true">Elimina</a>
                            </div> -->
                                </article>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        No hi ha articles per mostrar
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

                    <?php
                    if (!empty($articlesMostrats)) {

                        echo '
                        <a href="index.php?page=' . $paginesData['previousPage'] . '"
                            class="btn btn-primary ' . $paginesData['previousClass'] . '">
                                    Anterior
                            </a>
                        <a class="btn btn-primary"
                            href="#" >' .
                                    $paginesData['currentPage']
                                    . '</a>
                        <a class="btn btn-primary ' . $paginesData['nextClass'] . '"
                            href= "index.php?page=' . $paginesData['nextPage'] . '" >
                                Següent
                        </a>';
                    }

                    ?>
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