<?php


interface Domain51_Cache_Adapter
{
    public function __get($key);
    public function __set($key, $value);
    public function save();
    public function init(array $options);
}