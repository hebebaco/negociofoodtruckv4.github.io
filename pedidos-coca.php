<?php
require_once 'header.php';
use Illuminate\Database\Capsule\Manager as Capsule;
if($loggedin){
echo '
<center><h1>Pedidos!</h1></center>
<form class="needs-validation" action="pedidos-coca.php" method="post" novalidate>
<div class="form-row">
  <div class="col-md-4 mb-3">
    <label for="validationCustom01" class="text" >Nombre: </label>
    <input type="text" name="nombreCOCA" class="form-control" id="validationCustom01" value="" required>
    <div class="valid-feedback">
      Looks good!
    </div>
  </div>
  
  <div class="col-md-4 mb-3">

<div class="form-row">
  <div class="col-md-6 mb-3">
    <label for="validationCustom03" class="text" >Dirección: </label>
    <input type="text" name="DireCOCA" class="form-control" id="validationCustom03" required>
    <div class="invalid-feedback">
      Please provide a valid city.
    </div>
  </div>
</div>
<button class="btn btn-primary" type="submit">Submit form</button>
</form>
';
error_reporting(E_ERROR | E_PARSE);

$nombre=$_POST["nombreCOCA"];
$direc=$_POST["DireCOCA"];
$orden="COCACOLA";
$precio="$16";
if($nombre  ==  "" || $direc == "")
{
  echo "Escriba su nombre y direccion.";
}
else
{

$name = Capsule::table('orden')->select(['id_nombre'])->where('id_nombre', $nombre)->first();

  if($nombre == $name->id_nombre)
  {
    echo "Este Nombre Se encuentra ye en uso.";
  }
  else
  {
    $idses = Capsule::table('inicio_sesion')->select(['id_inicio_sesion'])->where('user', $user)->first();
Capsule::table('orden')->insert(['id_pedido' => '0', 'id_nombre' => $nombre,'id_dirrecion' => ' ', 'inicio_sesion_id_inicio_sesion' => $idses->id_inicio_sesion ]);

    Capsule::table('orden')->where('id_nombre', $nombre)
    ->update(['id_pedido' => $orden]);

    Capsule::table('orden')->where('id_nombre', $nombre)
    ->update(['id_dirrecion' => $direc]);
    
    Capsule::table('orden')->where('id_nombre', $nombre)
    ->update(['precio' => $precio]);
    echo"Compra exitosa";
  }
}
}
?>