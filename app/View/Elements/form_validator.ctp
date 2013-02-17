<?php
/**
  Filename: FormValidatorComponent.php
  @author: Femi TAIWO [dftaiwo@gmail.com]
  Created: Dec 17, 2008  2:22:51 AM
 */
?>
<script>
        $().ready(function(){
<?php
if (isset($validationRules) && is_array($validationRules) && count($validationRules)) {

        foreach ($validationRules as $modelName => $formElements) {

                foreach ($formElements as $elementName => $elementRules) {
                        $elementPath = Inflector::camelize($modelName) . Inflector::camelize($elementName);

                        //Check that we have at least one rule attached 
                        if (is_array($elementRules) && count($elementRules)) {
                                //$continueValidation = true;
                                //Loop through each of the rules for this element and test
                                foreach ($elementRules as $rule => $errMessage) {
                                        if (is_numeric($rule)) {
                                                $rule = $errMessage;
                                                $errMessage = Inflector::humanize($elementName) . ' - ' . ucwords($rule);
                                        }
                                        switch ($rule) {
                                                case FV_REQUIRED:
                                                        echo "$('#$elementPath').attr('required','required');\n";
                                                        $safeErrMessage = addslashes($errMessage);
                                                        echo "$('#$elementPath').attr('title','$safeErrMessage');\n";
                                                        break;
                                        }
                                }
                        }
                }
        }
}
?>

        });
</script>

<?php
$baseUrl = $this->Html->url('/');


if (isset($validationError) && $validationError && count($validationError)) {
        ?>
        <div class="errorMsg" style="color:red;background:#eee;border:1px dotted #ccc;">

                There was an error processing your information.
                <?php
                $message = '';
                $errorFields = array();
                foreach ($validationError as $errorDetails) {
                        if (isset($errorDetails['elementPath'])) {
                                $elementPath = $errorDetails['elementPath'];
                                $errorMessage = $errorDetails['error'];
                                $errorFields[] = Inflector::camelize($elementPath);
                        } else {
                                $errorMessage = $errorDetails;
                        }
                        if (is_array($errorMessage)) {
                                $errorMessage = (isset($errorMessage['error'])) ? $errorMessage['error'] : join(' ', $errorMessage);
                        }
                        $message .= "<br> -&raquo; $errorMessage";
                }
                echo $message;
                ?>

                <style>
                        /*  Echo the element names needing the error style */

                        <?php
                        if (count($errorFields)) {

                                echo '#' . join(',#', $errorFields);
                                ?> {

                                        background-color:#FFFFAC;
                                }
                        <?php } ?>
                </style>


        </div>
<?php } ?>
