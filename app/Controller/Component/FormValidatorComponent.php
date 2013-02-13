<?php

/**
  Filename: FormValidatorComponent.php
  @author: Femi TAIWO [dftaiwo@gmail.com]
  Created: Dec 17, 2008  2:21:59 AM
 */
App::uses('Component', 'Controller');

define('FV_REQUIRED','required');
define('FV_EMAIL','email');
define('FV_EMPTY_OR_EMAIL','empty_or_email');
define('FV_DATE','date');
define('FV_NUMERIC','numeric');
define('FV_ALPHANUMERIC','alphanum');
define('FV_DOUBLE','double');
define('FV_ALPHA','alpha');
define('FV_RANGE','range');
define('FV_MIN_LENGTH','minlength');
define('FV_MAX_LENGTH','maxlength');
define('FV_URL','website');

class FormValidatorComponent extends Component {

        public $validationRules = false;
        public $validationError = 'Incomplete Data Submitted';
        public $_controller;
        public $controllerObj = true;
        public $data = array();

        /**
         * Constructor
         *
         * @param ComponentCollection $collection A ComponentCollection this component can use to lazy load its components
         * @param array $settings Array of configuration settings.
         */
        public function __construct(ComponentCollection $collection, $settings = array()) {
                $this->_controller = $collection->getController();
                parent::__construct($collection, $settings);
        }

        public function initialize(Controller $controller) {
                $this->_controller = $controller;
        }

        function setRules($rules = array(), $_formName = 'postform') {

                $this->validationRules = $rules;
                $this->_controller->set('_formName', $_formName);

                $this->_controller->set('validationRules', $this->validationRules);
        }

        /**
         * Validate Form submission based on rules
         *
         * @return unknown
         */
        function validate() {

                //Set default values
                $valid = true;
                $continueValidation = true;
                $this->validationError = array();

//		pr($this->data);
//
                $this->data = $this->_controller->data;
                if (empty($this->_controller->data)) {
                        return false;
                }

                //Confirm that rules have been set
                if ($this->validationRules && is_array($this->validationRules) && count($this->validationRules)) {

                        foreach ($this->validationRules as $modelName => $formElements) {

                                if (!isset($this->data[$modelName])) {
                                        //Either developer or cross site hacks can cause this
                                        $msg = "Incomplete Form";
                                        if (Configure::read('debug')) {
                                                $msg = "Incomplete Form: Could not find '$modelName' Model in form";
                                        }
                                        $this->validationError['all'] = array('elementPath' => 'all',
                                            'error' => $msg); //"Could not find $modelName in form";


                                        $continueValidation = false;
                                } else {
                                        //Check that the rules have target elements specified
                                        if (is_array($formElements) && count($formElements)) {
                                                $continueValidation = true;
                                                //Pick up each of the rules attached to an element
                                                foreach ($formElements as $elementName => $elementRules) {
                                                        //Again, developer or cross site hacking/scripting
                                                        if (!array_key_exists($elementName, $this->data[$modelName])) {
                                                                //$this->validationError[] = "Could not find $modelName|$elementName in form";

                                                                $this->validationError[$elementName] = array(
                                                                    'elementPath' => $elementName,
                                                                    'error' => 'Unable to find ' . Inflector::humanize($elementName)
                                                                );
                                                                $continueValidation = false;
                                                        }

                                                        if (isset($this->data[$modelName][$elementName])) {


                                                                //Check that we have at least one rule attached 
                                                                if (is_array($elementRules) && count($elementRules)) {
                                                                        //$continueValidation = true;
                                                                        //Loop through each of the rules for this element and test
                                                                        foreach ($elementRules as $rule => $errMessage) {
                                                                                if (is_numeric($rule)) {
                                                                                        $rule = $errMessage;
                                                                                        $errMessage = Inflector::humanize($elementName) . ' - ' . ucwords($rule);
                                                                                }
                                                                                $elementValue = trim($this->data[$modelName][$elementName]);

                                                                                $this->data[$modelName][$elementName] = $elementValue;

                                                                                switch ($rule) {
                                                                                        case FV_REQUIRED:

                                                                                                $continueValidation = $this->_testRequired($elementValue);

                                                                                                break;

                                                                                        case FV_EMAIL:

                                                                                                $continueValidation = $this->_testEmail($elementValue);

                                                                                                break;
                                                                                        case FV_EMPTY_OR_EMAIL:
                                                                                                $continueValidation = true;
                                                                                                if ($elementValue) {
                                                                                                        $continueValidation = $this->_testEmail($elementValue);
                                                                                                }
                                                                                                break;

                                                                                        case FV_NUMERIC:

                                                                                                $continueValidation = $this->_testNumeric($elementValue);

                                                                                                break;

                                                                                        case FV_ALPHANUMERIC:

                                                                                                $continueValidation = $this->_testAlphaNumeric($elementValue);

                                                                                                break;
                                                                                        case FV_ALPHA:
                                                                                                //strictly alphabets!
                                                                                                $continueValidation = $this->_testAlpha($elementValue);

                                                                                                break;
                                                                                        case FV_MIN_LENGTH:
                                                                                                //for tihs rule, we need a param that would tell us the expected minimum length
                                                                                                if (is_array($errMessage)) {

                                                                                                        $param = (isset($errMessage['param'])) ? $errMessage['param'] : 0;
                                                                                                        $errMessage = (isset($errMessage['error'])) ? $errMessage['error'] : "Error: $elementName is too short. Minimum length is $param character(s);";
                                                                                                } else {
                                                                                                        $param = 0;
                                                                                                }

                                                                                                $continueValidation = $this->_testMinLength($elementValue, $param);




                                                                                                break;
                                                                                        case FV_MAX_LENGTH:
                                                                                                //for tihs rule, we need a param that would tell us the expected maximum length
                                                                                                if (is_array($errMessage)) {

                                                                                                        $param = (isset($errMessage['param'])) ? $errMessage['param'] : 0;
                                                                                                        $errMessage = (isset($errMessage['error'])) ? $errMessage['error'] : "Error: $elementName is too long. Maximum length is $param character(s);";
                                                                                                        $errMessage.=' Current Length is ' . strlen($elementValue) . ' characters';
                                                                                                } else {
                                                                                                        $param = 99999999;
                                                                                                }

                                                                                                $continueValidation = $this->_testMaxLength($elementValue, $param);




                                                                                                break;
                                                                                        case FV_RANGE:
                                                                                                if (is_array($errMessage)) {

                                                                                                        $minValue = (isset($errMessage['min'])) ? $errMessage['min'] : 0;
                                                                                                        $maxValue = (isset($errMessage['max'])) ? $errMessage['max'] : 99999999;
                                                                                                        $errMessage = (isset($errMessage['error'])) ? $errMessage['error'] : "Error: $elementName is invalid. Value should be between $minValue & $maxValue";
                                                                                                } else {
                                                                                                        $param = 99999999;
                                                                                                }

                                                                                                $continueValidation = $this->_testRange($elementValue, $minValue, $maxValue);
                                                                                                break;
                                                                                        case FV_DATE:

                                                                                                $continueValidation = $this->_testDate($elementValue);

                                                                                                break;
                                                                                        case FV_DOUBLE:
                                                                                                $continueValidation = $this->_testDouble($elementValue);
                                                                                                break;
                                                                                        case FV_URL:
                                                                                                $continueValidation = $this->_testUrl($elementValue);
                                                                                                break;
                                                                                        default:
                                                                                                $continueValidation = false;
                                                                                }
                                                                                //If the value failed to pass this validation test, then attach an error

                                                                                if (!$continueValidation) {

                                                                                        $elementPath = Inflector::camelize($modelName) . Inflector::camelize($elementName);
                                                                                        $this->validationError[$elementName] = array(
                                                                                            'elementPath' => $elementPath,
                                                                                            'error' => $errMessage
                                                                                        );

                                                                                        //Since it failed one validation, no need to continue validating this element
                                                                                        //According to Lekan.....Fail one, fail all!
                                                                                        break;
                                                                                }
                                                                        }
                                                                }
                                                        }
                                                }
                                        }
                                }
                        }
                }
//		pr($this->validationError);
                //If I've got any errors in the queue, then definitely, it failed to pass validation
                if (count($this->validationError)) {
                        $this->_controller->set('validationError', $this->validationError);
                        return false;
                }

                return true;
        }

        function getErrors() {

                return $this->validationError;
        }

        function _testRequired($value = '') {


                if (!empty($value) || $value === 0 || $value === '0') {

                        return true;
                } else {

                        return false;
                }
        }

        function _testEmail($value = '') {


                if (!empty($value)) {
                        if (eregi("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$", $value))
                                return true;
                }else {

                        return false;
                }
        }

        function _testNumeric($value = '') {


                if (!empty($value) || $value === '0') {
                        if ($value == ereg_replace("[^0-9]", '__', $value))
                                return true;
                }else {

                        return false;
                }
                return false;
        }

        function _testAlphaNumeric($value = '') {


                if (!empty($value)) {
                        if (preg_match('/^[a-zA-Z0-9]+$/', $value))
                                return true;
                }else {

                        return false;
                }
        }

        function _testAlpha($value = '') {


                if (!empty($value)) {
                        if (preg_match("/^[a-zA-Z]+$/", $value))
                                return true;
                }else {

                        return false;
                }
        }

        /** not yet tested or in use 16-01-2008 */
        function _testRange($value = '', $min = 0, $max = false) {
                if (!is_numeric($value)) {
                        return false;
                }

                if (!$max) {

                        $max = 99999999999;
                }

                if (!empty($value)) {

                        if ($value >= $min && $value <= $max) {
                                return true;
                        }
                }

                return false;
        }

        function _testMinLength($value = '', $minlength = 0) {

                if (strlen($value) >= $minlength) {
                        return true;
                }

                return false;
        }

        function _testMaxLength($value = '', $maxlength = 0) {

                if (strlen($value) <= $maxlength) {
                        return true;
                }

                return false;
        }

        function _testDate($value) {

                if (strlen($value) != 10)
                        return false;

                $parts = explode('-', $value);

                if (count($parts) != 3)
                        return false;

                return checkdate($parts[1], $parts[2], $parts[0]);
        }

        function _testDouble($value) {

                if (!is_null($value)) {
                        if ($value == ereg_replace("[^0-9\.]", '__', $value)) {

                                return true;
                        }
                }
                return false;
        }

        function _testUrl($value) {


                return true;
        }

}

