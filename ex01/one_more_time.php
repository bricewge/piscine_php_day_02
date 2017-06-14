#!/usr/bin/php
<?PHP

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
error_reporting(E_NOTICE);

setlocale(LC_TIME, "fr_FR");
date_default_timezone_set("Europe/Paris");

if ($argc >= 2) {
    $time = strptime($argv[1], "%A %e %B %Y %H:%M:%S");
    echo $argv[1]."\n";
    echo gettype($time)." ".(int)$time."\n";
    print_r($time);
    if ($time !== FALSE) {
        if (strlen($time["unparsed"]) != 0)
            exit("Wrong Format\n");
        $month = ($time["tm_mday"] != 0) ? $time["tm_mday"] - 1 : 0;
        $result = mktime($time["tm_hour"], $time["tm_min"], $time["tm_sec"],
                         $month, $time["tm_mday"], $time["tm_year"] + 1900);
        echo ((int)$result - 60*60)."\n";
    }
    else
        exit("Wrong Format\n");
}

?>