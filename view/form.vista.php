<!-- Anna Escribano -->
<?php include "partials/_head.vista.php"; ?>

<body>
    <?php showMessage($tipus, $missatge, $displayEliminar); ?>
    <?php include "partials/_nav.vista.php"; ?>
    <main>
        <h3>
            <?php echo $pageTitle ?>
        </h3>
        <form action="" method="post" class="articleForm">
            <input hidden class="form-control" type="text" name="user_id" placeholder="Títol de l'article"
                value="<?php echo $_SESSION['user_id']?? '' ?>">
            <div>
                <label for="" class="form-label">Títol*</label>
                <input class="form-control" type="text" name="nouTitol" placeholder="Títol de l'article"
                    value="<?php echo $nouTitol?? $titol ?>">
                <div class="form-text">
                    El títol no pot tenir més de 40 caràcters.
                </div>
            </div>

            <div>
                <label for="" class="form-label">Descripció*</label>
                <textarea class="form-control" name="nouCos"
                    placeholder="Descripció de l'article"><?php echo $nouCos?? $cos ?></textarea>
                <div class="form-text">
                    La descripció no pot tenir més de 400 caràcters.
                </div>
            </div>

            <div>
                <label for="" class="form-label">Ingredients</label>
                <textarea class="form-control" name="nousIngredients"
                    placeholder="Ingredients"><?php echo $nousIngredients ?? $ingredients ?></textarea>
                <div class="form-text">
                    Aquesta secció no pot tenir més de 500 caràcters.       
                </div>
            </div>

            <button type="submit" class="btn btn-primary" <?php echo $isDelete ? "hidden" : "" ?>><?php echo $isEdit ? "Editar" : "Inserir" ?></button>
            <a href="articles_form?isDelete=true"></a>
        </form>
    </main>
</body>

</html>