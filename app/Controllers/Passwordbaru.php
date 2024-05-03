<?php

namespace App\Controllers;

use App\Models\M_otp;

class passwordbaru extends BaseController
{
    public function index()
    {
        return view('v_passwordbaru');
    }
    public function changePassword()
    {
        $session = session();
        $request = service('request');
        $data = []; // Initialize the $data array


        if ($request->getMethod(true) === 'POST' ) {
            $session->remove('info');
            $userModel = new M_otp();
            
            $email = $request->getPost('email');
            $password = $request->getPost('password');

            $newPassword = password_hash($password, PASSWORD_DEFAULT);

            if ($userModel->updateUserPassword($email, $newPassword)) {
                return redirect()->to('Logins')->with('success', 'Password Berhasil Direset, silahkan masuk');;
            } else {
                $data['errors']['db-error'] = "Gagal mengganti password!";
            }

        }

        return view('v_passwordbaru', $data);
    }
}
