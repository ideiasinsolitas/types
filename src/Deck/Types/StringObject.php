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
class StringObject
{

    /**
     * @var
     */
    protected $string;

    /**
     * The short description
     *
     * @access public
     * @param  type [ $varname] description
     * @return type description
     */
    public function __construct($string = null)
    {

        if ($string && is_string($string)) {
            $this->string = $string;
        
        } else {
            $this->string = '';
        }
    }

    /**
     * The short description
     *
     * @access public
     * @param  type [ $varname] description
     * @return type description
     */
    public function __toString()
    {
        return trim($this->string);
    }

    /**
     * The short description
     *
     * @access public
     * @param  type [ $varname] description
     * @return type description
     */
    public function __set($name, $value)
    {
        if ($name === 'string' && !is_string($value)) {
            throw new \InvalidArgumentException('this->string must be string.');
            
        } else {
            $this->$name = $value;
        }
    }

    /**
     * The short description
     *
     * @access public
     * @param  type [ $varname] description
     * @return type description
     */
    public function append($string)
    {
        $this->string = $this->string . $string;
        return $this;
    }

    /**
     * The short description
     *
     * @access public
     * @param  type [ $varname] description
     * @return type description
     */
    public function prepend($string)
    {
        $this->string = $string . $this->string;
        return $this;
    }

    /**
     * The short description
     *
     * @access public
     * @param  type [ $varname] description
     * @return type description
     */
    public function replace($subject, $replacement)
    {
        $this->string = str_replace($subject, $replacement, $this->string);
        return $this;
    }

    /**
     * The short description
     *
     * @access public
     * @param  type [ $varname] description
     * @return type description
     */
    public function contains($string)
    {
        if (strpos($this->string, $string) !== false) {
            return true;
        }
        return false;
    }
}
