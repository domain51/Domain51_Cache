<?php

require_once 'Domain51/Cache/Adapter.php';
require_once 'Domain51/Cache/Adapter/memcache/Exception.php';

class Domain51_Cache_Adapter_memcache implements Domain51_Cache_Adapter
{
    private $_data = array();
    private $_memcache = null;
    private $_id = 'cache';
    
    
    public function __construct(array $options = array())
    {
        if (!extension_loaded('memcache')) {
            throw new Domain51_Cache_Adapter_memcache_Exception(
                'memcache extension not loaded'
            );
        }
        if (empty($options['hostname'])) {
            throw new Domain51_Cache_Adapter_memcache_Exception(
                "hostname option must be present"
            );
        }
        
        $this->_memcache = new Memcache();
        $this->_memcache->connect($options['hostname']);
        $cache_data = $this->_memcache->get($this->_id);
        if ($cache_data !== false) {
            $this->_data = $cache_data;
        }
        
        if (!empty($options['id'])) {
            $this->_id = $options['id'];
        }
    }
    
    public function __destruct()
    {
        $this->_memcache->close();
    }
    
    public function __get($key) { }
    
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
    
    public function save()
    {
        $this->_memcache->set($this->_id, $this->_data, 0, 3600);
    }
}