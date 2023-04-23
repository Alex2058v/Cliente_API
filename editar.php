<?php
$user_id = $_GET['user_id'];
$url = "http://127.0.0.1:8000/api/user/".$user_id;

$client = curl_init($url);
curl_setopt($client, CURLOPT_RETURNTRANSFER, true); // transferencia de datos
$response = curl_exec($client);
$result = json_decode($response);

if (!empty($_POST)) {
    $url = "http://127.0.0.1:8000/api/mod_user/".$_POST['id'];

    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "PATCH"); // definimos el método http

    $id = $_POST['id'];
    $name = $_POST['name'];
    $apellidos = $_POST['apellidos'];
    $edad = intval($_POST['edad']);
    $salario = $_POST['salario'];

    // estructura del JSON a enviar
    $data = json_encode(array(
        "nombre" => $name,
        "apellido" => $apellidos,
        "edad" => $edad,
        "salario" => $salario
    ));

    $headers = array(
        "Accept: application/json",
        "Content-Type: application/json",
        "Content-Type: text/html",
        "Content-Type: charset=UTF-8",
    );

    curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $data); //le manda los parametros en un JSON para modificar el registro

    $resp = curl_exec($curl);
    curl_close($curl);

    if ($resp) {
        echo "<script>alert('Registro actualizado exitosamente');document.location='index.php'</script>";
    } else {
        echo "<script>alert('No se pudo actualizar el registro');</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8" />
    <title>Editar un usuario con API Rest</title>
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <link rel="stylesheet" href="css/editar.css" />
</head>
<body class="container">
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-offset-2 col-md-8">
                        <h1>Editar un usuario</h1>
                    </div>
                </div>
            </div>
        </div>
    <div class="row">
    <div class="col-md-offset-3 col-md-6">
        <form action="editar.php?user_id=<?php echo $result->id?>" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?php echo $result->id;?>"/>
            <div class="form-group">
                <label for="nombre_estudiante">Nombre </label>
                <input type="text" value="<?php echo $result->nombre;?>" class="form-control" placeholder="Nombre Usuario" name="name" id="nombre" />
            </div>
            <div class="form-group">
                <label for="correo_usuario">Apellidos</label>
                <input type="text" value="<?php echo $result->apellido;?>" class="form-control" placeholder="Correo Usuario" name="apellidos" id="apellido" />
            </div>
            <div class="form-group">
                <label for="correo_usuario">Edad</label>
                <input type="text" value="<?php echo $result->edad;?>" class="form-control" placeholder="Correo Usuario" name="edad" id="edad" />
            </div>
            <div class="form-group">
                <label for="correo_usuario">Salario</label>
                <input type="text" value="<?php echo $result->salario;?>" class="form-control" placeholder="Correo Usuario" name="salario" id="sueldo" />
            </div>
            <button type="submit" class="btn btn-success">Enviar</button>
        </form>
    </div>
    </div>
    </div>
    <div class="row">
        <div class="col-offset-2 col-md-8">
            <div class="row">
                <div class="col-md-offset-2 col-md-8">
                    <a href="index.php" class="btn btn-default">Regresar</a>
                </div>
            </div>
        </div>
    </div>
</body>
<script src="http://code.jquery.com/jquery-1.11.2.min.js"></script>
<script src="js/bootstrap.min.js"></script>
</html>
