<?php

namespace App\Controllers;

use App\Models\M_login;
use CodeIgniter\Controller;

class Logins extends Controller
{
    protected $m_login;

    public function __construct()
    {
        $this->m_login = new M_login();
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
        return view('v_logins');
    }

    public function cek()
    {
        $username = $this->request->getVar('email');
        $password = $this->request->getVar('password');

        $u = strip_tags(str_replace("'", "", $username));
        $p = strip_tags(str_replace("'", "", $password));

        $cadmin = $this->m_login->cekadmin($u, $p);

        if ($cadmin) {
            session()->set('masuk', true);
            session()->set('user', $u);
            $session = \Config\Services::session();
            $session->regenerate();
            $userdata = [
                'id_pengguna' => $cadmin->id_pengguna,
                'nama' => $cadmin->nama,
                'email' => $cadmin->email,
                'kelas' => $cadmin->kelas,
            ];
            $session->set($userdata);

            if ($cadmin->id_role == '2') {
                session()->set('akses', '2');
                $idadmin = $cadmin->id_pengguna;
                $user_nama = $cadmin->nama;
                $user_kelas = $cadmin->kelas;
                session()->set('idadmin', $idadmin);
                session()->set('namaa', $user_nama);
                session()->set('kelas', $user_kelas);
                return redirect()->to(base_url('Dashboard'));
            } else {
                $error_message = 'Email atau Password Salah. Silakan coba lagi.';
                session()->setFlashdata('error', $error_message);
                return redirect()->to('Logins');
            }
        }else {
            $error_message = 'Email atau Password Salah. Silakan coba lagi.';
            session()->setFlashdata('error', $error_message);
            return redirect()->to('Logins');

    }
}

    public function logout()
    {
        $session = \Config\Services::session();
        $session->destroy();

        return redirect()->to(base_url('Home'));
    }

}
