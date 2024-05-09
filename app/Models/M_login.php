<?php

namespace App\Models;

use CodeIgniter\Model;

class M_login extends Model
{
    protected $table = 'pengguna';
    protected $primaryKey = 'id_pengguna';

    protected $allowedFields = ['email','code','password','nama','id_role','nisn','kelas'];

    public function cekadmin($u, $p)
    {
        $query = $this->db->table($this->table)
            ->select('pengguna.*, siswa.kelas') // Memilih kolom yang dibutuhkan
            ->join('siswa', 'pengguna.nisn = siswa.nisn') // Melakukan join dengan tabel siswa berdasarkan nisn
            ->where('email', $u)
            ->get()
            ->getRow();

        if ($query && password_verify($p, $query->password)) {
            return $query;
        }

        return null;
    }
}
