<!DOCTYPE html>
<?php
include_once './racine.php';
?>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Test</title>
    </head>
    <body>
        <form action="controller/addSpecialite.php" method="POST">
            <fieldset>
                <legend><h2>Spécialité</h2></legend>
                <table border="0">
                    <tr>
                        <td><label for="nom">Nom:</label></td>
                        <td><input type="text" id="nom" name="nom" required></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td><input type="submit" value="S'inscrire"></td>
                    </tr>
                </table>
            </fieldset>
        </form>
        <table border="1">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nom</th>
                    <th>Supprimer</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include_once RACINE . '/services/SpecialiteService.php';
                $ss = new SpecialiteService();
                foreach ($ss->findAll() as $s) {
                    ?>
                    <tr>
                        <td><?php echo $s->getId(); ?></td>
                        <td><?php echo $s->getNom(); ?></td>
                        <td>
                            <a href="controller/deleteSpecialite.php?id=
                               <?php echo $s->getId(); ?>">Supprimer</a> 
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>

        <br><br><br>

        <form action="controller/addUser.php" method="POST">
            <fieldset>
                <legend><h2>Utilisateur</h2></legend>
                <table border="0">
                    <tr>
                        <td><label for="nom">Nom:</label></td>
                        <td><input type="text" id="nom" name="nom" required></td>
                    </tr>
                    <tr>
                        <td><label for="prenom">Prénom:</label></td>
                        <td><input type="text" id="prenom" name="prenom" required></td>
                    </tr>
                    <tr>
                        <td><label for="cin">CIN:</label></td>
                        <td><input type="text" id="cin" name="cin" required></td>
                    </tr>
                    <tr>
                        <td><label for="email">Email:</label></td>
                        <td><input type="email" id="email" name="email" required></td>
                    </tr>
                    <tr>
                        <td><label for="telephone">Téléphone:</label></td>
                        <td><input type="text" id="telephone" name="telephone" required></td>
                    </tr>
                    <tr>
                        <td><label for="sexe">Sexe:</label></td>
                        <td>
                            <select name="sexe" id="sexe" required>
                                <option value="Homme">Homme</option>
                                <option value="Femme">Femme</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td><label for="dateNaissance">Date de Naissance:</label></td>
                        <td><input type="date" id="dateNaissance" name="dateNaissance" required></td>
                    </tr>
                    <tr>
                        <td><label for="password">Mot de passe:</label></td>
                        <td><input type="password" id="password" name="password" required></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td><input type="submit" value="S'inscrire"></td>
                    </tr>
                </table>
            </fieldset>
        </form>
        <table border="1">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>CIN</th>
                    <th>Email</th>
                    <th>Téléphone</th>
                    <th>Sexe</th>
                    <th>Date Naissance</th>
                    <th>Supprimer</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include_once RACINE . '/services/UserService.php';
                $us = new UserService();
                foreach ($us->findAll() as $u) {
                    ?>
                    <tr>
                        <td><?php echo $u->getId(); ?></td>
                        <td><?php echo $u->getNom(); ?></td>
                        <td><?php echo $u->getPrenom(); ?></td>
                        <td><?php echo $u->getCin(); ?></td>
                        <td><?php echo $u->getEmail(); ?></td>
                        <td><?php echo $u->getTelephone(); ?></td>
                        <td><?php echo $u->getSexe(); ?></td>
                        <td><?php echo $u->getDateNaissance(); ?></td>
                        <td>
                            <a href="controller/deleteUser.php?id=
                               <?php echo $u->getId(); ?>">Supprimer</a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>

        <br><br><br>

        <form action="controller/addAdmin.php" method="POST">
            <fieldset>
                <legend><h2>Admin</h2></legend>
                <table border="0">
                    <tr>
                        <td><label for="nom">Nom:</label></td>
                        <td><input type="text" id="nom" name="nom" required></td>
                    </tr>
                    <tr>
                        <td><label for="prenom">Prénom:</label></td>
                        <td><input type="text" id="prenom" name="prenom" required></td>
                    </tr>
                    <tr>
                        <td><label for="cin">CIN:</label></td>
                        <td><input type="text" id="cin" name="cin" required></td>
                    </tr>
                    <tr>
                        <td><label for="email">Email:</label></td>
                        <td><input type="email" id="email" name="email" required></td>
                    </tr>
                    <tr>
                        <td><label for="telephone">Téléphone:</label></td>
                        <td><input type="text" id="telephone" name="telephone" required></td>
                    </tr>
                    <tr>
                        <td><label for="sexe">Sexe:</label></td>
                        <td>
                            <select name="sexe" id="sexe" required>
                                <option value="Homme">Homme</option>
                                <option value="Femme">Femme</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td><label for="dateNaissance">Date de Naissance:</label></td>
                        <td><input type="date" id="dateNaissance" name="dateNaissance" required></td>
                    </tr>
                    <tr>
                        <td><label for="password">Mot de passe:</label></td>
                        <td><input type="password" id="password" name="password" required></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td><input type="submit" value="S'inscrire"></td>
                    </tr>
                </table>
            </fieldset>
        </form>
        <table border="1">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>CIN</th>
                    <th>Email</th>
                    <th>Téléphone</th>
                    <th>Sexe</th>
                    <th>Date Naissance</th>
                    <th>Supprimer</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include_once RACINE . '/services/AdminService.php';
                $as = new AdminService();
                foreach ($as->findAll() as $a) {
                    ?>
                    <tr>
                        <td><?php echo $a->getId(); ?></td>
                        <td><?php echo $a->getNom(); ?></td>
                        <td><?php echo $a->getPrenom(); ?></td>
                        <td><?php echo $a->getCin(); ?></td>
                        <td><?php echo $a->getEmail(); ?></td>
                        <td><?php echo $a->getTelephone(); ?></td>
                        <td><?php echo $a->getSexe(); ?></td>
                        <td><?php echo $a->getDateNaissance(); ?></td>
                        <td>
                            <a href="controller/deleteAdmin.php?id=
                               <?php echo $a->getId(); ?>">Supprimer</a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>

        <br><br><br>

        <form action="controller/addPatient.php" method="POST">
            <fieldset>
                <legend><h2>Patient</h2></legend>
                <table border="0">
                    <tr>
                        <td><label for="nom">Nom:</label></td>
                        <td><input type="text" id="nom" name="nom" required></td>
                    </tr>
                    <tr>
                        <td><label for="prenom">Prénom:</label></td>
                        <td><input type="text" id="prenom" name="prenom" required></td>
                    </tr>
                    <tr>
                        <td><label for="cin">CIN:</label></td>
                        <td><input type="text" id="cin" name="cin" required></td>
                    </tr>
                    <tr>
                        <td><label for="email">Email:</label></td>
                        <td><input type="email" id="email" name="email" required></td>
                    </tr>
                    <tr>
                        <td><label for="telephone">Téléphone:</label></td>
                        <td><input type="text" id="telephone" name="telephone" required></td>
                    </tr>
                    <tr>
                        <td><label for="sexe">Sexe:</label></td>
                        <td>
                            <select name="sexe" id="sexe" required>
                                <option value="Homme">Homme</option>
                                <option value="Femme">Femme</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td><label for="dateNaissance">Date de Naissance:</label></td>
                        <td><input type="date" id="dateNaissance" name="dateNaissance" required></td>
                    </tr>
                    <tr>
                        <td><label for="password">Mot de passe:</label></td>
                        <td><input type="password" id="password" name="password" required></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td><input type="submit" value="S'inscrire"></td>
                    </tr>
                </table>
            </fieldset>
        </form>
        <table border="1">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>CIN</th>
                    <th>Email</th>
                    <th>Téléphone</th>
                    <th>Sexe</th>
                    <th>Date Naissance</th>
                    <th>Supprimer</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include_once RACINE . '/services/PatientService.php';
                $ps = new PatientService();
                foreach ($ps->findAll() as $p) {
                    ?>
                    <tr>
                        <td><?php echo $p->getId(); ?></td>
                        <td><?php echo $p->getNom(); ?></td>
                        <td><?php echo $p->getPrenom(); ?></td>
                        <td><?php echo $p->getCin(); ?></td>
                        <td><?php echo $p->getEmail(); ?></td>
                        <td><?php echo $p->getTelephone(); ?></td>
                        <td><?php echo $p->getSexe(); ?></td>
                        <td><?php echo $p->getDateNaissance(); ?></td>
                        <td>
                            <a href="controller/deletePatient.php?id=
                               <?php echo $p->getId(); ?>">Supprimer</a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>

        <br><br><br>

        <?php
        include_once 'services/SpecialiteService.php';
        $ss = new SpecialiteService();
        $specialites = $ss->findAll();
        ?>
        <!-- Formulaire d'inscription d'un médecin -->
        <form action="controller/addMedecin.php" method="POST" enctype="multipart/form-data">
            <fieldset>
                <legend><h2>Médecin</h2></legend>
                <table border="0">
                    <tr>
                        <td><label for="nom">Nom:</label></td>
                        <td><input type="text" id="nom" name="nom" required></td>
                    </tr>
                    <tr>
                        <td><label for="prenom">Prénom:</label></td>
                        <td><input type="text" id="prenom" name="prenom" required></td>
                    </tr>
                    <tr>
                        <td><label for="cin">CIN:</label></td>
                        <td><input type="text" id="cin" name="cin" required></td>
                    </tr>
                    <tr>
                        <td><label for="email">Email:</label></td>
                        <td><input type="email" id="email" name="email" required></td>
                    </tr>
                    <tr>
                        <td><label for="telephone">Téléphone:</label></td>
                        <td><input type="text" id="telephone" name="telephone" required></td>
                    </tr>
                    <tr>
                        <td><label for="sexe">Sexe:</label></td>
                        <td>
                            <select name="sexe" id="sexe" required>
                                <option value="Homme">Homme</option>
                                <option value="Femme">Femme</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td><label for="dateNaissance">Date de Naissance:</label></td>
                        <td><input type="date" id="dateNaissance" name="dateNaissance" required></td>
                    </tr>
                    <tr>
                        <td><label for="password">Mot de passe:</label></td>
                        <td><input type="password" id="password" name="password" required></td>
                    </tr>
                    <tr>
                        <td><label for="adresse">Adresse:</label></td>
                        <td><input type="text" id="adresse" name="adresse" required></td>
                    </tr>
                    <tr>
                        <td><label for="numFix">Numéro Fixe:</label></td>
                        <td><input type="text" id="numFix" name="numFix"></td>
                    </tr>
                    <tr>
                        <td><label for="specialite">Spécialité:</label></td>
                        <td>
                            <select name="specialite_id" id="specialite" required>
                                <option value="">-- Sélectionner --</option>
                                <?php foreach ($specialites as $s) { ?>
                                    <option value="<?= $s->getId() ?>"><?= htmlspecialchars($s->getNom()) ?></option>
                                <?php } ?>

                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td><input type="submit" value="S'inscrire"></td>
                    </tr>
                </table>
            </fieldset>
        </form>

        <!-- Tableau des médecins -->
        <table border="1">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>CIN</th>
                    <th>Email</th>
                    <th>Téléphone</th>
                    <th>Sexe</th>
                    <th>Date Naissance</th>
                    <th>Adresse</th>
                    <th>Num Fixe</th>
                    <th>Spécialité</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include_once RACINE . '/services/MedecinService.php';
                $ms = new MedecinService();
                foreach ($ms->findAll() as $m) {
                    ?>
                    <tr>
                        <td><?php echo $m->getId(); ?></td>
                        <td><?php echo $m->getNom(); ?></td>
                        <td><?php echo $m->getPrenom(); ?></td>
                        <td><?php echo $m->getCin(); ?></td>
                        <td><?php echo $m->getEmail(); ?></td>
                        <td><?php echo $m->getTelephone(); ?></td>
                        <td><?php echo $m->getSexe(); ?></td>
                        <td><?php echo $m->getDateNaissance(); ?></td>
                        <td><?php echo $m->getAdresse(); ?></td>
                        <td><?php echo $m->getNumFix(); ?></td>
                        <td><?php echo $m->getSpecialite()->getNom(); ?></td>
                        <td>
                            <a href="controller/deleteMedecin.php?id=<?php echo $m->getId(); ?>">Supprimer</a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>

    </body>
</html>