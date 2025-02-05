<!-- Anna Escribano -->
<?php include "view/partials/_head.vista.php"; ?>

<body>
    <?php showMessage($tipus, $missatge); ?>
    <div class="container_home">
        <div class="grid_nav">
            <?php include "view/partials/_nav.vista.php"; ?>
        </div>

        <div class="grid_aside_left">
            <?php if ($pageTitle != 'login' && $pageTitle != 'registre') {
                include "view/partials/_lsidebar.vista.php";
            } ?>
        </div>

        <div class="grid_main">
            <?php echo $content; ?>
        </div>

        <div class="grid_aside_right">
            <?php if (str_contains(strtolower($pageTitle), 'articles_form')) {
                include 'view/partials/_rsidebar-opcions.vista.php';
            } else {
                include 'view/partials/_rsidebar-fitxa.vista.php';
            }
            ?>
        </div>

        <div class="grid_footer">
            <?php include 'view/partials/_footer.vista.php'; ?>
        </div>
    </div>

</body>

</html>