<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>MediBooking - Accueil</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
        }
        .hero {
            background-color: #0d6efd;
            color: white;
            padding: 80px 0;
        }
        .feature-box {
            background-color: #e7f1ff;
            border-radius: 12px;
            padding: 30px;
            height: 100%;
        }
        .feature-box i {
            font-size: 2rem;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>

<!-- Barre de navigation -->
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container">
        <a class="navbar-brand" href="index.php" style="font-size: x-large;">MediBooking</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" 
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a class="nav-link" href="views/login.php">Connexion</a></li>
                <li class="nav-item"><a class="nav-link" href="views/signup.php">Créer un compte</a></li>
            </ul>
        </div>
    </div>
</nav>


<!-- Section d'en-tête -->
<section class="hero text-center">
    <div class="container">
        <h1 class="display-4 fw-bold">Votre santé, notre priorité</h1>
        <p class="lead mt-3">Prenez vos rendez-vous médicaux en toute simplicité.</p>
        <a href="views/signup.php" class="btn btn-light btn-lg mt-3">Commencer</a>
    </div>
</section>

<!-- Section des fonctionnalités -->
<section class="container my-5">
    <div class="row text-center g-4">
        <div class="col-md-4">
            <div class="feature-box shadow-sm">
                <i class="bi bi-person-fill text-primary"></i>
                <h4 class="text-primary">Patients</h4>
                <p>Trouvez un médecin et réservez vos consultations en quelques clics. Accédez à vos dossiers médicaux en toute sécurité.</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="feature-box shadow-sm">
                <i class="bi bi-heart-pulse text-primary"></i>
                <h4 class="text-primary">Médecins</h4>
                <p>Gérez vos disponibilités, confirmez les rendez-vous et accédez aux dossiers des patients facilement.</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="feature-box shadow-sm">
                <i class="bi bi-shield-lock-fill text-primary"></i>
                <h4 class="text-primary">Administrateurs</h4>
                <p>Supervisez la plateforme, gérez les utilisateurs et assurez un bon fonctionnement du système.</p>
            </div>
        </div>
    </div>
</section>

<!-- Pied de page -->
<footer class="bg-primary text-white text-center py-3">
    <p class="mb-0">&copy; 2025 MediBooking. Tous droits réservés.</p>
</footer>

<!-- JS Bootstrap -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
