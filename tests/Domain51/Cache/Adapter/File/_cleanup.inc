<?php
$path = dirname(__FILE__) . '/cache';
$directory = new DirectoryIterator($path);
foreach ($directory as $file) {
    if (in_array((string)$file, array('.', '..'))) {
        continue;
    }
    unlink($path . '/' . (string)$file);
}

rmdir($path);
?>