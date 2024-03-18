<?php

namespace App\Models;

use CodeIgniter\Model;
use App\Models\Role;

class AkunPengguna extends Model
{
    private String $username, $password;
    private Role $role;
    public function __construct()
    {
        parent::__construct();
        $this->role = new Role;
    }

    public function set_username($username)
    {
        $this->username = $username;
    }
    public function get_username()
    {
        return $this->username;
    }
    public function set_password($password)
    {
        $this->password = $password;
    }
    public function get_password()
    {
        return $this->password;
    }
    public function set_role()
    {
        $this->nilai_role = $this->role->get_nama_role();
    }

    public function cekLogin($username, $password)
    {
        return $this->db->table('akun_pengguna')
            ->where([
                'username' => $username,
                'password' => $password
            ])->get()->getRowArray();
    }

    public function getUsername($uname)
    {
        return $this->db->table('akun_pengguna')
            ->select('username')
            ->where('username', $uname)
            ->get()->getResultArray();
    }
    public function regisVolunteer()
    {
        $data =
            [
                'username' => $this->username,
                'password' => $this->password,
                'role' => "1"
            ];
        $this->db->table('akun_pengguna')
            ->insert($data);
    }
    public function regisAnggota()
    {
        $data =
            [
                'username' => $this->username,
                'password' => $this->password,
                'role' => "2"
            ];
        $this->db->table('akun_pengguna')
            ->insert($data);
    }
    public function ubahPass($session)
    {
        $data = [
            'password' => $this->password,
        ];
        $update = $this->db->table('akun_pengguna')->where('username', $session)->update($data);
        if ($update) {
            return true;
        } else {
            return false;
        }
    }
}
