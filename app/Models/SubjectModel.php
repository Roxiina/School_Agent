<?php
namespace SchoolAgent\Models;

use SchoolAgent\Config\Database;
use PDO;

class SubjectModel
{
    private $db;

    public function __construct()
    {
        $this->db = Database::getConnection();
    }

    // CREATE
    public function createSubject($data)
    {
        $sql = "INSERT INTO matiere (nom, id_agent)
                VALUES (:nom, :id_agent)";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            ':nom' => $data['nom'],
            ':id_agent' => $data['id_agent']
        ]);
    }

    // READ (une matière)
    public function getSubject($id)
    {
        $sql = "SELECT * FROM matiere WHERE id_matiere = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // READ (toutes les matières)
    public function getSubjects()
    {
        $sql = "SELECT * 
                FROM matiere
                ORDER BY umatiere.id_matiere ASC";
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // UPDATE
    public function updateSubject($id, $data)
    {
        $sql = "UPDATE matiere
                SET nom = :nom, id_agent = :id_agent
                WHERE id_matiere = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            ':nom' => $data['nom'],
            ':id_agent' => $data['id_agent'],
            ':id' => $id
        ]);
    }

    // DELETE
    public function deleteSubject($id)
    {
        $sql = "DELETE FROM matiere WHERE id_matiere = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':id' => $id]);
    }
}