<?php

namespace App\Controllers;

class Dataguru extends BaseController
{
    public function index()
    {
        $sesi_pengguna_id = session()->get('idadmin');
        $akses_pengguna = session()->get('akses');

        if ($sesi_pengguna_id) {
            if ($akses_pengguna == 1) {
                $session = \Config\Services::session();
                $data['nama'] = $session->get('namaa');
                $data['jabatan']= $session->get('jabatan');
                $model = new \App\Models\M_guru();
                $data['guru'] = $model->where('id_role', 1)->findAll();
                return view('v_dataguru', $data);
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
    
        // Logika untuk melakukan pencarian data pengguna berdasarkan keyword dan syarat id_role = 1
        $model = new \App\Models\M_guru();
        $data['guru'] = $model->where('id_role', 1)
        ->groupStart()
            ->like('nama', $keyword)
            ->orLike('email', $keyword)
            ->orLike('jabatan', $keyword)
            ->orLike('nuptk', $keyword)
        ->groupEnd()
        ->findAll();
        $session = \Config\Services::session();
                $data['nama'] = $session->get('namaa');
                $data['jabatan']= $session->get('jabatan');
       
        return view('v_dataguru', $data);
    }
    public function hapus($id)
    {
        $model = new \App\Models\M_guru();
    
        // Ambil ID pengguna dari sesi
        $sesi_pengguna_id = session()->get('idadmin');
    
        // Cek apakah pengguna dengan ID yang diberikan ada
        $pengguna = $model->find($id);
    
        if ($pengguna) {
            // Jika ID pengguna yang dihapus sama dengan ID pengguna yang sedang aktif
            if ($id == $sesi_pengguna_id) {

                $session = \Config\Services::session();
                $session->destroy();
                $model->delete($id);
                // Kembali ke halaman login
                return redirect()->to(site_url('logins'));
            }
    
            // Hapus pengguna dengan ID yang diberikan
            $model->delete($id);
            
            // Redirect kembali ke halaman pengguna setelah penghapusan
            return redirect()->to('/dataguru')->with('success', 'Data Guru Berhasil Di Hapus.');
        } else {
            // Jika pengguna tidak ditemukan, Anda dapat menampilkan pesan kesalahan atau melakukan tindakan lain sesuai kebutuhan.
            return redirect()->to('/dataguru')->with('error', 'Data Guru Gagal Di Hapus.');
        }
    }
}