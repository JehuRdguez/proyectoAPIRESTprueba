<?php
if(isset($_GET['idPersona'])){ 
    include ("clases/conexion/conexion.php");
    $estado= new conexion();
    $idPersona=intval($_GET['idPersona']);
    $res= $estado->cambiarStatus($idPersona);
    if($res){
        header("location: /views/users.php");
    }
    else{
        echo "No se pudo actualizar";
    }
    
    }

?>

