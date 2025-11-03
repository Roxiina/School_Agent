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

    // READ (tous les utilisateurs)
    public function getUsers()
    {
        $sql = "SELECT u.id_user, u.nom, u.prenom, u.email, u.role, n.niveau 
                FROM utilisateur u
                JOIN niveau_scolaire n ON u.id_niveau_scolaire = n.id_niveau_scolaire
                ORDER BY u.id_user ASC";
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // READ (un utilisateur)
    public function getUser($id)
    {
        $sql = "SELECT * FROM utilisateur WHERE id_user = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // CREATE
    public function createUser($data)
    {
        $sql = "INSERT INTO utilisateur (nom, prenom, email, mot_de_passe, role, id_niveau_scolaire)
                VALUES (:nom, :prenom, :email, :mot_de_passe, :role, :id_niveau_scolaire)";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            ':nom' => $data['nom'],
            ':prenom' => $data['prenom'],
            ':email' => $data['email'],
            ':mot_de_passe' => password_hash($data['mot_de_passe'], PASSWORD_DEFAULT),
            ':role' => $data['role'],
            ':id_niveau_scolaire' => $data['id_niveau_scolaire']
        ]);
    }

    // UPDATE
    public function updateUser($id, $data)
    {
        $sql = "UPDATE utilisateur
                SET nom = :nom, prenom = :prenom, email = :email, role = :role, id_niveau_scolaire = :id_niveau_scolaire
                WHERE id_user = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            ':nom' => $data['nom'],
            ':prenom' => $data['prenom'],
            ':email' => $data['email'],
            ':role' => $data['role'],
            ':id_niveau_scolaire' => $data['id_niveau_scolaire'],
            ':id' => $id
        ]);
    }

    // DELETE
    public function deleteUser($id)
    {
        $sql = "DELETE FROM utilisateur WHERE id_user = :id";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([':id' => $id]);
    }

    // Pour l'authentification
    public function getUserByEmail($email)
    {
        $sql = "SELECT * FROM utilisateur WHERE email = :email LIMIT 1";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':email' => $email]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Méthodes pour l'administration

    public function getTotalUsers()
    {
        $sql = "SELECT COUNT(*) as total FROM utilisateur";
        $stmt = $this->db->query($sql);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['total'];
    }

    public function getRecentUsers($days = 1)
    {
        // Comme la table n'a pas de colonne created_at, retournons 0
        // Ou vous pouvez ajouter une colonne created_at à votre table
        return 0;
    }

    public function getUsersByRole()
    {
        $sql = "SELECT role, COUNT(*) as count FROM utilisateur GROUP BY role";
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getUsersByLevel()
    {
        $sql = "SELECT n.niveau, COUNT(*) as count 
                FROM utilisateur u 
                JOIN niveau_scolaire n ON u.id_niveau_scolaire = n.id_niveau_scolaire 
                GROUP BY n.niveau";
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAllUsersWithDetails()
    {
        $sql = "SELECT u.id_user, u.nom, u.prenom, u.email, u.role, n.niveau as niveau_scolaire
                FROM utilisateur u
                LEFT JOIN niveau_scolaire n ON u.id_niveau_scolaire = n.id_niveau_scolaire
                ORDER BY u.id_user DESC";
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getUserById($id)
    {
        $sql = "SELECT * FROM utilisateur WHERE id_user = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function updateUserRole($userId, $role)
    {
        $sql = "UPDATE utilisateur SET role = :role WHERE id_user = :id";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([':role' => $role, ':id' => $userId]);
    }

    public function isLastAdmin($userId)
    {
        $sql = "SELECT COUNT(*) as count FROM utilisateur WHERE role = 'admin' AND id_user != :id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':id' => $userId]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['count'] == 0;
    }

    public function updatePassword($userId, $hashedPassword)
    {
        $sql = "UPDATE utilisateur SET mot_de_passe = :password WHERE id_user = :id";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([':password' => $hashedPassword, ':id' => $userId]);
    }
}
