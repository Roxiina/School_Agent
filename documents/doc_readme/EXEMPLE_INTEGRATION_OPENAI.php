<?php
/**
 * 🔌 EXEMPLE D'INTÉGRATION OPENAI
 * 
 * Cet exemple montre comment intégrer OpenAI au système de chat
 * Une fois que vous serez prêt, suivez ces étapes :
 * 
 * 1. Installer : composer require openai-php/client
 * 2. Copier le code sendMessage() ci-dessous
 * 3. Ajouter votre clé API OpenAI à .env
 * 4. Tester !
 */

// ============================================================
// EXEMPLE 1 : sendMessage() avec intégration OpenAI
// ============================================================

/*
namespace SchoolAgent\Controllers;

use SchoolAgent\Models\ConversationModel;
use SchoolAgent\Models\MessageModel;
use SchoolAgent\Models\AgentModel;
use SchoolAgent\Config\Authenticator;
use OpenAI\Client;

class ConversationController
{
    private $openaiClient;

    public function __construct()
    {
        $this->model = new ConversationModel();
        $this->messageModel = new MessageModel();
        $this->agentModel = new AgentModel();
        
        // Initialiser le client OpenAI
        $apiKey = $_ENV['OPENAI_API_KEY'] ?? getenv('OPENAI_API_KEY');
        if ($apiKey) {
            $this->openaiClient = new Client(['api_key' => $apiKey]);
        }
    }

    // Envoyer un message via AJAX
    public function sendMessage()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            http_response_code(400);
            echo json_encode(['error' => 'Méthode non autorisée']);
            exit;
        }

        Authenticator::requireLogin();

        $data = json_decode(file_get_contents('php://input'), true);
        
        if (!isset($data['conversation_id']) || !isset($data['question'])) {
            http_response_code(400);
            echo json_encode(['error' => 'Données manquantes']);
            exit;
        }

        // Récupérer la conversation
        $conversation = $this->model->getConversation($data['conversation_id']);
        if (!$conversation) {
            http_response_code(404);
            echo json_encode(['error' => 'Conversation introuvable']);
            exit;
        }

        // Vérifier l'autorisation
        if ($conversation['id_user'] != Authenticator::getUserId()) {
            http_response_code(403);
            echo json_encode(['error' => 'Accès refusé']);
            exit;
        }

        // Récupérer l'agent
        $agent = $this->agentModel->getAgent($conversation['id_agent']);
        $question = htmlspecialchars(trim($data['question']));

        try {
            // Appel API OpenAI
            if (!$this->openaiClient) {
                throw new \Exception('Clé API OpenAI non configurée');
            }

            $response = $this->openaiClient->chat()->create([
                'model' => 'gpt-3.5-turbo', // ou 'gpt-4' pour plus de qualité
                'messages' => [
                    [
                        'role' => 'system',
                        'content' => $agent['system_prompt'] ?? 
                            'Tu es un assistant pédagogique bienveillant.'
                    ],
                    [
                        'role' => 'user',
                        'content' => $question
                    ]
                ],
                'temperature' => floatval($agent['temperature'] ?? 0.7),
                'max_tokens' => 1000
            ]);

            // Extraire la réponse
            $reponse = $response->choices[0]->message->content;

        } catch (\Exception $e) {
            // En cas d'erreur, utiliser une réponse par défaut
            error_log('OpenAI Error: ' . $e->getMessage());
            $reponse = 'Désolé, une erreur est survenue. Veuillez réessayer.';
        }

        // Sauvegarder le message
        $messageData = [
            'question' => $question,
            'reponse' => $reponse,
            'id_conversation' => $data['conversation_id']
        ];
        $this->messageModel->createMessage($messageData);

        // Retourner la réponse
        header('Content-Type: application/json');
        echo json_encode([
            'success' => true,
            'message' => [
                'question' => $question,
                'reponse' => $reponse
            ]
        ]);
        exit;
    }
}
*/

// ============================================================
// EXEMPLE 2 : Avec streaming (réponse progressive)
// ============================================================

/*
public function sendMessageWithStreaming()
{
    // ... même validation que ci-dessus ...

    try {
        header('Content-Type: text/event-stream');
        header('Cache-Control: no-cache');
        header('Connection: keep-alive');

        $stream = $this->openaiClient->chat()->createStreamed([
            'model' => 'gpt-3.5-turbo',
            'messages' => [
                ['role' => 'system', 'content' => $agent['system_prompt']],
                ['role' => 'user', 'content' => $question]
            ],
            'temperature' => $agent['temperature']
        ]);

        $fullResponse = '';

        foreach ($stream as $response) {
            $content = $response->choices[0]->delta->content ?? '';
            echo "data: " . json_encode(['content' => $content]) . "\n\n";
            flush();
            $fullResponse .= $content;
        }

        // Sauvegarder après réception complète
        $messageData = [
            'question' => $question,
            'reponse' => $fullResponse,
            'id_conversation' => $data['conversation_id']
        ];
        $this->messageModel->createMessage($messageData);

    } catch (\Exception $e) {
        echo "data: " . json_encode(['error' => $e->getMessage()]) . "\n\n";
        flush();
    }

    exit;
}
*/

// ============================================================
// ÉTAPE 1 : Installation
// ============================================================

/*
INSTALLATION :
--------------

1. Ouvrir terminal dans le dossier du projet
2. Exécuter :
   
   composer require openai-php/client

3. Vérifier l'installation :
   
   composer show | grep openai

*/

// ============================================================
// ÉTAPE 2 : Configuration .env
// ============================================================

/*
FILE: .env (ou variables d'environnement système)
---------------------------------------------------

# Clé API OpenAI (obtenir sur https://platform.openai.com/api-keys)
OPENAI_API_KEY=sk-xxxxxxxxxxxxxxxxxxxxxxxxxxxxxx

# Modèle utilisé
OPENAI_MODEL=gpt-3.5-turbo
# ou gpt-4 pour meilleure qualité

# Température (0.0 à 2.0)
# - 0.0 = réponses déterministes
# - 1.0 = équilibre
# - 2.0 = créatif
OPENAI_TEMPERATURE=0.7
*/

// ============================================================
// ÉTAPE 3 : Charger les variables d'environnement
// ============================================================

/*
FILE: public/index.php (au début)
-----------------------------------

require_once __DIR__ . '/../vendor/autoload.php';

// Charger les variables d'environnement
if (file_exists(__DIR__ . '/../.env')) {
    $dotenv = \Dotenv\Dotenv::createImmutable(__DIR__ . '/..');
    $dotenv->load();
}
*/

// ============================================================
// ÉTAPE 4 : Tester l'intégration
// ============================================================

/*
TESTS :
-------

1. Créer une conversation
2. Envoyer un message
3. Vérifier la réponse OpenAI
4. Vérifier qu'elle est sauvegardée en DB

Erreurs courantes :
- Clé API invalide → Vérifier la clé sur OpenAI
- Clé API manquante → Ajouter au .env
- Rate limit → Attendre quelques secondes
- Model non trouvé → Utiliser gpt-3.5-turbo ou gpt-4
*/

// ============================================================
// EXEMPLE 5 : Gestion des erreurs avancée
// ============================================================

/*
try {
    $response = $this->openaiClient->chat()->create([...]);
    
} catch (\OpenAI\Exceptions\AuthenticationException $e) {
    $reponse = 'Erreur d\'authentification OpenAI. Clé API invalide ?';
    error_log('Auth Error: ' . $e->getMessage());
    
} catch (\OpenAI\Exceptions\RateLimitException $e) {
    $reponse = 'Trop de requêtes. Veuillez réessayer dans quelques instants.';
    error_log('Rate Limit: ' . $e->getMessage());
    
} catch (\OpenAI\Exceptions\ServerException $e) {
    $reponse = 'Serveur OpenAI indisponible. Réessayez plus tard.';
    error_log('Server Error: ' . $e->getMessage());
    
} catch (\Exception $e) {
    $reponse = 'Une erreur est survenue.';
    error_log('General Error: ' . $e->getMessage());
}
*/

// ============================================================
// RESSOURCES UTILES
// ============================================================

/*
Documentation OpenAI PHP :
- https://github.com/openai-php/client
- https://platform.openai.com/docs/api-reference

Pricing :
- gpt-3.5-turbo : $0.0005 pour 1000 tokens
- gpt-4 : $0.03 pour 1000 tokens (input)

Modèles disponibles :
- gpt-3.5-turbo (rapide, pas cher)
- gpt-4 (meilleur, plus cher)
- gpt-4-turbo (rapide et bon)
*/

// ============================================================
// CHECKLIST AVANT PRODUCTION
// ============================================================

/*
□ Package openai-php/client installé
□ Clé API OpenAI obtenue et sécurisée
□ Variables .env configurées
□ Gestion d'erreurs implémentée
□ Logs d'erreur configurés
□ Limite de tokens configurée
□ Tests effectués
□ Monitoring mis en place
□ Tarification OpenAI comprise
□ Budget défini et alertes activées
*/

// ============================================================
// TROUBLESHOOTING
// ============================================================

/*
Q: Comment obtenir une clé API OpenAI ?
A: 1. Créer un compte sur https://platform.openai.com
   2. Aller dans Settings → API Keys
   3. Créer une nouvelle clé
   4. Garder la secrète (jamais commit en git !)

Q: Quelle est la différence entre gpt-3.5-turbo et gpt-4 ?
A: gpt-4 est plus intelligent mais plus lent et cher
   gpt-3.5-turbo : 0.0005$/1k tokens
   gpt-4 : 0.03$/1k tokens

Q: Comment réduire le coût ?
A: - Limiter max_tokens
   - Utiliser gpt-3.5-turbo
   - Implémenter un cache

Q: Que faire si je dépasse le budget ?
A: Aller sur https://platform.openai.com/account/billing/limits
   et fixer une limite de dépense

Q: Comment ajouter du streaming ?
A: Utiliser createStreamed() au lieu de create()
   Puis boucler sur les chunks reçus
*/

?>

<!-- 
    ========================================================
    EXEMPLE D'UTILISATION EN JAVASCRIPT (côté client)
    ========================================================
-->

<script>
// Envoyer un message avec réponse simple
async function sendMessage() {
    const response = await fetch('?page=conversation/send-message', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({
            conversation_id: conversationId,
            question: "Quelle est la capitale de la France ?"
        })
    });

    const data = await response.json();
    console.log('Réponse IA:', data.message.reponse);
}

// Envoyer un message avec streaming
async function sendMessageWithStreaming() {
    const eventSource = new EventSource(
        `?page=conversation/send-message&conversation_id=${conversationId}&question=test`
    );

    eventSource.onmessage = (event) => {
        const data = JSON.parse(event.data);
        if (data.content) {
            // Ajouter le content progressivement
            console.log(data.content);
        }
    };

    eventSource.onerror = () => {
        console.error('Erreur streaming');
        eventSource.close();
    };
}
</script>

<!-- 
    ========================================================
    NOTES IMPORTANTES
    ========================================================
    
    1. SÉCURITÉ
       - Jamais commit la clé API en git
       - Utiliser .env ou variables d'environnement
       - Valider toujours les entrées utilisateur
       - Limiter le max_tokens
    
    2. PERFORMANCE
       - Les requêtes OpenAI prennent 1-5 secondes
       - Implémenter un timeout
       - Utiliser des images de chargement
       - Envisager le caching
    
    3. MONITORING
       - Logger toutes les erreurs
       - Surveiller les coûts
       - Alerter si dépassement budget
       - Analyser les réponses
    
    4. MAINTENANCE
       - Vérifier régulièrement les mises à jour
       - Tester les nouvelles versions
       - Mettre à jour la doc
       - Former l'équipe
-->
