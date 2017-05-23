<?php require_once "header.php"; ?>
<link rel="stylesheet" href="../../public/css/ajoutPhoto.css">
<!-- Form -->
<div class="column">
  <form action="../controleurs/controleurAjoutPhoto.php" method="post" enctype='multipart/form-data'>
    <div class="field half first">
      <p>
        <label for="file">Votre photo (JPG, PNG ou GIF | max. 15 Ko) :</label><br />
        <input type="file" name="file" id="file" /><br />
      </p>
    </div>
    <div class="field half">
        <label for="pseudo">* Votre pseudo</label>
        <input type="text" name="pseudo" placeholder="Entrez votre pseudo" id="pseudo" size="20" maxlength="20" autofocus required/>
        <br />
        <label for="pass">* Votre mot de passe</label>
        <input type="password" name="pass" id="pass" placeholder="Entrez votre mot de passe" size="20" maxlength="20" required/>
        <br />
        <label for="description">Description :</label><br />
        <textarea name="description" id="description" placeholder="Entrez votre description de la photo" rows="10" cols="50" maxlength="500"></textarea>
    <label for="pseudo">Ville</label>
    <input type="text" name="ville" placeholder="Entrez la ville" id="ville" size="50" maxlength="50"/>
    <br />
      <label for="pays">Pays</label><br />
      <select name="pays" id="pays" required>
      <option value="france">France</option>
      <option value="espagne">Espagne</option>
      <option value="italie">Italie</option>
      <option value="royaume-uni">Royaume-Uni</option>
      <option value="canada">Canada</option>
      <option value="etats-unis">États-Unis</option>
      <option value="chine">Chine</option>
      <option value="japon">Japon</option>
      </select>
    </div>
  <ul class="actions">
    <li><input value="Envoyer" class="button" type="submit"></li>
  </ul>
  </form>
</div>
<footer>* : obligatoire</footer>
</section>
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
      <script src="../js/ajoutPhoto.js"></script>

<?php require_once "footer.php"; ?>
