<!-- Anna Escribano -->
<div class='alert alert-dismissible alert-<?php echo $tipus . " " . $display ?> ' role='alert'>
    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Tancar'></button>
    <h4><?php echo $missatge ?></h4>
    <form action="" method="get" class="<?php echo $displayEliminar ?>">
        <input type="submit" name="elimina" value="Eliminar"></input>
    </form>
</div>