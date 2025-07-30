<?php
// cct6_generate_a_inte.php

class ARVRModuleParser {
    private $moduleId;
    private $moduleName;
    private $moduleDescription;
    private $interactiveElements = array();

    function __construct($moduleId, $moduleName, $moduleDescription) {
        $this->moduleId = $moduleId;
        $this->moduleName = $moduleName;
        $this->moduleDescription = $moduleDescription;
    }

    function addInteractiveElement($elementType, $elementId, $elementData) {
        $this->interactiveElements[] = array(
            'elementType' => $elementType,
            'elementId' => $elementId,
            'elementData' => $elementData
        );
    }

    function generateARVRModule() {
        $output = '<!-- AR/VR Module: ' . $this->moduleName . ' -->' . "\n";
        $output .= '<module id="' . $this->moduleId . '">' . "\n";
        $output .= '  <description>' . $this->moduleDescription . '</description>' . "\n";
        foreach ($this->interactiveElements as $element) {
            $output .= '  <' . $element['elementType'] . ' id="' . $element['elementId'] . '">' . "\n";
            $output .= '    ' . $element['elementData'] . "\n";
            $output .= '  </' . $element['elementType'] . '>' . "\n";
        }
        $output .= '</module>' . "\n";
        return $output;
    }
}

// Test Case
$moduleId = 'cct6_test_module';
$moduleName = 'Test AR/VR Module';
$moduleDescription = 'This is a test AR/VR module';

$parser = new ARVRModuleParser($moduleId, $moduleName, $moduleDescription);

$parser->addInteractiveElement('button', 'btn_test', 'Click me!');
$parser->addInteractiveElement('image', 'img_test', 'https://example.com/image.jpg');

echo $parser->generateARVRModule();

?>