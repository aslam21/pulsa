<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		date_default_timezone_set('Asia/Jakarta');

		$this->load->model('m_data');

	}

	public function index()
	{		
		// 3 event terbaru
		$data['event'] = $this->db->query("SELECT * FROM event,pengguna,kategori WHERE event_status='publish' AND event_author=pengguna_id AND event_kategori=kategori_id ORDER BY event_id DESC LIMIT 3")->result();

		// data pengaturan website
		$data['pengaturan'] = $this->m_data->get_data('pengaturan')->row();

		// SEO META
		$data['meta_keyword'] = $data['pengaturan']->nama;
		$data['meta_description'] = $data['pengaturan']->deskripsi;

		$this->load->view('frontend/v_header',$data);
		$this->load->view('frontend/v_homepage',$data);
		$this->load->view('frontend/v_footer',$data);
	}

	public function single($slug)
	{
		$data['event'] = $this->db->query("SELECT * FROM event,pengguna,kategori WHERE event_status='publish' AND event_author=pengguna_id AND event_kategori=kategori_id AND event_slug='$slug'")->result();

		// data pengaturan website
		$data['pengaturan'] = $this->m_data->get_data('pengaturan')->row();
		$data['judul'] = $this->m_data->getJudulEvent($slug);
		
		// SEO META
		if(count($data['event']) > 0){
			$data['meta_keyword'] = $data['event'][0]->event_judul;
			$data['meta_description'] = substr($data['event'][0]->event_konten, 0,100);
		}else{
			$data['meta_keyword'] = $data['pengaturan']->nama;
			$data['meta_description'] = $data['pengaturan']->deskripsi;
		}

		$this->load->view('frontend/v_header',$data);
		$this->load->view('frontend/v_single',$data);
		$this->load->view('frontend/v_footer',$data);
	}

	public function blog()
	{		

		// data pengaturan website
		$data['pengaturan'] = $this->m_data->get_data('pengaturan')->row();

		// SEO META
		$data['meta_keyword'] = $data['pengaturan']->nama;
		$data['meta_description'] = $data['pengaturan']->deskripsi;


		// $this->load->database();
		$jumlah_data = $this->m_data->get_data('event')->num_rows();
		$this->load->library('pagination');
		$config['base_url'] = base_url().'blog/';
		$config['total_rows'] = $jumlah_data;
		$config['per_page'] = 2;

		$config['first_link']       = 'First';
		$config['last_link']        = 'Last';
		$config['next_link']        = 'Next';
		$config['prev_link']        = 'Prev';
		$config['full_tag_open']    = '<div class="pagging text-center"><nav><ul class="pagination justify-content-center">';
		$config['full_tag_close']   = '</ul></nav></div>';
		$config['num_tag_open']     = '<li class="page-item"><span class="page-link">';
		$config['num_tag_close']    = '</span></li>';
		$config['cur_tag_open']     = '<li class="page-item active"><span class="page-link">';
		$config['cur_tag_close']    = '<span class="sr-only">(current)</span></span></li>';
		$config['next_tag_open']    = '<li class="page-item"><span class="page-link">';
		$config['next_tagl_close']  = '<span aria-hidden="true">&raquo;</span></span></li>';
		$config['prev_tag_open']    = '<li class="page-item"><span class="page-link">';
		$config['prev_tagl_close']  = '</span>Next</li>';
		$config['first_tag_open']   = '<li class="page-item"><span class="page-link">';
		$config['first_tagl_close'] = '</span></li>';
		$config['last_tag_open']    = '<li class="page-item"><span class="page-link">';
		$config['last_tagl_close']  = '</span></li>';


		$from = $this->uri->segment(2);
		if($from==""){
			$from = 0;
		}
		$this->pagination->initialize($config);

		$data['event'] = $this->db->query("SELECT * FROM event,pengguna,kategori WHERE event_status='publish' AND event_author=pengguna_id AND event_kategori=kategori_id ORDER BY event_id DESC LIMIT $config[per_page] OFFSET $from")->result();

		$this->load->view('frontend/v_header',$data);
		$this->load->view('frontend/v_blog',$data);
		$this->load->view('frontend/v_footer',$data);
	}

	public function page($slug)
	{		
		$where = array(
			'halaman_slug' => $slug
		);

		$data['halaman'] = $this->m_data->edit_data($where,'halaman')->result();
		$data['judul'] = $this->m_data->getJudulHalaman($slug);

		// data pengaturan website
		$data['pengaturan'] = $this->m_data->get_data('pengaturan')->row();

		// SEO META
		$data['meta_keyword'] = $data['pengaturan']->nama;
		$data['meta_description'] = $data['pengaturan']->deskripsi;

		$this->load->view('frontend/v_header',$data);
		$this->load->view('frontend/v_page',$data);
		$this->load->view('frontend/v_footer',$data);
	}

	public function kategori($slug)
	{		

		// data pengaturan website
		$data['pengaturan'] = $this->m_data->get_data('pengaturan')->row();

		$jumlah_event = $this->db->query("SELECT * FROM event,pengguna,kategori WHERE event_status='publish' AND event_author=pengguna_id AND event_kategori=kategori_id AND kategori_slug='$slug'")->num_rows();
		
		$this->load->library('pagination');
		$config['base_url'] = base_url().'kategori/'.$slug;
		$config['total_rows'] = $jumlah_event;
		$config['per_page'] = 2;

		$config['first_link']       = 'First';
		$config['last_link']        = 'Last';
		$config['next_link']        = 'Next';
		$config['prev_link']        = 'Prev';
		$config['full_tag_open']    = '<div class="pagging text-center"><nav><ul class="pagination justify-content-center">';
		$config['full_tag_close']   = '</ul></nav></div>';
		$config['num_tag_open']     = '<li class="page-item"><span class="page-link">';
		$config['num_tag_close']    = '</span></li>';
		$config['cur_tag_open']     = '<li class="page-item active"><span class="page-link">';
		$config['cur_tag_close']    = '<span class="sr-only">(current)</span></span></li>';
		$config['next_tag_open']    = '<li class="page-item"><span class="page-link">';
		$config['next_tagl_close']  = '<span aria-hidden="true">&raquo;</span></span></li>';
		$config['prev_tag_open']    = '<li class="page-item"><span class="page-link">';
		$config['prev_tagl_close']  = '</span>Next</li>';
		$config['first_tag_open']   = '<li class="page-item"><span class="page-link">';
		$config['first_tagl_close'] = '</span></li>';
		$config['last_tag_open']    = '<li class="page-item"><span class="page-link">';
		$config['last_tagl_close']  = '</span></li>';


		$from = $this->uri->segment(3);
		if($from==""){
			$from = 0;
		}
		$this->pagination->initialize($config);

		$data['event'] = $this->db->query("SELECT * FROM event,pengguna,kategori WHERE event_status='publish' AND event_author=pengguna_id AND event_kategori=kategori_id AND kategori_slug='$slug' ORDER BY event_id DESC LIMIT $config[per_page] OFFSET $from")->result();

		// SEO META
		$data['meta_keyword'] = $data['pengaturan']->nama;
		$data['meta_description'] = $data['pengaturan']->deskripsi;

		$this->load->view('frontend/v_header',$data);
		$this->load->view('frontend/v_kategori',$data);
		$this->load->view('frontend/v_footer',$data);
	}

	public function search()
	{	
		 //mengambil nilai keyword dari form pencarian
		$cari = htmlentities((trim($this->input->post('cari',true)))? trim($this->input->post('cari',true)) : '');

     		//jika uri segmen 2 ada, maka nilai variabel $search akan diganti dengan nilai uri segmen 2
		$cari = ($this->uri->segment(2)) ? $this->uri->segment(2) : $cari;

		// data pengaturan website
		$data['pengaturan'] = $this->m_data->get_data('pengaturan')->row();

		// SEO META
		$data['meta_keyword'] = $data['pengaturan']->nama;
		$data['meta_description'] = $data['pengaturan']->deskripsi;

		$jumlah_event = $this->db->query("SELECT * FROM event,pengguna,kategori WHERE event_status='publish' AND event_author=pengguna_id AND event_kategori=kategori_id AND (event_judul LIKE '%$cari%' OR event_konten LIKE '%$cari%')")->num_rows();
		
		$this->load->library('pagination');
		$config['base_url'] = base_url().'search/'.$cari;
		$config['total_rows'] = $jumlah_event;
		$config['per_page'] = 2;

		$config['first_link']       = 'First';
		$config['last_link']        = 'Last';
		$config['next_link']        = 'Next';
		$config['prev_link']        = 'Prev';
		$config['full_tag_open']    = '<div class="pagging text-center"><nav><ul class="pagination justify-content-center">';
		$config['full_tag_close']   = '</ul></nav></div>';
		$config['num_tag_open']     = '<li class="page-item"><span class="page-link">';
		$config['num_tag_close']    = '</span></li>';
		$config['cur_tag_open']     = '<li class="page-item active"><span class="page-link">';
		$config['cur_tag_close']    = '<span class="sr-only">(current)</span></span></li>';
		$config['next_tag_open']    = '<li class="page-item"><span class="page-link">';
		$config['next_tagl_close']  = '<span aria-hidden="true">&raquo;</span></span></li>';
		$config['prev_tag_open']    = '<li class="page-item"><span class="page-link">';
		$config['prev_tagl_close']  = '</span>Next</li>';
		$config['first_tag_open']   = '<li class="page-item"><span class="page-link">';
		$config['first_tagl_close'] = '</span></li>';
		$config['last_tag_open']    = '<li class="page-item"><span class="page-link">';
		$config['last_tagl_close']  = '</span></li>';


		$from = $this->uri->segment(3);
		if($from==""){
			$from = 0;
		}
		$this->pagination->initialize($config);

		$data['event'] = $this->db->query("SELECT * FROM event,pengguna,kategori WHERE event_status='publish' AND event_author=pengguna_id AND event_kategori=kategori_id AND (event_judul LIKE '%$cari%' OR event_konten LIKE '%$cari%') ORDER BY event_id DESC LIMIT $config[per_page] OFFSET $from")->result();
		$data['cari'] = $cari;
		$this->load->view('frontend/v_header',$data);
		$this->load->view('frontend/v_search',$data);
		$this->load->view('frontend/v_footer',$data);
	}

	public function notfound()
	{
		// data pengaturan website
		$data['pengaturan'] = $this->m_data->get_data('pengaturan')->row();

		// SEO META
		$data['meta_keyword'] = $data['pengaturan']->nama;
		$data['meta_description'] = $data['pengaturan']->deskripsi;

		$this->load->view('frontend/v_header',$data);
		$this->load->view('frontend/v_notfound',$data);
		$this->load->view('frontend/v_footer',$data);
	}

	public function booking(){

		$this->form_validation->set_rules('jumlah','Jumlah','required');
		$this->form_validation->set_rules('event_id','Event_id','required');
		$this->form_validation->set_rules('event_nama','Event_nama','required');

		if($this->form_validation->run() != false){

				$jumlah = $this->input->post('jumlah');
				$event_id = $this->input->post('event_id');
				$tanggal_b = date('Y-m-d H:i:s');
				$tanggal_m = $this->input->post('tanggal_m');
				$event_nama = $this->input->post('event_nama');
				$pembeli = $this->input->post('pembeli');
				$tiket = substr(md5(uniqid($this->input->post('event_id', true))), 0, 10);
				$harga = $this->input->post('harga');
				$status = 0;

				$data = array(
					'booking_tanggal' => $tanggal_b,
					'booking_event_dimulai' => $tanggal_m,
					'booking_event_id' => $event_id,
					'booking_event' => $event_nama,
					'booking_jumlah' => $jumlah,
					'booking_pembeli_id' => $pembeli,
					'booking_tiket' => $tiket,
					'booking_harga' => $harga,
					'booking_status' => $status,
				);

				$this->m_data->insert_data($data,'booking');

				redirect(base_url().'dashboard/booking');	
				
			} else {

				$data['kategori'] = $this->m_data->get_data('kategori')->result();

				$this->load->view('dashboard/v_header');
				$this->load->view('dashboard/v_event_tambah',$data);
				$this->load->view('dashboard/v_footer');
			}
		}
	}
