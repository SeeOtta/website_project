<?php
if (isset($_POST['email'])) {

    // EDIT THE 2 LINES BELOW AS REQUIRED
    $email_from ="form@uikit.totowebontwikkeling.nl";
    $email_tobot = "jarnepeeters6@gmail.com";
    $email_subject = "Aanvraag door bot";

    function problem($error)
    {
        echo "We are very sorry, but there were error(s) found with the form you submitted. ";
        echo "These errors appear below.<br><br>";
        echo $error . "<br><br>";
        echo "Please go back and fix these errors.<br><br>";
        die();
    }

    // validation expected data exists
    if (
        !isset($_POST['name']) ||
        !isset($_POST['email']) ||
        !isset($_POST['message'])
    ) {
        problem('We are sorry, but there appears to be a problem with the form you submitted.');
    }

   
    //bots vangen

    $namebot = $_POST['name']; // required
    $emailbot = $_POST['email']; // required
    $messagebot = $_POST['message']; // required



    $error_message = "";
    $email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';

    if (!preg_match($email_exp, $email)) {
        $error_message .= 'Het opgegeven Email adress lijkt niet te bestaan.<br>';
    }

    $string_exp = "/^[A-Za-z .'-]+$/";

    if (!preg_match($string_exp, $name)) {
        $error_message .= 'De naam die je hebt opgegeven is niet in orde.<br>';
    }

    if (strlen($message) < 2) {
        $error_message .= 'Het opgegeven bericht is niet in orde.<br>';
    }

    if (strlen($error_message) > 0) {
        problem($error_message);
    }

    $email_message = "De bot bezorgde ons volgende gegevens.\n\n";

    function clean_string($string)
    {
        $bad = array("content-type", "bcc:", "to:", "cc:", "href");
        return str_replace($bad, "", $string);
    }

    $email_message .= "Naam: " . clean_string($namebot) . "\n";
    $email_message .= "Email: " . clean_string($emailbot) . "\n";
    $email_message .= "Bericht met datum:" . clean_string($messagebot) . "\n\n";

    // create email headers
    $headers = 'From: ' . $email_from . "\r\n" .
        'Reply-To: ' . $email_tobot . "\r\n" .
        'X-Mailer: PHP/' . phpversion();
    @mail($email_tobot, $email_subject, $email_message, $headers);

    ?>
    Ik werk niet bij bots
    <?php
}

?>