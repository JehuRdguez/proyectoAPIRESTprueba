<?php 

require_once 'conexion/conexion.php';
require_once 'response.class.php';

class users extends conexion{

	private $nombre = "";
	private $apellidos = "";
	private $rfc = "";
	private $nickName = "";
	private $tipoUsuario = "";

	public function listaUsuarios(){ //listaUsuarios(2) $pagina = 1
		/*$inicio = 0;
		$cantidadItems = 5;
		if($pagina > 1 ){ // val = 2
			$inicio = ($cantidadItems * ($pagina -1));  //(5*(2-1))= 5
 			$cantidadItems = $cantidadItems * $pagina; //5*2 = 10 
		}*/
		$query = "SELECT * FROM userdata"; // limit $inicio,$cantidad;
		$datos = parent::getData($query);

		for ($i=0; $i<count($datos);$i++){
			$listaUsuarios=$datos[$i];
	
			$idPersona = ($listaUsuarios["personId"]);
	  ?>

		  <tr>
			<!--DATOS DE CELDAS-->
			<td><?php echo ($listaUsuarios["userId"]);?></td>
			<td><?php echo ($listaUsuarios["NombreCompleto"] = $listaUsuarios["Name"] . " " .$listaUsuarios["Lastname"] ); ?></td>
			<td><?php echo ($listaUsuarios["RFC"]);?></td>
			<td><?php echo ($listaUsuarios["user"]);?></td>
			<td><?php echo ($listaUsuarios["userType"]);?></td>
			<td>
				<?php if (($listaUsuarios["userActive"])==1){ ?>
									<a type="button" class="btn btn-success" href="../cambioStatus.php?idPersona=<?php echo $idPersona; ?>"><i class="fa-solid fa-check"></i></a>
								<?php } else { ?>
									<a type="button" class="btn btn-danger" href="../cambioStatus.php?idPersona=<?php echo $idPersona; ?>"><i class="fa-solid fa-xmark"></i></a>
								<?php } ?>
			</td>
		 </tr>
	
		  <?php
	}


	}

	public function post($datos){
		$datos = $datos;
		$name = $datos['nw_userName'];
		$lname = $datos['nw_apellidos'];
		$rfc = $datos['nw_rfc'];
		$nick = $datos['nw_nickName'];
		$userType = $datos['userType'];

		$query = "INSERT INTO personas(personName, personLastName, personRFC, bActive) VALUES ('$name','$lname','$rfc',1)";
		$id = parent::postDataId($query);
		$query2 = "INSERT INTO users(personId, user, pass, userType) VALUES ('$id','$nick',md5('$nick'),'$userType')";
		$result = parent::postData($query2);
		return $result;
	}

	public function buscarUsuarioNombre($userName){ 
		$query = "SELECT * FROM userdata where Name =  '$userName'"; 
		$datos = parent::getData($query);
		return ($datos);

	}

}

?>