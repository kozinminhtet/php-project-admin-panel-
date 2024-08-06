<?php

namespace Libs\Database;

use PDOException;

class UsersTable
{
    private $db;

    public function __construct(MySQL $mysql)
    {
        $this->db = $mysql->connect();
    }

    //for admin
    public function all()
    {
        $statement = $this->db->query("SELECT users.*, roles.name AS role
            FROM users LEFT JOIN roles ON users.role_id = roles.id");
        return $statement->fetchAll();
    }

    public function find($email, $password)
    {
        try {
            //for injection ==> use prepare();
            $statement = $this->db->prepare("SELECT * FROM users WHERE email=:email");
            $statement->execute(['email' => $email]);
            $user = $statement->fetch();

            //to verify password ===> password_verify()
            if($user){
                if(password_verify($password, $user->password)){
                    return $user;
                }
            }

            return false;
        } catch (PDOException $e) {
            echo $e->getMessage();
            exit();
        }
    }

    public function insert($data)
    {
        try {
            $statement  = $this->db->prepare(
                "INSERT INTO users (name, email, phone, address, password, created_at) 
                VALUES (:name, :email, :phone, :address, :password, NOW())"
            );

            //to secure password ===> password_hash(), PASSWORD_DEFAULT
            $data['password'] = password_hash($data['password'], PASSWORD_BCRYPT);

            $statement->execute($data);
            return $this->db->lastInsertId();
        } catch (PDOException $e) {
            echo $e->getMessage();
            exit();
        }
    }

    public function updatePhoto($id, $photo)
    {
        try {
            $statement = $this->db->prepare("UPDATE users SET photo=:photo WHERE id=:id");
            $statement->execute(['id' => $id, 'photo' => $photo]);

            return $statement->rowCount();
        } catch (PDOException $e) {
            echo $e->getMessage();
            exit();
        }
    }

    //for delete
    public function delete($id)
    {
        $statement = $this->db->prepare("DELETE FROM users WHERE id=:id");
        $statement->execute(['id' => $id]);

        return $statement->rowCount();
    }

    //for suspend
    public function suspend($id)
    {
        $statement = $this->db->prepare("UPDATE users SET suspended=1 WHERE id=:id");
        $statement->execute(['id' => $id]);

        return $statement->rowCount();
    }

    //for unsuspend
    public function unsuspend($id)
    {
        $statement = $this->db->prepare("UPDATE users SET suspended=0 WHERE id=:id");
        $statement->execute(['id' => $id]);

        return $statement->rowCount();
    }

    //for change role
    public function changeRole($id, $role_id)
    {
        $statement = $this->db->prepare("UPDATE users SET role_id=:role_id WHERE id=:id");
        $statement->execute(['id' => $id, 'role_id' => $role_id]);

        return $statement->rowCount();
    }
}