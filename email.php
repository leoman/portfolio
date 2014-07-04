<?php

    if(isset($_POST['email'])) {

        $email_to = "peter@pmansell.com";
        $email_subject = "New Contact Form Message";

        if(!isset($_POST['name']) || !isset($_POST['email']) || !isset($_POST['message'])) {

            die();

        }

        $name = $_POST['name'];
        $email = $_POST['email'];
        $message = $_POST['message'];

        $email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';
        $string_exp = "/^[A-Za-z .'-]+$/";

        if(!preg_match($email_exp, $email) || !preg_match($string_exp, $name) || strlen($message) < 2) {
            die();
        }

        $email_message = "Form details below.\n\n";

        function clean_string($string) {
            $bad = array("content-type","bcc:","to:","cc:","href");
            return str_replace($bad,"",$string);
        }


        $email_message .= "Name: ".clean_string($name)."\n";

        $email_message .= "Email: ".clean_string($email)."\n";

        $email_message .= "Message: ".clean_string($message)."\n";

        // create email headers

        $headers = 'From: '.$email."\r\n".

            'Reply-To: '.$email."\r\n" .

            'X-Mailer: PHP/' . phpversion();

        @mail($email_to, $email_subject, $email_message, $headers);

    }