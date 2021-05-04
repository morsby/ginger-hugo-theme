<?php 
# Check for expired session

if(isset($_SESSION["expire"]) && time() > $_SESSION["expire"]) {
    session_unset();
    session_destroy();
}

# Check for valid login attempt
if (isset($_POST["password"]) && password_verify($_POST["password"], $password_hash)) {
    $_SESSION["auth"] = 1;
    $_SESSION["expire"] = time() + 5*60; # Expire login after 5 min
    header("Location: http://".$_SERVER['HTTP_HOST']."/gaestebog/admin/");
    exit();
# Check for invalid login attempt
} elseif (isset($_POST["password"]) && !password_verify($_POST["password"], $password_hash)) {
    $_SESSION["auth"] = 0;
}

# If no login attempt
if (!isset($_SESSION["auth"])) {
    $_SESSION["auth"] = 0;
}

# Set base URL
$base_url = "http://".$_SERVER['HTTP_HOST']."/";

# Setup a function cleaning/making inputs safe
function clean_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

# Check recaptcha
function isValid() 
{
    try {

        $url = 'https://www.google.com/recaptcha/api/siteverify';
        $data = ['secret'   => '6LcaTh4UAAAAANAbbCotNW4lesPXt-7B5oU-Mv3V',
                 'response' => $_POST['g-recaptcha-response'],
                 'remoteip' => $_SERVER['REMOTE_ADDR']];

        $options = [
            'http' => [
                'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
                'method'  => 'POST',
                'content' => http_build_query($data) 
            ]
        ];

        $context  = stream_context_create($options);
        $result = file_get_contents($url, false, $context);
        return json_decode($result)->success;
    }
    catch (Exception $e) {
        return null;
    }
}


# Include snippets and parsedown (for renderMessage)
include('snippets.php');
include('Parsedown.php');

function renderMessage($message, $admin = false) {
    global $base_url;
    
    # Render markdown content
    $Parsedown = new Parsedown();
    $message['message'] = $Parsedown->text($message['message']);
    
    # Replace img and a tags 
    $pattern = '#<img src="([^"]*)" alt="([^"]*)" />#';
    $message['message'] = preg_replace($pattern, "<em>[billede: $2 ($1)]</em>", $message['message']);

    $pattern = '#<a href=\"([^\"]*)\">(.*)<\/a>#';
    $message['message'] = preg_replace($pattern, "<em>[link: $1]</em>", $message['message']);
    
    # Remove all non-allowed tags
    $message['message'] = strip_tags($message['message'], '<p><br><em><strong>');
?>
    <div class="row message" id="message-<?php echo $message['id']; ?>">
        <div class="col-xs-12">
            <div class="card <?php echo ($message['visible'] == 0) ? 'hidden' : false; ?>">
                <div class="card-content">
        <?php echo ($message['visible'] == 0) ? '<strong>BESKEDEN ER IKKE OFFENTLIG</strong>' : false; ?>
                    <span class="card-title"><?php echo $message['name']; if ($admin == true) echo "&nbsp;(".$message['email'].")"; ?></span>
                    <div class="message-content">
                        <?php echo $message['message'] ?>
                    </div>
                </div>
                <div class="card-action">
                    <a><?php echo $message['date']; ?></a>
                </div>
                <?php if($admin == true) { ?>
                <div class="card-action">
                    <a href="<?php echo $base_url; ?>gaestebog/admin/update.php?action=toggle&id=<?php echo $message['id']; ?>"><?php echo ($message['visible'] == 1) ? "Skjul mig" : "Vis mig"; ?></a>
                    <a href="<?php echo $base_url; ?>gaestebog/admin/update.php?action=delete&id=<?php echo $message['id']; ?>" style="float:right;">SLET MIG </a>
                </div>
                <?php } ?>
            </div>
        </div>
    </div>
    <?php
}

?>