<?php
class Pinjam_m extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}

	function insert($data)
	{
		$query = $this->db->insert('mst_pinjam', $data);
		return $query;		
	}
	
	function jml_Pinjam()
	{
		return $this->db->count_all('mst_pinjam');
	}
	// ---
	
	function get_records($criteria='', $order='',$limit='', $offset=0)
	{
		$this->db->select('a.ID_Pinjam, a.ID_Anggota, b.Nama, a.ID_Buku, c.Judul, a.tgl_pinjam, a.tgl_kembali');
		$this->db->from('mst_pinjam as a');
		$this->db->join('anggota as b','a.ID_Anggota=b.ID_Anggota');
		$this->db->join('buku as c','a.ID_Buku=c.ID_Buku');
		if($criteria != '')
			$this->db->where($criteria);
		if($order != '')
			$this->db->order_by($order);
		if($limit != '')
			$this->db->limit($limit, $offset);
		$query=$this->db->get();
		return $query;
	}
	
	function update_by_id($data, $id)
	{
		$this->db->where("ID_Pinjam = '$id'");
		$query = $this->db->update('mst_pinjam', $data);
		return $query;
	}
	
	function delete_by_id($data, $id)
	{
		$query = $this->db->delete($data,"ID_Pinjam = '$id'");
		return $query;
	}
}
?>
