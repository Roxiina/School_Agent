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

    // READ (toutes les conversations)
    public function getConversations()
    {
        $sql = "SELECT c.id_conversation, c.titre, c.date_creation, c.id_agent, c.id_user
                FROM conversation c
                JOIN agent a ON c.id_conversation = a.id_agent
                JOIN utilisateur u ON c.id_conversation = u.id_user
                ORDER BY c.id_conversation ASC";
        $stmt = $this->db->query($sql);
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
        $stmt->execute([
            ':titre' => $data['titre'],
            ':date_creation' => $data['date_creation'],
            ':id_agent' => $data['id_agent'],
            ':id_user' => $data['id_user']
        ]);
    }

    // UPDATE
    public function updateConversation($id, $data)
    {
        $sql = "UPDATE conversation
                SET titre = :titre, date_creation = :date_creation, id_agent = :id_agent, id_user = :id_user
                WHERE id_conversation = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            ':titre' => $data['titre'],
            ':date_creation' => $data['date_creation'],
            ':id_agent' => $data['id_agent'],
            ':id_user' => $data['id_user'],
            ':id' => $id
        ]);
    }

    // DELETE
    public function deleteConversation($id)
    {
        $sql = "DELETE FROM conversation WHERE id_conversation = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':id' => $id]);
    }
}
