<?php require 'steamauth/steamauth.php'; 
      require 'info/db.php';  
      require 'steamprofile2.php'; 
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <title>SteamID64 - Simple ID Finder</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.6/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js"></script>
  <script src="https://steamid64.net/countUp.js"></script>
  <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<script>
  (adsbygoogle = window.adsbygoogle || []).push({
    google_ad_client: "ca-pub-8079476388223918",
    enable_page_level_ads: true
  });
</script>
</head>
<style>
    .jumbotron {
    padding: 1rem 2rem;
       background: #1b2838;
       background-image: url(jumbtron-background.jpg);
       color: white;
       background-position: top;
    padding-bottom: 1px;
    background-repeat: no-repeat;
    margin: 0px auto;
    
}

html, body {
  height: 100%;
  margin: 0;
}
.wrapper {
  min-height: 100%;

  /* Equal to height of footer */
  /* But also accounting for potential margin-bottom of last child */
  margin-bottom: -50px;
}
.footer,
.push {
  height: 50px;
}

</style>
<body>
      <div class="wrapper">
<nav class="navbar navbar-expand-md bg-dark navbar-dark">
  <!-- Brand -->
  <a class="navbar-brand" href="#"><img src="../../steamid64logo.png" width="110px" heigth="52px" /></a>

  <!-- Toggler/collapsibe Button -->
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
    <span class="navbar-toggler-icon"></span>
  </button>

  <!-- Navbar links -->
  <div class="collapse navbar-collapse" id="collapsibleNavbar">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" href="../index">Home</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="../FAQ">FAQ</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="../about">About</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="../donate">Donate</a>
      </li> 
      
    </ul>
    <ul class="navbar-nav ml-auto">
    <li><?php
if(!isset($_SESSION['steamid'])) {
   loginbutton("rectangle");
}  else {
include ('steamauth/userInfo.php');
   
   echo "<li class='nav-item dropdown'>
      <a class='nav-link dropdown-toggle' href='#' id='navbardrop' data-toggle='dropdown'> <img class='rounded' src='" . $steamprofile['avatar'] . "'>  ". $steamprofile['personaname'] ." </a>
      <div class='dropdown-menu'>
        <a class='dropdown-item' href='../myprofile'>My Profile</a>
        <a class='dropdown-item' href='#'>Settings</a>
        <a class='dropdown-item' href='?logout'>Sign out</a>
      </div>
    </li>"; 

}
?>



</li>
      </ul>
    
  </div> 
</nav>


    
<?php
/* Open a connection */
$mysqli = new mysqli("". $servername ."", "". $username ."", "". $password ."", "". $dbname ."");
/* check connection */
if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}
$query = "SELECT steamid FROM id_converter ORDER BY reg_date LIMIT 50000";
if ($stmt = $mysqli->prepare($query)) {

/* execute query */
    $stmt->execute();
/* store result */
    $stmt->store_result();
    
     $total = ($stmt->num_rows);
    $totalconverted = 8500 + $total;
     
         /* close statement */
    $stmt->close();
}

/* close connection */
$mysqli->close();
?>


<div class="jumbotron jumbotron-fluid text-center">
   
  <h1>Steam ID Finder</h1> 
 
<?php
echo "<p>We have already generated <span id='myTargetElement'></span> profiles!</p>"; 

echo "<script>
 var options = {
  useEasing: true, 
  useGrouping: true, 
  separator: ',', 
  decimal: '.', 
};
var demo = new CountUp('myTargetElement', 0, ".  $totalconverted .", 0, 2.5, options);
if (!demo.error) {
  demo.start();
} else {
  console.error(demo.error);
}
</script>"; 
?>

</div>

<?php 

$steamid = htmlspecialchars($_GET["steamid"]);
 if (empty($steamid)) {
   
   header('Location: http://steamid64.net/');
   exit;
   
   
  } else { 
?>


<?php
// FETCH USER FROM TABLE TO CHECK IF THEY ARE DONATOR - Matti 26.08.2017 


/* Open a connection */
$mysqli = new mysqli("". $servername ."", "". $username ."", "". $password ."", "". $dbname ."");
// Check connection
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
} 

$sql = "SELECT donator FROM id_converter WHERE steamid=". $steamid ."";
$result = $mysqli->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
       
        $donatorstat = $row["donator"];
        
    }
} else {
    echo "";
}

?>


<?php

// STEAM CONVERTER STARTS HERE - Matti 26.08.2017 

require_once 'lib/steamid.php';

// Optional: set Steam API Key
SteamID::SetSteamAPIKey(EA4FA02807E84092057D48943A0EFE61);

// detect a vanity URL and parse it (note parameter 3 must be set)
$format = SteamID::Parse( $steamid, SteamID::FORMAT_AUTO, true );
if( $format === FALSE ) {
     header('Location: https://steamid64.net');
   exit;
} else 

$formatsteamid = $format->Format( SteamID::FORMAT_STEAMID64 ); 

@ $decodeuserinfo = file_get_contents("http://api.steampowered.com/ISteamUser/GetPlayerSummaries/v0002/?key=EA4FA02807E84092057D48943A0EFE61&steamids=". $formatsteamid);
   $userinfo = json_decode($decodeuserinfo, true);
   
$steamuser = $userinfo['response']['players'][0];

}

?>

<br>
 
<div class="container steamcard">
<div class="row">
  <div class="col-sm-4">
     
      
      
      <div class="card" style="width:184px">
  <img class="card-img-top" src="<?php echo $steamuser['avatarfull'];  ?>" alt="Card image">
  <div class="card-body">
    <h4 class="card-title"><?php echo "<p>". $steamuser['personaname']  ."</p>"; ?> </h4>
    
    <p class="card-text"><?php 
    
    // if donator is set to 1 display donator badge, if set to 2 display dev badge, 0 standard.
if ($donatorstat == 1) {
    echo "<p style='color: green;'>Donator</p>";
} elseif ($donatorstat == 2) {
     
    echo "<p style='color: blue;'>Developer</p>";
} else 
echo ""; 

    
    ?></p>
    
    <p class="card-text"><?php
    
    // checks the users status 
// 1 = online, 2 = buys, 3 = away, 4 = snooze 
// Matti 02.10.2017
if ($steamuser['personastate'] == 1) {
    echo "<p>Online</p>";
} elseif ($steamuser['personastate'] == 2) {
    echo "<p>Busy</p>";
} elseif ($steamuser['personastate'] == 3) {
    echo "<p>Away</p>";
} elseif ($steamuser['personastate'] == 4) {
    echo "<p>Snooze</p>";
} else 
echo "<p>Offline</p>"; 
    
?></p>
<p class="card-text">
<?php
        // checks the users community state, exit if not public. 
// 1 = private profile, 0 = community not configured, 2 = friends only.
// Matti 26.08.2017
if ($steamuser['communityvisibilitystate'] == 1) {
echo "<p>Private Profile</p>";
} elseif ($steamuser['communityvisibilitystate'] == 0) {
echo "<p>Not Community Configured<p>";   
} elseif ($steamuser['communityvisibilitystate'] == 2) {
echo "<p>Friends Only</p>"; 
} else 
echo "<p>Public Profile</p>"; 


?>
</p>
<p class="card-text">
    <?php 
    // total games on steam account 
// Matti 02.10.2017 
$totalgames = number_format($games['response']['game_count']);
if ($totalgames == 0) {

} else 
echo "<p>".$totalgames." Games</p>"; 

?>
</p>
<p class="card-text">
    <?php 
if ($steamuser['communityvisibilitystate'] == 3) { 

$steamyears =  date("Y" , $steamuser['timecreated']); $steamyears2 = date("Y"); $totalyears = $steamyears2 - $steamyears; 
echo "<p>". $totalyears ." Steam Years</p>"; 


} else 
?>
</p>
<p class="card-text">
    <?php
    if ($steamuser['communityvisibilitystate'] == 3) {  
echo  "<p>". $decodelevel['response']['player_level'] ." Steam Level</p>"; }
?>
</p>
    <a href="<?php echo $steamuser['profileurl']; ?>" class="btn btn-primary">See Profile</a>
  </div>
</div>
      
      
  </div>
  <div class="col-sm-8">
      <?php
      echo "<div class='input-group'><span class='input-group-addon'>STEAMID64</span><input id='steamid64' type='text' class='form-control' readonly='readonly' onmouseover='this.select()' value='". $format->Format( SteamID::FORMAT_STEAMID64 ) ."'></div><br>";
echo "<div class='input-group'><span class='input-group-addon'>STEAMID32</span><input id='steamid32' type='text' class='form-control' readonly='readonly' onmouseover='this.select()' value='". $format->Format( SteamID::FORMAT_STEAMID32 ) ."'></div><br>";
echo "<div class='input-group'><span class='input-group-addon'>STEAMID3</span><input id='steamid3' type='text' class='form-control' readonly='readonly' onmouseover='this.select()' value='". $format->Format( SteamID::FORMAT_STEAMID3 ) ."'></div><br>";
echo "<div class='input-group'><span class='input-group-addon'>Profile URL</span><input id='profileurl' type='text' class='form-control' readonly='readonly' onmouseover='this.select()' value='". $steamuser['profileurl'] ."'></div><br>";
echo "<div class='input-group'><span class='input-group-addon'>Site URL</span><input id='profileurl' type='text' class='form-control' readonly='readonly' onmouseover='this.select()' value='steamid64.net/lookup/". $steamuser['steamid'] ."'></div><br>";
      ?>

<br>

<?php 
echo "<a href='../index'  class='btn btn-outline-secondary float-left'>Search again</a>";
echo "<a href='steam://friends/add/". $steamuser['steamid']  ."'  class='btn btn-outline-secondary float-right'>Add to friends</a>";
?>


  </div>
</div>
</div>  


<br>
<br>
<div align="center">
<?php
//assign adsense code to a variable
$googleadsensecode = '<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<!-- ad1 -->
<ins class="adsbygoogle"
     style="display:block"
     data-ad-client="ca-pub-8079476388223918"
     data-ad-slot="5309582959"
     data-ad-format="auto"></ins>
<script>
(adsbygoogle = window.adsbygoogle || []).push({});
</script>';
//now outputting this to HTML
echo $googleadsensecode;
?>
</div>
<br>
<br>





 
  
<div class="push"></div>
  </div>
  <footer style="color: white;" class="footer bg-dark text-center"><p>Made with ♡ by <a style="color: white;" href="http://steamcommunity.com/id/realmatti">Matti</a></p></footer>


</body>
</html>

