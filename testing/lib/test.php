<?php
require_once 'steamid.php';

// Optional: set Steam API Key
SteamID::SetSteamAPIKey(EA4FA02807E84092057D48943A0EFE61);



// detect a vanity URL and parse it (note parameter 3 must be set)
$steamid = SteamID::Parse( "https://steamcommunity.com/id/Mattimat", SteamID::FORMAT_AUTO, true );

// print it in SteamID3 format
echo $steamid->Format( SteamID::FORMAT_STEAMID3 );
echo $steamid->Format( SteamID::FORMAT_STEAMID64 );
// (prints "[U:1:108998443]")

?>