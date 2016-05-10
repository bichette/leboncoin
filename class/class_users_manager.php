<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Users_Manager {

    private $oDB;

    /* Constructeur de la classe UsersManager
      On passe le paramètre $oDB pour l'enregistrer en tant que propriété
     */

    public function __construct(PDO $oDB) {
        $this->oDB = $oDB;
    }

    const TABLE = 'users';

    public function get($iId) {
        /* $oData = mysql_query('SELECT * FROM Users WHERE id = ' . $iId);
          $aLine = mysql_fetch_array($oData, MYSQL_ASSOC);
          if ($aLine) {
          return new User($aLine);
          } */
        $oQuery = $this->oDB->prepare('SELECT * FROM Users WHERE id = ?');
        $oQuery->binValue(1, $iId, PDO::PARAM_INT);
        $oQuery->execute();
        $aLine = $oQuery->fetch(PDO::FETCH_ASSOC);
        if ($aLine) {
            return new User($aLine);
        }
    }

    public function getByEmailAndPassword($sEmail, $sPassword) {
        /* $srequete = 'SELECT * FROM Users WHERE email = "' . $sEmail . '" AND password = "' . $sPassword . '"';

          $oData = mysql_query($srequete);
          $aLine = mysql_fetch_array($oData, MYSQL_ASSOC);

          if ($aLine) {
          return new User($aLine);
          } */
        $oQuery = $this->oDB->prepare('SELECT * FROM ' . self::TABLE . ' WHERE email = :email AND password = :password');
        $oQuery->bindValue(':email', $sEmail, PDO::PARAM_STR);
        $oQuery->bindValue(':password', $sPassword, PDO::PARAM_STR);
        $oQuery->execute();
        $aLine = $oQuery->fetch(PDO::FETCH_ASSOC);
        if ($aLine) {
            return new User($aLine);
        }
    }

    /*
      Insert UN utilisateur (via ses données)
     */

    public function insert(User &$oUser) {
        $oQuery = $this->oDB->prepare('INSERT INTO ' . self::TABLE . '
			(email, password)
			VALUES (:email, :password)');
        $oQuery->bindValue(':email', $oUser->getEmail(), PDO::PARAM_STR);
        $oQuery->bindValue(':password', '', PDO::PARAM_STR);

        if ($oQuery->execute()) {
            // On récupère l'id auto-incrémenté par la base de données
            $oUser->setId($this->oDB->lastInsertId());
            return TRUE;
        } else {
            return FALSE;
        }
    }

    /*
      Met à jour UN utilisateur (via ses données)
     */

    public function update(User $oUser) {
        $oQuery = $this->oDB->prepare('UPDATE ' . self::TABLE . '
			SET
                            email = :email,
                            password = :password,
			WHERE id = :id');
        $oQuery->bindValue(':email', $oUser->getEmail(), PDO::PARAM_STR);
        $oQuery->bindValue(':password', '', PDO::PARAM_STR);
        $oQuery->bindValue(':id', $oUser->getId(), PDO::PARAM_INT);

        if ($oQuery->execute()) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    /*
      Supprime UN utilisateur (via ses données)
     */

    public function delete(User $oUser) {
        $oQuery = $this->oDB->prepare('DELETE ' . self::TABLE . ' WHERE id = :id');
        $oQuery->bindValue(':id', $oUser->getId(), PDO::PARAM_INT);

        if ($oQuery->execute()) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

}
