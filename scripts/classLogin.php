<?php
class Login{
	
	private function sesion($User,$Lvl,$IdUser,$SelDb)
	{
		$_SESSION["db"]			= $SelDb;
		$_SESSION["user"]		= $User;
		$_SESSION["lvl"] 		= $Lvl;
		$_SESSION["id_user"]	= $IdUser;
		//echo '<META HTTP-EQUIV="Refresh" CONTENT="0; URL=init.php">';
		echo $this->send($Lvl);
	}

	public function Logon($User,$Passwd)
	{
		$Conexion = new Conexion("userLab");
		//$Conexion = new Conexion("intellim_userlab");
		
		$Passwd = md5($Passwd);
		$Sql = "select idCliente,level,nameDb,passwd,usuario from clienteTbl 
					inner join laboratorioTbl on fk_idLaboratorio = idLaboratorio 
					where usuario = '$User' and status = 1 ";
					//echo $Sql;
		$Data = $Conexion->consulta($Sql);
		$Row = $Data -> fetch_array(MYSQLI_ASSOC);
		$Lvl = $Row["level"];
		$IdUser = $Row["idCliente"];
		$SelDb	= $Row["nameDb"];
		//echo $IdUser;
		
			if($User == $Row["usuario"] && $Passwd == $Row["passwd"]){			
				//--------------------- Asigno Variables de session -----------------------------
				$this->sesion($User,$Lvl,$IdUser,$SelDb);
			
			}else{
				echo '<META HTTP-EQUIV="Refresh" CONTENT="0; URL=badlogin.html">';
			}
			
	}
	
	public function send($Lvl){
		switch($Lvl){
			case "R": $Send = '<META HTTP-EQUIV="Refresh" CONTENT="0; URL=registro.php">'; 				break; //Root cualquier estado
			case "S": $Send = '<META HTTP-EQUIV="Refresh" CONTENT="0; URL=registro.php">'; 				break; //Todos los privilegios
			//case "D": $Send = '<META HTTP-EQUIV="Refresh" CONTENT="0; URL=delegado/init.php">'; 		break; //Solo Ver para X estado
			/*case "V": $send = '<META HTTP-EQUIV="Refresh" CONTENT="0; URL=dgplades/init.php">'; 	break; //dgplades
			case "Z": $send = '<META HTTP-EQUIV="Refresh" CONTENT="0; URL=presidencia/init.php">'; 	break; //presidencia
			case "B": $send = '<META HTTP-EQUIV="Refresh" CONTENT="0; URL=tesoreria/init.php">'; 	break; //tesoreria
			case "F": $send = '<META HTTP-EQUIV="Refresh" CONTENT="0; URL=auditoria/init.php">'; 	break; //auditoria*/
		}
		return $Send;
	}
}
?>