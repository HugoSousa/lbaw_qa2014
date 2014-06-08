 <?php
	include_once('../../config/init.php');
	include_once($BASE_DIR .'database/content.php');
	include_once($BASE_DIR .'database/answer.php');

	$questionID = $_POST['questionID'];
	$text = $_POST['text'];
	$userID = $_SESSION['userid']; //FIX ME
	$username = $_SESSION['username']; //FIX ME

	if(!isset($questionID) || !isset($text) || !isset($userID) || !isset($username))
        $return = array("error" => "Missing parameters.");
    else{

		$text = str_replace(array("\r\n", "\n"), '<br>', $text, $i);

		$contentID = insertContent($text, $userID, ANSWER);

		$contentID = $contentID[0]['id'];


		insertAnswer($contentID, $questionID );

		$res = array('text' => $text , 'username' => $username , 'answerID' => $contentID);
	}

	echo json_encode($res);

?>