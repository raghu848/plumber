<?php
//$cache_key = $_REQUEST['url'];
//$cachedValue = apc_fetch($cache_key);
//if ($cachedValue) {
    //echo $cachedValue;
//} else {
    function sanitize_output($buffer) {
    $search = array(
        '/(\n|^)(\x20+|\t)/',
        '/(\n|^)\/\/(.*?)(\n|$)/',
        '/\n/',
        '/\<\!--.*?-->/',
        '/(\x20+|\t)/', # Delete multispace (Without \n)
        '/\>\s+\</', # strip whitespaces between tags
        '/(\"|\')\s+\>/', # strip whitespaces between quotation ("') and end tags
        '/=\s+(\"|\')/'); # strip whitespaces between = "'
    
       $replace = array(
        "\n",
        "\n",
        " ",
        "",
        " ",
        "><",
        "$1>",
        "=$1");
        
        $buffer = preg_replace($search, $replace, $buffer);
        return $buffer;
    }
    ob_start("sanitize_output");
    $page = file_get_contents(__DIR__ .'/'. $_REQUEST['url']);
    //apc_store($cache_key, $page, 3600);
    echo $page;
    ob_end_flush();
//}
?>