<?php

namespace App\Controllers;

use App\Models\M_siswa;

class Datasiswag extends BaseController
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
                return view('v_datasiswag', $data);
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

    return view('v_datasiswag', $data);
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
        return view('v_datasiswag', $data);
    }
    public function hapus($id)
    {
        $model = new M_siswa();


        // Cek apakah pengguna dengan ID yang diberikan ada
        $pengguna = $model->find($id);

        if ($pengguna) {
            // Jika ID pengguna yang dihapus sama dengan ID pengguna yang sedang akti

            // Hapus pengguna dengan ID yang diberikan
            $model->delete($id);

            // Redirect kembali ke halaman pengguna setelah penghapusan
            return redirect()->to('/datasiswakelas')->with('success', 'Data Siswa Berhasil Di Hapus.');
        } else {
            // Jika pengguna tidak ditemukan, Anda dapat menampilkan pesan kesalahan atau melakukan tindakan lain sesuai kebutuhan.
            return redirect()->to('/datasiswakelas')->with('error', 'Data Siswa Gagal Di Hapus.');
        }
    }
}