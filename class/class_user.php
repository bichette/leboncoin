<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class User {

    protected $id;
    protected $email;
    protected $password;

    public function __construct($aData = array()) {
        if ($aData) {
            $this->hydrate($aData);
        }
    }

    public function hydrate($aData) {
        $this->setId($aData['id']);
        $this->setEmail($aData['email']);
        $this->setPassword($aData['password']);
    }

    public function getId() {
        return $this->id;
    }

    public function setId($iId) {
        if ($iId > 0) {
            $this->id = $iId;
        }
    }

    public function getEmail() {
        return $this->email;
    }

    public function setEmail($Email) {
        if (strlen($Email) > 0) {
            $this->email = $Email;
        }
    }

    public function getPassword() {
        return $this->password;
    }

    public function setPassword($sPassword) {
        if (strlen($sPassword) > 0) {
            $this->password = $sPassword;
        }
    }

}
