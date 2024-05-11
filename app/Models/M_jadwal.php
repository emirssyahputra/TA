<?php

namespace App\Models;

use CodeIgniter\Model;

class M_jadwal extends Model
{
    protected $table = 'jadwal';
    protected $primaryKey = 'id_jadwal';
    protected $useAutoIncrement = true;
    protected $allowedFields = ['id_jadwal', 'nama', 'nisn','kelas', 'guru','waktu','status'];

    public function editStatus($id_jadwal, $status)
    {
        $data = [
            'status' => $status
        ];

        // Ubah status dalam database
        $this->set($data)
             ->where('id_jadwal', $id_jadwal)
             ->update();

        return $this->affectedRows(); // Mengembalikan jumlah baris yang terpengaruh oleh operasi UPDATE
    }
}
