<?php

// On remonte de deux niveaux pour atteindre la racine depuis .github/scripts/
$root = realpath(__DIR__ . '/../../');

// Configuration des dossiers et des extensions autorisées
$constraints = [
    'site'     => ['html', 'php'],
    'site/img' => ['png', 'jpg', 'jpeg'],
    'site/css' => ['css'],
    'site/js'  => ['js'],
    'src'      => ['php'] // Optionnel, mais recommandé pour src
];

$errors = 0;

echo "--- Début de la vérification avancée ---" . PHP_EOL;
echo "Racine du projet : $root" . PHP_EOL . PHP_EOL;

foreach ($constraints as $folder => $allowedExtensions) {
    $fullPath = $root . '/' . $folder;

    // 1. Vérification de l'existence du dossier
    if (!is_dir($fullPath)) {
        echo "❌ Dossier MANQUANT : $folder" . PHP_EOL;
        $errors++;
        continue;
    }

    echo "📂 Analyse de /$folder..." . PHP_EOL;

    // 2. Scan du contenu du dossier
    $files = scandir($fullPath);
    foreach ($files as $file) {
        // On ignore les dossiers système et les sous-répertoires
        if ($file === '.' || $file === '..' || is_dir($fullPath . '/' . $file)) {
            continue;
        }

        // On ignore les fichiers .gitkeep que nous avons ajoutés
        if ($file === '.gitkeep') {
            continue;
        }

        $extension = strtolower(pathinfo($file, PATHINFO_EXTENSION));

        // 3. Vérification de l'extension
        if (!in_array($extension, $allowedExtensions)) {
            echo "   ⚠️ FICHIER NON CONFORME : '$file' n'est pas autorisé dans /$folder." . PHP_EOL;
            echo "      (Attendu : " . implode(' ou ', $allowedExtensions) . ")" . PHP_EOL;
            $errors++;
        }
    }
}

echo PHP_EOL . "--- Résultat ---" . PHP_EOL;

if ($errors > 0) {
    echo "❌ ÉCHEC : $errors erreur(s) de structure ou de fichiers détectée(s)." . PHP_EOL;
    exit(1); // Crucial pour bloquer la Pull Request sur GitHub
}

echo "🚀 SUCCÈS : Tout est conforme !" . PHP_EOL;
exit(0);