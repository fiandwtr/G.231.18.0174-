<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pinjam extends CI_Controller {
	
	var $data = array();
	
	function __construct()
	{
		parent::__construct();
		$this->load->helper('form');
		$this->load->helper('url'); 
		$this->load->model('anggota_m');
		$this->load->model('buku_m');
		$this->load->model('pinjam_m');
		// -- load library Form Validation
		$this->load->library('form_validation'); 
		// -- load library Pagination
		$this->load->library('pagination');
		// -- cek session login
		if(!is_logged_in()){
			redirect('perpus','refresh');		
		}
	}
	public function index()
	{
		// --- tambahan untuk pagination
		$config = array();
		$config["base_url"] = base_url() . "index.php/pinjam/index";
		$config["total_rows"] = $this->pinjam_m->jml_Pinjam();
		$config["per_page"] = 5;
		$config["uri_segment"] = 3;
		
		$this->pagination->initialize($config);
		$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		$this->data["links"] = $this->pagination->create_links();
		// -----------------------
		$this->data['query']=$this->pinjam_m->get_records(null,null,$config["per_page"], $page);
		$this->load->view('pinjam_v',$this->data);
	}
	
	function add_new()
	{
		$this->data['anggota'] = $this->anggota_m->opt_Anggota();
		$this->data['buku'] = $this->buku_m->opt_Buku();
		$this->data['is_update'] = 0;
		$this->load->view('pinjam_form_v',$this->data);
	}
	
	function save($is_update=0)
	{
		$data['ID_Anggota']		= $this->input->post('ID_Anggota',true);
		$data['ID_Buku']		= $this->input->post('ID_Buku',true);
		$data['tgl_pinjam']		= $this->input->post('tgl_pinjam',true);
		$data['tgl_kembali']	= $this->input->post('tgl_kembali',true);
		
		$is_update= $this->input->post('is_update',true);
		
		if($is_update==0)
		{
			if($this->pinjam_m->insert($data));
			redirect('pinjam');
		}
		else
		{
			$id=$this->input->post('id');
			if($this->pinjam_m->update_by_id($data,$id));
			redirect('pinjam');
		}
	}
	
	function edit($id)
	{
		$this->data['query']=$this->pinjam_m->get_records("ID_Pinjam = '$id'");
		$this->data['anggota'] = $this->anggota_m->opt_Anggota();
		$this->data['buku'] = $this->buku_m->opt_Buku();
		$this->data['is_update']=1;
		$this->load->view('pinjam_form_v',$this->data);
	}
	
	function delete($id)
	{
		if($this->pinjam_m->delete_by_id('mst_pinjam',$id))
		{
			redirect('pinjam');
		}
	}
	
}
