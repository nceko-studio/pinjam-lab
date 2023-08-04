<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {
	
	public function biodata()
	{
		$data['title'] = "Biodata User";
        $data['prodi'] = $this->MasterModel->getProdi();
        $data['biodata'] = $this->UserModel->getBiodata();
		$this->load->view('template/header', $data);
		$this->load->view('template/sidebar', $data);
		$this->load->view('template/navbar', $data);
		$this->load->view('user/biodata', $data);
		$this->load->view('template/footer', $data);
	}
	
	public function biodata_new()
	{
		$data['title'] = "New Biodata User";
        $data['prodi'] = $this->MasterModel->getProdi();
        $data['biodata'] = $this->UserModel->getBiodata();
		$this->load->view('template/header', $data);
		$this->load->view('template/sidebar', $data);
		$this->load->view('template/navbar', $data);
		$this->load->view('user/biodata_new', $data);
		$this->load->view('template/footer', $data);
	}
	
	public function biodata_edit($id)
	{
		$data['title'] = "Edit Biodata User";
        $data['prodi'] = $this->MasterModel->getProdi();
        $data['biodata'] = $this->UserModel->getBiodataById($id);
		$this->load->view('template/header', $data);
		$this->load->view('template/sidebar', $data);
		$this->load->view('template/navbar', $data);
		$this->load->view('user/biodata_edit', $data);
		$this->load->view('template/footer', $data);
	}

    public function biodata_proses()
	{
        $data = array(
			'no_card'	=>  $this->input->post('rfid'),
			'full_name'	=>  $this->input->post('full_name'),
			'address'	=>  $this->input->post('alamat'),
			'jk'	=>  $this->input->post('jk'),
			'id_prodi'	=>  $this->input->post('id_prodi')
		);

		$tambah = $this->UserModel->newBiodata($data);

		if ($tambah == true) {
			$this->session->set_flashdata('success', '<strong>SUCCESS!!!</strong> Berhasil Menambahakan Biodata Pengguna Baru.');
		} else {
			$this->session->set_flashdata('error', '<strong>ERROR!!!</strong> Gagal Menambahakan Biodata Pengguna Baru.');
		}
		redirect('user/biodata');
	}

    public function biodata_replace()
	{
        $id = $this->input->post('id_biodata');

        $data = array(
			'full_name'	=>  $this->input->post('full_name'),
			'address'	=>  $this->input->post('alamat'),
			'jk'	=>  $this->input->post('jk'),
			'id_prodi'	=>  $this->input->post('id_prodi')
		);

		$tambah = $this->UserModel->editBiodata($data, $id);

		if ($tambah == true) {
			$this->session->set_flashdata('success', '<strong>SUCCESS!!!</strong> Berhasil Memperbaharui Biodata Pengguna.');
		} else {
			$this->session->set_flashdata('error', '<strong>ERROR!!!</strong> Gagal Memperbaharui Biodata Pengguna.');
		}
		redirect('user/biodata');
	}

    public function biodata_hapus($id)
	{
        $hapus = $this->UserModel->deleteBiodata($id);

		if ($hapus == true) {
			$this->session->set_flashdata('success', '<strong>SUCCESS!!!</strong> Berhasil Menghapus Biodata Pengguna.');
		} else {
			$this->session->set_flashdata('error', '<strong>ERROR!!!</strong> Gagal Menghapus Biodata Pengguna.');
		}
		redirect('user/biodata');
	}


    public function akun()
	{
		$data['title'] = "Akun User";
        $data['akun'] = $this->UserModel->getAkun();
        $data['biodata'] = $this->UserModel->getBiodata();
		$this->load->view('template/header', $data);
		$this->load->view('template/sidebar', $data);
		$this->load->view('template/navbar', $data);
		$this->load->view('user/akun', $data);
		$this->load->view('template/footer', $data);
	}

    public function akun_new()
	{
		$id = $this->db->select('id_biodata')->from('tbl_biodata')->where('no_card',$this->input->post('id_biodata'))->get()->row();
        $data = array(
			'username'	=>  $this->input->post('username'),
			'password'	=>  MD5($this->input->post('password')),
			'id_biodata'	=>  $id->id_biodata,
			'role'	=>  $this->input->post('role')
		);

		$tambah = $this->UserModel->newAkun($data);

		if ($tambah == true) {
			$this->session->set_flashdata('success', '<strong>SUCCESS!!!</strong> Berhasil Menambahakan Akun Pengguna Baru.');
		} else {
			$this->session->set_flashdata('error', '<strong>ERROR!!!</strong> Gagal Menambahakan Akun Pengguna Baru.');
		}
		redirect('user/akun');
	}

    public function akun_reset_pass($id)
	{
        $hapus = $this->UserModel->resetAkun($id);

		if ($hapus == true) {
			$this->session->set_flashdata('success', '<strong>SUCCESS!!!</strong> Berhasil Mereset Password menjadi "Pengguna01".');
		} else {
			$this->session->set_flashdata('error', '<strong>ERROR!!!</strong> Gagal Mereset Password menjadi "Pengguna01".');
		}
		redirect('user/akun');
	}

    public function akun_hapus($id)
	{
        $hapus = $this->UserModel->deleteAkun($id);

		if ($hapus == true) {
			$this->session->set_flashdata('success', '<strong>SUCCESS!!!</strong> Berhasil Menghapus Akun User.');
		} else {
			$this->session->set_flashdata('error', '<strong>ERROR!!!</strong> Gagal Menghapus Akun User.');
		}
		redirect('user/akun');
	}
}
