<?php

namespace App\Controllers;

use App\Models\M_register;


class Register extends BaseController
{
    public function index()
    {
        // Tampilkan formulir registrasi
        return view('v_register');
    }

    public function process()
{
    // Ambil objek validasi dari Dependency Injection pada controller
    $validation = \Config\Services::validation();

    // Validasi formulir registrasi
    $validationRules = [
        'email' => [
            'rules' => 'required|valid_email|is_unique[pengguna.email]',
            'errors' => [
                'is_unique' => 'Email telah terdaftar, silakan gunakan email lain.',
            ],
        ]
    ];

    if (!$this->validate($validationRules)) {
        // Ambil pesan kesalahan validasi
        $validationErrors = $validation->getErrors();

        // Tambahkan pesan kesalahan ke sesi
        session()->setFlashdata('validation_errors', $validationErrors);

        return redirect()->to('/register')->withInput();
    }
        // Simpan data sementara di sesi
        $userData = [
            'email' => $this->request->getVar('email'),
            'nisn'  => $this->request->getVar('nisn'),
            'password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
            'nama' => $this->request->getVar('nama'),
            'id_role' => 2,

        ];

        // Simpan data sementara di sesi
        session()->set('pending_user_data', $userData);

        // Kirim email OTP
        $otpCode = $this->generateOTP();
        $this->sendOTP($userData['email'], $otpCode);

        // Simpan OTP ke dalam sesi
        session()->set('otp_code', $otpCode);

        // Redirect ke halaman verifikasi
        return redirect()->to('/register/verify');
    }

    public function verify()
    {
        // Tampilkan halaman verifikasi OTP
        return view('v_registerotp');
    }

    public function verifyProcess()
{
     // Ambil objek validasi dari Dependency Injection pada controller
    $validation = \Config\Services::validation();

    // Validasi OTP
    $validationRules = [
        'otp' => [
            'rules' => 'required|exact_length[6]|numeric',
            'errors' => [
                'exact_length' => 'Kode OTP harus terdiri dari 6 karakter.',
            ],
        ],
    ];
    
    $validation->setRules($validationRules);

    if (!$this->validate($validationRules)) {
        // Ambil pesan kesalahan validasi
        $validationErrors = $validation->getErrors();

        return redirect()->to('/register/verify')->withInput()->with('validation', $validationErrors);
    }

    // Ambil data sementara dari sesi
    $userData = session()->get('pending_user_data');
    $otpCode = session()->get('otp_code');

    // Verifikasi OTP
    if ($this->request->getPost('otp') != $otpCode) {
        return redirect()->to('/register/verify')->with('error', 'OTP tidak valid.')->withInput();
    }

    // Simpan data pengguna ke dalam database
    $userModel = new M_register();
    $userModel->insert($userData);
    
    // Bersihkan data sementara dari sesi
    session()->remove(['pending_user_data', 'otp_code']);

    // Redirect ke halaman login atau halaman lain yang sesuai
    return redirect()->to('logins')->with('success', 'Registrasi berhasil! Silakan masuk.');


}


    private function generateOTP()
    {
        
        return rand(100000, 999999);
    }

    private function sendOTP($email, $otpCode)
    {
        // Kirim email OTP (gunakan library Email CodeIgniter)
        $emailService = service('email');

        $emailService->setTo($email);
        $emailService->setFrom('emirssyah2@gmail.com', 'No Reply');
        $emailService->setSubject('Register Code OTP');
        $emailService->setMessage('Kode OTP anda adalah : ' . $otpCode);

        $emailService->send();
    }
}
