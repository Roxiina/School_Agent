<?php
namespace SchoolAgent\Models;

use SchoolAgent\Config\Database;
use PDO;

class UserModel
{
    private $db;

    public function __construct()
    {
        $this->db = Database::getConnection();
    }

    public function getAllUsers()
    {
        $sql = "SELECT u.id_user, u.nom, u.prenom, u.email, u.role, n.niveau 
                FROM utilisateur u
                JOIN niveau_scolaire n ON u.id_niveau_scolaire = n.id_niveau_scolaire
                ORDER BY u.id_user ASC";
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
