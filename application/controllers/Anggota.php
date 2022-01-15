<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Anggota extends CI_Controller {

	var $data = array();
	
	function __construct()
	{
		parent::__construct();
		$this->load->helper('form');
		$this->load->helper('url'); 
		$this->data['opt_progdi'] = array(''=>'-Pilih salah satu -',
											'TI'=>'Teknik Informatika',
											'SI'=>'Sistem Informasi',
											'IK'=>'Ilmu Komunikasi');
		$this->load->model('Anggota_m'); 
		$this->load->library('form_validation');
		$this->load->library('pagination'); 
		//cek session login
		if(!is_logged_in()){
			redirect('perpus','refresh');
		}
	}

	public function index()
	{
		 $config = array();
		 $config["base_url"] = base_url() . "index.php/anggota/index";
		 $config["total_rows"] = $this->Anggota_m->jml_Anggota();
		 $config["per_page"] = 5; //1 hal menampilkan 5 record
		 $config["uri_segment"] = 3;
		 //membuat pagination link
		 $this->pagination->initialize($config);
		 $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		 $this->data["links"] = $this->pagination->create_links();
		 //menampilkan halaman perhalaman
		 $this->data['query']=
		 $this->Anggota_m->get_records(null,null,$config["per_page"], $page); 
		 $this->load->view('anggota_v',$this->data);           
	}
	
	function add_new()
	{
		$this->data['is_update'] = 0;
		$this->load->view('anggota_form_v',$this->data);
	}
	
	function save($is_update=0)
	{
		$data['nim']		= $this->input->post('nim',true);
		$data['nama']	= $this->input->post('nama',true);
		$data['progdi']	= $this->input->post('progdi',true);
		
		if($is_update==0)
		{
			if($this->Anggota_m->insert($data));
			redirect('anggota');
		}
		else
		{
			$id=$this->input->post('id');
			if($this->Anggota_m->update_by_id($data,$id));
			redirect('anggota');
		}	
	}
	
	function edit($id)
	{
		$this->data['query']=$this->Anggota_m->get_records("ID_Anggota = '$id'");
		$this->data['is_update']=1;
		$this->load->view('anggota_form_v',$this->data);
	}

	function delete($id)
	{
		if($this->Anggota_m->delete_by_id('mst_anggota',$id))
		{
			redirect('anggota');
		}
	}

	//function cek form validation
    function check()
	{
        //rule dari form validation adalah text name, field data, required  
		$this->form_validation->set_rules('id', 'ID', 'trim');
		$this->form_validation->set_rules('nim', 'NIM', 'trim|required');
		$this->form_validation->set_rules('nama', 'Nama Mahasiswa', 'trim|required');
		$this->form_validation->set_rules('progdi', 'Program Studi', 'trim|required');
		
		$this->form_validation->set_message('required', 'Data {field} harus diisi.');
		$this->form_validation->set_error_delimiters('<div style="color:red;">', '</div><br/>');
		
        //kondisi perintah save atau mengedit data
		if($this->form_validation->run()==true){
			$this->save($this->input->post('is_update',true));
		}else{
			$this->data['is_update'] = $this->input->post('is_update',true);
			$this->load->view('anggota_form_v',$this->data);
		}
	}
}
