<?php
	
	$response = array();

	require_once 'dao.php';
        require_once 'simplepush.php';
        require_once 'simplegcm.php';
	$con = connectDB();
    $sql = "select id, gcm_id, token from tbl_customer";
        $result = mysqli_query($con, $sql);
        $users =array();
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_array($result)) {
                $guest = array();
                $guest["user_id"] = $row["id"];
                $guest["gcm_id"] = $row["gcm_id"];
                $guest["token"] = $row["token"];
                array_push($users,$guest);
            }
        }
        
        $messages = array();
        $sql = "select * from tbl_message";
        $result = mysqli_query($con, $sql);
        $messages = array();
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_array($result)) {
                $message = array();
                $message["title"] = $row["title"];
                $message["content"] = $row["content"];
                array_push($messages,$message);
            }
        }
        $message_count = count($messages);
        $rand_num = rand(0, $message_count -1);
        $message_to_send = $messages[$rand_num]["title"];

        $msg = $message_to_send;
        $msg = urldecode($msg);
        

        foreach ($users as $key => $user) {
            if($user['token'] != "")
            {
                echo $user['token'];
                sendPush($user['token'], $msg,"");
            }
            if($user['gcm_id'] != "")
            {
                sendGCM(array($user['gcm_id']), "$msg");
            }
        }
?>