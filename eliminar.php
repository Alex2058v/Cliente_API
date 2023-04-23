<?php
 //consumiendo nuestro webservice para obtener el conjunto de datos
 $user_id = $_GET['user_id'];
 $url = "http://127.0.0.1:8000/api/user/".$user_id;
$client = curl_init($url);
curl_setopt($client,CURLOPT_RETURNTRANSFER,true);
$response = curl_exec($client);
$result = json_decode($response);
?>
<!DOCTYPE html>
<html lang="es">
<head>
 <meta charset="utf-8" />
 <title>Eliminar un usuario con API Rest</title>
 <link rel="stylesheet" href="css/bootstrap.min.css" />
</head>
<body>
 <div class="content">
 <div class="row">
 <div class="col-md-12">
 <div class="row">
 <div class="col-offset-2 col-md-8">
 <h1>Eliminar un usuario</h1>
 </div>
 </div>
 </div>
 </div>
 <div class="row">
 <div class="col-offset-2 col-md-8">
 <div class="row">
 <div class="col-md-offset-2 col-md-8">
 <a href="index.php" class="btn btn-default">Back</a>
 </div>
 </div>
 </div>
 </div>
 <div class="row">
 <div class="col-md-offset-3 col-md-6">
     <!-- form -->
 <form action="eliminar.php?user_id=<?php echo $result->id?>" method="POST">
 <input type="hidden" name="id" value="<?php echo $result->id;?>"/> <!--envia como valor al metodo POST el id del estudiante para concatenar a la url -->
 <div class="form-group">
 <label for="nombre_estudiante">Nombre </label>
 <input  readonly type="text" value="<?php echo $result->nombre;?>" class="form-control" 
placeholder="Nombre" name="name" id="nombre" />
 </div>
 <div class="form-group">
 <label for="apellidos">Apellidos</label>
 <input  readonly type="text" value="<?php echo $result->apellido;?>" class="form-control" 
placeholder="apellidos" name="apellidos" id="apellidos" />
 </div>
 <div class="form-group">
 <label for="edad">Edad</label>
 <input  readonly type="text" value="<?php echo $result->edad;?>" class="form-control" 
placeholder="edad" name="edad" id="edad" />
 </div> 
 <div class="form-group">
 <label for="estado">Salario</label>
 <input  readonly type="text" value="<?php echo $result->salario;?>" class="form-control" 
placeholder="salario" name="salario" id="status" />
 </div> 
 <button type="submit" class="btn btn-danger">Confirmar</button>
 </form>
 </div>
 </div>
 </div>
 <script src="http://code.jquery.com/jquery-1.11.2.min.js"></script>
 <script src="js/bootstrap.min.js"></script>
</body>
</html>
<?php
if (!empty($_POST)) {
 //consumiendo nuestro webservice para enviar el conjunto de datos
 $id = $_POST['id'];//recupera el id del form
 echo $id;
 $url = "http://127.0.0.1:8000/api/delete_user/".$_POST['id'];
 $client = curl_init($url);
 curl_setopt($client,CURLOPT_CUSTOMREQUEST,"DELETE"); //definimos el metodo Delete http
 curl_setopt($client,CURLOPT_HTTPGET, false);
$response = curl_exec($client);
 if($response==true){
 echo "<script>alert('registro eliminado exitosamente');document.location='index.php'</script>";
 }else{
 echo "<script>alert('No se pudo eliminar el registro');document.location='index.php'</script>";
 }
}
?>