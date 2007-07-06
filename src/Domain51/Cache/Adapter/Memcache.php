<?php

require_once 'Domain51/Cache/Adapter/Abstract.php';
require_once 'Domain51/Cache/Adapter/memcache/Exception.php';

class Domain51_Cache_Adapter_Memcache extends Domain51_Cache_Adapter_Abstract
{
    private $_memcache = null;
    private $_id = 'cache';
    private $_expire = 3600;
    
    
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
        if (!isset($options['port'])) {
            $options['port'] = 11211;
        }
        
        $this->_memcache = new Memcache();
        $connected = @$this->_memcache->connect(
            $options['hostname'],
            $options['port']
        );
        if (!$connected) {
            throw new Domain51_Cache_Adapter_memcache_Exception(
                "unable to connect to memcache server at {$options['hostname']}:{$options['port']}"
            );
        }
        $cache_data = $this->_memcache->get($this->_id);
        if ($cache_data !== false) {
            $this->_data = $cache_data;
        }
        
        if (!empty($options['id'])) {
            $this->_id = $options['id'];
        }
        
        if (isset($options['expire'])) {
            $this->_expire = (int)$options['expire'];
        }
    }
    
    public function save()
    {
        $this->_memcache->set($this->_id, $this->_data, 0, $this->_expire);
    }
}