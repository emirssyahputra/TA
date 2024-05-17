<?php

namespace App\Controllers;
use App\Models\M_siswa;
use CodeIgniter\Validation\Exceptions\ValidationException;
class Tambahsiswa extends BaseController
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
                return view('v_tambahsiswa', $data);
            } else {
                session()->destroy();
                return redirect()->to(site_url('logins'));
            }
        } else {
            return redirect()->to(site_url('logins'));
        }
    }
    public function simpan()
    {
        // Memastikan request adalah POST
        if ($this->request->getMethod() === 'post') {
            // Validasi input (bisa disesuaikan dengan kebutuhan)
            $validation =  \Config\Services::validation();
            $validation->setRules([
                'nama' => 'required',
                'kelas' => 'required',
                'nisn' => 'required',
                'jenkel' => 'required',
                'ortu' => 'required',
                'wali' => 'required'
            ]);

            if (!$validation->withRequest($this->request)->run()) {
                // Jika validasi gagal, kembali ke halaman sebelumnya dengan pesan error
                return redirect()->back()->withInput()->with('errors', $validation->getErrors());
            }

            // Jika validasi sukses, ambil data dari request
            $nama = $this->request->getPost('nama');
            $kelas = $this->request->getPost('kelas');
            $nisn = $this->request->getPost('nisn');
            $jenkel = $this->request->getPost('jenkel');
            $ortu = $this->request->getPost('ortu');
            $wali = $this->request->getPost('wali');

            // Buat array untuk data siswa
            $data = [
                'nama' => $nama,
                'kelas' => $kelas,
                'nisn' => $nisn,
                'jenkel' => $jenkel,
                'no_ortu' => $ortu,
                'wali' => $wali,
            ];

            // Inisialisasi model Siswa
            $siswaModel = new M_siswa();

            // Masukkan data siswa ke dalam tabel siswa
            $siswaModel->save($data);

            // Redirect ke halaman yang sesuai atau tampilkan pesan sukses
            return redirect()->to('datasiswakelas')->with('success', 'Data Siswa Berhasil Ditambah');
        } else {
            // Jika bukan request POST, redirect ke halaman yang sesuai atau tampilkan pesan error
            return redirect()->to('datasiswakelas')->with('error', 'Data Siswa Gagal Ditambah');
        }
    }
}