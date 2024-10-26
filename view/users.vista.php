<!-- Anna Escribano -->
<?php include "view/partials/_head.vista.php"; ?>

<body>
    <?php include "view/partials/_nav.vista.php"; ?>
    <main class="container">

        <section class="userCards">
            <?php

            if (!empty($usuarisMostrats)) {
                foreach ($usuarisMostrats[$paginesData['currentPage'] - 1] as $key => $value) {
                    echo '
                    <article class="card">
                        <h2 class="card-title">' . $value['user'] . '</h2>
                        <div>
                            <p class="card-text" >' . $value['name'] . '</p>
                            <p class="card-text" >' . $value['email'] . '</p>
                        </div>
                        <div class="card-body footer "> 
                            <a class="btn btn-primary href="form.php?id=' . $value['id'] . '&isEdit=true">Edit</a>
                            <a class="btn btn-danger href="form.php?id=' . $value['id'] . '&isDelete=true">Elimina</a>
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
                    <option value="5" <?= $max_users == 5 ? 'selected' : '' ?>>5</option>
                    <option value="10" <?= $max_users == 10 ? 'selected' : '' ?>>10</option>
                    <option value="15" <?= $max_users == 15 ? 'selected' : '' ?>>15</option>
                </select>
            </form>
            <?php
            if (!empty($usuarisMostrats)) {

                echo '
                <a href="users.php?page=' . $paginesData['previousPage'] . '"
                    class="btn btn-primary ' . $paginesData['previousClass'] . '">
                            Anterior
                    </a>
                <a class="btn btn-primary"
                    href="#" >' .
                    $paginesData['currentPage']
                    . '</a>
                 <a class="btn btn-primary ' . $paginesData['nextClass'] . '"
                    href= "users.php?page=' . $paginesData['nextPage'] . '" >
                        Següent
                </a>';
            }

            ?>
        </section>
    </main>
</body>

</html>