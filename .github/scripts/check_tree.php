<?php
// On définit la racine du projet (deux niveaux au-dessus de .github/scripts/)
$root = dirname(__DIR__, 2); 

$requiredPaths = [
    'site',
    'site/img',
    'site/css',
    'site/js',
    'src'
];

$errors = 0;
echo "Analyse depuis la racine : $root" . PHP_EOL;

foreach ($requiredPaths as $path) {
    // On concatène la racine avec le chemin relatif
    if (is_dir($root . '/' . $path)) {
        echo "✅ " . $path . PHP_EOL;
    } else {
        echo "❌ " . $path . " (MANQUANT)" . PHP_EOL;
        $errors++;
    }
}

exit($errors > 0 ? 1 : 0);