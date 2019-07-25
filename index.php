<?php require 'steamauth/steamauth.php'; 
      require 'info/db.php';  
    
?>

<html lang="en">
<head>
  <title>SteamID64 - Simple ID Finder</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="Steamid64 is a Steam ID Finder that can easily help you find any Steam ID. Enter any of the accepted inputs and the system will automatically look up all the information you need. On top of that, you can also see other useful profile information. See the Allowed Inputs button for accepted inputs.">
  <meta name="keywords" content="STEAMID,STEAMID64,Steam ID,Steam ID Finder,Steam profile finder,SteamID,SteamID32,Steamid3,Steam ID Finder">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.6/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js"></script>
  
   <script src="https://steamid64.net/countUp.js"></script>
  
 
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
  <a class="navbar-brand" href="#"><img src="../steamid64logo.png" width="110px" heigth="52px" /></a>

  <!-- Toggler/collapsibe Button -->
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
    <span class="navbar-toggler-icon"></span>
  </button>

  <!-- Navbar links -->
  <div class="collapse navbar-collapse" id="collapsibleNavbar">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" href="index">Home</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="FAQ">FAQ</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="about">About</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="donate">Donate</a>
      </li> 
       <li class="nav-item">
        <a class="nav-link" href="privacy">Privacy</a>
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
        <a class='dropdown-item' href='myprofile'>My Profile</a>
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

<div class="steamidconverter">
<div class="container">
    <form class="form" method="GET" action="converter">
    <div class="form-group">
  <label for="usr"></label>
  <input type="text" name="steamid" class="form-control" id="steamid" placeholder="Enter a SteamID, SteamID3, SteamID64, custom URL or complete URL to get started. ">
  
  </div>
  <button type="submit" class="btn btn-outline-primary" data-toggle="modal" data-target="#Modal2">Submit</button> <button data-toggle="modal" data-target="#allowedinputs" type="button" class="btn btn-outline-info">Allowed Inputs</button>

</div>


 
</div>

<!-- The Modal -->
<div class="modal fade" id="allowedinputs">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Allowed Inputs</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
      <p> Profile name will not work, see the allowed inputs below.</p>

<p>Profile URL eg. https://steamcommunity.com/profiles/76561198408846151/</p>

<p>Custom URL eg. https://steamcommunity.com/id/realmatti</p>

<p>Custom name eg. realmatti</p>

<p>SteamID64 eg. 76561198408846151</p>

<p>SteamID32 eg. STEAM_1:1:224290211</p>

<p>SteamID3 eg. [U:1:448580423]</p>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
       </div>
  </div>
</div>



<div class="container">
    <div id="accordion">

  <div class="card">
    <div class="card-header">
      <a class="card-link" data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
     <p class="text-dark">Welcome</p>
      </a>
    </div>
    <div id="collapseOne" class="collapse show">
      <div class="card-body">
       Steamid64 is a Steam ID Finder that can easily help you find any Steam ID. Enter any of the accepted inputs and the system will automatically look up all information you need. On top of that, you can also see other useful profile information. See the Allowed Inputs button for accepted inputs.
      </div>
    </div>
  </div>

  <div class="card">
    <div class="card-header">
      <a class="collapsed card-link" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
         <p class="text-dark">What is a STEAM ID?</p>
      </a>
    </div>
    <div id="collapseTwo" class="collapse">
      <div class="card-body">
       A Steam ID is a unique identifier used to identify a Steam account. A Steam ID can be converted to the newer SteamID3 and to a SteamID64, sometimes referred to as Community ID or Friend ID. With this SteamID64, a user's Steam community page can be found. A Custom URL is an optional, more personalised identifier to look up a user's Steam Community page with. 
      </div>
    </div>
  </div>

  <div class="card">
    <div class="card-header">
      <a class="collapsed card-link" data-toggle="collapse" data-parent="#accordion" href="#collapseThree">
      <p class="text-dark">Features</p>
      </a>
    </div>
    <div id="collapseThree" class="collapse">
      <div class="card-body">
       <p>Steamid64 also looks up other useful profile information such as total games owned, steam level, profile visibility, and more. There is also an option to sign in through Steam, which gives grants even more options and features.</p> 
        
      <p>When you use the “Log In Through Steam” option, Valve gives the site your public profile information, steamid64.net does store your public profile information, but we do not store any other user information. We only use this information for statistical purposes and to display your profile stats.</p>
      </div>
    </div>
  </div>
  
  <div class="card">
    <div class="card-header">
      <a class="collapsed card-link" data-toggle="collapse" data-parent="#accordion" href="#collapseFour">
      <p class="text-dark">Why would anyone want my Steam ID?</p>
      </a>
    </div>
    <div id="collapseFour" class="collapse">
      <div class="card-body">
       <p>Software may use it to link your account to player data. A typical game server for example contains a ban- admin- and donatorlist. These lists consist of Steam IDs, just to make sure the correct player gets the permissions.</p> 
        <p>See FAQ for more information. </p>
      
      </div>
    </div>
  </div>

</div>
</div>


<br>
<br>
<div align="center">
<?php
//assign adsense code to a variable
$googleadsensecode = '<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js">
</script>
<!-- admainpage -->
<ins class="adsbygoogle"
     style="display:inline-block;width:320px;height:100px"
     data-ad-client="ca-pub-8079476388223918"
     data-ad-slot="8439334242"></ins>
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
 <footer class="footer bg-dark text-center"><p style="color: white;">Made with ♡ by <a style="color: white;" href="http://steamcommunity.com/id/realmatti">Matti</a> | <a  style="color: white;" href="privacy">Privacy Policy</a></p></footer>


</body>

</html>