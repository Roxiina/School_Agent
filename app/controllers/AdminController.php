<?php
namespace SchoolAgent\Controllers;

use SchoolAgent\Config\Authenticator;
use SchoolAgent\Models\UserModel;
use SchoolAgent\Models\ConversationModel;
use SchoolAgent\Models\AgentModel;
use SchoolAgent\Models\SubjectModel;
use SchoolAgent\Models\LevelModel;

class AdminController
{
    private $userModel;
    private $conversationModel;
    private $agentModel;
    private $subjectModel;
    private $levelModel;

    public function __construct()
    {
        // Vérifier que l'utilisateur est admin
        Authenticator::requireAdmin();
        
        $this->userModel = new UserModel();
        $this->conversationModel = new ConversationModel();
        $this->agentModel = new AgentModel();
        $this->subjectModel = new SubjectModel();
        $this->levelModel = new LevelModel();
    }

    public function index()
    {
        // Récupérer les statistiques pour le dashboard
        $stats = $this->getAdminStats();
        
        require __DIR__ . '/../Views/admin/dashboard.php';
    }

    public function dashboard()
    {
        $this->index();
    }

    private function getAdminStats()
    {
        try {
            // Nombre total d'utilisateurs
            $totalUsers = $this->userModel->getTotalUsers();
            
            // Nombre total de conversations
            $totalConversations = $this->conversationModel->getTotalConversations();
            
            // Utilisateurs récents (dernières 24h)
            $recentUsers = $this->userModel->getRecentUsers();
            
            // Conversations récentes
            $recentConversations = $this->conversationModel->getRecentConversations(10);
            
            // Répartition par rôle
            $usersByRole = $this->userModel->getUsersByRole();
            
            // Répartition par niveau
            $usersByLevel = $this->userModel->getUsersByLevel();

            return [
                'totalUsers' => $totalUsers,
                'totalConversations' => $totalConversations,
                'recentUsers' => $recentUsers,
                'recentConversations' => $recentConversations,
                'usersByRole' => $usersByRole,
                'usersByLevel' => $usersByLevel
            ];
        } catch (\Exception $e) {
            error_log("Erreur lors de la récupération des stats admin: " . $e->getMessage());
            return [
                'totalUsers' => 0,
                'totalConversations' => 0,
                'recentUsers' => [],
                'recentConversations' => [],
                'usersByRole' => [],
                'usersByLevel' => []
            ];
        }
    }

    // Gestion des utilisateurs
    public function users()
    {
        $users = $this->userModel->getAllUsersWithDetails();
        require __DIR__ . '/../Views/admin/users.php';
    }

    // Gestion des conversations
    public function conversations()
    {
        $conversations = $this->conversationModel->getAllConversationsWithDetails();
        require __DIR__ . '/../Views/admin/conversations.php';
    }

    // Gestion des agents
    public function agents()
    {
        $agents = $this->agentModel->getAllAgents();
        require __DIR__ . '/../Views/admin/agents.php';
    }

    // Gestion des matières
    public function subjects()
    {
        $subjects = $this->subjectModel->getAllSubjectsWithDetails();
        require __DIR__ . '/../Views/admin/subjects.php';
    }

    // Gestion des niveaux
    public function levels()
    {
        $levels = $this->levelModel->getAllLevels();
        require __DIR__ . '/../Views/admin/levels.php';
    }

    // Actions CRUD pour les utilisateurs
    public function deleteUser()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['user_id'])) {
            $userId = (int)$_POST['user_id'];
            
            // Empêcher la suppression du dernier admin
            if ($this->userModel->isLastAdmin($userId)) {
                Authenticator::setFlash("Impossible de supprimer le dernier administrateur.", "error");
            } else {
                if ($this->userModel->deleteUser($userId)) {
                    Authenticator::setFlash("Utilisateur supprimé avec succès.", "success");
                } else {
                    Authenticator::setFlash("Erreur lors de la suppression de l'utilisateur.", "error");
                }
            }
        }
        
        header('Location: ?page=admin&section=users');
        exit;
    }

    public function toggleUserRole()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['user_id'])) {
            $userId = (int)$_POST['user_id'];
            $currentUser = $this->userModel->getUserById($userId);
            
            if ($currentUser) {
                $newRole = $currentUser['role'] === 'admin' ? 'etudiant' : 'admin';
                
                // Empêcher de retirer les droits admin au dernier admin
                if ($currentUser['role'] === 'admin' && $this->userModel->isLastAdmin($userId)) {
                    Authenticator::setFlash("Impossible de retirer les droits au dernier administrateur.", "error");
                } else {
                    if ($this->userModel->updateUserRole($userId, $newRole)) {
                        Authenticator::setFlash("Rôle utilisateur mis à jour avec succès.", "success");
                    } else {
                        Authenticator::setFlash("Erreur lors de la mise à jour du rôle.", "error");
                    }
                }
            }
        }
        
        header('Location: ?page=admin&section=users');
        exit;
    }

    // Action pour supprimer une conversation
    public function deleteConversation()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['conversation_id'])) {
            $conversationId = (int)$_POST['conversation_id'];
            
            if ($this->conversationModel->deleteConversation($conversationId)) {
                Authenticator::setFlash("Conversation supprimée avec succès.", "success");
            } else {
                Authenticator::setFlash("Erreur lors de la suppression de la conversation.", "error");
            }
        }
        
        header('Location: ?page=admin&section=conversations');
        exit;
    }
}