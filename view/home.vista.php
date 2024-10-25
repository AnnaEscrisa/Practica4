<!-- Anna Escribano -->
<?php include "view/partials/_head.vista.php"; ?>

<body>
    <?php include "view/partials/_nav.vista.php"; ?>
    <main class="container">
        <form action="index.php" method="post" class="home-form">
            <label for="">Buscar article: </label>
            <input class="form-control" type="text" name="buscadorArticle" placeholder="Id de l'article">
            <button class="btn btn-primary" type="submit">Buscar</button>
        </form>
        <section class="homeCards">
            <?php

            if (!empty($articlesMostrats)) {
                foreach ($articlesMostrats[$paginesData['currentPage'] - 1] as $key => $value) {
                    echo '
                    <article class="card">
                        <h2 class="card-title">' . $value['titol'] . '</h2>
                        <p class="card-text nom" >' . $value['name'] . '</p>
                        <div>
                            <p class="card-text" >' . $value['cos'] . '</p>
                            <p class="card-text" >' . $value['ingredients'] . '</p>
                        </div>
                        <div class="card-body footer "> 
                            <a class="btn btn-primary ' . $hiddenButton . '" href="form.php?id=' . $value['id'] . '&isEdit=true">Edit</a>
                            <a class="btn btn-danger ' . $hiddenButton . '" href="form.php?id=' . $value['id'] . '&isDelete=true">Elimina</a>
                        </div>
                    </article>';
                }
            } else {
                echo "No hi ha articles per mostrar";
            }
            ?>
        </section>
        <section class="pages">
            <form action="" method="POST">
                <select name="selectPagines" onchange="this.form.submit();">
                    <option value="5" <?= $max_articles == 5 ? 'selected': '' ?>>5</option>
                    <option value="10" <?= $max_articles == 10 ? 'selected': '' ?>>10</option>
                    <option value="15" <?= $max_articles == 15 ? 'selected': '' ?>>15</option>
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
</body>

</html>