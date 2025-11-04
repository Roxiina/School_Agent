<?php
namespace SchoolAgent\Models;

use SchoolAgent\Config\Database;
use PDO;

class AgentModel
{
    private $db;

    public function __construct()
    {
        $this->db = Database::getConnection();
    }

    // CREATE
    public function createAgent($data)
    {
        $sql = "INSERT INTO agent (nom, avatar, description, temperature, system_prompt)
                VALUES (:nom, :avatar, :description, :temperature, :system_prompt)";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            ':nom' => $data['nom'],
            ':avatar' => $data['avatar'] ?? null,
            ':description' => $data['description'] ?? null,
            ':temperature' => $data['temperature'] ?? 1.0,
            ':system_prompt' => $data['system_prompt'] ?? null
        ]);
    }

    // READ (single)
    public function getAgent($id)
    {
        $stmt = $this->db->prepare("SELECT * FROM agent WHERE id_agent = :id");
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // READ (all)
    public function getAgents()
    {
        $stmt = $this->db->query("SELECT * FROM agent ORDER BY id_agent ASC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // UPDATE
    public function updateAgent($id, $data)
    {
        $sql = "UPDATE agent
                SET nom = :nom, avatar = :avatar, description = :description,
                    temperature = :temperature, system_prompt = :system_prompt
                WHERE id_agent = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            ':nom' => $data['nom'],
            ':avatar' => $data['avatar'],
            ':description' => $data['description'],
            ':temperature' => $data['temperature'],
            ':system_prompt' => $data['system_prompt'],
            ':id' => $id
        ]);
    }

    // DELETE
    public function deleteAgent($id)
    {
        $stmt = $this->db->prepare("DELETE FROM agent WHERE id_agent = :id");
        $stmt->execute([':id' => $id]);
    }

    
    // Récupérer tous les agents pour le formulaire
    public function getAllAgents()
    {
        $stmt = $this->db->query("SELECT * FROM agent ORDER BY nom ASC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
