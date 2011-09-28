<?php
class Access{
	private $bValid = 0;
	public function Access($Level){
		
		session_start();
		$Vars = explode(",",$Level);
		
		if(isset($_SESSION["user"])){
			foreach($Vars as $Permiso){
					$this->checkAcess($Permiso);		
			}
			
			if($this->bValid == 0)
				echo '<META HTTP-EQUIV="Refresh" CONTENT="0; URL=restricted.html">';	
		}else
			echo '<META HTTP-EQUIV="Refresh" CONTENT="0; URL=denied.html">';
	}
	
	public function checkAcess($toCheck){
		session_start();
		if($_SESSION['lvl'] == $toCheck)
			$this->bValid++;
	}
}
?>