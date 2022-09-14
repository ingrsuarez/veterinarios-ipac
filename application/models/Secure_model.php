<?php 


class Secure_model extends CI_Model {

	const usuarios_externos_table = "usuariosexternos";
	public function __constructor (){

		
		$this->load->database();
		
	}


	public function check_password($data)
	{
		$userName = $data['userName'];
		$password = $data['password'];
		$sql = "SELECT * FROM empleados WHERE usuario = '".$userName."' AND clave = '".$password."' LIMIT 1";
		$query = $this->db->query($sql);
		$result = $query->row_array();
		return $result;

	}

	public function check_activationCode($code)
	{
		$sql = "SELECT * FROM `usuariosexternos` WHERE usuariosexternos.email = 'ing.rsuarez@gmail.com'";
		$query = $this->db->query($sql);
		$result = $query->row_array();

	}

	public function access($sector="")
	{
		if (!empty($sector))
		{
			$puesto = $this->session->userdata('puesto');
			$sql = "SELECT acceso FROM `accesos` WHERE puesto =  '".$puesto."' AND sector = '".$sector."' LIMIT 1";
			$query = $this->db->query($sql);
			$result = $query->row_array();
			$access = $result['acceso'];
			return ((int) $access);
		}else
		{return FALSE;}

	}

	public function insert_user($array,$id)
	{
		
        $array['fechaRegistro'] = date("Y-m-d H:i:s");
		$row = $array;
		

		$where = "id = ".$id;

		$str = $this->db->update_string(self::usuarios_externos_table, $row, $where);
		$this->db->query($str);
		var_dump($str);
		// $this->db->insert(self::usuarios_externos_table,$row); 
		
	}

	public function search_newUser($email)
	{


	}

	public function mail_exist($emailToCheck)
	{
		$sql = "SELECT * FROM `usuariosexternos` WHERE `email` =  '".$emailToCheck."'";
		$query = $this->db->query($sql);
		$result = $query->row_array();
		if ($result == null){
			return FALSE;
		}
		if (empty($result['usuario']))
		{
			return $result['id'];
		}else
		{
			return "have user";
		}
		
	}

}
