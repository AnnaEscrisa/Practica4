<!-- Anna Escribano -->
<?php include "partials/_head.vista.php"; ?>

<body>
    <?php showMessage($tipus, $missatge, $displayEliminar); ?>
    <?php include "view/partials/_nav.vista.php"; ?>
    <main class="container">
        <form action="" method="post">
            <input name="id" class="form-control" type="text" value="<?= $user['id']?>" hidden required>
            <label class="form-label">Usuari</label>
            <input name="usuari" class="form-control" type="text" value="<?= $user['user'] ?>" required>
            <label for="">Nom</label>
            <input name="nom" type="text" class="form-control" value="<?= $user['name'] ?>" required>
            <label for="">Email</label>
            <input name="email" type="email" class="form-control" value="<?= $user['email'] ?>" required>

            <button type="submit" class="btn btn-primary">Edita</button>
        </form>
    </main>

</body>