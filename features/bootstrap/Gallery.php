<?php

/**
 * Created by PhpStorm.
 * User: pocok
 * Date: 2017. 05. 22.
 * Time: 17:33
 */
class Gallery
{
    public function __construct()
    {
    }
    public function getIndexPHPContent()
    {

    $index = '

<?php

    // Include the UberGallery class
    include(dirname(__DIR__,2).\'/resources/UberGallery.php\');

    // Initialize the UberGallery object
    $gallery = new UberGallery();

    // Initialize the gallery array
    $galleryArray = $gallery->readImageDirectory(\'\');

    // Define theme path
    if (!defined(\'THEMEPATH\')) {
        define(\'THEMEPATH\', $gallery->getThemePath());
    }

    // Set path to theme index
    $themeIndex = $gallery->getThemePath(true) . \'/index.php\';

    // Initialize the theme
    if (file_exists($themeIndex)) {
        include($themeIndex);
    } else {
        die(\'ERROR: Failed to initialize theme\');
    }

    ?>
    
    ';


       return $index;
    }
}