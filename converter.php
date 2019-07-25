<?php 
require 'info/db.php';
 
$steamid = htmlspecialchars($_GET["steamid"]);
 if (empty($steamid)) {
header("Location: https://steamid64.net/");
exit;
} else {

require_once 'lib/steamid.php';
require_once 'lib/steamapikey.php';

// Optional: set Steam API Key
SteamID::SetSteamAPIKey(EA4FA02807E84092057D48943A0EFE61);

// detect a vanity URL and parse it (note parameter 3 must be set)
$format = SteamID::Parse( $steamid, SteamID::FORMAT_AUTO, true );
if( $format === FALSE ) {
header("Location: https://steamid64.net/");
exit;
} else 
$formatsteamid = $format->Format( SteamID::FORMAT_STEAMID64 );

$url = file_get_contents("http://api.steampowered.com/ISteamUser/GetPlayerSummaries/v0002/?key=". $steamapikey ."&steamids=". $format->Format( SteamID::FORMAT_STEAMID64 ) .""); 
	$content = json_decode($url, true);
	
$name = $content['response']['players'][0]['personaname'];
$avatar = $content['response']['players'][0]['avatarfull'];

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$sql = "INSERT INTO id_converter (steamid, IP, avatar, name)
VALUES ('". $format->Format( SteamID::FORMAT_STEAMID64 ) ."', '". $_SERVER['REMOTE_ADDR'] ."', '". $avatar ."', '". $name ."')";



if ($conn->query($sql) === TRUE) {
  
} else {
header("Location: https://steamid64.net/lookup/". $format->Format( SteamID::FORMAT_STEAMID64 ) ."");
exit;    
}
$conn->close();
header("Location: https://steamid64.net/lookup/". $format->Format( SteamID::FORMAT_STEAMID64 ) ."");
exit;
}
?>