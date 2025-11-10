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

    public function createAgent($data)
    {
        $sql = "INSERT INTO agent (nom, avatar, description, temperature, system_prompt, model, max_completion_tokens)
                VALUES (:nom, :avatar, :description, :temperature, :system_prompt, :model, :max_completion_tokens)";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            ':nom' => $data['nom'],
            ':avatar' => $data['avatar'] ?? null,
            ':description' => $data['description'] ?? null,
            ':temperature' => $data['temperature'] ?? 1.0,
            ':system_prompt' => $data['system_prompt'] ?? null,
            ':model' => $data['model'] ?? 'llama-3.1-8b-instant',
            ':max_completion_tokens' => $data['max_completion_tokens'] ?? 512
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
                    temperature = :temperature, system_prompt = :system_prompt,
                    model = :model, max_completion_tokens = :max_completion_tokens
                WHERE id_agent = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            ':nom' => $data['nom'],
            ':avatar' => $data['avatar'] ?? null,
            ':description' => $data['description'] ?? null,
            ':temperature' => $data['temperature'] ?? 1.0,
            ':system_prompt' => $data['system_prompt'] ?? null,
            ':model' => $data['model'] ?? 'llama-3.1-8b-instant',
            ':max_completion_tokens' => $data['max_completion_tokens'] ?? 512,
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
    
    // Récupérer les agents auxquels un utilisateur a accès
    public function getAgentsByUser($userId)
    {
        $sql = "SELECT a.* 
                FROM agent a
                INNER JOIN utiliser u ON a.id_agent = u.id_agent
                WHERE u.id_user = :user_id
                ORDER BY a.nom ASC";

        $stmt = $this->db->prepare($sql);
        $stmt->execute([':user_id' => $userId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }



}
