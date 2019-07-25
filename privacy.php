<?php require 'steamauth/steamauth.php'; 
      require 'info/db.php';  
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>SteamID64 - Privacy Policy</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css">
  <meta name="description" content="Steamid64 is a Steam ID Finder that can easily help you find any Steam ID. Enter any of the accepted inputs and the system will automatically look up all the information you need. On top of that, you can also see other useful profile information. See the Allowed Inputs button for accepted inputs.">
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
        <a class="nav-link" href="Privacy">Privacy</a>
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

<br>

<div class="container">
<div class="card">
  <div class="card-body">
    <h4 class="card-title">Privacy Policy</h4>
    <p class="card-text">
<h5>Cookies</h5>

<p>SteamID64.net uses cookies in order to provide enhanced functionality to users, such as user accounts and saved preferences. If you continue to use this site, we'll assume you are happy to accept these cookies. </p>




<h5>Advertisements</h5>

<p>To display advertisements, Google and third parties use DART cookies to serve ads based on your prior visits to this and/or other websites. You may opt-out of these cookies here: <a href="http://www.google.com/settings/ads">Google ad settings</a>, <a href="http://www.networkadvertising.org/managing/opt_out.asp">Network Advertising Initiative opt out page</a>.</p>

 


<h5>Connect with Steam</h5>
<p>When you use the “Sign In Through Steam” option, Valve gives the site your public profile information, steamid64.net does store your public profile information, but we do not store any other user information. We only use this information to display your profile stats and Steam ID.</p>

<h5>Analytics</h5>
<p>Steamid64.net uses Google Analytics to analyse visits. The data it gathers is anonymised.</p>

<h5>Contact</h5>
<p>Should you have any questions regarding the above, please don't hesitate to reach me on contact@steamid64.net</p>
   
  </div>
</div>
</div>



 <div class="push"></div>
  </div>
  <footer class="footer bg-dark text-center"><p style="color: white;">Made with ♡ by <a style="color: white;" href="http://steamcommunity.com/id/realmatti">Matti</a> | <a  style="color: white;" href="privacy">Privacy Policy</a></p></footer>

</body>
</html>