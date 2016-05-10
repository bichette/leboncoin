<?php

class Annonce {
    /* protected $iId;
      protected $sTitle;
      protected $sDescription;
      protected $sImage;
      protected $iPrice;
      protected $oDate; */

    protected $id;
    protected $id_user;
    protected $title;
    protected $description;
    protected $picture;
    protected $price;
    protected $created_date;
    protected $updated_date;
// On utilise un attribut "static" (propre à notre référentiel Annonce)
// pour gérer un ID automatique des annonces

    public static $NB_ANNONCES = 0;

    /*
      public function __construct() {
      self::$NB_ANNONCES++;
      $this->iId = self::$NB_ANNONCES;
      }
     */

    public function __construct($aData = array()) {
        if ($aData) {
            $this->hydrate($aData);
        }
    }

    public function hydrate($aData) {
        $this->setId($aData['id']);
        $this->setIdUser($aData['id_user']);
        $this->setTitle($aData['title']);
        $this->setDescription($aData['description']);
        $this->setPicture($aData['picture']);
        $this->setPrice($aData['price']);
        $this->setCreatedDate($aData['created_date']);
        $this->setUpdatedDate($aData['updated_date']);
    }

    public static function load() {
        $aList = array();

        foreach (glob('data/annonce*') as $sFilepath) {
            $aList[] = unserialize(file_get_contents($sFilepath));
            //unserialize recrée la valeur originale de la variable ici 1 objet
        }

        Annonce::$NB_ANNONCES = count($aList);

        return $aList;
    }

    public static function getById($id) {
        $sFilepath = 'data/annonce' . str_pad($id, 3, '0', STR_PAD_LEFT);
        if (file_exists($sFilepath)) {
            return unserialize(file_get_contents($sFilepath));
        }
    }

    public function save() {
        echo 'je suis ds save';
        echo 'nb d articles : ' . $this->getId();
//str_pad : on veut 3 car, remplacer les manquants par des 0, et finir par le nb d annonces
        $sFilename = 'data/annonce' . str_pad($this->getId(), 3, '0', STR_PAD_LEFT);
        file_put_contents($sFilename, serialize($this));
        //serialize transforme un objet en texte
    }

    /*
      On crée une fonction pour retourner la valeur 'lisible'
      de notre propriété oDate (de type DateTime)
     */

    public function getFormattedDate() {
        if ($this->created_date instanceof DateTime) {
            return $this->created_date->format('Y-m-d H:i:s');
        }
        return $this->created_date;
    }

    /*
      Getteurs/Setters de nos propriétés

     */

    public function getId() {
        return $this->id;
    }

    public function setId($iId) {
        if ($iId > 0) {
            $this->id = $iId;
        }
    }

    public function getIdUser() {
        return $this->id_user;
    }

    public function setIdUser($iIdUser) {
        if ($iIdUser > 0) {
            $this->id_user = $iIdUser;
        }
    }

    public function getTitle() {
        return $this->title;
    }

    public function setTitle($sNewTitle) {
        $this->title = $sNewTitle;
    }

    public function getDescription() {
        return $this->description;
    }

    public function setDescription($sNewDescription) {
        if (strlen($sNewDescription) > 0) {
            $this->description = $sNewDescription;
        }
    }

    public function getPicture() {
        return $this->picture;
    }

    public function setPicture($sNewImage) {
        if (strlen($sNewImage) > 0) {
            $this->picture = $sNewImage;
        }
    }

    public function getPrice() {
        return $this->price;
    }

    public function setPrice($iNewPrice) {
        if (strlen($iNewPrice) > 0) {
            $this->price = $iNewPrice;
        }
    }

    public function getCreatedDate() {
        return $this->created_date;
    }

    public function setCreatedDate($oNewDate) {
        $this->created_date = $oNewDate;
    }

    public function getUpdatedDate() {
        return $this->updated_date;
    }

    public function setUpdatedDate($oNewDate) {
        $this->updated_date = $oNewDate;
    }

}

?>