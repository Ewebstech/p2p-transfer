
<?php   

  $currentUrl = $_SERVER['REQUEST_URI'];
  // dd($currentUrl);


?>
<ul class="nav nav-pills alternate flex-lg-column sticky-top">
  <li class="nav-item"><a class="nav-link <?php echo ($currentUrl == "/admin/manual-funding") ? 'active' : ''; ?> " href="/admin/manual-funding"><i class="fas fa-bookmark"></i>Manual Funding</a></li>
  <li class="nav-item"><a class="nav-link <?php echo ($currentUrl == "/admin/funding-history") ? 'active' : ''; ?> " href="/admin/funding-history"><i class="fas fa-bookmark"></i>Funding History</a></li>
</ul>