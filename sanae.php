<?php
/*
        SANAE  - A PHP-CLI SCRIPT FOR DORKING GOOGLE FROM SEARCHIFY
        AUTHOR : @elliottophellia
        VERSION: 1.0.1
        
        DISCLAIMER: 
        THIS SCRIPT IS FOR EDUCATIONAL PURPOSES ONLY
        I AM NOT RESPONSIBLE FOR ANY ILLEGAL ACTIVITIES YOU MAY DO WITH THIS SCRIPT
        USE AT YOUR OWN RISK.

        NOTE:
        Please notice there is a 100 query limit per day for the google api,
        so don't be confused if there are no results, the only way to get more result is
        buying a google api key then fork searchify repo and build it yourself.

        CREDIT:
        https://github.com/jusoftdev/searchify
*/
error_reporting(0);
$red = "\033[31m";
$green = "\033[32m";
$yellow = "\033[33m";
$clear = "\033[0m";

function banner() {
    print $GLOBALS['red'];
    print "  _____\n";                       
    print " / ____|\n";
    print "| (___   __ _ _ __   __ _  ___\n";
    print " \___ \ / _` | '_ \ / _` |/ _ \ \n";
    print $GLOBALS['clear'] . $GLOBALS['yellow'];
    print " ____) | (_| | | | | (_| |  __/ \n";
    print "|_____/ \__,_|_| |_|\__,_|\___|   v1.0.1\n";
    print $GLOBALS['clear'] . $GLOBALS['green'];
    print "https://github.com/elliottophellia/sanae\n";
    print $GLOBALS['clear']."\n";
}

function usage() {
    print "\nUsage: php sanae.php [dork] [page]\n";
    print "Dork needs to be in quotes, page is optional default is 1\n";
    print "Example: php sanae.php -d\--dork \"inurl:admin.php?id=1\" -p\--page 2\n\n";
}

if($argv[1] == "-h" || $argv[1] == "--help") {
    banner();
    usage();
    exit();
} elseif($argv[1] == "-d" || $argv[1] == "--dork") {
    banner()."\n";
    if(empty($argv[2])) {
        print "Please specify a dork\n";
        exit();
    } else {
        $dork = $argv[2];
    }
    if($argv[3] == "-p" || $argv[3] == "--page") {
        if(empty($argv[4])) {
            $page = '10';
        } elseif($argv[4] == 0) {
            print "Page cannot be 0\n";
            exit();
        } else {
            $page = $argv[4].'0';
        }
    }
    print "Waiting for results...\n\n";
    for ($i = 0; $i <= $page; $i++) {
        $ch = curl_init();
        $options = array(
            CURLOPT_URL => 'https://searchify.vercel.app/search?term='.$dork.'&start='.$i,
        //  CURLOPT_URL => 'https://searchify-ggqllngk2-elliottophellia.vercel.app/search?term='.$dork.'&start='.$i,
        //  CURLOPT_URL => 'http://127.0.0.1:8080/search?term='.$dork.'&start='.$i,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_SSL_VERIFYHOST => false,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_TIMEOUT        => 30,
            CURLOPT_HEADER         => true
        );
        curl_setopt_array($ch, $options);
        $result = curl_exec($ch);
        curl_close($ch);
        preg_match_all('/<a href="([^"]+)"/', $result, $matches);
        $url_array = [];
        foreach($matches[1] as $url) {
            $url_array[] = $url;
        }
    }
    $url_array = array_unique($url_array);
    foreach($url_array as $url) {
        print $url."\n";
    }
} else {
    banner();
    print "\nInvalid option, see --help for usage\n";
    exit();
}