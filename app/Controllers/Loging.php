<?php

namespace App\Controllers;

use App\Models\M_loging;
use CodeIgniter\Controller;

class Loging extends Controller
{
    protected $m_loging;

    public function __construct()
    {
        $this->m_loging = new M_loging();
    }

    public function index()
    {
        if (session()->get('masuk')) {
            // Jika sesi sudah ada, cek peran pengguna dan redirect ke halaman yang sesuai
            $akses = session()->get('akses');
            
            if ($akses == '1') {
                return redirect()->to(base_url('Dashboardg')); // Redirect ke halaman dashboard untuk peran 1
            } elseif ($akses == '2') {
                return redirect()->to(base_url('Dashboard')); // Redirect ke halaman admin untuk peran 2
            }
        }
        return view('v_loging');
    }

    public function cek()
    {
        $username = $this->request->getVar('email');
        $password = $this->request->getVar('password');

        $u = strip_tags(str_replace("'", "", $username));
        $p = strip_tags(str_replace("'", "", $password));

        $cadmin = $this->m_loging->cekadmin($u, $p);

        if ($cadmin) {
            session()->set('masuk', true);
            session()->set('user', $u);
            $session = \Config\Services::session();
            $session->regenerate();
            $userdata = [
                'id_pengguna' => $cadmin->id_pengguna,
                'nama' => $cadmin->nama,
                'email' => $cadmin->email,
                'jabatan'=> $cadmin->jabatan,
            ];
            $session->set($userdata);

            if ($cadmin->id_role == '1') {
                session()->set('akses', '1');
                $idadmin = $cadmin->id_pengguna;
                $user_nama = $cadmin->nama;
                $user_jabatan= $cadmin->jabatan;
                session()->set('idadmin', $idadmin);
                session()->set('namaa', $user_nama);
                session()->set('jabatan', $user_jabatan);
                return redirect()->to(base_url('Dashboardg'));
            } else {
                $error_message = 'Email atau Password Salah. Silakan coba lagi.';
            session()->setFlashdata('error', $error_message);
            return redirect()->to('loging');
            }
        }else {
            $error_message = 'Email atau Password Salah. Silakan coba lagi.';
        session()->setFlashdata('error', $error_message);
        return redirect()->to('loging');

    }
}

    public function logout()
    {
        $session = \Config\Services::session();
        $session->destroy();

        return redirect()->to(base_url('loging'));
    }

}
