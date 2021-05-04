<?php
session_start();

# Load other files
include('../../php/config.php');
include('../../php/functions.php');

$message_id = $_GET['id'];
$action = $_GET['action'];
if(isset($_GET['confirm'])) {
    $confirm = $_GET['confirm'];
} else {
    $confirm = 0;
}

if($action == "toggle") {
    $result = $db->prepare('SELECT * FROM gastebog WHERE id = :message_id');
    $result->bindParam(':message_id', $message_id, PDO::PARAM_STR);
    $result->execute();
    if ($result) {
        $msg = [];
        foreach ($result as $row) {
            $msg['id'] = $row['id'];
            $msg['visible'] = $row['visible'];
        }
        $toggled_value = ($msg['visible'] == 1) ? 0 : 1;
        
        $update = $db->prepare('UPDATE gastebog SET visible = :toggled_value WHERE id = :message_id');
        $update->bindParam(':toggled_value', $toggled_value, PDO::PARAM_STR);
        $update->bindParam(':message_id', $message_id, PDO::PARAM_STR);
        $update->execute();        
        
        header('Location: '.$base_url.'gaestebog/admin/#message-'.$message_id);
        
    } else {
        echo "Error!";
        die();
    }
    
} else if ($action == "delete") {
    $result = $db->prepare('SELECT * FROM gastebog WHERE id = :message_id');
    $result->bindParam(':message_id', $message_id, PDO::PARAM_STR);
    $result->execute();
    if ($result) {
        if($confirm == 1) {
            $delete = $db->prepare('DELETE from gastebog WHERE id = :message_id');
            $delete->bindParam(':message_id', $message_id, PDO::PARAM_STR);
            $delete->execute();        
            
            header('Location: '.$base_url.'gaestebog/admin/?deleted=true'); 
        } else {
            printHeader();
            echo "<h1>Er du sikker på, du vil slette denne besked?</h1>";
            echo '<div class="messages">';
            foreach ($result as $row) {
                $row['date'] = date("j. M Y, H:i", $row['sent_date']);
                renderMessage($row);
            }
            echo '</div>';
            
            ?>

            <a class="waves-effect waves-light btn" style="float: right" href="<?php echo $base_url; ?>gaestebog/admin/#message-<?php echo $message_id; ?>">Tilbage til listen over beskeder</a>
            
            <a class="waves-effect waves-light btn red" href="<?php echo $base_url; ?>gaestebog/admin/update.php?action=delete&id=<?php echo $message_id; ?>&confirm=1">SLET</a>
            
                
            <?php
            
            printFooter();
        }
    } else {
        echo "Error!";
        die();
    }
} else {
    header('Location: '.$base_url.'gaestebog/admin/#message-'.$message_id);
}
?>