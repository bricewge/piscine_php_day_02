#!/usr/bin/php
<?PHP

if ($argc >= 2) {
    $result = trim($argv[1]);
    $result = preg_replace("([\s\t]+)", " ", $result);
    echo $result;
}

?>