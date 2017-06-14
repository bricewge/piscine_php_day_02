#!/usr/bin/php
<?PHP

// I got the utmpx file format from:
// https://github.com/jjarava/mac-osx-forensics/blob/master/utmpx.py

date_default_timezone_set("Europe/Paris");
$fd = fopen("/var/run/utmpx", "r");
if ($fd) {
    $header = fread($fd, 296 + 2 + 622 + (4*3) + 324);
    $header = unpack("Z296magic/vid/x622/V2unknown/Vtimestamp/x324", $header);
    if ($header["magic"] == "utmpx-1.00") {
        while (($entry = fread($fd, 256 + 4 + 32 + (4*4) + 256 + 64)) != FALSE) {
            $entry = unpack("Z256user/Vid/Z32tty/Vpid/Vstatus/Vtime/Vusec/Z256host/x64", $entry);
            $time = strftime("  %b %e %H:%M \n", $entry["time"]);
            echo $entry["user"]." ".$entry["tty"].$time;
        }
    }
    fclose($fd);
}

?>