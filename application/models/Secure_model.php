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

	public function insert_user($array)
	{
		
        $array['fechaRegistro'] = date("Y-m-d H:i:s");
		$row = $array;
		
		$this->db->insert(self::usuarios_externos_table,$row); 
		
	}

}
