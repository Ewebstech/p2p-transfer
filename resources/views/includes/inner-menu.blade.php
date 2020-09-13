
<?php   

  $currentUrl = $_SERVER['REQUEST_URI'];
  // dd($currentUrl);


?>
<ul class="nav nav-pills alternate flex-lg-column sticky-top">
  <li class="nav-item"><a class="nav-link <?php echo ($currentUrl == "/profile") ? 'active' : ''; ?> " href="/profile"><i class="fas fa-user"></i>Personal Information</a></li>
  <li class="nav-item"><a class="nav-link <?php echo ($currentUrl == "/change-password") ? 'active' : ''; ?> " href="/change-password"><i class="fas fa-bookmark"></i>Change Password</a></li>
</ul>