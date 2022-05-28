<?php

class User_model
{
    private  $table = 'akun';
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function login()
    {
        if (isset($_POST['username'], $_POST['password'])) {
            $username = Security::xss_input($_POST['username']);
            $password = Security::xss_input($_POST['password']);


            $query = "select * from akun where username =:username ";
            $this->db->query($query);
            $this->db->bind("username", $username);
            $this->db->execute();

            $result =  $this->db->single();
            if (is_array($result)) {

                $pass = Security::pass_verify($password, $result['password']);
                if ($pass == 1) return $this->db->resultSet();
                else return false;
            } else return false;
        } else return false;
    }
    public function set_session(array $data)
    {
        $query = "update akun set
        session = :session
        where id = :id
    ";

        $this->db->query($query);
        $this->db->bind('id', $data['id']);
        $this->db->bind('session', $data['session']);
        $this->db->execute();
        // return $this->db->rowCount();
    }

    public function delete_session(array $data)
    {

        $query = "update akun set
            session = ''
            where session = :id and nama = :nama
        ";

        $this->db->query($query);
        $this->db->bind('id', $data['id']);
        $this->db->bind('nama', $data['nama']);
        $this->db->execute();
        return $this->db->rowCount();
    }
    public function data($data)
    {
        $query = "INSERT INTO akun values('','',:username,:password, '','')";
        $this->db->query($query);
        $this->db->bind('username', $data['username']);
        $this->db->bind('password', Security::pass_hash($data['password']));
        $this->db->execute();
        return $this->db->rowCount();
    }


    public function getAllSantri()
    {

        $this->db->query('SELECT * FROM ' . $this->table);
        // var_dump($this->db->resultSet()) or die;
        return $this->db->resultSet();
    }

    public function getSantriById($id)
    {
        $this->db->query('SELECT * FROM ' . $this->table . " where id=:id");
        $this->db->bind('id', $id);
        return $this->db->single();
    }
    public function tambah($data)
    {
        $query = "INSERT INTO akun values('','',:username,:password, '','')";
        $this->db->query($query);
        $this->db->bind('username', $data['username']);
        $this->db->bind('password', Security::pass_hash($data['password']));
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function hapus($id)
    {
        $query = "DELETE from akun where id = :id";
        $this->db->query($query);
        $this->db->bind('id', $id);
        $this->db->execute();
        return $this->db->rowCount();
    }
    public function ubah($data)
    {
        $query = "update akun set
            username = :username,
            level = :level
            where id = :id
        ";

        $this->db->query($query);
        $this->db->bind('id', $data['id']);
        $this->db->bind('username', $data['username']);
        $this->db->bind('level', $data['level']);
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function cari()
    {
        $keyword = $_POST['keyword'];
        $query = "select * from akun where username like :keyword";
        $this->db->query($query);
        $this->db->bind("keyword", "%$keyword%");
        return $this->db->resultSet();
    }
}
