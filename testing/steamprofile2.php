<?php 

$steamid = htmlspecialchars($_GET["steamid"]);
 if (empty($steamid)) {
   
   header('Location: http://mattimat.com/testing/index');
   exit;
   
   
  } else {



@ $getsteamlevel = file_get_contents("https://api.steampowered.com/IPlayerService/GetBadges/v1/?key=EA4FA02807E84092057D48943A0EFE61&format=json&steamid=".$steamid);
$decodelevel = json_decode($getsteamlevel, true);  

@ $getgames = file_get_contents("https://api.steampowered.com/IPlayerService/GetOwnedGames/v1/?key=EA4FA02807E84092057D48943A0EFE61&format=json&steamid=".$steamid ."%20&include_appinfo=0&include_played_free_games=0");
   $games = json_decode($getgames, true);

@ $vacbans = file_get_contents("http://api.steampowered.com/ISteamUser/GetPlayerBans/v1/?key=EA4FA02807E84092057D48943A0EFE61&steamids=". $steamid);
   $vac = json_decode($vacbans, true);
   
@ $getsteamlevel = file_get_contents("https://api.steampowered.com/IPlayerService/GetBadges/v1/?key=EA4FA02807E84092057D48943A0EFE61&format=json&steamid=".$steamid);
$decodelevel = json_decode($getsteamlevel, true);  
   
  }   
   ?>