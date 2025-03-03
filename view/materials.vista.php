<!-- Anna Escribano -->
<?php ob_start(); ?>
<main class="home_main materials">
    <section class="hm_menu">
        <p> <a href="materials">Materials</a> </p>
        <div class="icons">
            <form action="" method="">
                <div class="dropdown">
                    <div class="button button-lil" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <path
                                d="M2 4H15V6H2V4ZM2 11H15V13H2V11ZM3 18H2V20H13V18H3ZM19 21.414L19.707 20.707L22.707 17.707L23.414 17L22 15.586L21.293 16.293L20 17.586V4H18V17.586L16.707 16.293L16 15.586L14.586 17L15.293 17.707L18.293 20.707L19 21.414Z"
                                fill="black" />
                        </svg>
                    </div>
                    <ul class="dropdown-menu">
                        <li><button class="dropdown-item">Nom</button>
                        </li>
                        <li><button class="dropdown-item">Id</button></li>
                        </li>
                    </ul>
                </div>
            </form>
            <form action="">
                <div class="dropdown">
                    <div class="button button-lil" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <svg xmlns="http://www.w3.org/2000/svg" width="21" height="20" viewBox="0 0 21 20" fill="none">
                            <path
                                d="M19.5 9.787H7.145M2.784 9.787H1M2.784 9.787C2.784 9.20883 3.01368 8.65434 3.42251 8.24551C3.83134 7.83668 4.38583 7.607 4.964 7.607C5.54217 7.607 6.09666 7.83668 6.50549 8.24551C6.91432 8.65434 7.144 9.20883 7.144 9.787C7.144 10.3652 6.91432 10.9197 6.50549 11.3285C6.09666 11.7373 5.54217 11.967 4.964 11.967C4.38583 11.967 3.83134 11.7373 3.42251 11.3285C3.01368 10.9197 2.784 10.3652 2.784 9.787ZM19.5 16.394H13.752M13.752 16.394C13.752 16.9723 13.5218 17.5274 13.1128 17.9363C12.7039 18.3453 12.1493 18.575 11.571 18.575C10.9928 18.575 10.4383 18.3443 10.0295 17.9355C9.62068 17.5267 9.391 16.9722 9.391 16.394M13.752 16.394C13.752 15.8157 13.5218 15.2616 13.1128 14.8527C12.7039 14.4437 12.1493 14.214 11.571 14.214C10.9928 14.214 10.4383 14.4437 10.0295 14.8525C9.62068 15.2613 9.391 15.8158 9.391 16.394M9.391 16.394H1M19.5 3.18H16.395M12.034 3.18H1M12.034 3.18C12.034 2.60183 12.2637 2.04734 12.6725 1.63851C13.0813 1.22968 13.6358 1 14.214 1C14.5003 1 14.7838 1.05639 15.0483 1.16594C15.3127 1.2755 15.5531 1.43608 15.7555 1.63851C15.9579 1.84094 16.1185 2.08126 16.2281 2.34575C16.3376 2.61024 16.394 2.89372 16.394 3.18C16.394 3.46628 16.3376 3.74976 16.2281 4.01425C16.1185 4.27874 15.9579 4.51906 15.7555 4.72149C15.5531 4.92392 15.3127 5.0845 15.0483 5.19406C14.7838 5.30361 14.5003 5.36 14.214 5.36C13.6358 5.36 13.0813 5.13032 12.6725 4.72149C12.2637 4.31266 12.034 3.75817 12.034 3.18Z"
                                stroke="black" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" />
                        </svg>
                    </div>
                    <ul class="dropdown-menu">
                        <li><button type="submit" class="dropdown-item" name="filterPotion"
                                value="proteccio">Vegetals</button></li>
                        <li><button type="submit" class="dropdown-item" name="filterPotion"
                                value="malediccio">Animals</button></li>
                        <li><button type="submit" class="dropdown-item" name="filterPotion"
                                value="encanteri">Minerals</button></li>
                    </ul>
                </div>
            </form>
        </div>


    </section>

    <section class="cards_container">
        <?php
        foreach (['1', '2'] as $mat): ?>

            <div class="grid_card">
                <article class="article_card" style="background-image: url('public/img/article/none.webp')"
                    onclick="showSidebar(<?= htmlspecialchars($mat) ?>, 'material')">

                    <div class="ac_banner">
                        <h4 class="a_title"> Material</h4>
                    </div>

                </article>
            </div>
        <?php endforeach; ?>
    </section>
    <section class="pages">
        <form action="" method="POST">
            <select name="selectPagines" onchange="this.form.submit();">
                <option value="5">5</option>
                <option value="10">10</option>
                <option value="15">15</option>
            </select>
        </form>


        <a href=""
            class="button button-lil">
            ←
        </a>
        <a class="button button-lil" href="#"> 1</a>
        <a class="button button-lil" href="">
            →
        </a>

    </section>
</main>

<script src="public/js/materials.js"></script>

<?php
$content = ob_get_clean();
include "view/layout.php";
?>