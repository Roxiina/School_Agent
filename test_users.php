<?php
require_once 'vendor/autoload.php';
use SchoolAgent\Models\UserModel;

$userModel = new UserModel();
$users = $userModel->getUsers();

echo "=== UTILISATEURS DISPONIBLES ===\n";
foreach ($users as $user) {
    echo sprintf("ID: %d - %s %s (%s) - Email: %s\n", 
        $user['id_user'], 
        $user['prenom'], 
        $user['nom'], 
        $user['role'], 
        $user['email']
    );
}
echo "\n=== MOTS DE PASSE (depuis jeu_donne.txt) ===\n";
echo "Alice Dupont (etudiant): password1\n";
echo "Jean Martin (professeur): password2\n";
echo "Sophie Durand (admin): password3\n";