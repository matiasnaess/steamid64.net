<?php include ('steamauth/userInfo.php'); ?>

<?php  error_reporting(E_ERROR | E_PARSE); 

 
@ $currentlyplaying = file_get_contents("http://api.steampowered.com/ISteamUser/GetPlayerSummaries/v0002/?key=EA4FA02807E84092057D48943A0EFE61&steamids=". $steamprofile['steamid']);
   $playing = json_decode($currentlyplaying, true);

@ $getsteamlevel = file_get_contents("https://api.steampowered.com/IPlayerService/GetBadges/v1/?key=EA4FA02807E84092057D48943A0EFE61&format=json&steamid=".$steamprofile['steamid']);
$decodelevel = json_decode($getsteamlevel, true);  

@ $getgames = file_get_contents("https://api.steampowered.com/IPlayerService/GetOwnedGames/v1/?key=EA4FA02807E84092057D48943A0EFE61&format=json&steamid=".$steamprofile['steamid']."%20&include_appinfo=0&include_played_free_games=0");
   $games = json_decode($getgames, true);

@ $vacbans = file_get_contents("http://api.steampowered.com/ISteamUser/GetPlayerBans/v1/?key=EA4FA02807E84092057D48943A0EFE61&steamids=". $steamprofile['steamid']);
   $vac = json_decode($vacbans, true);

@ $getgames = file_get_contents("https://api.steampowered.com/IPlayerService/GetRecentlyPlayedGames/v0001/?key=EA4FA02807E84092057D48943A0EFE61&steamid=" . $steamprofile['steamid'] .  "&count=5&format=json");
  $gameslist = json_decode($getgames, true);  

@ $getgamebackground = file_get_contents("https://api.steampowered.com/IPlayerService/GetRecentlyPlayedGames/v0001/?key=EA4FA02807E84092057D48943A0EFE61&steamid=" . $steamprofile['steamid'] .  "&count=1&format=json");
  $gamebackground = json_decode($getgamebackground, true);  

@ $getbadges = file_get_contents("https://api.steampowered.com/IPlayerService/GetBadges/v1/?key=EA4FA02807E84092057D48943A0EFE61&format=json&steamid=".$steamprofile['steamid']);
   $badges = json_decode($getbadges, true); 
   
   foreach ($badges as $totalbadges) {
   $badgecount = count($badges['response']['badges']);
  }  


@ $getowned = file_get_contents("http://api.steampowered.com/IPlayerService/GetOwnedGames/v0001/?key=EA4FA02807E84092057D48943A0EFE61&steamid=".$steamprofile['steamid'] ."&format=json");
  $ownedgames = json_decode($getowned, true);

   

 

 


?>