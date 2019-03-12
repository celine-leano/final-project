<?php
/**
 * Celine Leano and Adolfo Gonzalez
 * 3/11/2019
 * 328/final-project/model/employee-stock-validation.php
 * Validates stock #
 */

global $f3;

$isValid = true;

if (!empty($_POST)) {
    // check that the input is numeric
    if (!empty($_POST['stock'])) {
        $stock = $_POST['stock'];
        if (!is_numeric($stock)) {
            $f3->set("errorStock", "Stock number cannot contain a non-numeric value");
            $isValid = false;
        } else if (strlen($stock) != 4) {
            // check if input is 4 numbers
            $f3->set("errorStock", "Stock number must contains 4 numbers");
            $isValid = false;
        }
    } else {
        $f3->set("errorStock", "Please enter a stock number");
        $isValid = false;
    }

    if ($isValid) {
        $success = searchStockNum($stock);

        if ($success) {
            $_SESSION['stock'] = $success;
            $f3->reroute("vehicle-info");
        } else {
            $f3->set("errorStock", "Invalid stock number");
        }
    }
}