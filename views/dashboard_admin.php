<!DOCTYPE html>
<html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default" data-assets-path="../assets/" data-template="vertical-menu-template-free">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
        <title>MediLab : Admin</title>
        <meta name="description" content="" />
        <link rel="icon" type="image/x-icon" href="../assets/img/favicon/favicon.ico" />
        <link rel="preconnect" href="https://fonts.googleapis.com" />
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
        <link href="https://fonts.googleapis.com/css2?family=Public+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet" />
        <link rel="stylesheet" href="../assets/vendor/fonts/boxicons.css" />
        <link rel="stylesheet" href="../assets/vendor/css/core.css" />
        <link rel="stylesheet" href="../assets/vendor/css/theme-default.css" />
        <link rel="stylesheet" href="../assets/css/demo.css" />
        <link rel="stylesheet" href="../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />
        <link rel="stylesheet" href="../assets/vendor/libs/apex-charts/apex-charts.css" />
        <script src="../assets/vendor/js/helpers.js"></script>
        <script src="../assets/js/config.js"></script>
    </head>

    <body>
        <div class="layout-wrapper layout-content-navbar">
            <div class="layout-container">
                <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
                    <div class="app-brand demo">
                        <a href="dashboard_admin.php" class="app-brand-link">
                            <span class="app-brand-logo demo">
                                <svg width="25" viewBox="0 0 25 42" xmlns="http://www.w3.org/2000/svg">
                                <use xlink:href="#path-1"></use>
                                </svg>
                            </span>
                            <span class="app-brand-text demo menu-text fw-bolder ms-2">MediLab</span>
                        </a>
                        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
                            <i class="bx bx-chevron-left bx-sm align-middle"></i>
                        </a>
                    </div>
                    <div class="menu-inner-shadow"></div>
                    <ul class="menu-inner py-1">
                        <li class="menu-item"><a href="#" onclick="showSection('medecinsSection')" class="menu-link"><i class="menu-icon tf-icons bx bx-user"></i><div>Médecins</div></a></li>
                        <li class="menu-item"><a href="#" onclick="showSection('patientsSection')" class="menu-link"><i class="menu-icon tf-icons bx bx-group"></i><div>Patients</div></a></li>
                        <li class="menu-item"><a href="#" onclick="showSection('demandesSection')" class="menu-link"><i class="menu-icon tf-icons bx bx-envelope"></i><div>Demandes</div></a></li>
                        <li class="menu-item"><a href="#" onclick="showSection('specialitesSection')" class="menu-link"><i class="menu-icon tf-icons bx bx-plus-medical"></i><div>Spécialités</div></a></li>
                        <li class="menu-item"><a href="#" onclick="showSection('statistiquesSection')" class="menu-link"><i class="menu-icon tf-icons bx bx-bar-chart"></i><div>Statistiques</div></a></li>
                    </ul>
                </aside>

                <div class="layout-page">
                    <div class="content-wrapper">
                        <div class="container-xxl flex-grow-1 container-p-y">




                            <div id="medecinsSection" style="display: none;">
                                <div class="row">
                                    <?php
                                    include_once '../services/MedecinService.php';
                                    $ms = new MedecinService();
                                    $medecins = $ms->findAll();
                                    foreach ($medecins as $medecin) {
                                        if ($medecin->getIsConfirmed() !== "false") {
                                            echo '<div class="col-md-4">';
                                            echo '<div class="card m-2 p-2">';
                                            echo '<h5 class="text-center">' . htmlspecialchars($medecin->getNom()) . ' ' . htmlspecialchars($medecin->getPrenom()) . '</h5>';
                                            echo '<p>Email: ' . htmlspecialchars($medecin->getEmail()) . '</p>';
                                            echo '<p>Téléphone: ' . htmlspecialchars($medecin->getTelephone()) . '</p>';
                                            echo '<p>Spécialité: ' . htmlspecialchars($medecin->getSpecialite()->getNom()) . '</p>';
                                            echo '<p>isConfirmed: ' . htmlspecialchars($medecin->getIsConfirmed()) . '</p>';
                                            echo '<button class="btn btn-danger mt-2" onclick="confirmDelete(' . $medecin->getId() . ')">Supprimer</button>';

                                            echo '</div>';
                                            echo '</div>';
                                        }
                                    }
                                    ?>
                                </div>
                            </div>





                            <div id="patientsSection"  style="display: none;">
                                <div class="row">
                                    <?php
                                    include_once '../services/PatientService.php';
                                    $ps = new PatientService();
                                    $patients = $ps->findAll();
                                    foreach ($patients as $patient) {
                                        echo '<div class="col-md-4">';
                                        echo '<div class="card m-2 p-2">';
                                        echo '<h5>' . htmlspecialchars($patient->getNom()) . ' ' . htmlspecialchars($patient->getPrenom()) . '</h5>';
                                        echo '<p>Email: ' . htmlspecialchars($patient->getEmail()) . '</p>';
                                        echo '<p>Téléphone: ' . htmlspecialchars($patient->getTelephone()) . '</p>';
                                        echo '<a href="../controller/deletePatient.php?id=' . $patient->getId() . '" class="btn btn-danger mt-2">Supprimer</a>';
                                        echo '</div>';
                                        echo '</div>';
                                    }
                                    ?>
                                </div>
                            </div>

                            <div id="specialitesSection" style="display: none;">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <h4>Liste des Spécialités</h4>
                                </div>

                                <div class="row">
                                    <?php
                                    include_once '../services/SpecialiteService.php';
                                    $ss = new SpecialiteService();
                                    $specialites = $ss->findAll();
                                    foreach ($specialites as $specialite) {
                                        echo '<div class="col-md-4">';
                                        echo '<div class="card m-2 p-2">';
                                        echo '<h5 align="center">' . htmlspecialchars($specialite->getNom()) . '</h5>';
                                        echo '<a href="../controller/deleteSpecialite.php?id=' . $specialite->getId() . '" class="btn btn-danger mt-2">Supprimer</a>';
                                        echo '</div>';
                                        echo '</div>';
                                    }
                                    ?>
                                </div>

                                <!-- Form at the bottom -->
                                <div class="mt-5">
                                    <h4 class="mb-3">Ajouter une Nouvelle Spécialité</h4>
                                    <form action="../controller/addSpecialite.php" method="POST">
                                        <div class="mb-3">
                                            <label for="nom" class="form-label">Nom de la Spécialité</label>
                                            <input type="text" id="nom" name="nom" class="form-control" required>
                                        </div>
                                        <button type="submit" class="btn btn-primary">Ajouter</button>
                                    </form>
                                </div>
                            </div>


                            <div id="statistiquesSection" style="display: none;">
                                <div class="row">
                                    <?php
                                    include_once '../services/PatientService.php';
                                    $ps = new PatientService();
                                    $patients = $ps->findAll();
                                    foreach ($patients as $patient) {
                                        echo '<div class="col-md-4">';
                                        echo '<div class="card m-2 p-2">';
                                        echo '<h5>' . htmlspecialchars($patient->getNom()) . ' ' . htmlspecialchars($patient->getPrenom()) . '</h5>';
                                        echo '<p>Email: ' . htmlspecialchars($patient->getEmail()) . '</p>';
                                        echo '<p>Téléphone: ' . htmlspecialchars($patient->getTelephone()) . '</p>';
                                        echo '<a href="../controller/deletePatient.php?id=' . $patient->getId() . '" class="btn btn-danger mt-2">Supprimer</a>';
                                        echo '</div>';
                                        echo '</div>';
                                    }
                                    ?>
                                </div>
                            </div>


                            <div id="demandesSection" style="display: none;">
                                <div class="row">
                                    <?php
                                    include_once '../services/MedecinService.php';
                                    $ms = new MedecinService();
                                    $medecins = $ms->findAll();
                                    foreach ($medecins as $medecin) {
                                        if ($medecin->getIsConfirmed() !== "false") {
                                            echo '<div class="col-md-4">';
                                            echo '<div class="card m-2 p-2">';
                                            echo '<h5 class="text-center">' . htmlspecialchars($medecin->getNom()) . ' ' . htmlspecialchars($medecin->getPrenom()) . '</h5>';
                                            echo '<p>Email: ' . htmlspecialchars($medecin->getEmail()) . '</p>';
                                            echo '<p>Téléphone: ' . htmlspecialchars($medecin->getTelephone()) . '</p>';
                                            echo '<p>Spécialité: ' . htmlspecialchars($medecin->getSpecialite()->getNom()) . '</p>';
                                            echo '<p>isConfirmed: ' . htmlspecialchars($medecin->getIsConfirmed()) . '</p>';
                                            echo '<a href="../controller/confirmMedecin.php?id=' . $medecin->getId() . '" class="btn btn-success mt-2">Confirmer</a>';
                                            echo '<button class="btn btn-danger mt-2" onclick="confirmDelete(' . $medecin->getId() . ')">Supprimer</button>';
                                            echo '</div>';
                                            echo '</div>';
                                        }
                                    }
                                    ?>
                                </div>
                            </div>



                            <footer class="content-footer footer bg-footer-theme">
                                <div class="container-xxl d-flex flex-wrap justify-content-center py-2 flex-md-row flex-column">
                                    <div class="mb-2 mb-md-0">
                                        &copy; <script>document.write(new Date().getFullYear());</script>
                                        , made by
                                    </div>
                                </div>
                            </footer>

                            <div class="content-backdrop fade"></div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Scripts -->
            <script src="../assets/vendor/libs/jquery/jquery.js"></script>
            <script src="../assets/vendor/libs/popper/popper.js"></script>
            <script src="../assets/vendor/js/bootstrap.js"></script>
            <script src="../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>
            <script src="../assets/vendor/js/menu.js"></script>
            <script src="../assets/vendor/libs/apex-charts/apexcharts.js"></script>
            <script src="../assets/js/main.js"></script>
            <script src="../assets/js/dashboards-analytics.js"></script>
            <script async defer src="https://buttons.github.io/buttons.js"></script>

            <script>
                function showSection(sectionId) {
                    const sections = ["medecinsSection", "patientsSection", "demandesSection", "specialitesSection", "statistiquesSection"];
                    sections.forEach(function (id) {
                    document.getElementById(id).style.display = id === sectionId ? 'block' : 'none';
                        });
                }
            </script>
            <script>
                function confirmDelete(id) {
                Swal.fire({
                title: 'Êtes-vous sûr ?',
                        text: "Cette action est irréversible.",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#d33',
                        cancelButtonColor: '#3085d6',
                        confirmButtonText: 'Oui, supprimer !',
                        cancelButtonText: 'Annuler'
                }).then((result) = > {
                if (result.isConfirmed) {
                window.location.href = '../controller/deleteMedecin.php?id=' + id;
                }
                });
                        }
            </script>

    </body>
</html>