#!/usr/bin/php
<?PHP

if ($argc >= 2) {
    date_default_timezone_set("Europe/Paris");
    $months = array('janvier' => 1, 'février' => 2, 'mars' => 3, 'avril' => 4,
                    'mai' => 5, 'juin' => 6, 'juillet' => 7, 'août' => 8,
                    'septembre' => 9, 'octobre' => 10, 'novembre' => 11, 'décembre' => 12);
    $wdays = array('lundi' => 1, 'mardi' => 2, 'mercredi' => 3, 'jeudi' => 4,
                   'vendredi' => 5, 'samedi' => 6, 'dimanche' => 7);

    $pattern = "/^([A-Z]?[a-z]+) ([0-9]{1,2}) ([A-Z]?[a-z]+) ([0-9]{4}) ([0-9]{2}):([0-9]{2}):([0-9]{2})$/";
    preg_match($pattern, $argv[1], $match);
    if (count($match) != 8)
        exit("Wrong Format\n");
    else {
        if ($wdays[strtolower($match[1])] === NULL or $months[strtolower($match[3])] === NULL)
            exit("Wrong Format\n");
        $nday = $match[2];
        $month = $months[strtolower($match[3])];
        $year = $match[4];
        $hour = $match[5];
        $min = $match[6];
        $sec = $match[7];
        echo mktime($hour, $min, $sec, $month, $nday, $year)."\n";
    }
}

?>