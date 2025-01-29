<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupérer et nettoyer les données du formulaire
    $name = htmlspecialchars($_POST['name'] ?? '');
    $prenom = htmlspecialchars($_POST['prenom'] ?? '');
    $pays = htmlspecialchars($_POST['pays'] ?? '');
    $email = htmlspecialchars($_POST['email'] ?? '');
    $ecran = htmlspecialchars($_POST['ecran'] ?? '');
    $utilisation = htmlspecialchars($_POST['utilisation'] ?? '');
    $boitier = htmlspecialchars($_POST['boitier'] ?? '');
    $requetes = htmlspecialchars($_POST['requetes'] ?? '');
    $timeline = htmlspecialchars($_POST['timeline'] ?? ''); 
    $service = htmlspecialchars($_POST['service'] ?? ''); 
    $refroidissement = htmlspecialchars($_POST['refroidissement'] ?? '');

    // Vérifier les champs obligatoires
    if (empty($name) || empty($prenom) || empty($email)) {
        echo "<p>Erreur : Tous les champs obligatoires ne sont pas remplis.</p>";
        exit;
    }

    // Créer le message
    $message = "Nom: $name\n";
    $message .= "Prénom: $prenom\n";
    $message .= "Pays: $pays\n";
    $message .= "Email: $email\n";
    $message .= "Écran: $ecran\n";
    $message .= "Utilisation: $utilisation\n";
    $message .= "Boîtier: $boitier\n";
    $message .= "Requêtes: $requetes\n";
    $message .= "Timeline: $timeline\n";
    $message .= "Prestation: $service\n";
    $message .= "Type de refroidissement: $refroidissement\n";
    $message = htmlspecialchars_decode($message);

    // Enregistrer dans un fichier
    $file = fopen("soumissions.txt", "a");
    if ($file) {
        fwrite($file, $message . "\n\n");
        fclose($file);
        echo "<p>Les données ont été enregistrées avec succès !</p>";
    } else {
        echo "<p>Erreur : Impossible d'ouvrir le fichier pour l'écriture.</p>";
    }

    // Envoyer un e-mail
    $to = "aquiris.pcgamer@gmail.com"; // Remplacez par votre adresse e-mail
    $subject = "Nouvelle soumission de formulaire";
    $headers = "From: https://faypse.github.io/"; // Adresse "From" (remplacez par un domaine valide)
    $email_message = "Bonjour,\n\nUne nouvelle soumission de formulaire a été reçue.\n\n" . $message;

    if (mail($to, $subject, $email_message, $headers)) {
        echo "<p>Un e-mail de notification a été envoyé avec succès.</p>";
    } else {
        echo "<p>Erreur lors de l'envoi de l'e-mail de notification.</p>";
    }
} else {
    echo "<p>Méthode de requête non autorisée.</p>";
}
?>
