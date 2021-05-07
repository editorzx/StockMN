<html lang="en">
  <head>
  <?php include("template/header.php"); ?>
  </head>
<body class="c-app flex-row align-items-center">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-md-8">
          <div class="card-group">
            <div class="card p-4 bg-gradient-dark text-white">
              <div class="card-body">
				<?php
				session_start();
				include ('config/lang.php');
				if(isset($_SESSION['statement']) && $_SESSION['statement'] == 200 )
					echo "<div class=\"alert alert-danger\" role=\"alert\">".ERROR_LOGIN."</div>";
				elseif(isset($_SESSION['statement']) && $_SESSION['statement'] == 300 )
					echo "<div class=\"alert alert-danger\" role=\"alert\">".ERROR_EMPTY_LOGIN."</div>";
				
				unset($_SESSION['statement']);
				?>
				<form id="frmlogin" action="ajax/login.php" method="post">
					<h1>เข้าสู่ระบบ</h1>
					</br>
					<div class="input-group mb-3">
						<div class="input-group-prepend">
							<span class="input-group-text">
							  <svg class="c-icon">
								<use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-user"></use>
							  </svg>
							</span>
						</div>
						<input class="form-control" name="email" id="email" type="email" placeholder="Email Address" autocomplete="off" required>
					</div>
					<div class="input-group mb-4">
						<div class="input-group-prepend">
							<span class="input-group-text">
							  <svg class="c-icon">
								<use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-lock-locked"></use>
							  </svg>
							</span>
						</div>
						<input class="form-control" name="pass" id="pass" type="password" placeholder="Password" required>
					</div>
					<div class="row">
					  <div class="col-12 text-right">
						<button id="btnlogin" class="btn btn-outline-light px-4" type="submit">Login</button>
					  </div>
					</div>
				</form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
	<?php include("template/footer.php"); ?>
  </body>
</html>