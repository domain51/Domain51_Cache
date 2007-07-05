--TEST--
Domain51_Cache_Adapter_File's base_dir option must point to a writable directory
--SKIPIF--
<?php if (is_writable('/')) echo "skip - root directory is writable"; ?>
--FILE--
<?php
//BEGIN REMOVE
set_include_path(dirname(__FILE__) . '/../../../../../src/' . PATH_SEPARATOR .
                 get_include_path()
                 );
// END REMOVE

require_once 'Domain51/Cache/Adapter/File.php';

try {
    new Domain51_Cache_Adapter_File(
        array(
            'base_dir' => '/',
        )
    );
    trigger_error('exception not caught');
} catch (Domain51_Cache_Exception $e) {
    echo $e->getMessage() . "\n";
}

?>
===DONE===
--EXPECT--
Domain51_Cache_Adapter_File requires a writable directory for 'base_dir'
===DONE===