<?php
/**
 * Vérification de l'arborescence requise
 */

$requiredPaths = [
    'site',
    'site/img',
    'site/css',
    'site/js',
    'src'
];

$errors = 0;

echo "Analyse de l'arborescence..." . PHP_EOL;

foreach ($requiredPaths as $path) {
    if (is_dir(__DIR__ . '/' . $path)) {
        echo "✅ " . $path . PHP_EOL;
    } else {
        echo "❌ " . $path . " (MANQUANT)" . PHP_EOL;
        $errors++;
    }
}

if ($errors > 0) {
    echo PHP_EOL . "Résultat : Arborescence non conforme !" . PHP_EOL;
    exit(1); // Indique un échec à GitHub Actions
}

echo PHP_EOL . "Résultat : Arborescence parfaite." . PHP_EOL;
exit(0); // Indique un succès