<?php
// Generamos tres números aleatorios entre 1 y 100
$numOne = rand(1, 100);
$numTwo = rand(1, 100);
$numThree = rand(1, 100);

// Proceso: suma de los tres números
$totalSum = $numOne + $numTwo + $numThree;
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Resultado de la Suma</title>
  <link rel="stylesheet" href="styles.css">
</head>
<body>
  <div class="container">
    <h1>Resultado de la Suma de Números Aleatorios</h1>
    <p><strong>Número 1:</strong> <?php echo $numOne; ?></p>
    <p><strong>Número 2:</strong> <?php echo $numTwo; ?></p>
    <p><strong>Número 3:</strong> <?php echo $numThree; ?></p>
    <h2>Total: <?php echo $totalSum; ?></h2>
    <a href="index.html" class="btnBack">Volver</a>
  </div>
</body>
</html>
