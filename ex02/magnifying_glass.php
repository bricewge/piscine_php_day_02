#!/usr/bin/php
<?PHP

if ($argc > 1) {
    function arrtoupper($matches) {
        return $matches[1].strtoupper($matches[2]).$matches[3];
    }
        $pat_title = "|(<a.*?title=\")(.*?)(\">)|";
    $pat_between = "|(<a.*?>)(.*?)(<)|";
    $content = file_get_contents($argv[1]);
    $content = preg_replace_callback($pat_title, "arrtoupper", $content);
    $result = preg_replace_callback($pat_between, "arrtoupper", $content);
    echo $result;
}

?>