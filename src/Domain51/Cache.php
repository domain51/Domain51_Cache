<?php

require_once 'Domain51/Cache/Adapter.php';
require_once 'Domain51/Cache/Exception.php';

class Domain51_Cache
{
    private $_adapter = null;
    
    public function __construct($type, array $options = array())
    {
        $this->_adapter = self::factory($type, $options);
    }
    
    public function __get($key)
    {
        return $this->_adapter->$key;
    }
    
    public function __set($key, $value)
    {
        $this->_adapter->$key = $value;
    }
    
    public function save()
    {
        $this->_adapter->save();
    }
    
    public function factory($type, array $options = array())
    {
        $adapter_name = 'Domain51_Cache_Adapter_' . $type;
        if (!class_exists($adapter_name)) {
            @include_once str_replace('_', '/', $adapter_name) . '.php';
            if (!class_exists($adapter_name)) {
                throw new Domain51_Cache_Exception(
                    "Requested adapter [{$type}] does not exist"
                );
            }
        }
        
        $adapter = new $adapter_name();
        if (!$adapter instanceof Domain51_Cache_Adapter) {
            throw new Domain51_Cache_Exception(
                "Requested adapter [{$type}] does not implement Domain51_Cache_Adapter"
            );
        }
        
        $adapter->init($options);
        return $adapter;
    }
}