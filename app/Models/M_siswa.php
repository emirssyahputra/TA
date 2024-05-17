<?php

namespace App\Models;

use CodeIgniter\Model;

class M_siswa extends Model
{
    protected $table = 'siswa';
    protected $primaryKey = 'id_siswa';
    protected $useAutoIncrement = true;
    protected $allowedFields = ['email', 'password', 'nama','nisn','kelas','no_ortu','jenkel','poin','wali'];

    public function searchData($keyword)
    {
        // Lakukan query untuk melakukan pencarian
        // Misalnya, mencari data berdasarkan nama kelas
        $builder = $this->db->table($this->table);
        $builder->like('kelas', $keyword);
        $query = $builder->get();

        // Mengembalikan hasil pencarian dalam bentuk array
        return $query->getResultArray();
    }
    public function updatePoinByNISN($nisn, $poin)
    {
        // Ambil poin sebelumnya dari tabel siswa
        $siswa = $this->where('nisn', $nisn)->first();

        // Hitung poin baru dengan menambahkan poin yang baru
        $poin_baru = $siswa['poin'] + $poin;

        // Update poin siswa
        $this->set('poin', $poin_baru)
            ->where('nisn', $nisn)
            ->update();
    }
    public function hapusRiwayatById($id_riwayat)
    {
        return $this->delete($id_riwayat);
    }
    public function getTotalPoinByNISN($nisn)
    {
        // Ambil data siswa berdasarkan NISN
        $siswa = $this->where('nisn', $nisn)->first();

        // Jika siswa dengan NISN yang diberikan ditemukan
        if ($siswa) {
            // Kembalikan total poin siswa
            return $siswa['poin'];
        }

        // Jika siswa tidak ditemukan, kembalikan 0 atau nilai default yang sesuai
        return 0;
    }
}
