<?php

require_once "Model.php";


class CommentsModel extends Model
{
    protected $table = "comments";


    public function findAllByStatusId(int $id): array
    {
        $query = $this->db->prepare('
            SELECT comments.*, users.firstName, users.lastName, users.avatar
            FROM comments
            JOIN users ON users.id = comments.user_id
            WHERE comments.status_id = :id
            ORDER BY comments.createdAt DESC
        ');

        $query->execute(['id' => $id]);

        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function delete(int $id)
    {
        $query = $this->db->prepare('DELETE FROM comments WHERE id = :id');
        $query->execute(['id' => $id]);
    }
}
