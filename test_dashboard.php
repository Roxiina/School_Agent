<?php
require_once 'vendor/autoload.php';
use SchoolAgent\Models\ConversationModel;
use SchoolAgent\Models\SubjectModel;

echo "=== TEST DASHBOARD ETUDIANT ===" . PHP_EOL . PHP_EOL;

$convModel = new ConversationModel();
$conversations = $convModel->getConversationsByUser(1);

echo "=== CONVERSATIONS DE L'UTILISATEUR 1 ===" . PHP_EOL;
echo "Nombre: " . count($conversations) . PHP_EOL;
if (count($conversations) > 0) {
    foreach ($conversations as $conv) {
        echo "- " . $conv['titre'] . " (Agent: " . $conv['agent_nom'] . ")" . PHP_EOL;
    }
} else {
    echo "Aucune conversation trouvée" . PHP_EOL;
}

echo PHP_EOL . "=== MATIERES AVEC AGENTS ===" . PHP_EOL;
$subjectModel = new SubjectModel();
$subjects = $subjectModel->getSubjectsWithAgents();
echo "Nombre de matières: " . count($subjects) . PHP_EOL;
if (count($subjects) > 0) {
    foreach ($subjects as $s) {
        echo "- " . $s['matiere_nom'] . " (Agent: " . $s['agent_nom'] . ")" . PHP_EOL;
    }
} else {
    echo "Aucune matière trouvée" . PHP_EOL;
}
