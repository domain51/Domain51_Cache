<?php


interface Domain51_Cache_Adapter
{
    public function __construct(array $options = array());
    public function __get($key);
    public function __set($key, $value);
    public function save();
}