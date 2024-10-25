let items = document.querySelectorAll('.nav-item');

let current_url = window.location.href;
let routes = [{
    ruta: 'login',
    nav: 'login'
},
{
    ruta: 'myArticles',
    nav: 'myArticles'
},
{
    ruta: 'form',
    nav: 'newArticle'
},
{
    ruta: 'index',
    nav: 'home'
}];

for (ruta of routes) {
    if ((current_url).includes(ruta.ruta)) {
       
        let nav_item = document.getElementById(ruta.nav);
        nav_item.classList.add('nav-selected');
        break;
    }
}
