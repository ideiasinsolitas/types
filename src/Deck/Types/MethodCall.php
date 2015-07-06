<?php

namespace Deck\Application;

class MethodCall
{
    protected $object;
    protected $methodName;
    protected $params;
    protected $result;

    public function __construct($object, $methodName, array $params = null)
    {
        $this->set($object, $methodName, $params);
    }

    public function set($object, $methodName, array $params = null)
    {
        $this->object = $object;
        $this->methodName = $methodName;
        $this->params = $params;
        return $this;
    }

    public function get() {
        return $this->result;
    }

    public function getParam($name) {
        return $this->$name;
    }

    public function getParams() {
        return array(
            'object' => $this->object, 
            'methodName' => $this->methodName, 
            'params' => $this->params
        );
    }

    public function call()
    {
        if (!is_object($this->object) || !is_string($this->methodName)) {
            throw new \InvalidArgumentException("Error Processing Request");
        }

        if (!method_exists($this->object, $this->methodName)) {
            throw new \InvalidArgumentException("Error Processing Request");
        }

        $object = $this->object;
        $params = $this->params;

        $c = count($params);
        switch ($c) {

            case 0:
                $this->result = $object->$methodName();
                break;
            case 1:
                $this->result = $object->$methodName($params[0]);
                break;
            case 2:
                $this->result = $object->$methodName($params[0], $params[1]);
                break;
            case 3:
                $this->result = $object->$methodName($params[0], $params[1], $params[2]);
                break;
            case 4:
                $this->result = $object->$methodName($params[0], $params[1], $params[2], $params[3]);
                break;
            case 5:
                $this->result = $object->$methodName($params[0], $params[1], $params[2], $params[3], $params[4]);
                break;
            default:
                $this->result = call_user_func_array(array($object, $methodName), $params);
                break;
        }

        return $this;
    }
}
