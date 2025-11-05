<?php
/**
 * Test du modèle SubjectModel
 */

require_once __DIR__ . '/../vendor/autoload.php';

use SchoolAgent\Models\SubjectModel;

try {
    $subjectModel = new SubjectModel();
    $subjects = $subjectModel->getSubjects();
    
    echo "Subjects retournés: " . count($subjects) . "\n\n";
    
    foreach ($subjects as $subject) {
        echo "ID: {$subject['id_matiere']} | Nom: {$subject['nom']} | Agent: {$subject['id_agent']}\n";
    }
    
} catch (Exception $e) {
    echo "Erreur: " . $e->getMessage() . "\n";
    echo $e->getTraceAsString();
}
