<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pages extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/userguide3/general/urls.html
	 */

	public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->model('empleados_model');
        $this->load->model('Novedades_model');
        $this->load->model('Secure_model');
        $this->load->helper('url_helper');

    }


	public function index($page = 'home',$empleado = array())
	{
        
		 if ( ! file_exists(APPPATH.'views/pages/'.$page.'.php'))
        {
                // Whoops, we don't have a page for that!
                show_404();
        }
        $data['title'] = $page;
        $user = $this->input->post('username');
        $userPassword = $this->input->post('password');
        $newdata = array(
        'userName'  => $user,
        'password'     => md5($userPassword));
        $newUser = $this->Secure_model->check_password($newdata);

        $this->session->set_userdata($newUser);

        if ($this->session->has_userdata('usuario'))
        {
            $board = $this->Novedades_model->get_board();
            $data['board'] = $board;
            $data['username'] = $this->session->userdata('usuario');
            
            $this->load->view('templates/head', $data);
            $this->load->view('templates/header', $data);
            $this->load->view('templates/aside', $this->session->userdata());
            $this->load->view('pages/home', $this->session->userdata());
            $this->load->view('templates/footer', $data);
        }else {
            echo("Por favor introduzca un usuario y contraseña correctos!");
            redirect('/secure/login', 'refresh');
        }
	}



    public function registrar_usuario()
    {
        
        if ($this->session->has_userdata('usuario'))
        {

        }else
        {
            if (empty($_POST))
            {
                $data = array('page'=>'REGISTRO');
                $this->load->view('templates/head', $data);
                $this->load->view('templates/header', $data);
                // $this->load->view('templates/aside', $this->session->userdata());
                $this->load->view('pages/registro', $data);
                $this->load->view('templates/footer', $data);
                $this->load->helper('form');
            }else
            {
                
                $registro['nombre'] = $this->input->post('nombre');
                $registro['apellido'] = $this->input->post('apellido');
                $registro['email'] = $this->input->post('email');
                $clave = $this->input->post('clave');
                $clave_confirmada = $this->input->post('clave_confirmada');
                $registro['telefono'] = $this->input->post('telefono');
                $registro['domicilio'] = $this->input->post('domicilio');
                $registro['ciudad'] = $this->input->post('ciudad');
                $registro['provincia'] = $this->input->post('provincia');
                $registro['fechaNacimiento'] = $this->input->post('fecha_nacimiento');
                $registro['tipo'] = $this->input->post('tipo');
                $registro['matricula'] = $this->input->post('matricula');
                if ($clave != $clave_confirmada)
                {
                    $message = 'Las claves ingresadas no coinciden';
                    echo ("<script>
                    alert('".$message."')
                    </script>");
                    unset($_POST);
                    redirect('/pages/registrar_usuario/', 'refresh');
                }else
                {
                    $registro['clave'] = hash('sha256', $clave);
                    $registro['usuario'] = $registro['email'];
                    // var_dump($registro);
                    $this->Secure_model->insert_user($registro);
                    $this->config->load('email_settings');
                    $this->load->library('email');

                    $this->email->from('administrador@veterinarios-ipac.com.ar', 'ACTIVAR USUARIO');
                    $this->email->to($registro['email']);
                   

                    $this->email->subject('Email Test');
                    $this->email->message('Hola Testing the email class.'.$registro['nombre'].$registro['fechaNacimiento']);

                    $this->email->send();
                    $message = 'Revise su correo para activar su usuario!';
                    echo ("<script>
                    alert('".$message."')
                    </script>");
                    unset($_POST);
                    redirect('/', 'refresh');
                }

            }
            

        }
         
       
    }

    //Function to verify board tasks
    public function verify_task($page = 'home')
    {
        if ($this->session->has_userdata('usuario'))
        {
            $taskId = $this->input->post('vid');

            $this->Novedades_model->set_board($taskId,'estado','verificado');
            $board = $this->Novedades_model->get_board();
            
            $data['board'] = $board;
            $data['title'] = $page;
            $this->load->view('templates/head', $data);
            $this->load->view('templates/header', $data);
            $this->load->view('templates/aside', $this->session->userdata());
            $this->load->view('pages/home', $data);
            $this->load->view('templates/footer', $data);
        }else
        {
            redirect('/secure/login', 'refresh');
        }
    }

    public function insert_task($page = 'home')
    {
        if ($this->session->has_userdata('usuario'))
        {    
            if( isset($_POST['nota'])){$note = $_POST['nota'];}

            if (!empty($note)){
                $this->Novedades_model->insert_board($note);
                redirect('/pages/index', 'refresh');
            }else{
                $board = $this->Novedades_model->get_board();
                $data['board'] = $board;
                $data['title'] = $page;
                $this->load->view('templates/head', $data);
                $this->load->view('templates/header', $data);
                $this->load->view('templates/aside', $this->session->userdata());
                $this->load->view('pages/home', $data);
                $this->load->view('templates/footer', $data);
            }

        }else{
             redirect('/secure/login', 'refresh');
        }
    }



    // Private methods

    

}
