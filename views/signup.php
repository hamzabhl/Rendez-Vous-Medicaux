<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Inscription - MediBooking</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <style>
            body {
                background-color: #e6f3ff;
                min-height: fit-content;
                font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            }

            .main-container {
                display: flex;
                justify-content: center;
                align-items: flex-start;
                margin: 2.5rem auto;
                gap: 2rem;
                flex-wrap: wrap;
            }

            .container-box {
                flex: 0 0 300px;
                background: #fff;
                border-radius: 12px;
                padding:2rem;
                box-shadow: 0 4px 12px rgba(0,0,0,0.1);
                display: flex;
                flex-direction: column;
                margin-left: -50px;
            }

            .form-box {
                flex: 1;
                max-width: 750px;
                background: #fff;
                border-radius: 12px;
                padding-left: 3rem;
                padding-right: 3rem;
                box-shadow: 0 4px 12px rgba(0,0,0,0.1);
                display: flex;
                flex-direction: column;
                justify-content: flex-start;
            }

            .title {
                font-size: 1.5rem;
                font-weight: bold;
                color: #003366;
                text-align: center;
            }

            .subtitle {
                color: #6c757d;
                text-align: center;
                margin-bottom: 1rem;
                font-size: 0.85rem;
            }

            .role-card {
                border: 1px solid #cce5ff;
                border-radius: 10px;
                padding: 0.5rem;
                margin-bottom: 0.7rem;
                background-color: #f8fbff;
                cursor: pointer;
                transition: all 0.3s;
                font-size: 0.75rem;
            }

            .role-card:hover {
                background-color: #e0f0ff;
            }

            .role-card img {
                width: 60px;
                height: 60px;
                border-radius: 50%;
                margin-right: 0.8rem;
            }

            .role-card h5 {
                margin: 0;
                color: #0056b3;
                font-weight: bold;
                font-size: 1rem;
            }

            .role-card p {
                margin: 0;
                color: #6c757d;
                font-size: 0.65rem;
            }

            .footer-link {
                text-align: center;
                font-size: 0.7rem;
            }

            .footer-link a {
                color: #0056b3;
                text-decoration: none;
                font-size: 0.85rem;
            }

            .form-section {
                display: none;
                font-size: 0.75rem;
            }

            .form-section.active {
                display: block;
            }

            .form-control:invalid:required {
                border-color: #dc3545;
            }

            .form-control:invalid:required:focus {
                box-shadow: 0 0 0 0.2rem rgba(220,53,69,.25);
            }
            .d-grid {
                margin: 25px;
            }

            .row.mb-2 > div {
                flex: 0 0 33.3333%;
                max-width: 33.3333%;
            }
        </style>
    </head>
    <body>

        <nav class="navbar navbar-expand-lg" style="background-color: #007bff;">
            <div class="container-fluid">
                <a class="navbar-brand text-white fw-bold" href="#">MediBooking</a>
            </div>
        </nav>

        <div class="main-container">
            <div class="container-box">
                <div>
                    <div class="title">Inscrivez-vous</div>
                    <div class="subtitle">Veuillez choisir votre rôle<br>Rejoignez notre communauté</div>

                    <div class="role-card d-flex align-items-center" onclick="showForm('medecin')">
                        <img src="../img/doctor.png" alt="Soignant">
                        <div>
                            <h5><i class="bi bi-stethoscope"></i> Soignant</h5>
                            <p>Offrir des soins de qualité et faciliter la gestion de vos rendez-vous avec vos patients</p>
                        </div>
                    </div>

                    <div class="role-card d-flex align-items-center" onclick="showForm('patient')">
                        <img src="../img/patient.png" alt="Patient">
                        <div>
                            <h5><i class="bi bi-person-fill"></i> Patient</h5>
                            <p>Accéder facilement à vos rendez-vous et bénéficier d’un suivi médical personnalisé</p>
                        </div>
                    </div>
                    <div class="footer-link mt-3">
                        Vous avez un compte ? <a href="login.php">s'authentifier</a><br>
                        <a href="../index.php">Acceuil</a>
                    </div>
                </div>
            </div>

            <div class="form-box">
                <form id="formPatient" class="form-section active" action="../controller/SignupController.php" method="post">
                    <h5 class="text-primary text-center my-4">Inscription Patient</h5>
                    <input type="hidden" name="role" value="patient">
                    <div class="row mb-2">
                        <div class="col-md-6">
                            <label class="form-label">Nom</label>
                            <input type="text" class="form-control" name="nom" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Prénom</label>
                            <input type="text" class="form-control" name="prenom" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">CIN</label>
                            <input type="text" class="form-control" name="cin" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Email</label>
                            <input type="email" class="form-control" name="email" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Téléphone</label>
                            <input type="text" class="form-control" name="telephone" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Sexe</label>
                            <select class="form-control" name="sexe" required>
                                <option value="">Sélectionnez</option>
                                <option value="Homme">Homme</option>
                                <option value="Femme">Femme</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Date de naissance</label>
                            <input type="date" class="form-control" name="dateNaissance" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Mot de passe</label>
                            <input type="password" class="form-control" name="password" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Confirmation de mot de passe</label>
                            <input type="password" class="form-control" name="confirmPassword" required>
                        </div>
                    </div>
                    <div class="d-grid my-5">
                        <button type="submit" class="btn btn-primary">S'inscrire</button>
                    </div>
                </form>

                <?php
                include_once '../services/SpecialiteService.php';
                $ss = new SpecialiteService();
                $specialites = $ss->findAll();
                ?>
                <form id="formMedecin" class="form-section" action="../controller/SignupController.php" method="post">
                    <h5 class="text-primary mb-3 text-center my-4">Inscription Médecin</h5>
                    <input type="hidden" name="role" value="medecin">
                    <div class="row mb-2">
                        <div class="col-md-6">
                            <label class="form-label">Nom</label>
                            <input type="text" class="form-control" name="nom" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Prénom</label>
                            <input type="text" class="form-control" name="prenom" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">CIN</label>
                            <input type="text" class="form-control" name="cin" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Email</label>
                            <input type="email" class="form-control" name="email" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Téléphone</label>
                            <input type="text" class="form-control" name="telephone" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Sexe</label>
                            <select class="form-control" name="sexe" required>
                                <option value="">Sélectionnez</option>
                                <option value="Homme">Homme</option>
                                <option value="Femme">Femme</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Date de naissance</label>
                            <input type="date" class="form-control" name="dateNaissance" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Adresse</label>
                            <input type="text" class="form-control" name="adresse" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Numéro Fixe</label>
                            <input type="text" class="form-control" name="numFix" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Spécialité</label>

                            <select name="specialite_id" id="specialite" required>
                                <option value="">-- Sélectionner --</option>
                                <?php foreach ($specialites as $s) { ?>
                                    <option value="<?= $s->getId() ?>"><?= htmlspecialchars($s->getNom()) ?></option>
                                <?php } ?>

                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Mot de passe</label>
                            <input type="password" class="form-control" name="password" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Confirmation de mot de passe</label>
                            <input type="password" class="form-control" name="confirmPassword" required>
                        </div>
                    </div>
                    <div class="d-grid my-5">
                        <button type="submit" class="btn btn-primary">S'inscrire</button>
                    </div>
                </form>
            </div>
        </div>

        <footer class="text-white text-center py-3" style="background-color: #007bff;">
            &copy; 2025 MediBooking. Tous droits réservés.
        </footer>

        <script>
            function showForm(type) {
                document.getElementById("formPatient").classList.remove("active");
                document.getElementById("formMedecin").classList.remove("active");

                if (type === 'medecin') {
                    document.getElementById("formMedecin").classList.add("active");
                } else {
                    document.getElementById("formPatient").classList.add("active");
                }
            }
        </script>

    </body>
</html>
