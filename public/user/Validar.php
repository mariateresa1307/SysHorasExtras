<?php
if(isset($_POST["Nombres"]) && !empty($_POST["Nombres"]) &&
isset($_POST["Apellidos"]) && !empty($_POST["Apellidos"]) &&
isset($_POST["Cedula"]) && !empty($_POST["Cedula"]) &&
isset($_POST["Usuario"]) && !empty($_POST["Usuario"]) &&
isset($_POST["pw"]) && !empty($_POST["pw"]) &&
isset($_POST["pw2"]) && !empty($_POST["pw2"]) &&
isset($_POST["Status"]) && !empty($_POST["Status"]) &&
isset($_POST["Rol"]) && !empty($_POST["Rol"]) &&
isset($_POST["Tipo de Usuario"]) && !empty($_POST["Tipo de Usuario"]) &&
$_POST["pw"] == $_POST["pw2"])

if( !is_numeric($_POST['Cedula']) )
echo "El campo edad debe contener números";

// {

//     $con=mysql_connect($host,$user,$pw)
//     or die ("Problemas al Conectar Server");

//     mysql_select_db($db,$con)
//     or die ("Problemas al Conectar DB");

//     mysql_query("INSERT INTO registro (NOMBRE,USER,PW,EMAIL)
// VALUES ('$_POST[nombre]','$_POST[user]','$_POST[pw]','$_POST[email]')",$con);
//     echo "Datos Insertados<br>";

//     echo "Nombre: "$_POST['nombre']."<br>";
//     echo "User: "$_POST['user']."<br>";
//     echo "Contraseña: "$_POST['pw']."<br>";
//     echo "E-mail: "$_POST['email']."<br>";
// }else{
//     echo "Verifica que llenaste todos los campos y las contraseñas coinciden";
// }

?>