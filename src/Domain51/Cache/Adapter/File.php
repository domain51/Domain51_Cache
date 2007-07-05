<?php

require_once 'Domain51/Cache/Adapter.php';
require_once 'Domain51/Cache/Exception.php';

class Domain51_Cache_Adapter_File implements Domain51_Cache_Adapter
{
    private $_base_dir = null;
    private $_id = 'cache-file';
    private $_data = array();
    
    private $_cache_file = '';
    private $_expire = 3600;
    
    public function __construct(array $options = array())
    {
        if (!isset($options['base_dir'])) {
            throw new Domain51_Cache_Exception(
                'Domain51_Cache_Adapter_File reqiures \'base_dir\' option'
            );
        }
        
        if (!is_dir($options['base_dir'])) {
            throw new Domain51_Cache_Exception(
                'Domain51_Cache_Adapter_File requires a directory for \'base_dir\''
            );
        }
        
        if (!is_writable($options['base_dir'])) {
            throw new Domain51_Cache_Exception(
                'Domain51_Cache_Adapter_File requires a writable directory for \'base_dir\''
            );
        }
        
        $this->_base_dir = $options['base_dir'];
        if (!empty($options['id'])) {
            $this->_id = $options['id'];
        }
        
        if (!empty($options['expire'])) {
            $this->_expire = $options['expire'];
        }
        
        $this->_cache_file = $this->_base_dir . '/' . $this->_id;
        if (file_exists($this->_cache_file) && filemtime($this->_cache_file) > time() - $this->_expire) {
            $this->_data = unserialize(file_get_contents($this->_cache_file));
        }
    }
    
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
    
    public function save()
    {
        $fp = fopen($this->_cache_file, 'w');
        fwrite($fp, serialize($this->_data));
        fclose($fp);
        
    }
}