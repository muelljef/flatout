    <!-- Custom styles for this template -->
    <link rel="stylesheet" href="<?php echo base_url("../cover.css"); ?>" />
  </head>

  <body>

    <div class="site-wrapper">

      <div class="site-wrapper-inner">

        <div class="cover-container">

          <div class="masthead clearfix">
            <div class="inner">
              <h3 class="masthead-brand">FLATOUT</h3>
              <nav>
                <ul class="nav masthead-nav">
                  <li><a href="<?php echo base_url($homeLink); ?>">Home</a></li>
                  <li class="active"><a href="<?php echo base_url($loginLink); ?>">Login</a></li>
                  <li><a href="<?php echo base_url($registerLink); ?>">Registration</a></li>
                </ul>
              </nav>
            </div>
          </div>

          <div class="inner cover">
              <!-- CodeIgniter Validation-->
              <?php echo validation_errors(); ?>
              <!-- open the form -->
              <?php echo form_open('users/login', 'class="form-signin"'); ?>

                <h2 class="form-signin-heading">Please sign in</h2>

                <label for="inputEmail" class="sr-only">Email address</label>
                <input id="inputEmail" name="inputEmail" class="form-control" placeholder="Email address" required="" autofocus="" type="email">

                <label for="inputPassword" class="sr-only">Password</label>
                <input id="inputPassword" name="inputPassword" class="form-control" placeholder="Password" required="" type="password">

                <div class="checkbox">
                  <label>
                    <input value="remember-me" type="checkbox"> Remember me
                  </label>
                </div>
                <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
                <br>
                <a href="<?php echo base_url("index.php/users"); ?>" id="homeLink">Return Home</a>
              </form>
          </div>

          <div class="mastfoot">
            <div class="inner">
              <p>Cover template for <a href="http://getbootstrap.com/">Bootstrap</a>, by <a href="https://twitter.com/mdo">@mdo</a>.</p>
            </div>
          </div>

        </div>

      </div>

    </div>
