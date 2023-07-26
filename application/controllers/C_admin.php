<?php

class C_admin extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();

		$this->load->model(array('M_absen'));
		$this->load->library('form_validation');
	}

	public function index()
	{
		/* echo "here";
		die; */
		$tgl = '2023-07-25';
		if (!empty($this->input->post('user')) && !empty($this->input->post('pass'))) {

			
			$hasil	= $this->M_absen->login($this->input->post());

			if ($hasil == TRUE) {
				$userdata = array(
					'id_pimpinan'  => $hasil->id_pimpinan,
					'username'    => $hasil->username,
					'full_name'   => ucfirst($hasil->full_name),
					'jabatan'   => $hasil->jabatan,
				);
				$this->session->set_userdata($userdata);

				header('Location: ' . base_url() . 'dash-home');
			} else {
				$this->session->set_flashdata('message', 'Anda tidak memiliki akses!');
				$data = array(
					'page' => 'page/login',

				);

				$this->load->view('container.html', $data);
			}
		} else {

			$data = array(
				'page' => 'page/login',

			);

			$this->load->view('container.html', $data);
		}
	}

	public function dash_home()
	{

		$tgl = '2023-07-25';

		if (!empty($this->session->userdata('id_pimpinan'))) {
			$data = array(
				'page' => 'page/dash_home',
				'tgl' => $tgl,

			);

			$this->load->view('container.html', $data);
		} else {
			$data = array(
				'page' => 'page/login',

			);

			$this->load->view('container.html', $data);
		}
	}

	public function input_piket()
	{
		$tgl = '2023-07-25';
		$list_anggota = $this->M_absen->list_anggota();
		$list_jadwal = $this->M_absen->list_jadwal();
		$get_jadwal = $this->M_absen->get_jadwal($tgl);
		
		if (!empty($this->session->userdata('id_pimpinan'))) {

			$data = array(
				'page' => 'page/input_piket',
				'list_anggota' => $list_anggota,
				'list_jadwal' => $list_jadwal,
				'tgl' => $tgl,
				'get_jadwal' => $get_jadwal,
			);
			$this->load->view('container.html', $data);
		} else {
			$data = array(
				'page' => 'page/login',

			);

			$this->load->view('container.html', $data);
		}
	}


	public function simpan_piket()
	{
		
		$id_anggota = $_POST['id_anggota']; 
		$nama = $_POST['nama']; 
		$jabatan = $_POST['jabatan']; 
		$status = $_POST['status']; 
		$keterangan = $_POST['keterangan'];
		$data = array();
		$tgl = '2023-07-26';
		
		$index = 0; 
		foreach($id_anggota as $dataid_anggota){ 
			array_push($data, array(
				'id_pimpinan'=>$this->session->userdata('id_pimpinan'), 
				'tgl_absensi'=>$tgl, 
				'tgl_ins'=>date('Y-m-d'), 
				'id_anggota'=>$dataid_anggota, 
				'status'=>$status[$index],  
				'keterangan'=>$keterangan[$index], 
			));
			
			$index++;
		}
		
		$sql = $this->M_absen->insert($data); 
		if($sql) {
			header('Location: ' . base_url() . 'input-piket');
			$this->session->set_flashdata('message', 'Data Absensi Piket Berhasil Disimpan!');
		} else {
			header('Location: ' . base_url() . 'input-piket');
			$this->session->set_flashdata('message', 'Data Absensi Piket Gagal Disimpan!');
		} 		
	}
	
	public function fetch()
    {
		$connect = mysqli_connect("localhost", "root", "", "absensi");
		if(isset($_POST["nama"]))
		{
			$nama = $_POST["nama"];
			$jabatan = $_POST["jabatan"];
			$status = $_POST["status"];
			$keterangan = $_POST["keterangan"];
			$query = '';
			for($count = 0; $count<count($nama); $count++){
				$nama_clean = mysqli_real_escape_string($connect, $nama[$count]);
				$jabatan_clean = mysqli_real_escape_string($connect, $jabatan[$count]);
				$status_clean = mysqli_real_escape_string($connect, $status[$count]);
				$keterangan_clean = mysqli_real_escape_string($connect, $keterangan[$count]);
				if($name_clean != '' && $email_clean != '' && $mobile_clean != '' && $message_clean != ''){
					$query .= 'INSERT INTO tr_piket(nama, jabatan, status, keterangan) 
					VALUES("'.$nama_clean.'", "'.$jabatan_clean.'", "'.$status_clean.'", "'.$keterangan_clean.'");';
				}
			}
			if($query != ''){
				if(mysqli_multi_query($connect, $query)){
					echo 'Users Data Inserted successfully';
				}else{
					echo 'Error';
				}
			}else{
				echo 'All Fields are Required';
			}
		}
		
	}
	
	public function logout()
	{
		$this->session->unset_userdata('id_pimpinan');

		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">You have been logged out!</div>');
		$data = array(
			'page' => 'page/login',

		);

		$this->load->view('container.html', $data);
	}

	public function rekapitulasi()
	{
		$list_jadwal = $this->M_absen->list_jadwal();
		$data = array(
			'page' => 'page/rekapitulasi',
			'list_jadwal' => $list_jadwal,
		);

		$this->load->view('container.html', $data);
	}
	
	public function ajax_get()
    {
		$data = $this->M_absen->get_sum($this->input->post('tanggal'));
	   
		echo json_encode($data);
    }
	
	public function ajax_get_detail()
    {
		$data = $this->M_absen->get_detail($this->input->post('tanggal'), $this->input->post('status'));
	   
		echo json_encode($data);
    }
	
	public function view_rekap()
	{
		$list_jadwal = $this->M_absen->list_jadwal();
		
		$data = array(
			'page' => 'page/rekapitulasi',
			'list_jadwal' => $list_jadwal,
		);

		$this->load->view('container.html', $data);
	}
	

}
