<?php
namespace SchoolAgent\Models;

use SchoolAgent\Config\Database;
use PDO;

class MessageModel
{
    private $db;

    public function __construct()
    {
        $this->db = Database::getConnection();
    }

    // READ (tous les messages d'une conversation)
    public function getMessages($conversationId = null)
    {
        if ($conversationId) {
            $sql = "SELECT * 
                    FROM message
                    WHERE id_conversation = :conversation_id
                    ORDER BY id_message ASC";
            $stmt = $this->db->prepare($sql);
            $stmt->execute([':conversation_id' => $conversationId]);
        } else {
            $sql = "SELECT * 
                    FROM message
                    ORDER BY id_message ASC";
            $stmt = $this->db->query($sql);
        }
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // READ (un message)
    public function getMessage($id)
    {
        $sql = "SELECT * FROM message WHERE id_message = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // CREATE
    public function createMessage($data)
    {
        $sql = "INSERT INTO message (question, reponse, id_conversation)
                VALUES (:question, :reponse, :id_conversation)";
        $stmt = $this->db->prepare($sql);
        $ok = $stmt->execute([
            ':question' => $data['question'],
            ':reponse' => $data['reponse'],
            ':id_conversation' => $data['id_conversation']
        ]);

        if ($ok) {
            // Retourner l'id inséré pour que le frontend puisse l'utiliser
            return $this->db->lastInsertId();
        }
        return false;
    }

    // UPDATE
    public function updateMessage($id, $data)
    {
        $sql = "UPDATE message
                SET question = :question, reponse = :reponse, id_conversation = :id_conversation
                WHERE id_message = :id";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            ':question' => $data['question'],
            ':reponse' => $data['reponse'],
            ':id_conversation' => $data['id_conversation'],
            ':id' => $id
        ]);
    }

    // UPDATE ONLY QUESTION
    public function updateMessageQuestion($id, $question)
    {
        $sql = "UPDATE message SET question = :question WHERE id_message = :id";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            ':question' => $question,
            ':id' => $id
        ]);
    }

    // DELETE
    public function deleteMessage($id)
    {
        $sql = "DELETE FROM message WHERE id_message = :id";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([':id' => $id]);
    }
}