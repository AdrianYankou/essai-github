<?php
session_start();
$titre = "Ajout de Jeu";
include 'param.inc.php';

?>

<div class="container my-5 justify-center">
    <h1 class="text-center">Ajout de Jeu</h1>
    <form method="POST" action="tt_ajout_jeu.php" enctype="multipart/form-data">
        <div class="row my-3 justify-content-center">
            <div class="col-md-3">
                <label for="nomjeu" class="form-label">Nom du Jeu</label>
                <input type="text" class="form-control" id="nomjeu" name="nomjeu" placeholder="Nom du jeu..." required>
            </div>
        </div>
        <div class="row my-3 justify-content-center">
            <div class="col-md-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" id="description" name="description" placeholder="Description du jeu..." required></textarea>
            </div>
        </div>
        <div class="row my-3 justify-content-center">
            <div class="col-md-3">
                <label for="categorie" class="form-label">Catégorie</label>
                <select class="form-select" id="categorie" name="categorie" required>
                    <option value="jeu_de_carte">Jeu de Carte</option>
                    <option value="jeu_sur_plateau">Jeu sur Plateau</option>
                </select>
            </div>
        </div>
        <div class="row my-3 justify-content-center">
            <div class="col-md-3">
                <label for="regles" class="form-label">Règles du Jeu (PDF)</label>
                <input type="file" class="form-control" id="regles" name="regles" accept=".pdf" required>
            </div>
        </div>
        <div class="row my-3 justify-content-center">
            <div class="col-md-3">
                <label for="photo" class="form-label">Photo du Jeu</label>
                <input type="file" class="form-control" id="photo" name="photo" accept="image/*" required>
            </div>
        </div>
        <div class="row my-3 justify-content-center">
            <div class="col-md-3">
                <div class="d-grid gap-2 d-md-block">
                    <button class="btn btn-outline-primary" type="submit">Ajouter le Jeu</button>
                </div>
            </div>
        </div>
    </form>
</div>
<?php
include 'footer.inc.php';
?>
