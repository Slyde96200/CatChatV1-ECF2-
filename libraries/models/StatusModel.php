<?php

require_once "Model.php";


class StatusModel extends Model
{
    protected $table = 'status';

    public function findAll(): array
    {
        $query = $this->db->prepare('
            SELECT
                status.*,
                users.firstName,
                users.lastName,
                users.avatar,
                COUNT(comments.id) AS comments
            FROM status
            JOIN users ON status.user_id = users.id
            LEFT JOIN comments ON comments.status_id = status.id
            GROUP BY status.id
            ORDER BY status.createdAt DESC
        ');
        $query->execute();

        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function find(int $id)
    {
        $query = $this->db->prepare('
            SELECT
                status.*,
                users.firstName,
                users.lastName,
                users.avatar,
                COUNT(comments.id) AS comments
            FROM status
            JOIN users ON status.user_id = users.id
            LEFT JOIN comments ON comments.status_id = status.id
            WHERE status.id = :id
            GROUP BY status.id
            ORDER BY status.createdAt DESC
        ');
        $query->execute(['id' => $id]);

        return $query->fetch(PDO::FETCH_ASSOC);
    }

    public function delete(int $id): void
    {
        $query = $this->db->prepare('DELETE FROM status WHERE id = :id');
        $query->execute(['id' => $id]);
    }

    public function findById(int $id)
    {
        $query = $this->db->prepare('SELECT * FROM status WHERE id = :id');
        $query->execute(['id' => $id]);

        return $query->fetch(PDO::FETCH_ASSOC);
    }
}
