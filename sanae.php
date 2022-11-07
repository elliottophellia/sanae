<?php
/*
        SANAE  - A PHP-CLI SCRIPT FOR DORKING GOOGLE FROM SEARCHIFY
        AUTHOR : @elliottophellia
        VERSION: 1.0.0
        
        DISCLAIMER: 
        THIS SCRIPT IS FOR EDUCATIONAL PURPOSES ONLY.
        I AM NOT RESPONSIBLE FOR ANY ILLEGAL ACTIVITIES YOU MAY DO WITH THIS SCRIPT.
        USE AT YOUR OWN RISK.

*/
error_reporting(0);
$red = "\033[31m";
$green = "\033[32m";
$lightgreen = "\033[1;32m";
$yellow = "\033[33m";
$clear = "\033[0m";
$domain = "https://searchify.vercel.app/search?term="; // if searchify domain is down, fork their repo and build it yourself

function banner() {
    print $GLOBALS['red'];
    print "     _____\n";                       
    print "    / ____|\n";
    print "   | (___   __ _ _ __   __ _  ___\n";
    print "    \___ \ / _` | '_ \ / _` |/ _ \ \n";
    print $GLOBALS['clear'] . $GLOBALS['yellow'];
    print "    ____) | (_| | | | | (_| |  __/ \n";
    print "   |_____/ \__,_|_| |_|\__,_|\___|   v1.0.0\n";
    print $GLOBALS['clear'] . $GLOBALS['green'];
    print "   https://github.com/elliottophellia/sanae\n";
    print $GLOBALS['clear'];
}

function usage() {
    print "\nUsage: php sanae.php [dork] [page]\n";
    print "Dork needs to be in quotes, page is optional default is 1\n";
    print "Example: php sanae.php -d\--dork \"inurl:admin.php?id=1\" -p\--page 2\n";
}

if($argv[1] == "-h" || $argv[1] == "--help") {
    banner();
    usage();
    exit();
} elseif($argv[1] == "-d" || $argv[1] == "--dork") {
    banner();
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
    if($argv[5] == "-o" || $argv[5] == "--output") {
        if(empty($argv[6])) {
            $output = 'result.txt';
        } else {
            $output = $argv[6];
        }
    }
    $ch = curl_init();
    $options = array(
        CURLOPT_URL => $GLOBALS['domain'].$dork.'&start='.$page,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_SSL_VERIFYPEER => false,
        CURLOPT_SSL_VERIFYHOST => false,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_TIMEOUT        => 30,
        CURLOPT_HEADER         => true,
    );
    curl_setopt_array($ch, $options);
    $result = curl_exec($ch);
    curl_close($ch);
    preg_match_all('/<a href="([^"]+)"/', $result, $matches);
    foreach($matches[1] as $match) {
        echo $GLOBALS['lightgreen'].$match."\n";
    }
} else {
    banner();
    exit();
}