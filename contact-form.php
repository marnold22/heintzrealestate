<?php

// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Load Composer's autoloader
require 'vendor/autoload.php';


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

        //Unset the post submission (for next load)
        unset($_POST['submit']);

        // Compose the email
        $composed_email = "";
        $composed_email .= "First Name: ".$first_name."<br>";
        $composed_email .= "Last Name: ".$$last_name."<br>";
        $composed_email .= "Email: ".$email."<br>";
        $composed_email .= "Interested in: ".$checklist."<br>";
        $composed_email .= "Message: ".$message."<br>";

        // Create new PHPMailer object
        $mail = new PHPMailer(TRUE);

        // Server settings
        // $mail->SMTPDebug = SMTP::DEBUG_OFF;                              // Enable verbose debug output
        // $mail->isSMTP();                                                 // Send using SMTP
        // $mail->Host       = 'SEND_GRID_HOST';                            // Set the SMTP server to send through
        // $mail->SMTPAuth   = true;                                        // Enable SMTP authentication
        // $mail->Username   = SEND_GRID_FROM_USER_CREDENTIALS;                  // SMTP username
        // $mail->Password   = SEND_GRID_FROM_PASS_CREDENTIALS;             // SMTP password
        // $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;              // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
        // $mail->Port       = 587;                                         // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above


        // Test Settings
        $mail->SMTPDebug = SMTP::DEBUG_SERVER;
        $mail->isSMTP();
        $mail->Host       = 'SEND_GRID_HOST';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'SEND_GRID_FROM_USER_CREDENTIALS';
        $mail->Password   = 'SEND_GRID_FROM_PASS_CREDENTIALS';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->Port       = 465;


        //Recipients
        $mail->setFrom('SEND_GRID_FROM_CREDENTIALS', 'Benjamin Heintz');  // Set default address that emails are sent from
        $mail->addAddress('BENS_EMAIL_HERE', 'Benjamin Heintz');          // This is who the email is being sent to (ie. Ben's work email)

        // Content
        $mail->isHTML(true);                                             // Set email format to HTML
        $mail->Subject = 'Request More Information From Website';        // Subject
        $mail->Body    = $composed_email;                                // Body
        $mail->AltBody = $composed_email;                                // Alt. Body

        // Send the email
        if ($mail->send()) {
            $mailsend_success = "Message sent! Thank you for contacting us.";
            echo '<script>alert("'.$mailsend_success.'")</script>';
            reset_form_data();

        } else {
            $mailsend_error = "Message could not be sent. Mailer Error: {" . $mail->ErrorInfo . "}";
            echo '<script>alert("'.$mailsend_error.'")</script>';
            reset_form_data();
        }

    }

}