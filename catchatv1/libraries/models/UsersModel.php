<?php

require_once "Model.php";


class UsersModel extends Model
{
    protected $table = "users";


    public function findByEmail(string $email)
    {
        $query = $this->db->prepare('
            SELECT * FROM users WHERE email = :email
        ');

        $query->execute([
            ':email' => $email,
        ]);

        return $query->fetch(PDO::FETCH_ASSOC);
    }

    public function getUser($id)
    {
        $sql = "SELECT * FROM users WHERE id = :id LIMIT 1";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(['id' => $id]);
        return $stmt->fetch();
    }

    public function updateUser($id, $firstName, $lastName, $email, $password)
    {
        $sql = "UPDATE users SET firstName = :firstName, lastName = :lastName, email = :email, password = :password WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            'id' => $id,
            'firstName' => $firstName,
            'lastName' => $lastName,
            'email' => $email,
            'password' => $password
        ]);
    }
}
