<?php

// Calcul de la racine : on remonte de .github/scripts/ vers la racine du projet
$root = realpath(__DIR__ . '/../../');

// Configuration : Dossier => Extensions autorisées
$config = [
    'site'     => ['html', 'php'],
    'site/img' => ['png', 'jpg', 'jpeg'],
    'site/css' => ['css'],
    'site/js'  => ['js'],
    'src'      => ['php']
];

$totalErrors = 0;

echo "=== VÉRIFICATION GLOBALE (STRUCTURE & CONTENU) ===" . PHP_EOL;
echo "📍 Racine : $root" . PHP_EOL . PHP_EOL;

foreach ($config as $folder => $allowedExtensions) {
    $fullPath = $root . '/' . $folder;

    // --- ÉTAPE 1 : VÉRIFICATION DE L'ARBORESCENCE ---
    if (!is_dir($fullPath)) {
        echo "❌ STRUCTURE : Dossier /$folder MANQUANT" . PHP_EOL;
        $totalErrors++;
        // Si le dossier manque, on ne peut pas vérifier ses fichiers, on passe au suivant
        continue; 
    }

    echo "✅ STRUCTURE : Dossier /$folder PRÉSENT" . PHP_EOL;

    // --- ÉTAPE 2 : VÉRIFICATION DES EXTENSIONS ---
    $files = scandir($fullPath);
    $folderClean = true;

    foreach ($files as $file) {
        // On ignore les dossiers systèmes, les sous-dossiers et le fichier .gitkeep
        if ($file === '.' || $file === '..' || is_dir($fullPath . '/' . $file) || $file === '.gitkeep') {
            continue;
        }

        $extension = strtolower(pathinfo($file, PATHINFO_EXTENSION));

        if (!in_array($extension, $allowedExtensions)) {
            echo "   ⚠️ EXTENSION : Fichier '$file' non autorisé dans /$folder" . PHP_EOL;
            echo "      (Attendu : " . implode(', ', $allowedExtensions) . ")" . PHP_EOL;
            $folderClean = false;
            $totalErrors++;
        }
    }

    if ($folderClean && count($files) > 2) { // > 2 car scandir compte toujours "." et ".."
        echo "   ✨ Contenu conforme." . PHP_EOL;
    }
}

echo PHP_EOL . "=== BILAN FINAL ===" . PHP_EOL;

if ($totalErrors > 0) {
    echo "❌ ÉCHEC : $totalErrors erreur(s) détectée(s). Vérifiez les logs ci-dessus." . PHP_EOL;
    exit(1); // Stop la Pull Request
}

echo "🚀 SUCCÈS : Arborescence et fichiers 100% conformes !" . PHP_EOL;
exit(0);