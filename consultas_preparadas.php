
<style>
table{
  width: 70%;
  margin: 0 auto;
}
td{
  border: 1px solid black;
  text-align: center;
  padding: 5px 10px 5px 10px;
  width: 16.6%;
  border-collapse: collapse;
  margin: 0;
}

#referencia{
  color: blue;
  font-weight: bold;
}
p{
  font-size: 24px;
  font-weight: bold;
  color: navy;
  text-align: center;
  margin-top: 35px;
}
</style>


<?php

$busqueda=$_GET["buscar"];
require("datos_conexion.php");  


          // Creamos la conexión
          $conexion=mysqli_connect($db_host, $db_usuario, $db_password, $db_nombre);
          // Comprobamos la conexión
          if(mysqli_connect_errno()){
            echo "No se ha podido establecer la conexión con la BBDD";
            exit();
          }
                mysqli_select_db($conexion, $db_nombre) or die ("No se ha encontrado la BBDD");
                mysqli_set_charset($conexion, "utf8");
          // Consulta SQL-query-:
          $consulta="SELECT * FROM artículos WHERE `PAÍS DE ORIGEN` = ?"; 


// OBJETO STMT
$resultados=mysqli_prepare($conexion, $consulta);

//AÑADIR/ASOCIAR/UNIR UN PARAMETRO/S A LA CONSULTA:
$asocia=mysqli_stmt_bind_param($resultados,"s", $busqueda);//devuelve true o false

//EJECUTAR LA CONSULTA
$ejecutar=mysqli_stmt_execute($resultados);//devuelve true o false-no almacena, es una consulta


//Ejecutar resultado
  if($ejecutar==false){
   echo "No se ha podido realizar la busqueda.";
  }else{
    //Asociar variables al resultado de la consulta
    $preparada=mysqli_stmt_bind_result($resultados, $codigo, $seccion, $nombre, $fecha, $pais, $precio);
      echo "<p>Artículos encontrados:</p> <br><br>";
        //Lectura de valores
        while(mysqli_stmt_fetch($resultados)){ 
          echo "<table><tr><td id='referencia'>";
          echo $codigo . " </td><td>";
          echo $seccion . " </td><td>";
          echo $nombre . " </td><td>";
          echo $fecha . " </td><td>";
          echo $pais . " </td><td>";
          echo $precio . " </td></tr></table>";
          echo "<br>";
        }
      //Cerrar la consulta_y le dices el objeto
      mysqli_stmt_close($resultados);
      }
//CERRAR LA CONEXION
mysqli_close($conexion);
?>


