#!/usr/bin/php
<?PHP

if ($argc > 1) {
    $ch = curl_init($argv[1]);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $page = curl_exec($ch);
    // $print_r($page);
    print_r(preg_match_all("|<img src=\"(.*?)\".*?>|", $page, $imgurls));
    print_r($imgurls);
    foreach($imgurls[1] as $imgurl) {
        if (print_r(preg_match("|^https?://|") == 0)) {
            $imgurl = $argv[1].$imgurl;
        }
    }
    print_r($imgurls);
    $img = curl_init($imgurl);
    curl_setopt($img, CURLOPT_RETURNTRANSFER, 1);
    $page = curl_exec($ch);
    // if ($ch != FALSE) {
    //     preg_match("|^https?://(.*)$|", $argv[1], $dirname);
    //     // echo $dirname[1];
    //     if (mkdir($dirname[1], "755")) {
    //         // echo "Made it!\n";
    //     }
    // }
}
?>