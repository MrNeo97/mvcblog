<?= $this->layout('layout') ?>

<div class="container">

    <h1>Inicio</h1>

    <h2 style="color: cornflowerblue;">Listado de posts</h2>

    <hr>

            <?php if(!empty($posts)) : ?>

                <?php foreach ($posts as $key => $post) : ?>


                    <div class="row">
                        <div class="col">
                            <h3><?= $post->titulo ?></h3>
                            <p><?= $post->resumen ?></p>
                            <p><?= $post->fecha ?></p>
                            <p><?= $categorias[$key][0]->nombre ?></p>
                            <p><a href="/posts/<?= $post->id ?>">[Leer más]</a></p>
                        </div>
                    </div>

                    <hr>

                <?php endforeach ?>

            <?php else : ?>
                <p>No hay ningún post</p>
            <?php endif ?>


</div>
