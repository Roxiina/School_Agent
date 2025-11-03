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
        $sql = "SELECT u.*, n.niveau 
                FROM utilisateur u
                LEFT JOIN niveau_scolaire n ON u.id_niveau_scolaire = n.id_niveau_scolaire
                WHERE u.id_user = :id";
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

    // UPDATE email uniquement (pour étudiants)
    public function updateUserEmail($id, $email)
    {
        $sql = "UPDATE utilisateur SET email = :email WHERE id_user = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            ':email' => $email,
            ':id' => $id
        ]);
    }

    // UPDATE mot de passe
    public function updateUserPassword($id, $password)
    {
        $sql = "UPDATE utilisateur SET mot_de_passe = :password WHERE id_user = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            ':password' => password_hash($password, PASSWORD_DEFAULT),
            ':id' => $id
        ]);
    }

    // DELETE
    public function deleteUser($id)
    {
        $sql = "DELETE FROM utilisateur WHERE id_user = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':id' => $id]);
    }

    // Pour l'authentification
    public function getUserByEmail($email)
    {
        $sql = "SELECT * FROM utilisateur WHERE email = :email LIMIT 1";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':email' => $email]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
