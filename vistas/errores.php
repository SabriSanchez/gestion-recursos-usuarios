<!DOCTYPE html>
<html>

<head>
  <title>Prantalla-Errores</title>
  <link rel="stylesheet" href="../utiles/bootstrap.min.css" />
</head>

<body>
  <?php
  session_start();

  echo "<div class='jumbotron d-flex align-items-center min-vh-100'>
  <div class='container text-center'>
  <div class='row'>
  <div class='col alert alert-danger' role='alert'>
    <h4 class='alert-heading'>" . $_GET['titulo'] . "</h4>
    <p>" . $_GET['mensaje'] . "</p>
    <p class='mb-0'><a href='../" . $_GET['pagina'] . "'>Regresar</a></p>
  </div>
  </div>
  </div>
  </div>"; ?>

<script src="./utiles/bootstrap.bundle.min.js"></script>
</body>

</html>