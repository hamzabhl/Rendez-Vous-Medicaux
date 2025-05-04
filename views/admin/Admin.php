<?php
session_start();
if (!isset($_SESSION['user']) || $_SESSION['role'] !== 'admin') {
    header('Location: ../../index.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <title>MediLab Admin</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
        <style>
            body {
                background-color: #f8fbff;
                font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            }
            .sidebar {
                background: #0d6efd;
                min-height: 100vh;
                padding-top: 2rem;
            }
            .sidebar .nav-link {
                color: #fff;
                font-weight: 500;
                padding: 0.75rem 1rem;
                transition: background 0.3s;
            }
            .sidebar .nav-link.active,
            .sidebar .nav-link:hover {
                background-color: #004bb1;
                color: #fff;
                border-left: 4px solid #ffc107;
            }
            .content-wrapper {
                padding: 2rem;
                background-color: #f0f4f8;
            }
            .dashboard-cards .card {
                border: none;
                border-radius: 0.75rem;
                box-shadow: 0 0.25rem 1rem rgba(0,0,0,0.05);
            }
            .dashboard-cards .card .card-body {
                padding: 1.5rem;
            }
            .dashboard-cards .card h5 {
                margin-bottom: 1rem;
            }
            .section-title {
                font-size: 1.5rem;
                font-weight: bold;
                color: #003366;
                margin-bottom: 1.5rem;
            }
            .content-section {
                display: none;
            }
            .content-section.active {
                display: block;
            }
            footer {
                padding: 1rem;
                background: #e9ecef;
                text-align: center;
                font-size: 0.875rem;
            }
        </style>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    </head>
    <body>

        <div class="container-fluid">
            <div class="row">
                <!-- Sidebar -->
                <div class="col-md-3 col-lg-2 sidebar">
                    <div class="text-center text-white mb-4">
                        <h4 class="fw-bold">MediLab Admin</h4>
                    </div>
                    <ul class="nav flex-column">
                        <li class="nav-item"><a class="nav-link active" href="#" onclick="showSection('medecinsSection', event)"><i class="bi bi-person-badge me-2"></i>Médecins</a></li>
                        <li class="nav-item"><a class="nav-link" href="#" onclick="showSection('patientsSection', event)"><i class="bi bi-people me-2"></i>Patients</a></li>
                        <li class="nav-item"><a class="nav-link" href="#" onclick="showSection('demandesSection', event)"><i class="bi bi-envelope-check me-2"></i>Demandes</a></li>
                        <li class="nav-item"><a class="nav-link" href="#" onclick="showSection('specialitesSection', event)"><i class="bi bi-patch-plus me-2"></i>Spécialités</a></li>
                        <li class="nav-item mt-3"><a class="nav-link" href="../../controller/logout.php"><i class="bi bi-box-arrow-right me-2"></i>Se déconnecter</a></li>
                    </ul>
                </div>

                <!-- Main Content -->

                <main class="col-md-9 ms-sm-auto col-lg-10 content-wrapper">
                    <div id="medecinsSection" class="content-section active">
                        <div class="section-title">Liste des Médecins</div>
                        <div class="row">
                            <?php
                            include_once '../../services/MedecinService.php';
                            $ms = new MedecinService();
                            $medecins = $ms->findAll();
                            foreach ($medecins as $medecin) {
                                if ($medecin->getIsConfirmed() === 1) {
                                    echo '<div class="col-md-4">';
                                    echo '<div class="card mb-4">';
                                    echo '<div class="card-body text-center">';
                                    echo '<i class="bi bi-person-circle fs-1 text-primary mb-2"></i>';
                                    echo '<h5>' . htmlspecialchars($medecin->getNom()) . ' ' . htmlspecialchars($medecin->getPrenom()) . '</h5>';
                                    echo '<p>Email : ' . htmlspecialchars($medecin->getEmail()) . '</p>';
                                    echo '<p>Spécialité : ' . htmlspecialchars($medecin->getSpecialite()->getNom()) . '</p>';
                                    echo '<a href="../../controller/deleteMedecin.php?id=' . $medecin->getId() . '" class="btn btn-danger btn-sm mt-2" onclick="return confirm(\'Supprimer ce médecin ?\')">';
                                    echo '<i class="bi bi-trash"></i> Supprimer</a>';
                                    echo '</div></div></div>';
                                }
                            }
                            ?>
                        </div>
                    </div>

                    <div id="patientsSection" class="content-section">
                        <div class="section-title">Liste des Patients</div>
                        <div class="row">
                            <?php
                            include_once '../../services/PatientService.php';
                            $ps = new PatientService();
                            $patients = $ps->findAll();
                            foreach ($patients as $patient) {
                                echo '<div class="col-md-4">';
                                echo '<div class="card mb-4">';
                                echo '<div class="card-body">';
                                echo '<h5>' . htmlspecialchars($patient->getNom()) . ' ' . htmlspecialchars($patient->getPrenom()) . '</h5>';
                                echo '<p>Email : ' . htmlspecialchars($patient->getEmail()) . '</p>';
                                echo '<a href="../../controller/deletePatient.php?id=' . $patient->getId() . '" class="btn btn-danger btn-sm mt-2" onclick="return confirm(\'Supprimer ce patient ?\')">';
                                echo '<i class="bi bi-trash"></i> Supprimer</a>';
                                echo '</div></div></div>';
                            }
                            ?>
                        </div>
                    </div>

<!--                    <div id="demandesSection" class="content-section">
                        <div class="section-title">Médecins non confirmés</div>
                        <div class="row">
                            <?php
                            foreach ($medecins as $medecin) {
                                if ($medecin->getIsConfirmed() === 0) {
                                    echo '<div class="col-md-4">';
                                    echo '<div class="card mb-4">';
                                    echo '<div class="card-body">';
                                    echo '<h5>' . htmlspecialchars($medecin->getNom()) . ' ' . htmlspecialchars($medecin->getPrenom()) . '</h5>';
                                    echo '<p>Email : ' . htmlspecialchars($medecin->getEmail()) . '</p>';
                                    echo '<p>Spécialité : ' . htmlspecialchars($medecin->getSpecialite()->getNom()) . '</p>';
                                    echo '<a href="../../controller/deleteMedecin.php?id=' . $medecin->getId() . '" class="btn btn-danger btn-sm mt-2" onclick="return confirm(\'Supprimer ce médecin ?\')">';
                                    echo '<i class="bi bi-trash"></i> Supprimer</a>';
                                    echo '<a href="../../controller/ApproveDoctor.php?id=' . $medecin->getId() . '" class="btn btn-success btn-sm mt-2 ml-5" onclick="return confirm(\'Approuver ce médecin ?\')">';
                                    echo '<i class="bi bi-check"></i>Aprouver</a>';
                                    echo '</div></div></div>';
                                }
                            }
                            ?>
                        </div>
                    </div>-->

                    <div id="demandesSection" class="content-section">
    <div class="section-title">Médecins non confirmés</div>
    <div class="row">
        <?php foreach ($medecins as $medecin) {
            if ($medecin->getIsConfirmed() === 0) {
                $id = $medecin->getId();
                $nom = htmlspecialchars($medecin->getNom());
                $prenom = htmlspecialchars($medecin->getPrenom());
                $email = htmlspecialchars($medecin->getEmail());
                $specialite = htmlspecialchars($medecin->getSpecialite()->getNom());

                echo <<<HTML
                <div class="col-md-4">
                    <div class="card mb-4">
                        <div class="card-body">
                            <h5>$nom $prenom</h5>
                            <p>Email : $email</p>
                            <p>Spécialité : $specialite</p>
                            <button class="btn btn-danger btn-sm mt-2" onclick="confirmDelete($id)">
                                <i class="bi bi-trash"></i> Supprimer
                            </button>
                            <button class="btn btn-success btn-sm mt-2 ms-2" onclick="confirmApprove($id)">
                                <i class="bi bi-check"></i> Approuver
                            </button>
                        </div>
                    </div>
                </div>
HTML;
            }
        } ?>
    </div>
</div>
                    <div id="specialitesSection" class="content-section">
                        <div class="section-title">Liste des Spécialités</div>
                        <div class="row">
                            <?php
                            include_once '../../services/SpecialiteService.php';
                            $ss = new SpecialiteService();
                            $specialites = $ss->findAll();
                            foreach ($specialites as $specialite) {
                                echo '<div class="col-md-4">';
                                echo '<div class="card mb-4">';
                                echo '<div class="card-body">';
                                echo '<h5>' . htmlspecialchars($specialite->getNom()) . '</h5>';
                                echo '<a href="../../controller/deleteSpecialite.php?id=' . $specialite->getId() . '" class="btn btn-danger btn-sm mt-2" onclick="return confirm(\'Supprimer cette spécialité ?\')">';
                                echo '<i class="bi bi-trash"></i> Supprimer</a>';
                                echo '</div></div></div>';
                            }
                            ?>
                        </div>
                    </div>
                </main>
            </div>
        </div>

        <footer>
            &copy; <?php echo date('Y'); ?> MediLab. Tous droits réservés.
        </footer>

        <script>
                    function showSection(id, event) {
                    if (event)
                            event.preventDefault();
                            document.querySelectorAll('.content-section').forEach(section => {
                    section.classList.remove('active');
                    });
                            document.querySelectorAll('.nav-link').forEach(link => {
                    link.classList.remove('active');
                    });
                            document.getElementById(id).classList.add('active');
                            event.target.classList.add('active');
                    }
        </script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
                            function confirmDelete(id) {
                            Swal.fire({
                            title: 'Êtes-vous sûr ?',
                                    text: "Ce médecin sera supprimé définitivement.",
                                    icon: 'warning',
                                    showCancelButton: true,
                                    confirmButtonColor: '#d33',
                                    cancelButtonColor: '#6c757d',
                                    confirmButtonText: 'Oui, supprimer !'
                            }).then((result) => {
                            if (result.isConfirmed) {
                            window.location.href = '../../controller/deleteMedecin.php?id=' + id;
                            }
                            });
                            }

                    function confirmApprove(id) {
                    Swal.fire({
                    title: 'Confirmer l\'approbation ?',
                            text: "Ce médecin sera marqué comme confirmé.",
                            icon: 'question',
                            showCancelButton: true,
                            confirmButtonColor: '#198754',
                            cancelButtonColor: '#6c757d',
                            confirmButtonText: 'Oui, approuver'
                    }).then((result) => {
                    if (result.isConfirmed) {
                    window.location.href = '../../controller/ApproveDoctor.php?id=' + id;
                    }
                    });
                    }
        </script>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    </body>
</html>
