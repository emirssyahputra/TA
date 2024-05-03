<?php
namespace App\Controllers;

use CodeIgniter\Controller;

class Verif extends BaseController
{
    public function index()
    {
        return view('v_verif');
    }
    public function resetOtp()
    {
        $session = session();
        $model = new \App\Models\M_otp();
        $request = service('request');


        if ($request->getMethod() === 'post') {
            $session->remove('info');

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

                return redirect()->to('/Verif')->withInput()->with('validation', $validationErrors);
            }
            $otp_code = $request->getPost('otp');
            $user = $model->getUserByOTP($otp_code);

            if ($user) {
                $email = $user['email'];
                $session->set('email', $email);
                return redirect()->to('Passwordbaru')->with('email', $email);
            } else {
                $data['errors']['otp-error'] = "Anda memasukkan OTP yang salah!";

            }
        }
        return view('v_verif', $data);

    }
}
