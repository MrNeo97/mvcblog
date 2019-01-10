<?php $this->layout('layout') ?>

<form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST">
    <div class="container">
        <div class="row">
            <div class="col-6">

                <?php if (isset($accion) && $accion == 'editar') : ?>
                    <input type="hidden" name="id" value="<?= $datos['id']?>">
                <?php endif ?>

                <div class="form-group">

                    <h1><?= $title ?? 'Crear' ?> Post</h1>

                    <label for="titulo">Título</label>

                    <input type="text" class="form-control" name="titulo"
                           value="<?= isset($datos['titulo']) ? $datos['titulo'] : '' ?><?= isset($datos->titulo) ? $datos->titulo : '' ?>">

                    <p class="text-danger"><?= isset($errores['titulo']) ? $errores['titulo'] : '' ?></p>

                </div>
                <br>

                <div class="form-group">

                    <label for="resumen">Resumen</label>

                    <input type="text" class="form-control" name="resumen"
                           value="<?= isset($datos['resumen']) ? $datos['resumen'] : '' ?>">

                    <p class="text-danger"><?= isset($errores['resumen']) ? $errores['resumen'] : '' ?></p>

                </div>
                <br>

                <div class="form-group">

                    <label for="contenido">Contenido</label>

                    <input type="text" class="form-control" name="contenido"
                           value="<?= isset($datos['contenido']) ? $datos['contenido'] : '' ?>">

                    <p class="text-danger"><?= isset($errores['contenido']) ? $errores['contenido'] : '' ?></p>

                </div>
                <br>

                <div class="form-group">

                    <label for="categoria">Categoría</label>

                    <select class="form-control" id="seleccion" name="categoria_id">

                        <option value="1" <?php if(isset($datos['categoria_id']) && $datos['categoria_id'] == 1) {  echo 'selected'; } ?>>Categoria 1</option>
                        <option value="2" <?php if(isset($datos['categoria_id']) && $datos['categoria_id'] == 2) {  echo 'selected'; } ?>>Categoria 2</option>
                        <option value="3" <?php if(isset($datos['categoria_id']) && $datos['categoria_id'] == 3) {  echo 'selected'; } ?>>Categoria 3</option>

                    </select>

                    <p class="text-danger"><?= isset($errores['categoria_id']) ? $errores['categoria_id'] : '' ?></p>

                </div>
                <br>

                <div class="form-group">

                    <label for="palabras">Palabras</label>

                    <input type="text" class="form-control" name="palabras"
                           value="<?= isset($datos['palabras']) ? $datos['palabras'] : '' ?>">

                    <p class="text-danger"><?= isset($errores['palabras']) ? $errores['palabras'] : '' ?></p>

                </div>
                <br>


                <div class="form-group">

                    <label for="privado">Privado</label>

                    <select class="form-control" id="seleccion" name="privado">

                        <option value="1" <?php if(isset($datos['privado']) && $datos['privado'] == 1) {  echo 'selected'; } ?>>Si</option>
                        <option value="0" <?php if(isset($datos['privado']) && $datos['privado'] == 0) {  echo 'selected'; } ?>>No</option>


                    </select>

                    <p class="text-danger"><?= isset($errores['privado']) ? $errores['privado'] : '' ?></p>

                </div>
                <br>

                <button class="btn btn-primary" type="submit">Enviar</button>


            </div>
        </div>
    </div>
</form>

