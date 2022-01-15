<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Buku extends CI_Controller
{
    var $data=array();

    //fungsi perintah pertama yang akan dijalankan
    function __construct()
    {
        parent::__construct();
        //load helper form
        $this->load->helper('form');
        //load helper url
        $this->load->helper('url');

        $this->data['opt_kategori']=array( ''=>'-Pilih Salah Satu-',
                                            'novel'=>'Novel',
                                            'komik'=>'Komik',
                                            'kamus'=>'Kamus',
                                            'pemrograman'=>'Pemrograman');
        //load  model Buku_m.php                                    
        $this->load->model('Buku_m');  
        //load library form validation
        $this->load->library('form_validation'); 
        //load library form pagination 
        $this->load->library('pagination');  
        //cek session login 
        if(!is_logged_in()){
			redirect('perpus','refresh');		
		}                               
    }

    //function index buku
    function index()
    {
        //script untuk pagination
        $config = array();
		$config["base_url"] = base_url() . "index.php/buku/index";
		$config["total_rows"] = $this->Buku_m->jml_Buku();
		$config["per_page"] = 5; //1 hal menampilkan 5 record
		$config["uri_segment"] = 3;
		//membuat pagination link
		$this->pagination->initialize($config);
		$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		$this->data["links"] = $this->pagination->create_links();
		//menampilkan halaman perhalaman
		$this->data['query']=
        $this->Buku_m->get_records(null,null,$config["per_page"], $page); 
		$this->load->view('buku_v',$this->data); 
    }

    //function untuk memangil form tambah/edit
    function add_new()
    {
        $this->data['is_update']=0;
        $this->load->view('buku_form_v',$this->data);
    }

    //function save ada 2 perintah yaitu simpan atau update
    function save($is_update=0)
    {
        $data['Judul']      =$this->input->post('judul',true);
        $data['Pengarang']  =$this->input->post('pengarang',true);
        $data['Kategori']   =$this->input->post('kategori',true);
       
        if($is_update==0)
        {   //kondisi simpan data baru
            if($this->Buku_m->insert($data))
                redirect('buku');
        }else{
            //kondisi update data
            $id=$this->input->post('id');
            if($this->Buku_m->update_by_id($data,$id))
                redirect('buku');
        }
    }

    //function untuk menampilkan data yang akan di edit
    function edit($id)
    {
        $this->data['query']=$this->Buku_m->get_records("ID_Buku='$id'");
        $this->data['is_update']=1;
        $this->load->view('buku_form_v',$this->data);
    }

    //function perintah menghapus data
    function delete($id)
    {
        if($this->Buku_m->delete_by_id($id))
        {
            redirect('buku');
        }
    }

    //function cek form validation
    function check()
	{
        //rule dari form validation adalah text name, field data, required  
		$this->form_validation->set_rules('id', 'ID', 'trim');
		$this->form_validation->set_rules('judul', 'Judulku', 'trim|required');
		$this->form_validation->set_rules('pengarang', 'Nama Pengarang', 'trim|required');
		$this->form_validation->set_rules('kategori', 'Kategori', 'trim|required');
		
		$this->form_validation->set_message('required', 'Data {field} harus diisi.');
		$this->form_validation->set_error_delimiters('<div style="color:red;">', '</div><br/>');
		
        //kondisi perintah save atau mengedit data
		if($this->form_validation->run()==true){
			$this->save($this->input->post('is_update',true));
		}else{
			$this->data['is_update'] = $this->input->post('is_update',true);
			$this->load->view('buku_form_v',$this->data);
		}
	}
}