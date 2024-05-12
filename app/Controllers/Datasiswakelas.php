<?php

namespace App\Controllers;

use App\Models\M_siswa;

class Datasiswakelas extends BaseController
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
                // Inisialisasi model Siswa
                $siswaModel = new M_siswa();

                // Ambil semua kelas yang berbeda dari tabel siswa
                $kelas = $siswaModel->distinct()->select('kelas')->findAll();

                // Inisialisasi array untuk menyimpan kelas dan wali kelas
                $kelasWali = [];

                // Loop melalui setiap kelas
                foreach ($kelas as $k) {
                    // Ambil wali kelas dari kelas tertentu
                    $waliKelas = $siswaModel->where('kelas', $k['kelas'])->select('wali')->first();

                    // Simpan kelas dan wali kelas ke dalam array
                    $kelasWali[] = [
                        'kelas' => $k['kelas'],
                        'wali_kelas' => $waliKelas['wali']
                    ];
                }

                // Kirim data kelas dan wali kelas ke view
                $data['kelasWali'] = $kelasWali;

                // Load view dan kirim data ke view
                return view('v_datasiswakelas', $data);
            } else {
                session()->destroy();
                return redirect()->to(site_url('logins'));
            }
        } else {
            return redirect()->to(site_url('logins'));
        }
    }
    public function search(){
        $keyword = $this->request->getPost('search'); // Ambil keyword pencarian dari form
        
        // Inisialisasi model Siswa
        $siswaModel = new M_siswa();
    
        // Lakukan pencarian kelas berdasarkan keyword
        $kelas = $siswaModel->like('kelas', $keyword)->distinct()->select('kelas')->findAll();
    
        // Inisialisasi array untuk menyimpan kelas dan wali kelas
        $kelasWali = [];
    
        // Loop melalui setiap kelas yang ditemukan
        foreach ($kelas as $k) {
            // Ambil wali kelas dari kelas tertentu
            $waliKelas = $siswaModel->where('kelas', $k['kelas'])->select('wali')->first();
    
            // Simpan kelas dan wali kelas ke dalam array
            $kelasWali[] = [
                'kelas' => $k['kelas'],
                'wali_kelas' => $waliKelas['wali']
            ];
        }
    
        // Kirim data kelas yang sesuai dengan pencarian dan wali kelas ke view
        $data['kelasWali'] = $kelasWali;
        $session = \Config\Services::session();
        $data['nama'] = $session->get('namaa');
        $data['jabatan'] = $session->get('jabatan');
       
        return view('v_datasiswakelas', $data);
    }
    
    
}