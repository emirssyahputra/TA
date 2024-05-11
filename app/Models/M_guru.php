<?php namespace App\Models;

use CodeIgniter\Model;

class M_guru extends Model
{
    protected $table = 'guru'; 
    protected $primaryKey = 'id_pengguna'; 
    protected $allowedFields = ['email', 'nama','password', 'id_role','nuptk','jabatan'];

    public function hapusPengguna($id)
    {
        return $this->delete($id);
    }
    public function getall()
    {
        return $this->findAll(); // Mengambil semua data guru dari tabel
    }
}
