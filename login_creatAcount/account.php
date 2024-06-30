<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Vérifier si les champs obligatoires sont vides
    if (empty($_FILES["photo"]["tmp_name"]) || empty($_POST["phone"]) || empty($_POST["name"]) || empty($_POST["password"])) {
        header("Location: ../login_creatAccount/index.php?message=er");
        exit;
    }

    // Récupérer les données du formulaire
    $phone_number = $_POST["phone"];
    $name = $_POST["name"];
    $password = $_POST["password"];
    $confirm_password = $_POST["confirm_password"];

    // Vérifier si les mots de passe correspondent
    if ($password !== $confirm_password) {
        header("Location: creatAccount.php?message=password_mismatch");
        exit;
    }

    // Gérer le téléchargement de l'image
    $target_directory = "../uploads/";
    $target_file = $target_directory . basename($_FILES["photo"]["name"]);
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Générer un nom unique pour l'image
    $new_image_name = $phone_number . '_' . date("Ymd_His") . '.' . $imageFileType;
    $target_path = $target_directory . $new_image_name;

    // Déplacer le fichier téléchargé vers le répertoire cible
    if (!move_uploaded_file($_FILES["photo"]["tmp_name"], $target_path)) {
        $upload_error = $_FILES["photo"]["error"];
    echo "Upload Error: " . $upload_error;
        // header("Location: creatAccount.php?message=upload_error");
        exit;
    }

    // Connexion à la base de données (à adapter selon votre configuration)
    $con = new mysqli("localhost", "root", "", "projet_exam");

    // Vérifier la connexion
    if ($con->connect_error) {
        die("Connection failed: " . $con->connect_error);
    }

    // Échapper les variables pour l'insertion (à des fins d'illustration seulement, non sécurisé)
    $phone_number = $con->real_escape_string($phone_number);
    $name = $con->real_escape_string($name);
    $password = $con->real_escape_string($password);
    $new_image_name = $con->real_escape_string($new_image_name);

    // Préparer et exécuter la requête d'insertion
    $sql = "INSERT INTO users (phone_number, names, photo, created_at, mdp) VALUES ('$phone_number', '$name', '$new_image_name', NOW(), '$password')";

    if ($con->query($sql) === TRUE) {
        header("Location: creatAccount.php?message=ok");
    } else {
        header("Location: creatAccount.php?message=error");
    }

    $con->close();
    exit;
}
?>
