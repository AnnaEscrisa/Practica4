function showSidebar(article) {
    document.getElementById("ar_title").textContent = article.titol;
    document.getElementById("ar_img").src = 'public/img/articles/' + article.image;
    document.getElementById("ar_description").textContent = article.cos;
    document.getElementById("ar_edit").href = `articles_form?isEdit=true&id=${article.id}`;
    document.getElementById("ar_delete").addEventListener(
        "click",
        function () {
            openDeleteModal(`articles_form?isDelete=true&id=${article.id}`, 'article')
        });
    document.getElementById("aside_right").style.display = "block";
}
