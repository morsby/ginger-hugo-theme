<?php
# Load other files
include('config.php');
include('functions.php');

if (isset($_POST['submit'])) {
    // Setup empty errorvars
    $nameErr = $emailErr = $websiteErr = $messageErr = $recaptchaErr = "";
    
    // Make sure required fields are filled
    if (empty($_POST["name"])) {
        $nameErr = "Name is required";
    } else {
        $name = clean_input($_POST['name']);
    }
    
    if (empty($_POST["email"])) {
        $emailErr = "Email is required";
    } else {
        $email = clean_input($_POST['email']);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailErr = "Invalid email format";
        }
    }
    
    if (empty($_POST["message"])) {
        $messageErr = "Message is required";
    } else {
        $message = clean_input($_POST['message']);
    }
    
    
    $website = clean_input($_POST['website']);
    if (!empty($website) && !preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i", $website)) {
        $websiteErr = "Invalid URL";
    }
    
    if(!isValid() == true) {
        $recaptchaErr = "There was an error with Google's recaptcha. Maybe you're a bot? If not, try again.";
    }
   
    if (!empty($nameErr) || !empty($emailErr)  || !empty($messageErr)  || !empty($websiteErr) || !empty($recaptchaErr)) {
        $result = array(
            array("error","There was an error handling the form!"),
            array($name,$nameErr),
            array($email,$emailErr),
            array($message,$messageErr),
            array($website,$websiteErr),
            array($recaptcha,$recaptchaErr)
         );
         
        echo json_encode($result);
        die();
    }
   
    $sql =  'INSERT INTO gastebog(name, email, website, message, sent_date) ';
    $sql .= ' VALUES (:name, :email, :website, :message, UNIX_TIMESTAMP() )';

    try {
        $query = $db->prepare($sql);
        $query->bindValue(':name', $name, PDO::PARAM_STR);
        $query->bindValue(':email', $email, PDO::PARAM_STR);
        $query->bindValue(':website', $website, PDO::PARAM_STR);
        $query->bindValue(':message', $message, PDO::PARAM_STR);

        if ($query->execute()) {
            $result = array(
             array("success","Din besked er sendt! Du kan se den nedenfor. <br> Your message is sent! You can see it below."),
             array($name,$nameErr),
             array($email,$emailErr),
             array($message,$messageErr),
             array($website,$websiteErr),
           );
           
            echo json_encode($result);
        } else {
            $result = array(
             array("error","Der skete en fejl!! <br> An error occured!!"),
             array($name,$nameErr),
             array($email,$emailErr),
             array($message,$messageErr),
             array($website,$websiteErr),
           );
           
            echo json_encode($result);
        }
    } catch (Exception $e) {
        echo $e->getMessage();
    }
    $db = null;
    die();
} else {

//now output the data to a simple html table...
    $result = $db->query('SELECT * FROM gastebog WHERE visible = 1 ORDER BY id DESC');

    printMessages($result);
    
   // close the database connection
   $db = null;
    die();
}
