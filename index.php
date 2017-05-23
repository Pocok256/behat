<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <title>Behat Error Logs</title>
    <link rel="stylesheet" type="text/css" href="resources/themes/root-folder/root.css" />
</head>
<?php
$dir="error_log";
$files =  glob($dir . '/*' , GLOB_ONLYDIR);

foreach ($files as $file) {
$scenario = explode("/",$file,2);

    echo "<a class='folder' href='".$file."'><img class='folder-icon' src='resources/themes/root-folder/Folder-icon.png' ><p>".$scenario[1]."</p></a>";
}