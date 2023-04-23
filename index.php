<?php
// Consumiendo nuestro webservice para obtener el conjunto de datos
$url = "http://127.0.0.1:8000/api/users";
$client = curl_init($url);
curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($client);
$result = json_decode($response);
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>CRUD con API Rest Laravel</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/style.css">
</head>
<body>
  <div class="container">
    <header>
      <h1 class="text-center">CRUD con API Rest Laravel</h1>
    </header>
    <main>
      <div class="row">
        <div class="col-md-8 offset-md-2">
          <div class="d-flex justify-content-between align-items-center">
            <h2>Usuarios</h2>
            <a href="nuevo.php" class="btn btn-primary">Crear nuevo</a>
          </div>
          <table class="table table-bordered">
            <thead>
              <tr>
                <th class="text-center">#Id</th>
                <th class="text-center">Nombre</th>
                <th class="text-center">Apellidos</th>
                <th class="text-center">Edad</th>
                <th class="text-center">Salario</th>
                <th class="text-center">Operaciones</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($result as $row): ?>
              <tr> 
                <td class="text-center"><?php echo $row->id ?></td>
                <td class="text-center"><?php echo $row->nombre ?></td>
                <td class="text-center"><?php echo $row->apellido ?></td>
                <td class="text-center"><?php echo $row->edad ?></td>
                <td class="text-center">$<?php echo $row->salario ?></td>
                <td class="text-center">
                  <a href="editar.php?user_id=<?php echo $row->id ?>" class="btn btn-success">Modificar</a>
                  <a href="eliminar.php?user_id=<?php echo $row->id ?>" class="btn btn-danger">Eliminar</a>
                </td>
              </tr>
              <?php endforeach ?>
            </tbody>
          </table>
        </div>
      </div>
    </main>
  </div>
</body>
<script src="http://code.jquery.com/jquery-1.11.2.min.js"></script>
<script src="js/bootstrap.min.js"></script>
</html>
