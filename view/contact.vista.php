<!-- Anna Escribano -->
<?php ob_start(); ?>
<main class="home_main">
    <form action="" method="post" class="form_section">
        <?php if (isset($_SESSION['user'])): ?>
            <input class="form-control" name="id" type="text" value="<?= $_SESSION['user'] ?>" hidden>
        <?php else: ?>
            <div class="form-group">
                <label for="nom">Nom</label>
                <input id="nom" class="form-control" type="text" name="nom">
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input id="email" class="form-control" type="email" name="email">
            </div>
        <?php endif; ?>

        <div class="form-group">
            <label for="opcions contacte" class="form-label">Asumpte</label>
            <select name="" id="opcions contacte">
                <option value="Dubtes">Dubtes
                </option>
                <option value="Reportar">Reportar poció</option>
                <option value="Problemas">Problemes amb el compte</option>
                <option value="Altres">Altres
                </option>
            </select>
        </div>

        <div class="form-group">
            <label for="missatge">Missatge</label>
            <textarea class="form-control" name="missatge" id="missatge" cols="30" rows="5"></textarea>
        </div>

        <button class="button">Envia</button>
    </form>

</main>
<?php
$content = ob_get_clean();
include "view/layout.php";
?>