<?php 
$GLOBAL_URL = $_SERVER['REQUEST_URI'];
?>
<!-- Testing for global url pathname for active link class -->
<?php //echo $GLOBAL_URL ?>
<?php //print ($_SERVER['REQUEST_URI'] == $GLOBAL_URL) ? 'active' : '' ?>

<!-- Desktop menu -->

<div class="sticky-top d-none d-lg-block">
  <?php include 'top-header.php' ?>
  <nav class="navbar navbar-expand-lg bg-white py-4">
    <div class="container-fluid">
      <a class="navbar-brand fw-bold" href="http://localhost/PHP-PRODUCT-UPLOAD-v2/">
        <img src="http://localhost/PHP-PRODUCT-UPLOAD-v2/assets/product-upload-logo.png" width="200px" alt="Product Upload logo" />
      </a>
      <button class="navbar-toggler border border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMobile" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
<!--
      <div class="collapse navbar-collapse" id="navbarText">
        <ul class="navbar-nav mb-2 mb-lg-0 mx-auto">
          <li class="nav-item">
            <a class="nav-link <?php echo ($_SERVER['REQUEST_URI'] == $GLOBAL_URL) ? 'active' : '' ?>" aria-current="page" href="http://localhost/PHP-PRODUCT-UPLOAD-v2/">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" aria-current="page" href="#">About</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" aria-current="page" href="#">FAQ</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" aria-current="page" href="#">Contact</a>
          </li>          
        </ul>
      </div>
--> 
      <div class="d-none d-lg-block" id="navbarText">
        <ul class="navbar-nav mb-2 mb-lg-0 ms-auto">

          <?php
            // Check if local storage has a specific value
            echo '<script>';
            echo 'var username = localStorage.getItem("username");';
            echo 'if (username) {';
            echo '    document.write("<li class=\'nav-item\'><a class=\'nav-link fw-bold text-primary\' aria-current=\'page\' href=\'http://localhost/PHP-PRODUCT-UPLOAD-v2/admin/account.php\'>Welcome " + username + "</a></li>");';
            echo '} else {';
            echo '    document.write("");';
            echo '}';
            echo '</script>';
          ?>
<!--
          <li class="nav-item">
            <a class="nav-link" aria-current="page" href="#"><i class="ri-search-line"></i></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" aria-current="page" href="#"><i class="ri-shopping-cart-fill"></i></a>
          </li>
-->
          <?php
            // Check if local storage has a specific value
            echo '<script>';
            echo 'var username = localStorage.getItem("username");';
            echo 'if (username) {';
            echo '    document.write("<li class=\'nav-item\'><a class=\'nav-link\' href=\'http://localhost/PHP-PRODUCT-UPLOAD-v2/admin/account.php\'>Account</a></li><li class=\'nav-item\'><a class=\'nav-link\' href=\'http://localhost/PHP-PRODUCT-UPLOAD-v2/db/logout.php\'>Log Out</a></li>");';
            echo '} else {';
            echo '    document.write("<li class=\'nav-item\'><a class=\'nav-link\' href=\'http://localhost/PHP-PRODUCT-UPLOAD-v2/db/login.php\'>Log In</a></li><li class=\'nav-item\'><a class=\'nav-link\' href=\'http://localhost/PHP-PRODUCT-UPLOAD-v2/db/register.php\'>Register</a></li>");';
            echo '}';
            echo '</script>';
          ?>
        </ul>
      </div>


    </div>
  </nav>
  <?php include 'products-page-tags.php' ?>
  <!-- -->
</div>


<!-- Mobile menu -->

<div class="sticky-top d-block d-lg-none">
  <?php include 'top-header.php' ?>
  <nav class="navbar navbar-expand-lg bg-white py-4">
    <div class="container-fluid">
      <a class="navbar-brand fw-bold" href="http://localhost/PHP-PRODUCT-UPLOAD-v2/">
        <img src="http://localhost/PHP-PRODUCT-UPLOAD-v2/assets/product-upload-logo.png" width="200px" alt="Product Upload logo" />
      </a>
      <button class="navbar-toggler border border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMobile" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <!-- START Mobile Nav -->
      <div class="collapse navbar-collapse" id="navbarMobile">
        <ul class="navbar-nav mb-2 mb-lg-0 mx-auto">
<!--          
          <li class="nav-item">
            <a class="nav-link <?php echo ($_SERVER['REQUEST_URI'] == $GLOBAL_URL) ? 'active' : '' ?>" aria-current="page" href="http://localhost/PHP-PRODUCT-UPLOAD-v2/">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" aria-current="page" href="#">About</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" aria-current="page" href="#">FAQ</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" aria-current="page" href="#">Contact</a>
          </li>
-->
          <?php
            // Check if local storage has a specific value
            echo '<script>';
            echo 'var username = localStorage.getItem("username");';
            echo 'if (username) {';
            echo '    document.write("<li class=\'nav-item\'><a class=\'nav-link fw-bold text-primary\' aria-current=\'page\' href=\'http://localhost/PHP-PRODUCT-UPLOAD-v2/admin/account.php\'>Welcome " + username + "</a></li>");';
            echo '} else {';
            echo '    document.write("");';
            echo '}';
            echo '</script>';
          ?>
<!--
          <li class="nav-item">
            <a class="nav-link" aria-current="page" href="#"><i class="ri-search-line"></i></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" aria-current="page" href="#"><i class="ri-shopping-cart-fill"></i></a>
          </li>
-->
          <?php
            // Check if local storage has a specific value
            echo '<script>';
            echo 'var username = localStorage.getItem("username");';
            echo 'if (username) {';
            echo '    document.write("<li class=\'nav-item\'><a class=\'nav-link\' href=\'http://localhost/PHP-PRODUCT-UPLOAD-v2/admin/account.php\'>Account</a></li><li class=\'nav-item\'><a class=\'nav-link\' href=\'http://localhost/PHP-PRODUCT-UPLOAD-v2/db/logout.php\'>Log Out</a></li>");';
            echo '} else {';
            echo '    document.write("<li class=\'nav-item\'><a class=\'nav-link\' href=\'http://localhost/PHP-PRODUCT-UPLOAD-v2/db/login.php\'>Log In</a></li><li class=\'nav-item\'><a class=\'nav-link\' href=\'http://localhost/PHP-PRODUCT-UPLOAD-v2/db/register.php\'>Register</a></li>");';
            echo '}';
            echo '</script>';
          ?>
        </ul>
      </div>
      <!-- END Mobile Nav -->

      <div class="d-none d-lg-block" id="navbarText">
        <ul class="navbar-nav mb-2 mb-lg-0 ms-auto">

          <li class="nav-item">
            <a class="nav-link" aria-current="page" href="#"><i class="ri-search-line"></i></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" aria-current="page" href="#"><i class="ri-shopping-cart-fill"></i></a>
          </li>

          <?php
            // Check if local storage has a specific value
            echo '<script>';
            echo 'var username = localStorage.getItem("username");';
            echo 'if (username) {';
            echo '    document.write("<li class=\'nav-item\'><a class=\'nav-link\' href=\'http://localhost/PHP-PRODUCT-UPLOAD-v2/admin/account.php\'>Account</a></li><li class=\'nav-item\'><a class=\'nav-link\' href=\'http://localhost/PHP-PRODUCT-UPLOAD-v2/db/logout.php\'>Log Out</a></li>");';
            echo '} else {';
            echo '    document.write("<li class=\'nav-item\'><a class=\'nav-link\' href=\'http://localhost/PHP-PRODUCT-UPLOAD-v2/db/login.php\'>Log In</a></li><li class=\'nav-item\'><a class=\'nav-link\' href=\'http://localhost/PHP-PRODUCT-UPLOAD-v2/db/register.php\'>Register</a></li>");';
            echo '}';
            echo '</script>';
          ?>
        </ul>
      </div>


    </div>
  </nav>
  <?php include 'products-page-tags.php' ?>
  <!-- -->
</div>