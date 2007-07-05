<?php

class Domain51_Cache_Adapter_NullForTesting implements Domain51_Cache_Adapter
{
    public function __construct(array $options = array())
    {
        
    }
    
    public function __get($key) { }
    public function __set($key, $value) { }
    public function save() { }
}