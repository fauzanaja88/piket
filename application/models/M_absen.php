<?php
class M_absen extends CI_Model
{

	function __construct()
	{
		parent::__construct();
	}

	function login($postData)
	{
		$data = $this->db->query("
				select * from pimpinan where username = '" . $postData['user'] . "' 
				AND password = '" . base64_encode(md5($postData['pass'])) . "'
			")->row();
			
		

		return $data;
	}
	function list_anggota()
	{
		$data = $this->db->query("
				SELECT * FROM anggota
			")->result();

		return $data;
	}
	function list_jadwal()
	{
		$data = $this->db->query("
				SELECT * FROM ms_jadwal
			")->result();

		return $data;
	}
	function get_jadwal($params)
	{
		$data = $this->db->query("
				SELECT * FROM ms_jadwal where tanggal ='".$params."'
			")->row();
		return $data;
	}
	
	function get_sum($posData)
	{
		$data = $this->db->query("
				SELECT STATUS,COUNT(STATUS) AS jml_status
				FROM tr_piket 
				where tgl_absensi = '".$posData."'
				GROUP BY STATUS
			")->result();
		return $data;
	}
	function get_detail($tanggal, $status)
	{
		$data = $this->db->query("
				SELECT a.`id_anggota`,b.`nama`,b.`jabatan`,b.`group_piket`,a.`keterangan`
				FROM tr_piket a
				INNER JOIN anggota b ON b.`id_anggota` = a.`id_anggota`
				WHERE a.tgl_absensi = '".$tanggal."' AND STATUS = '".$status."'
				GROUP BY a.`id_anggota`,b.`nama`,b.`jabatan`,b.`group_piket`
			")->result();
		return $data;
	}
	
	function insert($data)
	{
		return $this->db->insert_batch('tr_piket', $data);
	}

	function insert_hist($data)
	{

		$this->db->insert('tb_approval_lembur_hist', $data);
		return $this->db->insert_id();
	}

	
	function delete($data)
	{
		$this->db->where('id_lembur', $data['id_lembur'])
			->delete('tb_approval_lembur', $data);
	}


}
