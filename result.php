<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Résultat PHP</title>
</head>
<body>
    <?php
        $nom = isset($_GET['nom']) ? $_GET['nom'] : '';
        $nomMajuscule = mb_strtoupper($nom, 'UTF-8');
    ?>
    <h1 id="displayName"><?php echo htmlspecialchars($nomMajuscule); ?></h1>
    
    <a href="index.php">Retour</a>
</body>
</html>