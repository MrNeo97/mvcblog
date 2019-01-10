<?= $this->layout('layout') ?>

<div class="container">

    <?php if(!empty($post)) : ?>

    <h2><?= $post->titulo ?></h2>

    <hr>

    <div class="row">
        <div class="col">

            <p><?= $post->resumen ?></p>
            <p><?= $post->fecha ?></p>
            <p><?= $categoria[0]->nombre ?></p>

        </div>
    </div>

    <?php else : ?>
        <h2 style="color: red">Contenido privado</h2>
        <p>Este producto es privado, para ver contenido privado necesita estar <span style="color: #0a6ebd">registrado</span></p>
    <?php endif ?>


</div>
