<?php

namespace App\Models;

use CodeIgniter\Model;

class MemberModel extends Model
{
    protected $table = 'member';
    protected $primaryKey = 'member_id';
    protected $allowedFields = [
        'username',
        'no_hp',
        'email',
        'password',
        'nama_lengkap',
        'nim_nis',
        'jenis_kelamin',
        'foto',
        'instansi_pendidikan',
        'nama_instansi',
        'level',
        'is_verifikasi',
        'token'
    ];


    /** untuk ambil data */
    // public function getData($parameter)
    // {
    //     $builder = $this->table($this->table);
    //     $builder->where('username', $parameter);
    //     $builder->orWhere('email', $parameter);
    //     $query = $builder->get();
    //     return $query->getRowArray();
    // }

    // public function getMember($table, $data, $where)
    // {
    //     $this->db->table($table)->update($data, $where);
    //     return true;
    // }

    // /** untuk update /simpan data */
    public function updateData($data)
    {
        $builder = $this->table($this->table);
        if ($builder->save($data)) {
            return true;
        } else {
            return false;
        }
    }
}