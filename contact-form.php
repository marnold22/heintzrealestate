<?php

// Clean user input function
function clean_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

// Reset Form
function reset_form_data() {
    $first_name = $last_name = $email = $checklist = $message = "";
    $first_name_err = $last_name_err = $email_err = $checklist_err = $message_err = "";
}

// Set initial variables to empty string ""
$first_name = $last_name = $email = $checklist = $message = "";
$first_name_err = $last_name_err = $email_err = $message_err = "";


// START FORM PROCESS
// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST"){

    // Check required fields are filled
    if(!isset($_POST["inputFirst"]) || !isset($_POST["inputLast"]) || !isset($_POST["inputEmail"]) || !isset($_POST["inputMessage"])) {
        echo "Sorry one of the required fields is missing, please try again!";
        $first_name_err = $last_name_err = $email_err = $message_err = "REQUIRED FIELDS";
        die();
    }

    // FIRST NAME
    $first_name = clean_input($_POST["inputFirst"]);
    if (!preg_match("/^[a-zA-Z ]*$/", $first_name)) {
        $first_name_err = "Only letters and whitespace allowed.";
    }

    // LAST NAME
    $last_name = clean_input($_POST["inputLast"]);
    if (!preg_match("/^[a-zA-Z ]*$/", $last_name)) {
        $last_name_err = "Only letters and whitespace allowed.";
    }

    // EMAIL
    $email = clean_input($_POST["inputEmail"]);
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $email_error = "Invalid email format";
    }

    // MESSAGE
    $message = clean_input($_POST["inputMessage"]);

    // CHECKLIST
    if(isset($_POST[""])) {
        // Loop through all checkboxes           
        foreach($_POST['check_list'] as $selected) {
            $checklist .= strtoupper($selected. ", ");
        }
    }

    if($first_name_err == "" && $last_name_err == "" && $email_err == "" && $message_err == "") {
        // SEND EMAIL
    }

}