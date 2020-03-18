<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function __construct()
     {
          parent::__construct();
          if($this->session->userdata('id'))
          {
           redirect(base_url().'dashboard');	
          }
          $this->load->library('encryption');
          $this->load->model('m_data');
     }

	public function index()
	{
		$this->load->view('v_login');
	}

	public function aksi()
	{

		$this->form_validation->set_rules('username', 'Username', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');

		if($this->form_validation->run() != false){

			// menangkap data username dan password dari halaman login
			$username = $this->input->post('username');
			$password = $this->input->post('password');

			$where = array(
				'pengguna_username' => $username,
				'pengguna_password' => md5($password),
				'pengguna_status' => 1
			);

			$this->load->model('m_data');

			// cek kesesuaian login pada table pengguna
			$cek = $this->m_data->cek_login('pengguna',$where)->num_rows();

			// cek jika login benar
			if($cek > 0){

				// ambil data pengguna yang melakukan login
				$data = $this->m_data->cek_login('pengguna',$where)->row();

				// buat session untuk pengguna yang berhasil login
				$data_session = array(
					'id' => $data->pengguna_id,
					'username' => $data->pengguna_username,
					'level' => $data->pengguna_level,
					'status' => 'telah_login'
				);
				$this->session->set_userdata($data_session);

				// alihkan halaman ke halaman dashboard pengguna

				redirect(base_url().'dashboard');
			}else{
				redirect(base_url().'login?alert=gagal');
			}

		}else{
			redirect(base_url().'login');
		}
	}

	public function register()
	{

		$this->load->view('v_register');
		
	}

	public function register_aksi(){
		// Wajib isi judul,konten
		$this->form_validation->set_rules('nama','Nama','required');
		$this->form_validation->set_rules('username','Username','required|is_unique[pengguna.pengguna_nama]');
		$this->form_validation->set_rules('email','Email','required|is_unique[pengguna.pengguna_nama]');
		$this->form_validation->set_rules('nomer_hape','Nomer hape','required');
		$this->form_validation->set_rules('password','Password','required');

		if($this->form_validation->run() != false){

           $data = array(
            'pengguna_nama' => $this->input->post('nama'),
            'pengguna_email'  => $this->input->post('email'),
            'nomer_hape'  => $this->input->post('nomer_hape'),
            'pengguna_username' => $this->input->post('username'),
            'pengguna_password' => md5($this->input->post('password')),
            'pengguna_level' => 'user',
            'pengguna_status' => '1'
           );

           $this->m_data->insert_data($data,'pengguna');

			// alihkan kembali ke method pages
			redirect(base_url().'login');	

		}else{
			$this->load->view('v_register');
		}
	}

}
