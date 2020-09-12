
<?php   

  $currentUrl = $_SERVER['REQUEST_URI'];
  // dd($currentUrl);

  if($currentUrl == "/change-password"){
      $class = "nav-link active";
  } 

  if($currentUrl == "/profile"){
      $class = "nav-link active";
  } 


?>
<ul class="nav nav-pills alternate flex-lg-column sticky-top">
  <li class="nav-item"><a class="nav-link active" href="/profile"><i class="fas fa-user"></i>Personal Information</a></li>
  <li class="nav-item"><a class="nav-link" href="/change-password"><i class="fas fa-bookmark"></i>Change Password</a></li>
</ul>