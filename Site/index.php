<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <!-- <link
      rel="stylesheet"
      href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"
      integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p"
      crossorigin="anonymous"
    /> -->    
    <link rel="stylesheet" href="style.css" />
    <title>Fórmula 1 - Início</title>
  </head>
  <body>
    <nav class="navbar">
      <div class="container">
        <div class="logo"><i class="fa-solid fa-car-side"></i> FÓRMULA 1 </div>
        <ul class="nav">
          <li>
            <a href="./index.php">Inicio</a>
          </li>
          <li>
            <a href="./index.php?opt=1">Vencedores</a>
          </li>
          <li>
            <a href="./index.php?opt=2">Total de Vitórias</a>
          </li>
          <li>
            <a href="./index.php?opt=3">Pit Stop</a>
          </li>
          <li>
            <a href="./index.php?opt=4">Aniversariantes</a>
          </li>
          <li>
            <a href="./index.php?opt=5">Representantes</a>
          </li>
        </ul>
      </div>
    </nav>

    <header class="header">
      <div class="container">
        <div>
          <br><br><br><br><br><br><br><br><br><br><br><br><br>
          <h1 style="color:yellow; border-width: 1px;">Base de Dados de Fórmula 1 (1950 - 2023)</h1>
        </div>
        <img src="https://traversymedia.com/images/grid.svg" alt="" />
      </div>
    </header>

    <section class="tabela">
      <?php include './consultas.php'; ?>
    </section>
  </body>
</html>
