<?php
$dir="error_log";
$files =  glob($dir . '/*' , GLOB_ONLYDIR);

foreach ($files as $file) {
$scenario = explode("/",$file,2);

    echo "<a href='".$file."'>".$scenario[1]."</a>";
}