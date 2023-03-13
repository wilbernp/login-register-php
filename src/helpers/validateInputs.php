<?php
function validateInputs()
{
    $errors = [];
    foreach ($_POST as $key => $value) {
        if (empty($value)) {
            $errors[$key] = ucfirst($key) . ' is equired';
        }
    }

    return $errors;
}

?>