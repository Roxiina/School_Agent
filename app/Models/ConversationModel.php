<?php
namespace SchoolAgent\Models;

use SchoolAgent\Config\Database;
use PDO;

class ConversationModel
{
    private $db;

    public function __construct()
    {
        $this->db = Database::getConnection();
    }

    // READ (toutes les conversations pour un utilisateur)
    public function getConversations($userId = null)
    {
        if ($userId) {
            $sql = "SELECT c.id_conversation, c.titre, c.date_creation, c.id_agent, a.nom as agent_nom, a.avatar
                    FROM conversation c
                    JOIN agent a ON c.id_agent = a.id_agent
                    WHERE c.id_user = :user_id
                    ORDER BY c.date_creation DESC";
            $stmt = $this->db->prepare($sql);
            $stmt->execute([':user_id' => $userId]);
        } else {
            $sql = "SELECT c.id_conversation, c.titre, c.date_creation, c.id_agent, a.nom as agent_nom, a.avatar
                    FROM conversation c
                    JOIN agent a ON c.id_agent = a.id_agent
                    ORDER BY c.date_creation DESC";
            $stmt = $this->db->query($sql);
        }
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // READ (une conversation)
    public function getConversation($id)
    {
        $sql = "SELECT * FROM conversation WHERE id_conversation = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // CREATE
    public function createConversation($data)
    {
        $sql = "INSERT INTO conversation (titre, date_creation, id_agent, id_user)
                VALUES (:titre, :date_creation, :id_agent, :id_user)";
        $stmt = $this->db->prepare($sql);
        $result = $stmt->execute([
            ':titre' => $data['titre'],
            ':date_creation' => $data['date_creation'],
            ':id_agent' => $data['id_agent'],
            ':id_user' => $data['id_user']
        ]);
        return $result; // Retourner true si succès, false si échec
    }

    // UPDATE
    public function updateConversation($id, $data)
    {
        $updates = [];
        $params = [':id' => $id];
        
        if (isset($data['titre'])) {
            $updates[] = 'titre = :titre';
            $params[':titre'] = $data['titre'];
        }
        if (isset($data['date_creation'])) {
            $updates[] = 'date_creation = :date_creation';
            $params[':date_creation'] = $data['date_creation'];
        }
        if (isset($data['id_agent'])) {
            $updates[] = 'id_agent = :id_agent';
            $params[':id_agent'] = $data['id_agent'];
        }
        if (isset($data['id_user'])) {
            $updates[] = 'id_user = :id_user';
            $params[':id_user'] = $data['id_user'];
        }
        
        if (empty($updates)) {
            return false;
        }
        
        $sql = "UPDATE conversation SET " . implode(', ', $updates) . " WHERE id_conversation = :id";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute($params);
    }

    // DELETE
    public function deleteConversation($id)
    {
        $sql = "DELETE FROM conversation WHERE id_conversation = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':id' => $id]);
        return $stmt->rowCount(); // Retourner le nombre de lignes supprimées
    }
}
