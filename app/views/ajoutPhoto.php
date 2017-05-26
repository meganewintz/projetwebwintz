<?php
    require_once "header.php";
    require_once '../ORMs/ORMCategorie.php';
    require_once '../ORMs/ORMPays.php';
    $ormCategorie = new ORMCategorie($bdd);
    $ormPays = new ORMPays($bdd);
?>
<link rel="stylesheet" href="../../public/css/ajoutPhoto.css">
<!-- Form -->
<div class="column">
  <form action="../controllers/controllerAjoutPhoto.php" method="post" enctype='multipart/form-data'>
    <div class="field half first">
      <p>
        <label for="file">Votre photo (JPG ou PNG)</label><br />
        <input type="file" name="file" id="file" /><br />
      </p>
    </div>
    <div class="field half">
        <label for="pseudo">Votre pseudo</label>
        <input type="text" name="pseudo" placeholder="Entrez votre pseudo" id="pseudo" size="20" maxlength="20" autofocus required/>
        <br />
        <label for="pass">Votre mot de passe</label>
        <input type="password" name="pass" id="pass" placeholder="Entrez votre mot de passe" size="20" maxlength="20" required/>
        <br />
        <label for="titre">Titre</label>
        <input type="text" name="titre" id="titre" placeholder="Entrez le titre de votre photo" maxlength="50" required></input>
        <br />
        <label for="description">Description</label>
        <textarea type="text" name="description" id="description" placeholder="Entrez une description de la photo (non obligatoire)" rows="5" cols="50" maxlength="500"></textarea>
    <br />
    <div>
      <label for="categorie">Catégories</label>
      <select name="categorie" id="categorie" required>
      <?php $ormCategorie = new ORMCategorie($bdd);
      $listeCategories = $ormCategorie->getAllCategories();
      foreach ($listeCategories as $categorie) {
          echo "<option value=\"" . $categorie . "\">" . $categorie . "</option>";
      }
      ?>
      </select>
    </div>
    <br />
    <label for="pseudo">Ville</label>
    <input type="text" name="ville" placeholder="Entrez la ville" id="ville" size="50" maxlength="50" required/>
    <br />
    <div>
      <label for="pays">Pays</label>
      <select name="pays" id="pays" required>
      <?php $ormPays = new ORMPays($bdd);
      $listePays = $ormPays->getAllPays();
      foreach ($listePays as $pays) {
          echo "<option value=\"" . $pays . "\">" . $pays . "</option>";
      }
      ?>
      </select>
    </div>
    <br />
  <ul class="actions">
    <li><input value="Envoyer" class="button" type="submit"></li>
  </ul>
  </form>
</div>
</section>
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
      <script src="../js/ajoutPhoto.js"></script>

<?php require_once "footer.php"; ?>
