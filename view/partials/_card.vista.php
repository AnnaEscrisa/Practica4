<div class="grid_card">
    <article class="article_card" style="background-image: url('public/img/articles/<?= $value['image'] ?>')"
        onclick="showSidebar(<?= htmlspecialchars(json_encode($value)) ?>)">

        <div class="ac_banner">
            <h3 class="a_title"> <?= $value['titol'] ?></h3>
        </div>

    </article>
</div>