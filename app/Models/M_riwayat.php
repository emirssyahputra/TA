<?php

namespace App\Models;

use CodeIgniter\Model;

class M_riwayat extends Model
{
    protected $table      = 'riwayat';
    protected $primaryKey = 'id_riwayat';
    protected $useAutoIncrement = true;
    protected $allowedFields = ['nisn', 'pelanggaran', 'tanggal', 'poin'];

    public function getRiwayatPelanggaranByNISN($nisn)
    {
        // Query untuk mendapatkan riwayat pelanggaran berdasarkan NISN
        return $this->where('nisn', $nisn)->findAll();
    }
    public function delete($id = null, bool $purge = false): bool
{
    // Get the data of the riwayat pelanggaran to be deleted
    $riwayatPelanggaran = $this->find($id);

    // If the riwayat pelanggaran is found
    if ($riwayatPelanggaran) {
        // Get the NISN of the student associated with this riwayat pelanggaran
        $nisn = $riwayatPelanggaran['nisn'];

        // Get the poin to be subtracted
        $poin = $riwayatPelanggaran['poin'];

        // Delete the riwayat pelanggaran
        $result = parent::delete($id, $purge);

        // If the deletion is successful
        if ($result) {
            // Update the poin of the student by subtracting the poin of the deleted riwayat pelanggaran
            $siswaModel = new M_siswa();
            $siswaModel->updatePoinByNISN($nisn, -$poin);
        }

        return $result;
    }

    return false;
}

}
