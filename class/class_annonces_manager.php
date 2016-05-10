<?php

class Annonces_Manager {

    private $oDB;

    const TABLE = 'annonces';  // Constante de classe où l'on stocke le nom de la table relative à nos annonces

    public function __construct(PDO $oDB) {
        $this->oDB = $oDB;
    }

    public function getList() {
// $oData = mysql_query('SELECT * FROM annonces');

        $oData = $this->oDB->query('SELECT * FROM annonces');

        /* while ($aLine = mysql_fetch_array($oData, MYSQL_ASSOC)) {
          $oAnnonce = new Annonce($aLine);
          $aList[] = $oAnnonce; */

        while ($aLine = $oData->fetch(PDO::FETCH_ASSOC)) {
            $oAnnonce = new Annonce($aLine);

            $aList[] = $oAnnonce;
        }
// echo '$aList ds getist : ';
//print_r($aList);
        return $aList;
    }

    public function get($iId) {
// $oData = mysql_query('SELECT * FROM annonces WHERE id = ' . $iId);
//$aLine = mysql_fetch_array($oData, MYSQL_ASSOC);
        $oData = $this->oDB->query('SELECT * FROM annonces WHERE id = ' . $iId);
        $aLine = $oData->fetch(PDO::FETCH_ASSOC);

        /* autre solution :
          $oQuery = $this->oDB->prepare('SELECT * FROM ' . self::TABLE . ' WHERE id = ?');
          $oQuery->bindValue(1, $iId, PDO::PARAM_INT);
          $oQuery->execute();
         */
        echo '$aLine ds get :';
        print_r($aLine);


        return new Annonce($aLine);
    }

//& devant une variable pour un passage par reference
// ie on va modifier sa valeur

    public function insert(Annonce &$oAnnonce) {
        /* $sTitle = mysql_escape_string($oAnnonce->getTitle());
          $sDescription = mysql_escape_string($oAnnonce->getDescription());
          $sPicture = $oAnnonce->getPicture();
          $iPrice = $oAnnonce->getPrice();
          $sCreatedDate = $oAnnonce->getFormattedDate();

          $sQuery = 'INSERT INTO annonces (id_user, title,description,picture,price,created_date) VALUES '
          . ' ("", :title", ":description", ":picture", ":price", ":createddate")';
          $sQuery = str_replace(':title', $sTitle, $sQuery);
          $sQuery = str_replace(':description', $sDescription, $sQuery);
          $sQuery = str_replace(':picture', $sPicture, $sQuery);
          $sQuery = str_replace(':price', $iPrice, $sQuery);
          $sQuery = str_replace(':createddate', $sCreatedDate, $sQuery);
          $sQuery = mysql_query($sQuery);
          if ($sQuery)

          $oAnnonce->setId(mysql_insert_id());

          return TRUE;
          }

          return FALSE; */

        $oQuery = $this->oDB->prepare('INSERT INTO ' . self::TABLE .
                ' (id_user, title, description, picture, price, created_date)
      VALUES (:id_user, :title, :description, :picture, :price, :created_date)');
        $oQuery->bindValue(':id_user', $oAnnonce->getIdUser(), PDO::PARAM_INT);
        $oQuery->bindValue(':title', $oAnnonce->getTitle(), PDO::PARAM_STR);
        $oQuery->bindValue(':description', $oAnnonce->getDescription(), PDO::PARAM_STR);
        $oQuery->bindValue(':picture', $oAnnonce->getPicture(), PDO::PARAM_STR);
        $oQuery->bindValue(':price', $oAnnonce->getPrice(), PDO::PARAM_INT);
        $oQuery->bindValue(':created_date', $oAnnonce->getCreatedDate()->format('Y-m-d H:i'), PDO::PARAM_STR);

        if ($oQuery->execute()) {
            $oAnnonce->setId($this->oDB->lastInsertId());
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function update(Annonce $oAnnonce) {

        /*  $sQuery = 'UPDATE Annonces SET '
          . 'title="' . $oAnnonce->getTitle() .
          '",description="' . $oAnnonce->getDescription() .
          '",picture="' . $oAnnonce->getPicture() .
          '",price=' . $oAnnonce->getPrice() .
          ' WHERE id=' . $oAnnonce->getId();

          $oData = mysql_query($sQuery); */

        $oQuery = $this->oDB->prepare('UPDATE ' . self::TABLE . '
			SET
                            title = :title,
                            description = :description,
                            picture = :picture,
                            price = :price
			WHERE id = :id');
        $oQuery->bindValue(':title', $oAnnonce->getTitle(), PDO::PARAM_STR);
        $oQuery->bindValue(':description', $oAnnonce->getDescription(), PDO::PARAM_STR);
        $oQuery->bindValue(':picture', $oAnnonce->getPicture(), PDO::PARAM_STR);
        $oQuery->bindValue(':price', $oAnnonce->getPrice(), PDO::PARAM_INT);
        $oQuery->bindValue(':id', $oAnnonce->getId(), PDO::PARAM_INT);

        if ($oQuery->execute()) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function delete(Annonce $oAnnonce) {
        /* $sQuery = 'DELETE FROM `Annonces`
          WHERE `id` = ' . $oAnnonce->getId();
          $oData = mysql_query($sQuery); */
        $oQuery = $this->oDB->prepare('DELETE FROM ' . self::TABLE . ' WHERE id = :id');
        $oQuery->bindValue(':id', $oAnnonce->getId(), PDO::PARAM_INT);
        if ($oQuery->execute()) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

}

?>