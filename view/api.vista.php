<!-- Anna Escribano -->
<?php ob_start(); ?>
<main class="about">

    <section class="web">
        <div id="no-logat">
            <h1>API Key</h1>
            <div>
                <p>Només els usuaris registrats poden generar una clau d'accés a la api.</p>
                <p>Per obtenir la teva clau, <a href="login">inicia sessió o registra't</a></p>
            </div>
            <div id="clau" class="hidden">
                <p id="user-id" hidden><?= $_SESSION['user_id'] ?? '' ?></p>
                <p>La teva clau: </p>
                <code id="user-key"></code>
                <p>La teva clau caducarà el <span id="caducitat"></span></p>
            </div>
        </div>
        <div>
            <h1>Headers</h1>
            <p>L'api key s'ha d'afegir als header de la petició com a "api-key".</p>
            <p>Exemple d'utilització:</p>
            <pre>
                GET /api/articles HTTP/1.1
                Host: annaescribano.com/backend
                api-key: YOUR_API_KEY_HERE
            </pre>
        </div>
        <div>
            <h1>Enpoints</h1>
            <ul>
                <li>GET /api/articles</li>
                <p>Obté totes les pocions.</p>
                <li>GET /api/articles?id={id}</li>
                <p>Obté una poció específica.</p>
                <?php if (isset($_SESSION['user']) && $_SESSION['isAdmin']): ?>
                    <div>
                        <li>GET /api/users</li>
                        <p>Obté tots els usuaris registrats. Només disponible per usuaris administardors.</p>
                        <li>GET /api/users?id={id}</li>
                        <p>Obté un usuari específic registrat. Només disponible per usuaris administardors.</p>
                    </div>
                <?php endif; ?>

            </ul>
        </div>


    </section>
    <button class="button" id="generar">Generar Api Key</button>

</main>
<?php
$content = ob_get_clean();
include "view/layout.php";
?>