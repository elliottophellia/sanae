<?php
/*
AUTHOR : REIDHO SATRIA (@elliottophellia)
VERSION : 1.0.1
LICENSE : GPLv2

CREDIT :
https://github.com/hnhx/librex
*/
error_reporting(0);
set_time_limit(0);
ini_set('max_execution_time', 0);
ini_set('memory_limit', '-1');

$red = "\033[1;31m";
$green = "\033[1;32m";
$yellow = "\033[1;33m";
$blue = "\033[1;34m";
$clear = "\033[0m";

function user_agent()
{
    $user_agent = array(
        'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/107.0.0.0 Safari/537.36',
        'Mozilla/5.0 (Linux; Android 10; STK-LX1 Build/HONORSTK-LX1; wv) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/107.0.5304.114 Mobile Safari/537.36',
        'Mozilla/5.0 (Linux; Android 13; SM-G998B Build/TP1A.220624.014; wv) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/107.0.5304.105 Mobile Safari/537.36',
        'Mozilla/5.0 (Macintosh; Intel Mac OS X 13.0; rv:107.0) Gecko/20100101 Firefox/107.0',
        'Mozilla/5.0 (Macintosh; Intel Mac OS X 13_0_1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/107.0.0.0 Safari/537.36',
        'Mozilla/5.0 (iPhone; CPU iPhone OS 16_1 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) CriOS/107.0.5304.101 Mobile/15E148 Safari/604.1',
        'Mozilla/5.0 (iPad; CPU OS 16_1 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) CriOS/107.0.5304.101 Mobile/15E148 Safari/604.1',
        'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/107.0.0.0 Safari/537.36',
        'Mozilla/5.0 (Windows Mobile 10; Android 10.0; Microsoft; Lumia 950XL) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/107.0.0.0 Mobile Safari/537.36 Edge/40.15254.603',
        'Mozilla/5.0 (iPhone; CPU iPhone OS 16_1_1 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/16.0 EdgiOS/107.1418.52 Mobile/15E148 Safari/605.1.15'
    );
    return $user_agent[array_rand($user_agent)];
}

function librex()
{
    $urlgoogle = array(
        'https://librex.beparanoid.de/api.php?q=',
        'https://lx.vern.cc/api.php?q=',
        'https://search.davidovski.xyz/api.php?q=',
        'https://search.funami.tech/api.php?q=',
        'https://search.madreyk.xyz/api.php?q=',
        'https://search.pabloferreiro.es/api.php?q=',
        'https://buscar.weblibre.org/api.php?q=',
        'https://search.ahwx.org/api.php?q=',
        'https://pufe.org/api.php?q=',
        'https://librex.kitscomputer.tk/api.php?q=',
        'https://librex.smlan.dev/api.php?q=',
        'https://linxer.org/api.php?q='
    );
    return $urlgoogle[array_rand($urlgoogle)];
}

function request($dork, $page , $output)
{
    $i = 1;
    while ($i <= $page) {
        $options  = array('http' => array('user_agent' => user_agent()));
        $context  = stream_context_create($options);
        $response = file_get_contents(librex() . urlencode($dork) . '&p=' . $i . '&type=0', false, $context);
        $json = json_decode($response, true);
        $file = fopen($output, "w");
        foreach ($json as $data) {
            echo $data['url'] . PHP_EOL;
            fwrite($file, $data['url'] . PHP_EOL);
        }
        $i++;
    }
}

function banner()
{
    echo "
    $GLOBALS[red]Donate
$GLOBALS[blue]https://saweria.co/ophellia$GLOBALS[yellow]     ⢀⣤⣶⣾⣿⣿⣿⣿⡿⠿⠛⠛⠛⣛⡓⠶⠤⣄⡀⠀⠀⠀⠀⠀⠀⠀⠀⠀
 ⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⢀⣠⣶⣿⣿⣿⣿⣿⢯⣷⣾⣆⠀⠀⠀⣀⣈⣿⣿⠆⠀⠀⠉⠓⢄⠀⠀⠀⠀⠀⠀⠀
 ⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⢀⣴⣿⣿⣿⣿⣿⠟⠋⠀⢸⣿⣿⣿⣿⣿⣿⣿⣿⣿⣷⡄⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀
 ⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⢠⣤⣶⣶⣀⣀⡐⠛⠿⠿⣿⣿⠟⠁⠀⠀⠀⢈⣾⣿⣿⣿⣿⣿⣿⣿⣿⣿⣭⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀
 ⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⣠⣴⡾⠿⠛⠛⠛⢻⣿⣿⣿⣿⣶⣶⠿⠤⢤⣤⣤⣴⡿⠈⢻⣿⣿⣿⣿⣿⣿⣿⠟⠁⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀
 ⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⣰⣾⡿⠛⠁⠀⠀⠀⠀⢠⣿⣿⣿⣿⣿⣿⠃⠀⠀⠀⠀⠀⠀⠀⠀⠀⠙⣿⣿⣿⣿⣿⠋⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀
 ⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⣼⡿⠋⠀⠀⠀⠀⠀⠀⢀⣿⣿⣿⣿⣿⣿⡇⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⣽⣿⣿⣿⣯⣤⣄⡀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀
 ⣀⠀⠀⠀⠴⠷⠶⠦⣤⣄⣠⠔⠋⠀⠀⠀⠀⠀⠀⠀⠀⣸⣿⣿⣿⣿⣿⣿⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⣸⣿⣿⣿⣿⡟⢻⣿⣿⣷⡄⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀
 ⠉⠁⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⢀⣠⣴⣿⣶⣾⣿⣶⣶⣦⠤⣤⣀⡀⠀⠀⠀⠀⣀⣤⣾⣯⣼⣿⣿⣿⣿⣾⣿⣿⣿⣿⣦⡀⠀⠀⠀⠀⠀⠀⠀⠀
 ⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⢀⡾⠋⠉⠀⣿⣿⣿⣿⣿⣿⣿⠀⠀⠈⠉⠙⠛⠻⠿⠛⠋⣿⣿⣿⣿⣿⣿⣿⣿⣿⠀⠙⣿⣿⣿⣦⡀⠀⠀⠀⠀⠀⠀
 ⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⣀⣠⣤⠴⠟⠀⠀⠀⠀⢿⣿⣿⣿⣿⣿⣿⡇⠀⠀⠀⠀⠀⠀⠀⠀⣠⣾⣿⣿⣿⣿⣿⣿⣿⡏⠀⠀⠈⣹⣿⣿⡿⠂⠀⠀⠀⠀⠀
 ⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⣰⣿⣥⠀⠀⠀⠀⠀⠀⠀⠀⢸⣿⣿⣿⣿⣿⣿⣷⠀⠀⠀⠀⠀⠀⠀⠀⣿⣿⣿⠿⣿⣿⣿⣿⣿⣇⣠⣶⣾⣿⠿⠋⠀⠀⠀⠀⠀⠀⣰
 ⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠉⠉⠁⠀⠀⠀⠀⠀⠀⠀⠀⠈⣿⣿⣿⣿⣿⣿⣿⣇⠀⠀⠀⠀⠀⠀⢸⣿⣿⣏⠀⣿⣿⣿⣿⣿⣿⣿⣿⣿⣧⣄⠀⠀⠀⠀⠀⠀⢰⡏
 ⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠸⣿⣿⣿⣿⣿⣿⣿⣧⠀⠀⠀⠀⠀⠀⠙⢿⣿⣷⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣇⡀⠀⠀⠀⣴⡿⠀
 ⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⢹⣿⣿⣿⣿⣿⣿⣿⣷⣄⠀⠀⠀⠀⠀⣠⣾⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⠃⠀⣠⣾⡿⠁⠀
 ⠀⠀⠀⠀⠀$GLOBALS[green]╔═╗╔═╗╔╗╔╔═╗╔═╗$GLOBALS[yellow]⠀⠀⠀⠀⠹⣿⣿⣿⣿⣿⣿⣿⣿⣷⣤⡀⠐⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣁⣴⣾⣿⡟⠁⠀⠀
 ⠀⠀⠀⠀⠀$GLOBALS[green]╚═╗╠═╣║║║╠═╣║╣$GLOBALS[yellow]⠀⠀⠀⠀⠀⠀⠀⠙⢿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣷⣾⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⡿⠋⠀⠀⠀⠀
 ⠀⠀⠀⠀⠀$GLOBALS[green]╚═╝╩ ╩╝╚╝╩ ╩╚═╝$GLOBALS[yellow]⠀⠀⠀⠀⠀⠀⠀⠀⠀⠙⠻⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⡿⠋⠀⠀⠀⠀⠀⠀
 ⠀⠀⠀⠀⠀$GLOBALS[clear]elliottophellia$GLOBALS[yellow]⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀ ⠀⠙⠻⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⡿⠿⠋⠀⠀⠀⠀⠀⠀⠀⠀
 ⠀⠀⠀⠀⠀⠀⠀⠀$GLOBALS[green]v$GLOBALS[clear]1$GLOBALS[green].$GLOBALS[red]0$GLOBALS[green].$GLOBALS[blue]1$GLOBALS[yellow]⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀ ⠀⠀⠈⠉⠙⠛⠛⠛⠛⠛⠛⠛⠛⠉⠉⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀$GLOBALS[clear]

Dorking Google From LibreX, The Best Dorking Tool You Can Find!

Usage: php sanae.php [$GLOBALS[green]dork$GLOBALS[clear]] [$GLOBALS[green]page$GLOBALS[clear]] [$GLOBALS[green]output$GLOBALS[clear]]

[$GLOBALS[green]dork$GLOBALS[clear]] - google dork to use, use quotes if you want to use more than one word
[$GLOBALS[green]page$GLOBALS[clear]] - number of pages to scan, default is 1
[$GLOBALS[green]output$GLOBALS[clear]] - clean url only output, default is sanae.txt

Note: If results are not showing, try to rerun the script.

";
}

if (isset($argv[1])) {
    if (is_file($argv[1])) {
        echo "ERROR: You can't use a file as dork!";
        exit;
    } else {
        $dork = $argv[1];
    }
    if (isset($argv[3])) {
        $output = $argv[3];
    } else {
        $output = "sanae" . "_" . rand() . ".txt";
    }
    if (isset($argv[2])) {
        if (is_numeric($argv[2])) {
            $page = $argv[2];
        } else {
            $output = $argv[2];
            $page = 1;
        }
    } else {
        $page = 1;
    }
    banner();
    echo "Dork: $dork\r\nPage: $page\r\nOutput: $output";
    echo "\r\n\r\n";
    echo request($dork, $page, $output);
} else {
    banner();
    echo "Dork: ";
    $dork = trim(fgets(STDIN));
    if (is_file($dork)) {
        echo "$GLOBALS[red]ERROR$GLOBALS[clear]: You can't use a file as dork!\r\n";
        exit;
    }
    echo "Page: ";
    $page = trim(fgets(STDIN));
    if (empty($page)) {
        echo "$GLOBALS[yellow]NOTICE$GLOBALS[clear]: Page is empty, using $GLOBALS[red]1$GLOBALS[clear] as default\r\n";
        $page = 1;
    } elseif (!is_numeric($page)) {
        echo "$GLOBALS[red]ERROR$GLOBALS[clear]: Page must be a number!\r\n";
        exit;
    }
    echo "Output: ";
    $output = trim(fgets(STDIN));
    if (empty($output)) {
        $output = "sanae" . "_" . rand() . ".txt";
        echo "$GLOBALS[yellow]NOTICE$GLOBALS[clear]: Output is empty, using $GLOBALS[red]$output$GLOBALS[clear] as default";
    }
    echo "\r\n\r\n";
    echo request($dork, $page, $output);
}
