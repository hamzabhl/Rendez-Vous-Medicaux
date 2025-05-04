<?php
include_once '../../services/UserService.php';
include_once '../../services/PatientService.php';
session_start();
if (!isset($_SESSION['user']) || $_SESSION['role'] !== 'patient') {
    header('Location: ../../index.php');
}
$user = $_SESSION['user'];
?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Accueil Patient - MediPlateforme</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        <style>
            body {
                background-color: #f4f9ff;
            }
            .nav-link.active {
                font-weight: bold;
                color: #fff !important;
                background-color: #003d80;
                border-left: 4px solid #ffc107;
            }
            .nav-link.sub {
                padding-left: 32px;
                font-size: 0.95rem;
            }
            .nav-link.sub:hover {
                background-color: #004b99;
            }
            .content-section {
                display: none;
            }
            .content-section.active {
                display: block;
            }
            .sidebar {
                min-height: 100vh;
                background-color: #0d6efd;
                color: white;
            }
            .sidebar .nav-link {
                color: white;
                padding: 12px 16px;
                cursor: pointer;
            }
            .sidebar .nav-link:hover {
                background-color: #0b5ed7;
            }
            .submenu {
                display: none;
            }
            .submenu.show {
                display: block;
            }
            .form-control {
                font-size: 0.85rem;
                padding: 0.25rem 0.4rem;
            }
            .forgot-link {
                font-size: 0.875rem;
                display: inline-block;
                margin-top: -10px;
                margin-bottom: 15px;
            }
        </style>
    </head>
    <body>
        <div class="container-fluid">
            <div class="row">
                <!-- Vertical Navbar -->
                <nav class="col-md-3 col-lg-2 d-md-block sidebar py-4">
                    <h4 class="text-center mb-4">MediPlateforme</h4>
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link active" href="#" onclick="showSection('accueil', event)">Accueil</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#" onclick="showSection('rendezvous', event)">Mes Rendez-vous</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" onclick="toggleSubmenu(event)">Mon Profil</a>
                            <ul class="nav flex-column ms-3 submenu">
                                <li class="nav-item">
                                    <a class="nav-link sub" href="#" onclick="showSection('editInfos', event)">Modifier mes infos</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link sub" href="#" onclick="showSection('changePassword', event)">Changer le mot de passe</a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link sub" href="../../controller/logout.php">Se déconnecter</a>
                        </li>
                    </ul>
                </nav>

                <!-- Main Content -->
                <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 py-4">
                    <div id="accueil" class="content-section active">
                        <h2>Bienvenue </h2>
                        <p>Gérez vos rendez-vous, consultez les médecins, mettez à jour votre profil...</p>
                        <div class="input-group mt-4 mb-3 w-75">
                            <input type="text" class="form-control" placeholder="Rechercher un médecin ou une spécialité..." aria-label="Rechercher" aria-describedby="search-button">
                            <button class="btn btn-outline-primary" type="button" id="search-button">
                                <a href="../../controller/searchMedecins.php">Rechercher</a>
                            </button>
                        </div>
                    </div>

                    <div id="rendezvous" class="content-section">
                        <h2>Mes Rendez-vous</h2>
                        <p>Ici s'afficheront les rendez-vous planifiés.</p>
                    </div>

                    <div id="profil" class="content-section">
                        <h2>Mon Profil</h2>
                        <p>Choisissez une option dans le menu pour modifier vos informations ou changer votre mot de passe.</p>
                    </div>

                    <div id="editInfos" class="content-section">

                        <div class="card shadow-sm mb-5">
                            <div class="card-header bg-black text-white">
                                <h2 class="mb-0">Mes Informations Personnelles</h2>
                            </div>
                            <div class="card-body">
                                <div class="row mb-3">
                                    <div class="col-md-6"><strong>Nom:</strong> <?= htmlspecialchars($user->getNom()) ?></div>
                                    <div class="col-md-6"><strong>Prénom:</strong> <?= htmlspecialchars($user->getPrenom()) ?></div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-6"><strong>Email:</strong> <?= htmlspecialchars($user->getEmail()) ?></div>
                                    <div class="col-md-6"><strong>Téléphone:</strong> <?= htmlspecialchars($user->getTelephone()) ?></div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-6"><strong>CIN:</strong> <?= htmlspecialchars($user->getCin()) ?></div>
                                    <div class="col-md-6"><strong>Sexe:</strong> <?= htmlspecialchars($user->getSexe()) ?></div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-6"><strong>Date de naissance:</strong> <?= htmlspecialchars($user->getDateNaissance()) ?></div>
                                </div>
                            </div>
                        </div>

                        <h2>Modifier mes informations</h2>
                        <form id="profileForm" class="mt-4" method="post" action="../../controller/updatePatient.php">
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="nom" class="form-label">Nom</label>
                                    <input type="text" class="form-control" id="nom" name="nom" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="prenom" class="form-label">Prénom</label>
                                    <input type="text" class="form-control" id="prenom" name="prenom" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="email" name="email" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="telephone" class="form-label">Téléphone</label>
                                    <input type="text" class="form-control" id="telephone" name="telephone" required>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Mettre à jour</button>
                        </form>
                    </div>

                    <div id="changePassword" class="content-section">
                        <h2>Changer le mot de passe</h2>
                        <form method="post" action="../../controller/updatePassword.php">
                            <div class="mb-3">
                                <label for="currentPassword" class="form-label">Mot de passe actuel</label>
                                <input type="password" class="form-control" id="currentPassword" name="currentPassword" required>
                                <a href="../password/PasswordForgotten.php" class="forgot-link text-primary">Mot de passe oublié ?</a>
                            </div>
                            <div class="mb-3">
                                <label for="newPassword" class="form-label">Nouveau mot de passe</label>
                                <input type="password" class="form-control" id="newPassword" name="newPassword" required>
                            </div>
                            <div class="mb-3">
                                <label for="confirmNewPassword" class="form-label">Confirmer le nouveau mot de passe</label>
                                <input type="password" class="form-control" id="confirmNewPassword" name="confirmNewPassword" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Changer le mot de passe</button>
                        </form>
                    </div>

                </main>
            </div>
        </div>

        <script>
                    function showSection(id, event) {
                    if (event) event.preventDefault();
                            const sections = document.querySelectorAll('.content-section');
                            const links = document.querySelectorAll('.nav-link');
                            sections.forEach(sec => sec.classList.remove('active'));
                            links.forEach(link => link.classList.remove('active'));
                            document.getElementById(id).classList.add('active');
                            event.target.classList.add('active');
                    }

            function toggleSubmenu(event) {
            event.preventDefault();
                    const submenu = event.target.nextElementSibling;
                    submenu.classList.toggle('show');
            }
        </script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
        <!-- SweetAlert2 -->
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        <?php if (isset($_GET['error'])): ?>
            <script>
    <?php if ($_GET['error'] === 'invalid_current_password'): ?>
                Swal.fire({
                icon: 'error',
                        title: 'Mot de passe incorrect',
                        text: 'Le mot de passe actuel est incorrect.'
                });
    <?php elseif ($_GET['error'] === 'passwords_do_not_match'): ?>
                Swal.fire({
                icon: 'warning',
                        title: 'Incohérence',
                        text: 'Les mots de passe ne correspondent pas.'
                });
    <?php endif; ?>
            </script>
        <?php endif; ?>
        <?php if (isset($_GET['updated'])): ?>
            <script>
                Swal.fire({
                icon: 'success',
                        title: 'Succès',
                        text: 'Mot de passe mis à jour avec succès.'
                });            </script>
            <?php endif; ?>
        <script>
                    document.getElementById('search-button').addEventListener('click', function () {
            const keyword = document.getElementById('searchInput').value.trim();
                    if (keyword.length === 0) {
            Swal.fire({
            icon: 'warning',
                    title: 'Recherche vide',
                    text: 'Veuillez entrer un nom ou une spécialité à rechercher.'
            });
                    return;
            }

            fetch('../../controller/searchMedecins.php?query=' + encodeURIComponent(keyword))
                    .then(response => response.json())
                    .then(data => {
                    if (data.length === 0) {
                    Swal.fire({
                    icon: 'info',
                            title: 'Aucun résultat',
                            text: 'Aucun médecin trouvé pour cette recherche.'
                    });
                            return;
                    }

                    let resultsHtml = '<h4>Résultats de recherche</h4><ul class="list-group mt-3">';
                            data.forEach(med => {
                            resultsHtml += ` < li class = "list-group-item" >
                            < strong > ${med.nom} ${med.prenom} < /strong><br>
                                                        Email: ${med.email} < br >
                                                        Spécialité: ${med.specialite}
                                                < /li>`;
                                                });
                                                resultsHtml += '</ul>';
                                                Swal.fire({
                                                title: 'Médecins trouvés',
                                                        html: resultsHtml,
                                                        width: 600,
                                                        showCloseButton: true,
                                                        showConfirmButton: false
                                                });
                                        })
                                        .catch(err => {
                                        console.error(err);
                                                Swal.fire({
                                                icon: 'error',
                                                        title: 'Erreur',
                                                        text: 'Une erreur est survenue lors de la recherche.'
                                                });
                                        });
                                        });
        </script>


    </body>
</html>