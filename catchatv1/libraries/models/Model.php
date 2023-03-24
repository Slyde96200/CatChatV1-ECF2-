<?php


abstract class Model
{

    protected $db;

    protected $table;

    public function __construct()
    {
        // On vérifie que le nom de la table est bien précisé 
        if (empty($this->table)) {
            //  erreur 
            throw new Exception('Vous devez spécifier une propriété <em>protected $table</em>  ' . get_called_class());
        }

        //   créé l'objet PDO 
        $this->db = Database::getInstance();
    }


    public function find(int $id)
    {
        // Retrouver l'article et le retourner
        $query = $this->db->prepare("SELECT * FROM $this->table WHERE id = :id");
        $query->execute([
            ':id' => $id,
        ]);

        return $query->fetch(PDO::FETCH_ASSOC);
    }


    public function findAll(): array
    {
        // Retourner tous les articles
        $query = $this->db->prepare("SELECT * FROM $this->table");
        $query->execute();

        return $query->fetchAll(PDO::FETCH_ASSOC);
    }


    public function insert(array $data): int
    {
        $sql = "INSERT INTO $this->table SET ";

        $columns = array_keys($data);
        $sqlColumns = [];

        foreach ($columns as $column) {
            $sqlColumns[] = "$column = :$column";
        }

        $sql .= implode(",", $sqlColumns);

        $query = $this->db->prepare($sql);

        $query->execute($data);

        return $this->db->lastInsertId();
    }


    public function update(array $data)
    {
        if (!array_key_exists('id', $data)) {
            throw new Exception("Vous ne pouvez pas appeler la fonction update sans préciser dans votre tableau un champ `id` !");
        }

        $sql = "UPDATE $this->table SET ";

        $columns = array_keys($data);
        $sqlColumns = [];

        foreach ($columns as $column) {
            $sqlColumns[] = "$column = :$column";
        }

        $sql .= implode(",", $sqlColumns);

        $sql .= " WHERE id = :id";

        $query = $this->db->prepare($sql);

        $query->execute($data);
    }
}
