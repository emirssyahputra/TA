<?php

namespace App\Models;

use CodeIgniter\Model;

class M_login extends Model
{
    protected $table = 'pengguna';

    public function cekadmin($u, $p)
    {
        $query = $this->db->table($this->table)
            ->where('email', $u)
            ->get()
            ->getRow();

        if ($query && password_verify($p, $query->password)) {
            return $query;
        }

        return null;
    }
}
