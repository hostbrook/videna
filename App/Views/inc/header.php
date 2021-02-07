<!DOCTYPE html>
<html lang="<?=$lang?>">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="<?=$description?>">
  <meta name="author" content="Videna">

  <title><?=$title?></title>

  <!-- Bootstrap core CSS -->
  <link href="/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Favicon -->
  <link rel="shortcut icon" href="/favicon/favicon.ico">

  <!-- Bootstrap core JavaScript -->
  <script src="/vendor/jquery/jquery.min.js"></script>
  <script src="/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

</head>

<body>

  <!-- Navigation -->
  <nav class="navbar navbar-expand-md navbar-dark bg-dark">
    <a class="navbar-brand" href="/"><span class="badge bg-success">Videna</span></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
  
    <div class="collapse navbar-collapse" id="navbarsExampleDefault">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item active">
          <a class="nav-link" href="/"><?=$_['home']?> <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Pages</a>
          <div class="dropdown-menu" aria-labelledby="dropdown01">
            <a class="dropdown-item" href="/product-one/"><?=$_['product']?> 1</a>
            <a class="dropdown-item" href="/product-one/sub-product-one/"><?=$_['sub-product']?> 1</a>
          </div>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="dropdown03" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">SPA</a>
          <div class="dropdown-menu" aria-labelledby="dropdown03">
            <a class="dropdown-item spa" href="/"><?=$_['home']?></a>
            <a class="dropdown-item spa" href="/product-one/"><?=$_['product']?> 1</a>
            <a class="dropdown-item spa" href="/product-one/sub-product-one"><?=$_['sub-product']?> 1</a>
          </div>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="dropdown02" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?=$_['language']?></a>
          <div class="dropdown-menu" aria-labelledby="dropdown02">
            <a class="dropdown-item" href="/en/">English</a>            
            <a class="dropdown-item" href="/ru/">Русский</a>
          </div>
        </li>
      </ul>

<?php if ( isset($user) and $user['account'] > USR_UNREG ): ?>
      <span class="navbar-text text-light p-2"><?=$user['name']?></span>
<?php endif; ?>

<?php if ( isset($user) and $user['account'] > USR_UNREG ): ?>
      <a class="btn btn-outline-success" href="/logout">Logout</a>
<?php else: ?>
      <a class="btn btn-outline-success" href="/login">Login</a>
<?php endif; ?>

    </div>
  </nav>
  <!-- /Navigation -->


  <!-- Page Content -->
  <div class="container" id="spa-page">