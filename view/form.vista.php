<!-- Anna Escribano -->
<?php include "partials/_head.vista.php"; ?>

<body>
    <?php include "partials/_nav.vista.php"; ?>
    <main class="container">
        <h3>
            <?php echo $pageTitle ?>
        </h3>
        <form action="" method="post">
            <label for="" class="form-label">Títol*</label>
            <input class="form-control" type="text" name="nouTitol" placeholder="Títol de l'article"
                value="<?php echo $titol ?>">
            <div class="form-text">
                El títol no pot tenir més de 40 caràcters.
            </div>
            <label for="" class="form-label">Contingut*</label>
            <textarea class="form-control" name="nouCos" placeholder="Cos de l'article"><?php echo $cos ?></textarea>
            <div class="form-text">
                El cos no pot tenir més de 400 caràcters.
            </div>
            <button type="submit" class="btn btn-primary" <?php echo $isDelete ? "hidden" : "" ?>><?php echo $isEdit ? "Editar" : "Inserir" ?></button>
            <a href="form.php?isDelete=true"></a>
        </form>
    </main>
</body>

</html>