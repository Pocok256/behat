<?php

use Behat\Behat\Context\Context;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;
use Behat\MinkExtension;
use Behat\Behat\Hook\Scope\AfterStepScope;

/**
 * Defines application features from the specific context.
 */
class FeatureContext extends \Behat\MinkExtension\Context\MinkContext
{
    /**
     * Initializes context.
     *
     * Every scenario gets its own context instance.
     * You can also pass arbitrary arguments to the
     * context constructor through behat.yml.
     */
    public function __construct()
    {
    }

    /**
    Take screenshot,html dump, and some error message when step fails.
    Works only with Selenium2Driver. *
    @afterstep
     */
    /** @AfterStep */
    public function afterStep(AfterStepScope $scope)
    {
        self::takeScreenshotAfterFailedStep($scope);
    }
    public function takeScreenshotAfterFailedStep($scope) {
        if($scope->getTestResult()->getResultCode() == 99) {
            $current_scenario =  "dummy";
            $file_and_path_html = 'tmp/' . time() . $current_scenario . '.html';
            $file_and_path_png = 'tmp/' . time() . $current_scenario . '.jpg';
            $file_and_path_txt = 'tmp/' . time() . $current_scenario . '.txt';
            $errorStep = $scope->getStep()->getText();
            file_put_contents(htmlspecialchars($file_and_path_txt), $errorStep);
            $html_data = $this->getSession()->getDriver()->getContent();
            file_put_contents(htmlspecialchars($file_and_path_html), $html_data);
            $image_data = $this->getSession()->getDriver()->getScreenshot();
            file_put_contents(htmlspecialchars($file_and_path_png), $image_data);
        }
    }
}
