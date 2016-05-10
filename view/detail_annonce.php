<?php

//print_r($_GET);

$oArticle = false;
if (isset($_GET['id'])) {
    //$oArticle = Annonce::getById($_GET['id']);
    $oArticle = $oAnnManager->get($_GET['id']);
}

if ($oArticle) {
    echo '<article>';
    echo '<div class="date">' . $oArticle->getCreatedDate() . '</div>';
    echo '<div>' . $oArticle->getId() . '</div>';
    echo '</br>';
    echo '<div style="background-color: #DCDCDC; width:90%; height: 400px;">';
    echo '<h2 style="color: #3973ac;">' . $oArticle->getTitle() . '</h2>';
    echo '<img src="userfiles/' . $oArticle->getPicture() . '" title="imagearticle1" alt="etoile" width="340" height="300" style="float:left; margin-right:8px; margin-left:8px;" />';
    echo '<p style="color: #ff6600; font-style: bold; font-size: 40px;">' . $oArticle->getPrice() . ' €</p>';
    echo '<div style="padding:0px 8px 8px 8px;">' . $oArticle->getDescription() . '</div>';
    echo '</div>';
    echo '<a href="index.php?delete_ann=' . $oArticle->getId() . '">Supprimer cette annonce</a>';
    echo '</article>';
} else {
    echo '<div>Article inexistant</div>';
}
?>
