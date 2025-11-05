<?php

namespace SchoolAgent\Controllers\Front;

use SchoolAgent\Models\AgentModel;
use SchoolAgent\Models\SubjectModel;
use SchoolAgent\Config\Authenticator;

class AgentsController
{
    private AgentModel $agentModel;
    private SubjectModel $subjectModel;

    public function __construct()
    {
        $this->agentModel = new AgentModel();
        $this->subjectModel = new SubjectModel();
    }

    /**
     * Affiche tous les agents groupés par matière
     */
    public function index()
    {
        // Descriptions personnalisées pour chaque matière
        $subjectDescriptions = [
            'Mathématiques' => 'Résolvez vos problèmes de calcul, d\'algèbre et de géométrie avec un agent expert en mathématiques. Parfait pour comprendre les concepts complexes et préparer vos examens.',
            'Français' => 'Améliorez votre français avec un agent spécialisé. Analyse de textes, grammaire, conjugaison, littérature - tout ce dont vous avez besoin pour maîtriser la langue.',
            'Sciences' => 'Explorez le monde des sciences avec un agent expert. Physique, chimie, biologie - des explications claires pour comprendre les phénomènes naturels.',
            'Anglais' => 'Progressez en anglais avec un agent dédié à la langue. Vocabulaire, grammaire, prononciation et compréhension - pour devenir bilingue!',
            'Informatique' => 'Apprenez l\'informatique de manière progressive. Du code à la théorie, un agent expert pour vous guider dans vos apprentissages numériques.',
            'Méthodologie' => 'Maîtrisez les techniques d\'apprentissage efficace et l\'organisation du travail scolaire.',
            'Histoire' => 'Plongez dans l\'histoire avec un agent expert pour comprendre les événements qui ont façonné notre monde.',
        ];
        
        // Récupérer tous les agents
        $agents = $this->agentModel->getAgents();
        
        // Récupérer toutes les matières
        $subjects = $this->subjectModel->getSubjects();
        
        // Créer une map agents par id
        $agentsById = [];
        foreach ($agents as $agent) {
            $agentsById[$agent['id_agent']] = $agent;
        }
        
        // Grouper les agents par matière
        $agentsBySubject = [];
        foreach ($subjects as $subject) {
            // Inclure toutes les matières (y compris Histoire)
            $agentsBySubject[$subject['id_matiere']] = [
                'name' => $subject['nom'],
                'description' => $subject['description'] ?? '',
                'why_use' => $subjectDescriptions[$subject['nom']] ?? 'Un agent expert pour vous accompagner dans votre apprentissage de cette matière.',
                'agents' => []
            ];
            
            // Ajouter l'agent associé à cette matière
            $agentId = $subject['id_agent'] ?? null;
            if ($agentId && isset($agentsById[$agentId])) {
                $agentsBySubject[$subject['id_matiere']]['agents'][] = $agentsById[$agentId];
            }
        }
        
        // Récupérer l'utilisateur connecté
        $isLogged = Authenticator::isLogged();
        $user = [];
        if ($isLogged) {
            $userId = Authenticator::getUserId();
            // Vous devriez récupérer les données de l'utilisateur ici si nécessaire
        }
        
        // Charger la vue
        require_once __DIR__ . '/../../Views/front/agents.php';
    }
}
