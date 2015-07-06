<?php

class MethodCallFactory
{
    public static function make($object, $methodName, array $params = null)
    {
        $call = new MethodCall($object, $methodName, array $params = null);
        return $call->call();
    }
}