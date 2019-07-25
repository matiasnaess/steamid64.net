<?php require 'steamauth/steamauth.php'; 
      require 'info/db.php';  
    
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
</head>
<style>
body {
   height:1500px;
   margin:0 auto;
}

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

.footer {
   
  margin-top: 500px;
    padding-bottom: 16px;
   color: white;
   text-align: center;
}
</style>
<body>

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
    $totalconverted = 8000 + $total;
     
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
    <h4 class="card-title">Donate</h4>
    <p class="card-text">If you want to contribute to Steamid64.net you can give a donation. </p>
    <p>if you send a donation you will recieve a Donator badge as a thank you and be placed in the Hall of fame (optional).</p>
    <h5>Donate here</h5>
    <a href="https://paypal.me/steamid64"><img src="https://mattimat.com/silver-pill-paypal-26px.png" /></a>
<br><br>
<p><strong>Please note</strong>: If you want to receive the donator badge and your profile placed in the Hall of Fame, you need to provide your Steam ID or steamid64.net URL with your donation. See the about page if you forget to do so. It may take up to 24 hours for the ladder to be updated and donator badge placed on your profile.</p>
<br>
   
   <p>Questions or help regarding donations: paypal@steamid64.net</p>
   
  </div>
</div>
</div>

<br>

<div class="container">
    <div class="card">
  <div class="card-body">
  <h2>Hall Of Fame</h2>
  <p>List of Donators - Thank you for the support!</p>            
  <table class="table table-dark table-striped">
    <thead>
      <tr>
        <th></th>
        <th>User</th>
        <th>Amount</th>
       
      </tr>
    </thead>
    <tbody>
     
       <tr>
        <td><img class="img-rounded" src="https://steamcdn-a.akamaihd.net/steamcommunity/public/images/avatars/48/48797340ee547477b83a3760e6034c539df37b67_full.jpg/" width="40px" height="40px" /></td>   
        <td><a class="text-white" href="https://steamid64.net/lookup/76561198408109892">Matti | Level Up Bot (18:1)</a></td>
        <td>$2.00</td>
       
      </tr>
    </tbody>
  </table>
</div>
</div>
</div>



<div class="footer bg-dark">
  <p>Made with ♡ by <a style="color: white;" href="http://steamcommunity.com/id/realmatti">Matti</a></p> <p>steamid64.net is not affiliated with Valve. All trademarks and registered trademarks are the property of their respective owners.</p>
</div>
</body>
</html>