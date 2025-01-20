function showSidebar(article) {
    $(".container_home").removeClass('container_home_open');
    $('main').removeClass('main_open');
    $("#aside_right").removeClass('aside_right_visible');

    document.getElementById("ar_title").textContent = article.titol;
    document.getElementById("ar_img").src = 'public/img/articles/' + article.image;
    document.getElementById("ar_description").textContent = article.cos;
    $('.ar_user').html(article.name);

    document.getElementById("ar_edit").href = `articles_form?isEdit=true&id=${article.id}`;
    document.getElementById("ar_delete").addEventListener(
        "click",
        function () {
            openDeleteModal(`articles_form?isDelete=true&id=${article.id}`, 'article')
        });
    
    $("#aside_right").toggleClass('aside_right_visible');
    $(".container_home").toggleClass('container_home_open');
    $('main').toggleClass('main_open');
}
