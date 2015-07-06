<?php

namespace Deck\Types;

/**
 * The short description
 *
 * As many lines of extendend description as you want {@link element}
 * links to an element
 * {@link http://www.example.com Example hyperlink inline link} links to
 * a website. The inline
 *
 * @package package name
 * @author  Pedro Koblitz
 */
class Hash
{

    /**
     * @var
     */
    private $hash;

    /**
     * @var
     */
    private $salt;

    /**
     * @var
     */
    private $encryptionType = 'Sha256';

    /**
     * @var
     */
    private $valid = false;

    /*
     * @access public
     * 
     * @param $encryptionType string
     */
    public function __construct($encryptionType = 'Sha256')
    {

        if ($encryptionType === 'Bcrypt' || $encryptionType === 'Sha256') {
            $this->encryptionType = $encryptionType;
        
        } else {
            throw new \InvalidArgumentException("Only Sha256 and Bcrypt avaiable as hashing algorithms");
        }

        $this->salt = $this->generateSalt();
    }

    /**
     * The short description
     *
     * @access public
     * @param  type [ $varname] description
     * @return type description
     */
    public function setEncryptionType($encryptionType)
    {
        $this->encryptionType = $encryptionType;
        return $this;
    }

    /**
     * The short description
     *
     * @access public
     * @param  type [ $varname] description
     * @return type description
     */
    public function setSalt($salt)
    {
        $this->salt = $salt;
        return $this;
    }

    /*
     * @access public
     * 
     * @param $password string
     * 
     * @return $this
     * 
     */
    public function hash($password)
    {
        $methodName = 'hash' . $this->encryptionType;
        $this->$methodName($password);
        return $this;
    }

    /*
     * @access private
     * 
     * @param $password string
     * 
     * @return void
     * 
     */
    private function hashSha256($password)
    {
        $this->hash = hash("sha256", $password . $this->salt);
        return $this;
    }

    /*
     * @access private
     * 
     * @param
     */
    private function hashBcrypt($password)
    {

        if (defined("CRYPT_BLOWFISH") && CRYPT_BLOWFISH) {
            $this->hash = crypt($password, $this->salt);
        }
        return $this;
    }

     /**
     * The short description
     *
     * @access public
     * @param  type [ $varname] description
     * @return type description
     */
    private function generateSalt()
    {

        $intermediateSalt = md5(uniqid(rand(), true));
        $salt = '$2y$11$' . substr($intermediateSalt, 0, 22);
        return $salt;
    }

    private function md5($string)
    {
        return md5($string);
    }

    /*
     * @access public
     * 
     * @return
     */
    public function __toString()
    {
        return $this->hash;
    }
}
