<!-- Anna Escribano -->
<?php ob_start(); ?>
<main class="home_main">
    <section class="hm_menu">
        <p> <a href="home">Pocions</a> > <?= $pageTitle ?> </p>
    </section>
    <form action="" method="post" class="form_section article" enctype="multipart/form-data" id="article_form">
        <input hidden class="form-control" type="text" name="id" value="<?= $_GET['id'] ?? '' ?>">
        <div class="form-group">
            <label for="" class="form-label">Títol*</label>
            <input class="form-control" type="text" name="nouTitol" placeholder="Títol de l'article"
                value="<?php echo $nouTitol ?? $article['titol'] ?? '' ?>">
        </div>

        <div class="form-group">
            <label for="" class="form-label">Descripció*</label>
            <textarea class="form-control" name="nouCos"
                placeholder="Descripció de l'article"><?php echo $nouCos ?? $article['cos'] ?? '' ?></textarea>
        </div>

        <!--no implementat a backend -->
        <div class="form-group">
            <label for="" class="form-label">Tipus</label>
            <select name="tipus">
                <option value="proteccio">Protecció</option>
                <option value="malediccio">Maledicció</option>
                <option value="encanteri">Encanteri</option>
                <option value="endevinacio">Endevinacio</option>
            </select>
        </div>

        <!--no implementat a backend -->
        <div class="form-group">
            <label for="" class="form-label"> Ingredients</label>
            <div class="hstack">
                <button type="button" class="button" data-ingredients onclick="showSidebar('vegetals', 'form')">Vegetals</button>
                <button type="button" class="button" data-ingredients onclick="showSidebar('animals', 'form')">Animals</button>
                <button type="button" class="button" data-ingredients onclick="showSidebar('minerals', 'form')">Minerals</button>
            </div>
        </div>

        <div class="form-group">
            <label for="" class="form-label">Imatge</label>
            <input type="file" name="imatge" class="form-control" placeholder="Imatge">
            <input type="hidden" name="imatgePrevia" value="<?= $article['image'] ?? 'none.webp' ?>">
        </div>

        <button type="submit"
            class="button button-lil"><?= $pageTitle != 'Nou Article' ? 'Editar' : 'Inserir' ?></button>
    </form>
</main>
<?php
$content = ob_get_clean();
include "view/layout.php";
?>