<?php

namespace App\Models;

use CodeIgniter\Model;

class M_Register extends Model
{
    protected $table = 'pengguna';
    protected $primaryKey = 'id_pengguna';
    protected $useAutoIncrement = true;
    protected $allowedFields = ['email', 'password', 'nama','nisn', 'id_role'];
}
