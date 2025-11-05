<?php
/**
 * Test du contrôleur AgentsController
 */

require_once __DIR__ . '/../vendor/autoload.php';

use SchoolAgent\Models\AgentModel;
use SchoolAgent\Models\SubjectModel;

try {
    $agentModel = new AgentModel();
    $subjectModel = new SubjectModel();
    
    $agents = $agentModel->getAgents();
    $subjects = $subjectModel->getSubjects();
    
    echo "Agents: " . count($agents) . "\n";
    echo "Subjects: " . count($subjects) . "\n\n";
    
    // Créer une map agents par id
    $agentsById = [];
    foreach ($agents as $agent) {
        $agentsById[$agent['id_agent']] = $agent;
    }
    
    // Grouper les agents par matière
    $agentsBySubject = [];
    foreach ($subjects as $subject) {
        $agentsBySubject[$subject['id_matiere']] = [
            'name' => $subject['nom'],
            'agents' => []
        ];
        
        // Ajouter l'agent associé à cette matière
        $agentId = $subject['id_agent'] ?? null;
        if ($agentId && isset($agentsById[$agentId])) {
            $agentsBySubject[$subject['id_matiere']]['agents'][] = $agentsById[$agentId];
        }
    }
    
    echo "=== Résultat final ===\n";
    foreach ($agentsBySubject as $subjectId => $data) {
        echo "{$data['name']}: " . count($data['agents']) . " agent(s)\n";
        foreach ($data['agents'] as $agent) {
            echo "  - {$agent['nom']}\n";
        }
    }
    
} catch (Exception $e) {
    echo "Erreur: " . $e->getMessage() . "\n";
    echo $e->getTraceAsString();
}
