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
                foreach ($articlesMostrats[$currentPage - 1] as $key => $value) {
                    echo '
                    <article class="card">
                        <h2 class="card-title">' . $value['titol'] . '</h2>
                        <p class="card-text" >' . $value['cos'] . '</p>
                        <div class="card-body footer "> 
                            <a class="btn btn-primary '. $hiddenButton.'" href="form.php?id=' . $value['id'] . '&isEdit=true">Edit</a>
                            <a class="btn btn-danger '. $hiddenButton.'" href="form.php?id=' . $value['id'] . '&isDelete=true">Elimina</a>
                        </div>
                    </article>';
                }
            } else {
                echo "No hi ha articles per mostrar";
            }
            ?>
        </section>
        <section class="pages">
            <?php 
            if (!empty($articlesMostrats)) {
            
                echo '
                <a href="index.php?page=' . $previousPage . '"
                    class="btn btn-primary ' . $previousClass . '">
                            Anterior
                    </a>
                <a class="btn btn-primary"
                    href="#" >' .
                    $currentPage
                    . '</a>
                 <a class="btn btn-primary ' . $nextClass . '"
                    href= "index.php?page=' . $nextPage . '" >
                        Següent
                </a>';
            }
            
            ?>
        </section>
    </main>
</body>

</html>