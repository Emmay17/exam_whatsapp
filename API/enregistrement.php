<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "WB2"; // Remplacez par le nom de votre base de données
$port = 3307; // Si vous utilisez un port non standard, par exemple 3307

// Créer une connexion
$conn = new mysqli($servername, $username, $password, $dbname, $port);

// Vérifier la connexion
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Traitement du formulaire
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Vérifiez que les champs sont bien remplis
    if (isset($_POST['numero']) && isset($_POST['nom_utilisateur']) && isset($_POST['about']) && isset($_POST['mot_de_passe']) && isset($_FILES['photo'])) {
        $numero = $_POST['numero'];
        $nom_utilisateur = $_POST['nom_utilisateur'];
        $about = $_POST['about'];
        $mot_de_passe = password_hash($_POST['mot_de_passe'], PASSWORD_BCRYPT);

        // Gestion de l'upload de la photo
        $target_dir = "../IMAGES/";
        $target_file = $target_dir . basename($_FILES["photo"]["name"]);
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Vérifier si le fichier est une image
        $check = getimagesize($_FILES["photo"]["tmp_name"]);
        if ($check === false) {
            die("Le fichier n'est pas une image.");
        }

        // Autoriser certains formats de fichier
        $extensions_autorisees = array("jpg", "jpeg", "png", "gif");
        if (!in_array($imageFileType, $extensions_autorisees)) {
            die("Désolé, seuls les fichiers JPG, JPEG, PNG & GIF sont autorisés.");
        }

        // Vérifier les permissions du répertoire
        if (!is_writable($target_dir)) {
            die("Le répertoire de destination n'est pas accessible en écriture.");
        }

        // Déplacer le fichier téléchargé vers le répertoire de destination
        if (move_uploaded_file($_FILES["photo"]["tmp_name"], $target_file)) {
            // Préparer la requête SQL
            $stmt = $conn->prepare("INSERT INTO utilisateur (numero_telephone, nom_utilisateur, date_enregistrement, about, photo, mot_de_passe) VALUES (?, ?, NOW(), ?, ?, ?)");
            $stmt->bind_param("sssss", $numero, $nom_utilisateur, $about, $target_file, $mot_de_passe);
        
            if ($stmt->execute() === TRUE) {
                echo "Enregistrement réussi.";
            } else {
                echo "Erreur: " . $stmt->error;
            }
        
            // Fermer la déclaration
            $stmt->close();
        } else {
            echo "Désolé, une erreur s'est produite lors du téléchargement de votre fichier.";
        }
        
    } else {
        echo "Veuillez remplir tous les champs du formulaire.";
    }
}

$conn->close();
?>
