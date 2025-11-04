<?php
namespace SchoolAgent\Models;

use SchoolAgent\Config\Database;
use PDO;

// table pivot utiliser
class UserAgentModel
{
    private $db;

    public function __construct()
    {
        $this->db = Database::getConnection();
    }

    // Assign agent to user
    public function assignAgentToUser($id_user, $id_agent)
    {
        $sql = "INSERT IGNORE INTO utiliser (id_user, id_agent)
                VALUES (:id_user, :id_agent)";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            ':id_user' => $id_user,
            ':id_agent' => $id_agent
        ]);
    }

    // Remove link
    public function removeAgentFromUser($id_user, $id_agent)
    {
        $sql = "DELETE FROM utiliser WHERE id_user = :id_user AND id_agent = :id_agent";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            ':id_user' => $id_user,
            ':id_agent' => $id_agent
        ]);
    }

    // Get all agents available for a user
    public function getAgentsByUser($id_user)
    {
        $sql = "SELECT a.* FROM agent a
                JOIN utiliser u ON a.id_agent = u.id_agent
                WHERE u.id_user = :id_user";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':id_user' => $id_user]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Get all users linked to a given agent
    public function getUsersByAgent($id_agent)
    {
        $sql = "SELECT u.* FROM utilisateur u
                JOIN utiliser ua ON u.id_user = ua.id_user
                WHERE ua.id_agent = :id_agent";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':id_agent' => $id_agent]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAllRelations()
    {
        $sql = "SELECT ua.id_user, ua.id_agent, u.nom AS user_nom, u.prenom AS user_prenom, a.nom AS agent_nom
                FROM utiliser ua
                JOIN utilisateur u ON ua.id_user = u.id_user
                JOIN agent a ON ua.id_agent = a.id_agent
                ORDER BY u.nom ASC";
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getAllUsers()
    {
        $sql = "SELECT * FROM utilisateur ORDER BY nom ASC";
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Récupérer une relation spécifique
public function findRelation($id_user, $id_agent)
{
    $sql = "SELECT ua.id_user, ua.id_agent, u.nom AS user_nom, u.prenom AS user_prenom, a.nom AS agent_nom
            FROM utiliser ua
            JOIN utilisateur u ON ua.id_user = u.id_user
            JOIN agent a ON ua.id_agent = a.id_agent
            WHERE ua.id_user = :id_user AND ua.id_agent = :id_agent";
    $stmt = $this->db->prepare($sql);
    $stmt->execute([
        ':id_user' => $id_user,
        ':id_agent' => $id_agent
    ]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

// Modifier l'agent associé à un utilisateur
public function updateAgentForUser($id_user, $old_id_agent, $new_id_agent)
{
    $sql = "UPDATE utiliser
            SET id_agent = :new_id_agent
            WHERE id_user = :id_user AND id_agent = :old_id_agent";
    $stmt = $this->db->prepare($sql);
    return $stmt->execute([
        ':id_user' => $id_user,
        ':old_id_agent' => $old_id_agent,
        ':new_id_agent' => $new_id_agent
    ]);
}


}
