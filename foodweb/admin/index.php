<?php include('partials/nav.php'); ?>
<div class="main-content"><div class="wrapper">
<?php
            if(isset($_SESSION['login-successful'])){
                echo $_SESSION['login-successful'];
                unset($_SESSION['login-successful']);
            }
      ?>
</div></div>
<?php include('partials/footer.php'); ?>