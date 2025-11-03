<?php
namespace SchoolAgent\Models;

use SchoolAgent\Config\Database;

class AgentModel {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance();
    }

    public function getAgents() {
        $sql = "SELECT * FROM agent ORDER BY name ASC";
        $result = $this->db->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getAgent($id) {
        $sql = "SELECT * FROM agent WHERE id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    public function createAgent($data) {
        $sql = "INSERT INTO agent (name, description) VALUES (?, ?)";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("ss", $data['name'], $data['description']);
        
        return $stmt->execute();
    }

    public function updateAgent($id, $data) {
        $sql = "UPDATE agent SET name = ?, description = ? WHERE id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("ssi", $data['name'], $data['description'], $id);
        
        return $stmt->execute();
    }

    public function deleteAgent($id) {
        $sql = "DELETE FROM agent WHERE id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("i", $id);
        
        return $stmt->execute();
    }
}
