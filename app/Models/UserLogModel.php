<?php
namespace SchoolAgent\Models;

use SchoolAgent\Config\Database;
use PDO;

class UserLogModel
{
    private $db;

    public function __construct()
    {
        $this->db = Database::getConnection();
    }

    public function all()
    {
        $sql = "SELECT ul.*, u.nom, u.prenom 
                FROM user_log ul
                JOIN utilisateur u ON ul.id_user = u.id_user
                ORDER BY derniere_connection DESC";
        return $this->db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    public function find(int $id)
    {
        $sql = "SELECT ul.*, u.nom, u.prenom 
                FROM user_log ul
                JOIN utilisateur u ON ul.id_user = u.id_user
                WHERE ul.id_userlog = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function delete(int $id)
    {
        $stmt = $this->db->prepare("DELETE FROM user_log WHERE id_userlog = :id");
        return $stmt->execute([':id' => $id]);
    }
}
