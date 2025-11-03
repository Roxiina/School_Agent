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
                ORDER BY id_matiere ASC";
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // READ (toutes les matières avec agents associés)
    public function getSubjectsWithAgents()
    {
        $sql = "SELECT m.id_matiere, m.nom as matiere_nom, a.id_agent, a.nom as agent_nom, a.avatar, a.description, a.temperature, a.system_prompt
                FROM matiere m
                JOIN agent a ON m.id_agent = a.id_agent
                ORDER BY m.nom ASC";
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