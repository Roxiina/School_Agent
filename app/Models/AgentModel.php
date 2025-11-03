<?php
namespace SchoolAgent\Models;

use SchoolAgent\Config\Database;
use PDO;

class AgentModel {
    private $db;

    public function __construct() {
        $this->db = Database::getConnection();
    }

    public function getAgents() {
        $sql = "SELECT * FROM agent ORDER BY nom ASC";
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAgent($id) {
        $sql = "SELECT * FROM agent WHERE id_agent = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function createAgent($data) {
        $sql = "INSERT INTO agent (nom, avatar, description) VALUES (:nom, :avatar, :description)";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            ':nom' => $data['nom'],
            ':avatar' => $data['avatar'] ?? null,
            ':description' => $data['description'] ?? null
        ]);
    }

    public function updateAgent($id, $data) {
        $sql = "UPDATE agent SET nom = :nom, avatar = :avatar, description = :description WHERE id_agent = :id";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            ':nom' => $data['nom'],
            ':avatar' => $data['avatar'] ?? null,
            ':description' => $data['description'] ?? null,
            ':id' => $id
        ]);
    }

    public function deleteAgent($id) {
        $sql = "DELETE FROM agent WHERE id_agent = :id";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([':id' => $id]);
    }
}
