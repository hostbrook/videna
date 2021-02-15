<!DOCTYPE html>
<html lang="<?=$lang?>">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="<?=$description?>">
  <meta name="author" content="Videna">

  <title><?=$title?></title>

  <!-- Bootstrap core CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">

  <!-- Favicon -->
  <link rel="icon" type="image/png" sizes="32x32" href="/favicon/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="16x16" href="/favicon/favicon-16x16.png">
  <link rel="shortcut icon" href="/favicon/favicon.ico">

  <!-- Bootstrap core JavaScript -->
  <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>

</head>

<body>

  <!-- Navigation -->
  <nav class="navbar navbar-expand-md navbar-dark bg-dark">

    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
  
    <div class="collapse navbar-collapse" id="navbarsExampleDefault">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item active">
          <a class="nav-link" href="/"><?=$_['home']?></a>
        </li>

        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false"><?=$_['pages']?></a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="/product/"><?=$_['product']?></a></li>
            <li><a class="dropdown-item" href="/product/sub-product/"><?=$_['sub-product']?></a></li>
          </ul>
        </li>

        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false"><?=$_['language']?></a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="/en/">English</a></li>
            <li><a class="dropdown-item" href="/ru/">Русский</a></li>
          </ul>
        </li>

      </ul>
   </div>

<?php if ( isset($user) and $user['account'] > USR_UNREG ): ?>
    <span class="navbar-text text-light"><?=$user['name']?></span>
<?php endif; ?>

<?php if ( isset($user) and $user['account'] > USR_UNREG ): ?>
    <a class="btn btn-outline-success mx-2" href="/logout"><?=$_['logout']?></a>
<?php else: ?>
    <a class="btn btn-outline-success mx-2" href="/login"><?=$_['login']?></a>
<?php endif; ?>
    
  </nav>
  <!-- /Navigation -->


  <!-- Page Content -->
  <div class="container" id="spa-page">