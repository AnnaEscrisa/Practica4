<!-- Anna Escribano -->
<?php ob_start(); ?>
<main class="about">

    <section class="web">
        <h1></h1>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer cursus faucibus purus, non consectetur diam
            semper nec. Donec sed dapibus ex, et placerat nisi. Sed non neque vel dui sagittis fringilla non vel enim.
            Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Nulla
            facilisi. Nullam vel ipsum eget dolor gravida cursus. Donec at facilisis felis.</p>
    </section>

    <section class="materials">
        <h1>Materials</h1>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Modi iure sed delectus deleniti maxime voluptatibus
            saepe. Explicabo pariatur, at vitae reprehenderit, facere architecto rem, esse labore iusto voluptas itaque
            blanditiis.</p>
        <div class="buttons">
            <?php $materials = ['vegetals', 'animals', 'minerals'];
            foreach ($materials as $item):?>
            <a class="button" href="materials"><?= $item;?></a>
            <?php endforeach;?>

        </div>
    </section>

</main>
<?php
$content = ob_get_clean();
include "view/layout.php";
?>