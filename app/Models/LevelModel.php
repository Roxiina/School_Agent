<?php
namespace SchoolAgent\Models;

use SchoolAgent\Config\Database;
use PDO;

class LevelModel
{
    private $db;

    public function __construct()
    {
        $this->db = Database::getConnection();
    }

    // CREATE
    public function createLevel($data)
    {
        $sql = "INSERT INTO niveau_scolaire (niveau)
                VALUES (:niveau)";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            ':niveau' => $data['niveau']
        ]);
    }

    // READ (un niveau)
    public function getLevel($id)
    {
        $sql = "SELECT * FROM niveau_scolaire WHERE id_niveau_scolaire = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // READ (tous les niveaux)
    public function getLevels()
    {
        $sql = "SELECT * 
                FROM niveau_scolaire
                ORDER BY id_niveau_scolaire ASC";
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // UPDATE
    public function updateLevel($id, $data)
    {
        $sql = "UPDATE niveau_scolaire
                SET niveau = :niveau
                WHERE id_niveau_scolaire = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            ':niveau' => $data['niveau'],
            ':id' => $id
        ]);
    }

    // DELETE
    public function deleteLevel($id)
    {
        $sql = "DELETE FROM niveau_scolaire WHERE id_niveau_scolaire = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':id' => $id]);
    }
}
