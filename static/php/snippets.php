<?php 

function printHeader()
{
    ?>
    
    <!DOCTYPE html>
    <html>

    <head>
        <!--Import Google Icon Font-->
        <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <!--Import materialize.css-->
        <link type="text/css" rel="stylesheet" href="http://<?php echo $_SERVER['HTTP_HOST']; ?>/css/styles.css" />

        <!-- Fancybox -->
        <link type="text/css" rel="stylesheet" href="http://<?php echo $_SERVER['HTTP_HOST']; ?>/css/fancybox.min.css" />
        <!-- Scrollbars -->
        <link type="text/css" rel="stylesheet" href="http://<?php echo $_SERVER['HTTP_HOST']; ?>/css/perfect-scrollbar.min.css" />
        <!--Let browser know website is optimized for mobile-->
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta charset="UTF-8">
        
        <base href="http://<?php echo $_SERVER['HTTP_HOST']; ?>/">
        <noscript>
            <link type="text/css" rel="stylesheet" href="http://<?php echo $_SERVER['HTTP_HOST']; ?>/css/noscript.css" media="screen,projection" />
        </noscript>
         <title> GingerDolls.dk - Gæstebogsadministrator</title>
    </head>
    <body>
            <div class="container">
                
<?php 
}

function printFooter()
{
    ?>
    
    </div>    
    <!--Import jQuery before materialize.js-->
    <script type="text/javascript" src="http://<?php echo $_SERVER["HTTP_HOST"]; ?>/js/jquery-2.1.1.min.js"></script>
    <script type="text/javascript" src="http://<?php echo $_SERVER["HTTP_HOST"]; ?>/js/materialize.min.js"></script>
    <script type="text/javascript" src="http://<?php echo $_SERVER["HTTP_HOST"]; ?>/js/fancybox.min.js"></script> 
    <script type="text/javascript" src="http://<?php echo $_SERVER["HTTP_HOST"]; ?>/js/perfect-scrollbar.jquery.min.js"></script> 

    <script type="text/javascript" src="http://<?php echo $_SERVER["HTTP_HOST"]; ?>/js/scripts.js"></script> 

    <script type="text/javascript" src="http://<?php echo $_SERVER["HTTP_HOST"]; ?>/js/guestbook.js"></script>
    </body>
    </html>

<?php 
}

function printLogin()
{
    ?>
    <h1 class="center-align">Log ind for at administrere din gæstebog</h1>
    <div class="row">
        <form name="test" action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="post" class="col-xs-12">
            <div class="row">
                <div class="input-field col-xs-12">
                      <input id="password" name="password" type="password" class="validate">
                      <label for="password">Kodeord</label>
                </div>
            </div>
            <?php if (isset($_POST['password'])) {
        ?>
                <div class="row">
                   <div class="col-xs-12">
                     <div class="card-panel red darken">
                       <strong class="white-text">Forkert kode &hellip;</strong>
                     </div>
                   </div>
                 </div>
            <?php 
    } ?>
        </form>
    </div>
<?php 
}

function printMessages($result, $admin = false)
{
    ?>
    <?php 
    if ($admin == true) {
            ?>
            <h1>Administrer dine beskeder:</h1>
        <?php

        if (isset($_GET["deleted"])) {
            ?>
            <div class="row">
               <div class="col-xs-12">
                 <div class="card-panel orange darken">
                   <strong class="white-text">Beskeden er slettet!</strong>
                 </div>
               </div>
             </div>
        <?php
        }
    } ?>
    <div class="messages">
            
    <?php
    $messages = array();
    if ($result) {
        foreach ($result as $row) {
            $row['date'] = date("j. M Y, H:i", $row['sent_date']);
            renderMessage($row, $admin);
        }

        //$msgs = json_encode($messages, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_UNESCAPED_UNICODE);
        //echo $msgs;
    }
    // close the database connection
    $db = null; ?>
    
</div>
<?php 
}
?>