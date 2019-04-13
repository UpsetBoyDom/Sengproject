<?php
/**
 * @author Yushae Raza
 * 2019-3-16
 * Determines type of user and loads pages corresponding to their permissions
 */

session_start();

	/**
	 * Load website pages according to users access level
	 * @param $filename the name of the file being read
	 */
	function read_file($filename){
		$file_content;
		if(isset($_SESSION['role'])){
			if($_SESSION['role']==2){//load admin page if role is 2
				$file_content = file_get_contents("../Menu/Menu(Admin).html");
			}
			else if($_SESSION['role']==1){//load patient page if role is 1
				$file_content = file_get_contents("../Menu/Menu(Patient).html");
			}
			else{//load patient page by default
			$file_content = file_get_contents("../Menu/Menu(Patient).html");
			}
		}
		else{//load patient page by default
			$file_content = file_get_contents("../Menu/Menu(Patient).html");
		}
		return $file_content;//return the content of the file
	}


	if(isset($_POST["Name"])){
		echo read_file($_POST["Name"]);//display the contents of the file read
	}
	?>