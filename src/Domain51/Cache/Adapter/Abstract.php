<?php

require_once 'Domain51/Cache/Adapter.php';

abstract class Domain51_Cache_Adapter_Abstract implements Domain51_Cache_Adapter
{
    protected $_data = array();
    
    abstract public function __construct(array $options = array());
    
    public function __get($key)
    {
        return $this->_data[$key];
    }
    
    public function __set($key, $value)
    {
        $this->_data[$key] = $value;
    }
    
    public function __isset($key)
    {
        return isset($this->_data[$key]);
    }
    
    public function __unset($key)
    {
        unset($this->_data[$key]);
    }
    
}