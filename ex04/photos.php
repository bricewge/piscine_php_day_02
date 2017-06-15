#!/usr/bin/php
<?PHP

if ($argc > 1) {
    // Get the page
    if (($ch = curl_init($argv[1])) !== FALSE) {
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $page = curl_exec($ch);
        curl_close($ch);
    }
    // Get urls of the images
    if ($page !== NULL) {
        preg_match_all("|<img.*?src=\"(.*?)\".*?>|", $page, $imgurls);
        foreach($imgurls[1] as $i => $imgurl) {
            if (preg_match("|^https?://|", $imgurl) === 0) {
                $imgurls[1][$i] = $argv[1].$imgurl;
            }
        }
    }
    // Make dir
    if ($imgurls[1] != NULL) {
        $dirname = parse_url($argv[1], PHP_URL_HOST);
        mkdir($dirname, 0755);
        // Download images
        foreach ($imgurls[1] as $imgurl) {
            $ch_img = curl_init($imgurl);
            curl_setopt($ch_img, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch_img, CURLOPT_FOLLOWLOCATION, 1);
            $img = curl_exec($ch_img);
            curl_close($img);
            $filename = pathinfo($imgurl);
            $fd = fopen($dirname."/".$filename["basename"], "w");
            fputs($fd, $img);
            fclose($fd);
        }
    }
}
?>