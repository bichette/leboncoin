<?php
$aAnnonces = $oAnnManager->getList();
$aAnnoncesSide = array_slice($oAnnManager->getList(), 0, 3);
?>
<div class="fond">
    <form>
        <div id="ssmenu1">
            <div class="posligne1">
                <input type="text" name="objetrecherche" placeholder="Que recherchez-vous?" class="centreligne"/>

                <select name="catégories" id="categorie" class="centreligne" >
                    <option label="toutes catégories" selected>Toutes categories</option>
                    <option label="chaussures">Chaussures</option>
                    <option label="voitures">Voitures</option>
                </select>
            </div>
            <div class="posligne2">
                <select name="régions" id="region" class="centreligne" >
                    <option value="toute la France" selected>Toute la France</option>
                    <option value="PACA">Provence Alpes Côte d'Azur</option>
                    <option value="Ile de France">Ile de France</option>
                </select>

                <datalist id="villes" >
                    <option value="Brignoles">Brignoles</option>
                    <option label="Marseille" value="Marseille">
                    <option value="Aix en Provence">Aix en Provence</option>
                    <option value="Paris">Paris</option>
                </datalist>

                <input list="villes" name="villes" placeholder="Villes ou Code Postal" class="centreligne" >

                <input type="submit" class="bouton" >
            </div>
        </div>
        <div id="ssmenu2">

            <div class="positionblock">
                <input type="text" name="objetrecherche" placeholder="Que recherchez-vous?" size=30/>
            </div>

            <div class="positionblock">
                <select name="catégories"  style="width:100%;">
                    <option label="toutes catégories" selected>Toutes categories</option>
                    <option label="chaussures">Chaussures</option>
                    <option label="voitures">Voitures</option>
                </select>
            </div>

            <div class="positionblock">
                <select name="régions" style="width:100%;">
                    <option value="toute la France" selected>Toute la France</option>
                    <option value="PACA">Provence Alpes Côte d'Azur</option>
                    <option value="Ile de France">Ile de France</option>
                </select>
            </div>

            <div class="positionblock">
                <datalist style="width:100%;">
                    <option value="Brignoles">Brignoles</option>
                    <option label="Marseille" value="Marseille">
                    <option value="Aix en Provence">Aix en Provence</option>
                    <option value="Paris">Paris</option>
                </datalist>
            </div>

            <div class="positionblock">
                <input list="villes" name="villes" placeholder="Villes ou Code Postal" size=30>
            </div>

            <div class="positionblock">
                <input type="submit" class="bouton" >
            </div>


        </div>

    </form>
</div>
</div>

<div class="corps">
    <section>
        <h2>Annonces</h2>

        <?php
        /* echo '<pre>';
          echo 'article recupere : ';
          print_r($aAnnonces);
          echo '</pre>'; */
        foreach ($aAnnonces as $oAnnonce) {
            echo '<a href="index.php?page=detail_annonce&id=' . $oAnnonce->getId() . '">';
            echo '<article>';
            echo '<div class="date">' . $oAnnonce->getFormattedDate() . '</div>';
            echo '<img src="userfiles/' . $oAnnonce->getPicture() . '" title="imagearticle1" alt="etoile" width="170" height="150"  />';
            echo '<div class="margeg">';
            echo '<h2 style="color: #3973ac;">' . $oAnnonce->getTitle() . '</h2>';
            echo '<p>' . substr($oAnnonce->getDescription(), 0, 100) . '</p>';
            echo '<p style="color: #ff6600; font-style: bold; font-size: 20px;">' . $oAnnonce->getPrice() . '€</p>';
            echo '</div>';
            echo '<hr/>';
            echo '<p class="ligne"></p>';
            echo '</article>';
            echo '</a>';
        }
        ?>

    </section>
    <aside class="corpsd">

        <div style="background-color: #A9A9A9;">
            <h2 class="titreA">Annonces à la une</h2>

            <?php
            foreach ($aAnnoncesSide as $oAnnonce) {
                echo '<article>';
                echo '<h2>article</h2>';
                echo '<div>' . $oAnnonce->getFormattedDate() . '</div>';
                echo '<img src="userfiles/' . $oAnnonce->getPicture() . '" title="imagearticle4" alt="etoile" class="imgaside" />';
                echo '<p class="titrebleu"><strong>' . $oAnnonce->getTitle() . '</strong></p>';
                echo substr($oAnnonce->getDescription(), 0, 40);
                echo '<p class="prix"><strong>' . $oAnnonce->getPrice() . '</strong></p>';
                echo '</hr>';
                echo '</article>';
            }
            ?>

            <ul style="padding:0px; text-align:center;" >
                <li class="savoirplus"><a href="images/etoile.jpg">En savoir plus</a></li>
            </ul>

        </div>
    </aside>
</div>

