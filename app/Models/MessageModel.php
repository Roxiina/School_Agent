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

    // READ (tous les messages)
    public function getMessages()
    {
        $sql = "SELECT * 
                FROM message
                ORDER BY id_message ASC";
        $stmt = $this->db->query($sql);
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

    // READ (tous les messages d'une conversation)
    public function getMessagesByConversation($conversationId)
    {
        $sql = "SELECT * FROM message WHERE id_conversation = :id_conversation ORDER BY id_message ASC";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':id_conversation' => $conversationId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // CREATE
    public function createMessage($data)
    {
        $sql = "INSERT INTO message (question, reponse, id_conversation)
                VALUES (:question, :reponse, :id_conversation)";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            ':question' => $data['question'],
            ':reponse' => $data['reponse'],
            ':id_conversation' => $data['id_conversation']
        ]);
    }

    // UPDATE
    public function updateMessage($id, $data)
    {
        $sql = "UPDATE message
                SET question = :question, reponse = :reponse, id_conversation = :id_conversation
                WHERE id_message = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            ':question' => $data['question'],
            ':reponse' => $data['reponse'],
            ':id_conversation' => $data['id_conversation'],
            ':id' => $id
        ]);
    }

    // DELETE
    public function deleteMessage($id)
    {
        $sql = "DELETE FROM message WHERE id_message = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':id' => $id]);
    }
}