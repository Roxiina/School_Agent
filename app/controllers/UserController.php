<?php
namespace SchoolAgent\Controllers;

use SchoolAgent\Models\UserModel;
use SchoolAgent\Config\Authenticator;

class UserController
{
    private $model;

    public function __construct()
    {
        $this->model = new UserModel();
    }

    // Liste tous les utilisateurs
    public function index()
    {
        // Seuls les professeurs et admins peuvent voir la liste des utilisateurs
        Authenticator::requireRole(['professeur', 'admin']);
        $users = $this->model->getUsers();
        require __DIR__ . '/../Views/user/index.php';
    }

    // Afficher le profil d'un utilisateur
    public function show($id)
    {
        $user = $this->model->getUser($id);

        if (!$user) {
            http_response_code(404);
            echo "<h1>Utilisateur introuvable</h1>";
            exit;
        }

        require __DIR__ . '/../Views/user/show.php';
    }

    // Profil de l'utilisateur connecté
    public function profile()
    {
        Authenticator::requireLogin();
        $userId = Authenticator::getUserId();
        $userRole = Authenticator::getUserRole();
        $user = $this->model->getUser($userId);
        
        if (!$user) {
            Authenticator::setFlash('Utilisateur introuvable.', 'error');
            header('Location: ?page=dashboard');
            exit;
        }

        // Gérer la mise à jour du profil
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Pour les étudiants, seul l'email peut être modifié
            if ($userRole === 'etudiant') {
                $newEmail = $_POST['email'] ?? '';
                $newPassword = $_POST['password'] ?? '';
                $confirmPassword = $_POST['password_confirm'] ?? '';
                
                $hasErrors = false;

                // Validation de l'email
                if (empty($newEmail)) {
                    Authenticator::setFlash('L\'email ne peut pas être vide.', 'error');
                    $hasErrors = true;
                } elseif (!filter_var($newEmail, FILTER_VALIDATE_EMAIL)) {
                    Authenticator::setFlash('L\'email n\'est pas valide.', 'error');
                    $hasErrors = true;
                } else {
                    // Vérifier si l'email n'existe pas déjà (sauf le sien)
                    $existingUser = $this->model->getUserByEmail($newEmail);
                    if ($existingUser && $existingUser['id_user'] != $userId) {
                        Authenticator::setFlash('Cet email est déjà utilisé.', 'error');
                        $hasErrors = true;
                    }
                }

                // Validation du mot de passe si rempli
                if (!empty($newPassword)) {
                    if (strlen($newPassword) < 6) {
                        Authenticator::setFlash('Le mot de passe doit contenir au moins 6 caractères.', 'error');
                        $hasErrors = true;
                    } elseif ($newPassword !== $confirmPassword) {
                        Authenticator::setFlash('Les mots de passe ne correspondent pas.', 'error');
                        $hasErrors = true;
                    }
                }

                // Si pas d'erreurs, mettre à jour
                if (!$hasErrors) {
                    // Mettre à jour l'email
                    $this->model->updateUserEmail($userId, $newEmail);
                    
                    // Mettre à jour le mot de passe si fourni
                    if (!empty($newPassword)) {
                        $this->model->updateUserPassword($userId, $newPassword);
                        Authenticator::setFlash('Votre email et votre mot de passe ont été mis à jour avec succès.', 'success');
                    } else {
                        Authenticator::setFlash('Votre email a été mis à jour avec succès.', 'success');
                    }
                    
                    // Rafraîchir les données
                    $user = $this->model->getUser($userId);
                }
            }
        }

        // Charger la bonne vue selon le rôle
        if ($userRole === 'etudiant') {
            require __DIR__ . '/../Views/user/student-profile.php';
        } else {
            require __DIR__ . '/../Views/user/profile.php';
        }
    }

    // Formulaire création utilisateur + traitement POST
    public function create()
    {
        // Seuls les admins peuvent créer des utilisateurs
        Authenticator::requireRole(['admin']);
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Création de l'utilisateur directement depuis le formulaire
            $this->model->createUser($_POST);
            header('Location: ?page=user');
            exit;
        }

        // Sinon, on affiche le formulaire
        require __DIR__ . '/../Views/user/create.php';
    }

    // Formulaire édition utilisateur + traitement POST
    
    public function edit($id)
    {
        // Vérifier les droits d'accès
        $currentUserId = Authenticator::getUserId();
        $currentUserRole = Authenticator::getUserRole();
        
        // Un utilisateur peut éditer son propre profil
        // Les professeurs et admins peuvent éditer d'autres profils
        if ($id != $currentUserId && !in_array($currentUserRole, ['professeur', 'admin'])) {
            Authenticator::setFlash('Vous ne pouvez pas modifier ce profil.', 'error');
            header('Location: ?page=dashboard');
            exit;
        }
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Mise à jour directement depuis le formulaire
            $this->model->updateUser($id, $_POST);
            header('Location: ?page=user');
            exit;
        }

        // Sinon, on affiche le formulaire avec les données de l'utilisateur
        $user = $this->model->getUser($id);
        require __DIR__ . '/../Views/user/edit.php';
    }

    // Suppression utilisateur
    public function delete($id)
    {
        // Seuls les admins peuvent supprimer des utilisateurs
        Authenticator::requireRole(['admin']);
        
        $this->model->deleteUser($id);
        header('Location: ?page=user');
        exit;
    }
}
