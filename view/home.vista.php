<!-- Anna Escribano -->
<?php include "view/partials/_head.vista.php"; ?>

<body>
    <?php include "view/partials/_nav.vista.php"; ?>
    <main class="container">
        <form action="" method="post" class="home-form">
            <label for="">Buscar article: </label>
            <input class="form-control" type="text" name="buscadorArticle" placeholder="Id de l'article">
            <button class="btn btn-primary" type="submit">Buscar</button>
        </form>
        <section class="homeCards">
            <?php

            if (!empty($articles)) {
                foreach ($articles as $key => $value) {
                    echo '
                    <article class="card">
                        <h2 class="card-title">' . $value['titol'] . '</h2>
                        <p class="card-text" >' . $value['cos'] . '</p>
                        <div class="card-body footer"> 
                            <a class="btn btn-primary" href="form.php?id=' . $value['id'] . '&isEdit=true">Edit</a>
                            <a class="btn btn-danger" href="form.php?id=' . $value['id'] . '&isDelete=true">Elimina</a>
                        </div>
                    </article>';
                }
            } else {
                echo "No hi ha articles per mostrar";
            }
            ?>
        </section>
    </main>
</body>

</html>