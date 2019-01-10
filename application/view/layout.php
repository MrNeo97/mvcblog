<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title><?= $titulo ?? 'MINI3' ?></title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="<?php echo URL; ?>css/bootstrap.css" rel="stylesheet">
    <link href="<?php echo URL; ?>css/style.css" rel="stylesheet">
    <link href="<?php echo URL; ?>font/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">


</head>
<body>
<!--<div class="logo"></div>-->

<!-- navigation -->
<?php if(\Mini\Core\Session::userIsLoggedIn()) : ?>

    <?php $this->insert('partials/menu') ?>

<?php else : ?>

    <?php $this->insert('partials/menulogin') ?>

<?php endif ?>

<?= $this->section('content') ?>

<?php if(\Mini\Core\Session::userIsLoggedIn()) : ?>

    <footer>
        <a class="btn btn-danger" href="/login/cerrarSesion" role="button">Cerrar Sesión</a>
    </footer>

<?php endif ?>

<div class="footer text-center">
    <p>Copyright© Catalogo 2018</p>
</div>

<!-- jQuery, loaded in the recommended protocol-less way -->
<!-- more http://www.paulirish.com/2010/the-protocol-relative-url/ -->
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>

<!-- define the project's URL (to make AJAX calls possible, even when using this in sub-folders etc) -->
<script>
    var url = "<?php echo URL; ?>";
</script>

<!-- our JavaScript -->
<script src="<?php echo URL; ?>js/application.js"></script>
</body>
</html>