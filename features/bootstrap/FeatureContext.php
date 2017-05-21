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
    private $filenameHTML;
    private $filenameTXT;
    private $filenameJPG;
    private $errorLogPath;

    /**
     * Initializes context.
     *
     * Every scenario gets its own context instance.
     * You can also pass arbitrary arguments to the
     * context constructor through behat.yml.
     */
    public function __construct()
    {
        $this->filenameHTML = time() . '.html';
        $this->filenameTXT = time() . '.txt';
        $this->filenameJPG = time() . '.jpg';
        $this->errorLogPath = "error_log";
    }

    /** @AfterStep */
    public function afterStep(AfterStepScope $scope)
    {
        $this->makeLogAfterFailedStep($scope);
    }

    /**
     * Take screenshot,html dump, and some error message when step fails.
     * Works only with Selenium2Driver. *
     * @afterstep
     */
    public function makeLogAfterFailedStep($scope)
    {
        if ($scope->getTestResult()->getResultCode() == 99) {
            $featureName = $this->getFeatureName($scope);
            $this->setFeatureDIR($featureName);
            $this->makeTextErrorLog($scope, $featureName);
            $this->makeHtmlErrorLog($featureName);
            $this->makeImageErrorLog($featureName);
        }
    }

    public function getFeatureName($scope)
    {
        return $scope->getFeature()->getTitle();
    }

    /**
     * @param $featureName
     */
    public function makeHtmlErrorLog($featureName)
    {
        $html_data = $this->getSession()->getDriver()->getContent();
        file_put_contents(htmlspecialchars($this->errorLogPath . "/" . $featureName . '/' . $this->filenameHTML),
          $html_data);
    }

    /**
     * @param $scope
     * @param $featureName
     */
    public function makeTextErrorLog($scope, $featureName)
    {
        $errorStep = $scope->getStep()->getText();
        file_put_contents(htmlspecialchars($this->errorLogPath . "/" . $featureName . '/' . $this->filenameTXT),
          $errorStep);
    }

    /**
     * @param $featureName
     */
    public function makeImageErrorLog($featureName)
    {
        $image_data = $this->getSession()->getDriver()->getScreenshot();
        file_put_contents(htmlspecialchars($this->errorLogPath . "/" . $featureName . '/' . $this->filenameJPG),
          $image_data);
    }

    /**
     * @param $featureName
     */
    public function setFeatureDIR($featureName)
    {
        if (!is_dir($this->errorLogPath . '/' . $featureName)) {
            mkdir($this->errorLogPath . "/" . $featureName, "0777");
        }
    }
}
