<?php

namespace App\Models;

use CodeIgniter\Model;

class M_loging extends Model
{
    protected $table = 'guru';

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
