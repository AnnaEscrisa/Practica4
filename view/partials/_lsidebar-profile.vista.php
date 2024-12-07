
<div class="profile_sidebar">
    <ul>
        <li><a href="profile?isEdit=true">Editar dades</a></li>
        <?php if (!$_SESSION['social']): ?>
            <li><a href="new_pass">Canviar contrasenya</a></li>
        <?php endif; ?>
    </ul>
    <ul>
        <li><a href="login?isLogout=true">Logout</a></li>
        <li><button>Eliminar compte</button></li>
    </ul>
</div>