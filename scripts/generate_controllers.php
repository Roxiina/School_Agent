<?php
// Script pour générer les Controllers User

$baseDir = __DIR__ . '/..';
$controllersDir = $baseDir . '/app/controllers';

// ConversationController
$conversationController = <<<'EOT'
<?php
namespace SchoolAgent\Controllers;

use SchoolAgent\Models\ConversationModel;
use SchoolAgent\Models\MessageModel;
use SchoolAgent\Config\Authenticator;

class ConversationController {
    private $conversationModel;
    private $messageModel;

    public function __construct() {
        $this->conversationModel = new ConversationModel();
        $this->messageModel = new MessageModel();
    }

    public function index() {
        Authenticator::requireLogin();
        $userId = $_SESSION['user_id'] ?? null;
        $conversations = $this->conversationModel->getConversations($userId);
        require __DIR__ . '/../Views/conversation/index.php';
    }

    public function show($id) {
        Authenticator::requireLogin();
        $conversation = $this->conversationModel->getConversation($id);
        if (!$conversation) {
            http_response_code(404);
            echo "<h1>Conversation introuvable</h1>";
            exit;
        }
        $messages = $this->messageModel->getMessages($id);
        require __DIR__ . '/../Views/conversation/show.php';
    }

    public function create() {
        Authenticator::requireLogin();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'user_id' => $_SESSION['user_id'],
                'agent_id' => $_POST['agent_id'] ?? 1,
                'subject_id' => $_POST['subject_id'] ?? 1,
                'title' => $_POST['title'] ?? 'Nouvelle conversation'
            ];
            if ($this->conversationModel->createConversation($data)) {
                $_SESSION['success'] = 'Conversation créée.';
                header('Location: ?page=conversation');
                exit;
            }
        }
        require __DIR__ . '/../Views/conversation/create.php';
    }

    public function edit($id) {
        Authenticator::requireLogin();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = ['title' => $_POST['title'] ?? ''];
            if ($this->conversationModel->updateConversation($id, $data)) {
                $_SESSION['success'] = 'Conversation mise à jour.';
                header('Location: ?page=conversation&action=show&id=' . $id);
                exit;
            }
        }
        $conversation = $this->conversationModel->getConversation($id);
        require __DIR__ . '/../Views/conversation/edit.php';
    }

    public function delete($id) {
        Authenticator::requireLogin();
        if ($this->conversationModel->deleteConversation($id)) {
            $_SESSION['success'] = 'Conversation supprimée.';
        }
        header('Location: ?page=conversation');
        exit;
    }
}
EOT;

file_put_contents($controllersDir . '/ConversationController.php', $conversationController);

// MessageController
$messageController = <<<'EOT'
<?php
namespace SchoolAgent\Controllers;

use SchoolAgent\Models\MessageModel;
use SchoolAgent\Config\Authenticator;

class MessageController {
    private $messageModel;

    public function __construct() {
        $this->messageModel = new MessageModel();
    }

    public function store() {
        Authenticator::requireLogin();
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['content'])) {
            $data = [
                'conversation_id' => $_POST['conversation_id'] ?? null,
                'sender_type' => $_POST['sender_type'] ?? 'user',
                'sender_id' => $_POST['sender_id'] ?? $_SESSION['user_id'],
                'content' => $_POST['content']
            ];

            if ($this->messageModel->createMessage($data)) {
                echo json_encode(['success' => true]);
                exit;
            }
        }
        echo json_encode(['success' => false]);
        exit;
    }

    public function index() {
        Authenticator::requireLogin();
        $conversationId = $_GET['conversation_id'] ?? null;
        if (!$conversationId) {
            echo json_encode(['success' => false]);
            exit;
        }
        $messages = $this->messageModel->getMessages($conversationId);
        echo json_encode(['success' => true, 'data' => $messages]);
        exit;
    }

    public function delete($id) {
        Authenticator::requireLogin();
        if ($this->messageModel->deleteMessage($id)) {
            echo json_encode(['success' => true]);
            exit;
        }
        echo json_encode(['success' => false]);
        exit;
    }
}
EOT;

file_put_contents($controllersDir . '/MessageController.php', $messageController);

// UserController  
$userController = <<<'EOT'
<?php
namespace SchoolAgent\Controllers;

use SchoolAgent\Config\Authenticator;

class UserController {
    public function index() {
        Authenticator::requireLogin();
        require __DIR__ . '/../Views/user/index.php';
    }

    public function profile() {
        Authenticator::requireLogin();
        require __DIR__ . '/../Views/user/show.php';
    }
}
EOT;

file_put_contents($controllersDir . '/UserController.php', $userController);

// LevelController
$levelController = <<<'EOT'
<?php
namespace SchoolAgent\Controllers;

use SchoolAgent\Models\LevelModel;
use SchoolAgent\Config\Authenticator;

class LevelController {
    private $levelModel;

    public function __construct() {
        $this->levelModel = new LevelModel();
    }

    public function index() {
        Authenticator::requireLogin();
        $levels = $this->levelModel->getLevels();
        require __DIR__ . '/../Views/level/index.php';
    }

    public function show($id) {
        Authenticator::requireLogin();
        $level = $this->levelModel->getLevel($id);
        require __DIR__ . '/../Views/level/show.php';
    }
}
EOT;

file_put_contents($controllersDir . '/LevelController.php', $levelController);

// SubjectController
$subjectController = <<<'EOT'
<?php
namespace SchoolAgent\Controllers;

use SchoolAgent\Models\SubjectModel;
use SchoolAgent\Config\Authenticator;

class SubjectController {
    private $subjectModel;

    public function __construct() {
        $this->subjectModel = new SubjectModel();
    }

    public function index() {
        Authenticator::requireLogin();
        $subjects = $this->subjectModel->getSubjects();
        require __DIR__ . '/../Views/subject/index.php';
    }

    public function show($id) {
        Authenticator::requireLogin();
        $subject = $this->subjectModel->getSubject($id);
        require __DIR__ . '/../Views/subject/show.php';
    }
}
EOT;

file_put_contents($controllersDir . '/SubjectController.php', $subjectController);

echo "Controllers créés avec succès!";
