<?php

class controller_user extends CI_Controller
{
    function __construct()
	{
		parent:: __construct();
        $this->load->helper('html');
        $this->load->helper('html');
		$this->load->helper(array('url','form'));
		$this->load->library('form_validation');
		$this->load->library('session');
		$this->load->model('Model');
    }
    
    public function Home(){
        $this->load->view('Home');
    }

    public function Register()
    {
        $this->load->view('Register');
    }

    public function Login()
    {
        $this->load->view('Login');
    }

    public function login_process()
    {
        $val_login = array(     
                            array(
                                'field' => 'email',
                                'label' => 'email',
                                'rules' => 'required',
                                'error' => array('required'=>'Email tidak boleh kosong'),
                        
                            ),
                            array(
                                'field' => 'password',
                                'label' => 'label',
                                'rules' => 'required',
                                'error' => array('required'=>'Password harus diisi'),
                            ),
                        );
        $this->form_validation->set_rules($val_login);

        if($this->form_validation->run()==FALSE){
            $this->load->view('Login');
        }else{
            $data = array(
                'email' => $this->input->post('email'),
                'password' => $this->input->post('password')
            );
            $result = $this->Model->Login($data);
            if($result==true){
                $email = $this->input->post('email');
                $result = $this->Model->bandingkan($email);
                if($result!=false){
                     $session_data = array(
                        'email' => $result[0]->email,
                        'name' => $result[0]->nama,
                        // var_dump($result)
                        );
                $this->session->set_userdata($session_data);
                $this->load->view('Home');
                }else{
                    echo '<script>alert("Username dan Password anda tidak cocok");</script>';
                    redirect ('controller_user/Login','refresh');
                }
            }else{
                echo '<script>alert("Terjadi kesalahan :(");</script>';
                redirect ('controller_user/Login','refresh');
            }

        }
    }

 