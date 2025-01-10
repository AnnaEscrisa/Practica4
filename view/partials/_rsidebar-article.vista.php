<aside id="aside_right" style="display: none">
    <img id="ar_img" class="ar_img" src="" alt="">
    <h3 id="ar_title"></h3>
    <p id="ar_description"></p>
    <a id="ar_edit" class="btn btn-primary <?= $hiddenButton ?>">Edit</a>
    <button id="ar_delete" class="btn btn-danger <?= $hiddenButton ?>">Eliminar</button>
    <button id="ar_clone" class="btn btn-info <?= isset($_SESSION['user']) ? '' : 'hidden'?>">Clonar</button>
</aside>