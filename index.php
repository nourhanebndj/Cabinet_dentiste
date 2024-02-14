<?php
session_start(); // Ajout de session_start() pour démarrer la session

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "cabinet"; // Remplacez "cabinet" par le nom de votre base de données

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("La connexion à la base de données a échoué : " . $conn->connect_error);
}
$sql = "SELECT * FROM avis";
$result = $conn->query($sql);

$avis = array();
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $avis[] = $row;
    }
}
?>

<?php
function submitRating()
{
    global $conn; // Récupérez la connexion à la base de données
    if (isset($_POST['submit'])) {
        // Vérifier si l'utilisateur a déjà soumis un avis en vérifiant la variable de session

        $nom = $_POST['nom'];
        $message = $_POST['message'];
        $rating = $_POST['rating'];
        $date = $_POST['date'];

        // Vérifiez si les champs sont remplis
        if (!empty($nom) && !empty($message) && !empty($rating) && !empty($date)) {
            // Échappez les données pour éviter les failles d'injection SQL
            $nom = mysqli_real_escape_string($conn, $nom);
            $message = mysqli_real_escape_string($conn, $message);
            $rating = intval($rating); // Assurez-vous que le rating est un entier

            // Convert the date to the proper format (YYYY-MM-DD) using DateTime class
            $formattedDate = date('Y-m-d', strtotime($date));

            // Insérez l'avis dans la table "avis"
            $sql = "INSERT INTO avis (nom, rating, text, date) VALUES ('$nom', '$rating', '$message', '$formattedDate')";
            if ($conn->query($sql) === TRUE) {
                // L'avis a été inséré avec succès
                echo '<div class="success">Merci pour votre avis !</div>';
                // Définir la variable de session pour indiquer que l'utilisateur a soumis un avis
                $_SESSION['has_submitted_review'] = true;
            } else {
                // Une erreur s'est produite lors de l'insertion de l'avis
                echo '<div class="error">Une erreur s\'est produite. Veuillez réessayer plus tard.</div>';
            }
        } else {
            // Affichez un message si tous les champs ne sont pas remplis
            echo '<div class="error">Veuillez remplir tous les champs du formulaire.</div>';
        }
    }
}


?>
<!DOCTYPE html>
<html>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width,initial-scale=1.0">
<title>Cabinet dentaire</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<link rel="stylesheet" href="style.css">
<link rel="stylesheet" href="script.js">
</head>

<body>
    <header class="header fixed-top">
        <div class="container">
            <div class="row align-items-center justify-content-between">
                <a href="index.php" class="logo">Cabinet<span>Soin.</span></a>
                <nav class="nav">
                    <a href="#C:\Users\nourh\Downloads\Bureau\dentiste cabinet\pages\index.php">Acceuil</a>
                    <a href="about_us.html">A propos</a>
                    <a href="#services">Service</a>
                    <a href="#contact">avis</a>

                </nav>
                <a href="reservation.php" class="link-btn">Reservation</a>

            </div>
        </div>
    </header>
    <section class="announcement-container">
        <div class="announcement-slider" id="announcementSlider">
            <div class="announcement">Annonce:Ouverture:9h-14h.</div>
        </div>
    </section>
    <section class="home" id="home">
        <div class="container">
            <div class="row min-vh-100 align-items-center">
                <div class="content">
                    <h3>let us brithen your smile</h3>
                    <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Neque, ipsum eveniet? Voluptate
                        veniam,
                        nulla praesentium iure earum placeat repellendus dolorem aliquam ipsam sequi molestias
                        facilis
                        autem blanditiis maiores nostrum qui.</p>
                    <a href="#contact" class="link-btn">Votre avis</a>
                </div>
            </div>
        </div>
    </section>
    <section class="about" id="#about">
        <div class="container1">
            <div class="row align-items-center">
                <div class="col-md-6 image">
                    <img src="/pages\image\exercices-reeducation-epaule.jpg" class="w-50 mb-4 mb-md-0" alt="">
                    <span>A propos de nous</span>
                    <h3>True healthcare for your family</h3>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Debitis praesentium voluptatem
                        consequuntur saepe excepturi eveniet delectus reiciendis nisi ratione cum magnam, quo nobis
                        amet? Ut deserunt soluta at odit alias!</p>
                    <a href="about_us.html" class="link-btn1">A propos de nous</a>
                </div>
            </div>
    </section>
    <section class="services" id="services">
        <h1 class="heading">Notre Services</h1>
        <div class="box-container">
            <div class="box">
                <img src="/pages\image\Sans titre.png" alt="">
                <a>Alignement specialiste</a>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Ea optio magnam nisi laboriosam quisquam
                    consectetur maiores repudiandae facilis? Voluptatum pariatur explicabo commodi nulla aliquam
                    vitae
                    reiciendis omnis necessitatibus, iure ipsa?</p>
            </div>
            <div class="box">
                <img src="/pages\image\Sans titre.png" alt="">
                <a>Alignement specialiste</a>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Ea optio magnam nisi laboriosam quisquam
                    consectetur maiores repudiandae facilis? Voluptatum pariatur explicabo commodi nulla aliquam
                    vitae
                    reiciendis omnis necessitatibus, iure ipsa?</p>
            </div>
            <div class="box">
                <img src="/pages\image\Sans titre.png" alt="">
                <a>Alignement specialiste</a>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Ea optio magnam nisi laboriosam quisquam
                    consectetur maiores repudiandae facilis? Voluptatum pariatur explicabo commodi nulla aliquam
                    vitae
                    reiciendis omnis necessitatibus, iure ipsa?</p>
            </div>
        </div>
    </section>
    <!-- Votre code HTML pour la section "Client Satisfait" -->
    <section class="reviews" id="vues">
        <h1 class="heading">Client Satisfait</h1>
        <div class="box-container">
            <?php foreach ($avis as $avis_item): ?>
            <div class="box1">
                <!-- Vous pouvez utiliser une image par défaut ou spécifier une image pour chaque avis dans la table `avis` -->
                <img src="/pages\image\icone parsonne.png" alt="Image du client">
                <p><?php echo $avis_item['text']; ?></p>
                <div class="stars">
                    <?php for ($i = 1; $i <= 5; $i++): ?>
                    <?php if ($i <= intval($avis_item['rating'])): ?>
                    <i class="fas fa-star"></i>
                    <?php else: ?>
                    <i class="far fa-star"></i>
                    <?php endif; ?>
                    <?php endfor; ?>
                </div>
                <h3><?php echo $avis_item['nom']; ?></h3>
                <h3><?php echo $avis_item['date']; ?></h3>
            </div>
            <?php endforeach; ?>
        </div>
    </section>

    <!-- Votre code HTML pour la section "Votre Avis" -->
    <section class="contact" id="contact">
        <h1 class="heading">Votre Avis</h1>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <!-- Votre code pour le champ du nom et du message d'avis -->
            <span>Votre Nom</span>
            <input type="text" name="nom" placeholder="entrer votre nom" class="box">
            <span>Votre Avis</span>
            <input type="text" name="message" placeholder="entrer votre avis" class="box">
            <span>date</span>
            <input type="date" name="date" class="box">

            <!-- Code pour les étoiles -->
            <div class="rating">
                <input type="radio" id="star5" name="rating" value="5"><label for="star5"></label>
                <input type="radio" id="star4" name="rating" value="4"><label for="star4"></label>
                <input type="radio" id="star3" name="rating" value="3"><label for="star3"></label>
                <input type="radio" id="star2" name="rating" value="2"><label for="star2"></label>
                <input type="radio" id="star1" name="rating" value="1"><label for="star1"></label>
            </div>

            <!-- Votre code pour le bouton "Soumettre" -->
            <input type="submit" name="submit" value="votre avis" class="link-btn">
        </form>
        <div id="message">
            <?php
        // Appeler la fonction submitRating pour traiter l'avis soumis
        submitRating();
        ?>
        </div>
    </section>

</body>

</html>