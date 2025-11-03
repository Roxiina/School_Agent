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

    // READ (tous les agents)
    public function getAgents()
    {
        $sql = "SELECT * FROM agent ORDER BY nom ASC";
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // READ (un agent)
    public function getAgent($id)
    {
        $sql = "SELECT * FROM agent WHERE id_agent = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // READ (agents par matière)
    public function getAgentsBySubject()
    {
        $sql = "SELECT DISTINCT a.id_agent, a.nom, a.avatar, a.description, a.temperature, a.system_prompt
                FROM agent a
                JOIN matiere m ON a.id_agent = m.id_agent
                ORDER BY a.nom ASC";
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // CREATE
    public function createAgent($data)
    {
        $sql = "INSERT INTO agent (nom, avatar, description, temperature, system_prompt)
                VALUES (:nom, :avatar, :description, :temperature, :system_prompt)";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            ':nom' => $data['nom'],
            ':avatar' => $data['avatar'],
            ':description' => $data['description'],
            ':temperature' => $data['temperature'],
            ':system_prompt' => $data['system_prompt']
        ]);
    }

    // UPDATE
    public function updateAgent($id, $data)
    {
        $sql = "UPDATE agent
                SET nom = :nom, avatar = :avatar, description = :description, temperature = :temperature, system_prompt = :system_prompt
                WHERE id_agent = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            ':id' => $id,
            ':nom' => $data['nom'],
            ':avatar' => $data['avatar'],
            ':description' => $data['description'],
            ':temperature' => $data['temperature'],
            ':system_prompt' => $data['system_prompt']
        ]);
    }

    // DELETE
    public function deleteAgent($id)
    {
        $sql = "DELETE FROM agent WHERE id_agent = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':id' => $id]);
    }
}
