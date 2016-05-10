<?php if ($_SESSION['oUser'] instanceof User) { ?>
    <span>Connecté sous <?php echo $_SESSION['oUser']->getEmail(); ?> </span><br />
    <a href="index.php?logout">Se déconnecter</a>
    <!-- on aurait pu mettre  href="index.php?action=logout"-->
<?php } else {
    ?>
    <form method="POST">
        <label for="email">Email</label>
        <input type="email" name="email" value="" required />

        <label for="password">Mot de passe</label>
        <input type="password" name="password" value="" required />

        <input type="submit" name="loginForm" value="Se connecter"/>
    </form>
<?php } ?>
<div class="logo">
    <img src="images/logoleboncoin.JPG" title="logo" alt="logo leboncoin" width="170" height="100" class="logo" />

    <button id="homeAjax">homeAjax</button>
    <button id="contactAjax" >contactAjax</button>
</div>
<nav>
    <ul class="menu">
        <li class="menu1"><a href="index.php">ACCUEIL</a></li>
        <li class="menu1"><a href="index.php?page=depot_annonce">DEPOSER UNE ANNONCE</a></li>
        <li class="menu1"><a href="images/etoile.jpg">OFFRES</a></li>
        <li class="menu1"><a href="index.php?page=contact">CONTACT</a></li>
    </ul>
</nav>




<p class="ligne"></p>

<!-- On utilise la nouvelle balise HTML5 "nav" pour indiquer un élement de navigation dans notre site -->
<!-- On rajoute une classe spécifique FontAwesome pour afficher une icône pour le menu dans certains cas -->
<div class="responsive">
    <nav class="fa fa-bars">
        <ul>
            <li class="menu1"><a href="index.php">ACCUEIL</a></li>
            <li class="menu1"><a href="index.php?page=depot_annonce">DEPOSER UNE ANNONCE</a></li>
            <li class="menu1"><a href="images/etoile.jpg">OFFRES</a></li>
            <li class="menu1"><a href="index.php?page=contact">CONTACT</a></li>
        </ul>
    </nav>
</div>

