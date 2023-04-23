<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8" />
    <title>Ingresar nuevo usuario con API Rest</title>
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <link rel="stylesheet" href="css/style2.css" />
</head>
<body class="container">
    <div class="content">
        <div class="row">
            <div class="col-offset-2 col-md-8">
                <h1>Crear un nuevo usuario</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-md-offset-3 col-md-6">
                <form action="nuevo.php" method="POST">
                    <div class="form-group">
                        <label for="nombre_estudiante">Nombre</label>
                        <input type="text" class="form-control" placeholder="Nombre completo" name="name" id="nombre">
                    </div>
                    <div class="form-group">
                        <label for="apellidos">Apellidos</label>
                        <input type="text" class="form-control" placeholder="Apellidos" name="apellidos" id="apellido">
                    </div>
                    <div class="form-group">
                        <label for="edad">Edad</label>
                        <input type="text" class="form-control" placeholder="Edad" name="edad" id="edad">
                    </div>
                    <div class="form-group">
                        <label for="sueldo">Salario</label>
                        <input type="text" class="form-control" placeholder="Sueldo" name="salario" id="sueldo">
                    </div>
                    <button type="submit" class="btn btn-success">Enviar</button>
                </form>
                <a href="index.php" class="btn btn-default">Regresar</a>
            </div>
        </div>
    </div>
    <script src="http://code.jquery.com/jquery-1.11.2.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>
<script src="http://code.jquery.com/jquery-1.11.2.min.js"></script>
<script src="js/bootstrap.min.js"></script>
</html>
<?php
if (!empty($_POST)) {
 //consumiendo nuestro webservice para enviar el conjunto de datos
 $url = "http://127.0.0.1:8000/api/add_user";
 $curl = curl_init($url);
 curl_setopt($curl, CURLOPT_URL, $url);
 curl_setopt($curl, CURLOPT_POST, true);
 curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
 
 $headers = array(
    "Accept: application/json",
    "Content-Type: application/json",
    );
    curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
    
    $usr_name=$_POST['name'];
    $usr_apellidos=$_POST['apellidos'];
    $usr_edad=$_POST['edad'];
    $usr_salario=$_POST['salario'];
    /*function genRan($length = 1) {
        return substr(str_shuffle("0123456789"), 0, $length); 
    }*/
    $date=date(DATE_W3C);//"created_at":"$date"
    //$id_usr=genRan();
    //echo $id_estudiante;
    //estructura del JSON a enviar 
    $data = <<<DATA
    {
    "nombre":"$usr_name",
    "apellido":"$usr_apellidos",
    "edad":"$usr_edad",
    "salario":"$usr_salario"}
    DATA;
    //$post_data=json_encode($data);

    curl_setopt($curl, CURLOPT_POSTFIELDS, $data); //envia el registro o fila
    $resp = curl_exec($curl);//returna true si funciona , false si no
    //echo $resp;
    curl_close($curl);
    if($resp==true){
    echo "<script>alert('registro agregado exitosamente');document.location='index.php'</script>";
    }else{
    echo "<script>alert('No se pudo agregar el registro');document.location='index.php'</script>";
    }
   }
?>
