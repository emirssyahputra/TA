<?php

namespace App\Controllers;
use App\Models\M_siswa;

class Datalanggarsiswa extends BaseController
{
    public function index()
    {
        $sesi_pengguna_id = session()->get('idadmin');
        $akses_pengguna = session()->get('akses');

        if ($sesi_pengguna_id) {
            if ($akses_pengguna == 1) {
                $session = \Config\Services::session();
                $data['nama'] = $session->get('namaa');
                $data['jabatan'] = $session->get('jabatan');
                return view('v_datalanggarsiswa', $data);
            } else {
                session()->destroy();
                return redirect()->to(site_url('logins'));
            }
        } else {
            return redirect()->to(site_url('logins'));
        }
    }
    public function search()
    {
        $keyword = $this->request->getPost('search'); // Ambil keyword pencarian dari form
    
        // Inisialisasi model Siswa
        $siswaModel = new M_siswa();
        // Ambil kelas dari sesi
        $session = \Config\Services::session();
        $kelas = $session->get('kelas');
    
        // Lakukan pencarian siswa berdasarkan nama
        $siswa = $siswaModel->where('kelas', $kelas)->like('nama', $keyword)->findAll();
    
        // Kirim data siswa ke view
        $data['siswa'] = $siswa;
        $session = \Config\Services::session();
        $data['nama'] = $session->get('namaa');
        $data['jabatan'] = $session->get('jabatan');
    
        return view('v_datalanggarsiswa', $data);
    }
        public function tampilkanDataSiswa($kelas)
        {
            $session = \Config\Services::session();
            $data['nama'] = $session->get('namaa');
            $data['jabatan'] = $session->get('jabatan');
            $session->set('kelas', $kelas);
            // Inisialisasi model Siswa
            $siswaModel = new M_siswa();
    
            // Ambil data siswa berdasarkan kelas yang dipilih
            $siswa = $siswaModel->where('kelas', $kelas)->findAll();
    
            // Kirim data siswa ke view
            $data['siswa'] = $siswa;
    
            // Load view dan kirim data ke view
            return view('v_datalanggarsiswa', $data);
        }
}