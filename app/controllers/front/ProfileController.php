<?php

namespace SchoolAgent\Controllers\Front;

use SchoolAgent\Config\Authenticator;
use SchoolAgent\Models\UserModel;

class ProfileController
{
    private UserModel $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    /**
     * Affiche le profil de l'utilisateur connecté
     */
    public function index()
    {
        // Vérifier que l'utilisateur est connecté
        if (!Authenticator::isLogged()) {
            header('Location: /login');
            exit;
        }

        // Récupérer l'ID de l'utilisateur
        $userId = Authenticator::getUserId();

        // Récupérer les données de l'utilisateur
        $user = $this->userModel->getUser($userId);

        if (!$user) {
            Authenticator::setFlash('Utilisateur non trouvé', 'error');
            header('Location: /home');
            exit;
        }

        // Récupérer l'état de connexion
        $isLogged = true;

        // Récupérer le flash message s'il existe
        $flash = Authenticator::getFlash();

        // Charger la vue
        require_once __DIR__ . '/../../Views/front/profile.php';
    }

    /**
     * Met à jour le profil de l'utilisateur
     */
    public function update()
    {
        // Vérifier que l'utilisateur est connecté
        if (!Authenticator::isLogged()) {
            header('Location: /login');
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: /profile');
            exit;
        }

        $userId = Authenticator::getUserId();
        
        // Vérifier si c'est une mise à jour de mot de passe
        if (isset($_POST['change_password'])) {
            $this->updatePassword($userId);
            return;
        }
        
        // Récupérer les données du formulaire
        $nom = $_POST['nom'] ?? '';
        $prenom = $_POST['prenom'] ?? '';
        $email = $_POST['email'] ?? '';

        // Validation simple
        if (empty($nom) || empty($prenom) || empty($email)) {
            Authenticator::setFlash('Tous les champs sont requis', 'error');
            header('Location: /profile');
            exit;
        }

        // Vérifier que l'email est valide
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            Authenticator::setFlash('Email invalide', 'error');
            header('Location: /profile');
            exit;
        }

        // Mettre à jour l'utilisateur (garder les données existantes pour les champs non modifiables)
        $currentUser = $this->userModel->getUser($userId);
        $this->userModel->updateUser($userId, [
            'nom' => $nom,
            'prenom' => $prenom,
            'email' => $email,
            'role' => $currentUser['role'],
            'id_niveau_scolaire' => $currentUser['id_niveau_scolaire']
        ]);

        Authenticator::setFlash('Profil mis à jour avec succès', 'success');

        header('Location: /profile');
        exit;
    }

    /**
     * Met à jour le mot de passe de l'utilisateur
     */
    private function updatePassword($userId)
    {
        $currentPassword = $_POST['current_password'] ?? '';
        $newPassword = $_POST['new_password'] ?? '';
        $confirmPassword = $_POST['confirm_password'] ?? '';

        // Validation
        if (empty($currentPassword) || empty($newPassword) || empty($confirmPassword)) {
            Authenticator::setFlash('Tous les champs sont requis', 'error');
            header('Location: /profile');
            exit;
        }

        // Vérifier que les nouveaux mots de passe correspondent
        if ($newPassword !== $confirmPassword) {
            Authenticator::setFlash('Les mots de passe ne correspondent pas', 'error');
            header('Location: /profile');
            exit;
        }

        // Vérifier que le nouveau mot de passe a une longueur suffisante
        if (strlen($newPassword) < 6) {
            Authenticator::setFlash('Le mot de passe doit contenir au moins 6 caractères', 'error');
            header('Location: /profile');
            exit;
        }

        // Récupérer l'utilisateur
        $user = $this->userModel->getUser($userId);

        // Vérifier le mot de passe actuel
        if (!password_verify($currentPassword, $user['mot_de_passe'])) {
            Authenticator::setFlash('Le mot de passe actuel est incorrect', 'error');
            header('Location: /profile');
            exit;
        }

        // Mettre à jour le mot de passe
        $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
        $updateResult = $this->userModel->updatePassword($userId, $hashedPassword);

        if ($updateResult) {
            Authenticator::setFlash('Mot de passe mis à jour avec succès', 'success');
        } else {
            Authenticator::setFlash('Erreur lors de la mise à jour du mot de passe', 'error');
        }

        header('Location: /profile');
        exit;
    }
}
