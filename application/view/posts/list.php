<?= $this->layout('layout') ?>

<div class="container">

    <?php if(!empty($posts)) : ?>

    <h1>Listado de productos</h1>

    <table class="table">
        <thead>
        <tr>
            <th>Titulo</th>
            <th>Slug</th>
            <th>Resumen</th>
            <th>Contenido</th>
            <th>Categoría</th>
            <th>Palabras</th>
            <th>Privacidad</th>
            <th>Fecha creación</th>
            <th>Acción</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach($posts as $key => $post) : ?>
            <tr>
                <td><?= $post->titulo ?></td>
                <td><?= $post->slug ?></td>
                <td><?= $post->resumen ?></td>
                <td><?= $post->contenido ?></td>
                <td><?= $categorias[$key][0]->nombre ?></td>
                <td><?= $post->palabras ?></td>
                <td><?php if ($post->privado) { echo 'privado'; } else { echo 'público'; } ?></td>
                <td><?= $post->fecha ?></td>
                <td>
                    <a href="<?php echo URL; ?>post/editar/<?= $post->id ?>" style="font-size:25px; color:blue;"><i class="fas fa-pen-square"></i></a>
                    <a href="<?php echo URL; ?>post/borrar/<?= $post->id ?>" style="font-size:25px; color:red;"><i class="fas fa-trash"></i></a>
                </td>
            </tr>
        <?php endforeach ?>
        </tbody>
    </table>

    <?php else : ?>

        <p>No Products Found</p>

    <?php endif ?>
</div>