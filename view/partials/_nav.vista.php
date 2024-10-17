<!-- Anna Escribano -->
<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container">
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" href="index.php">Home</a>
        </li>
        <li class="nav-item <?php echo !isset($_SESSION['user'])? "hidden": "" ?>">
          <a class="nav-link" href="index.php?myArticles=true">Els meus articles</a>
        </li>
        <li class="nav-item  <?php echo !isset($_SESSION['user'])? "hidden": "" ?>">
          <a class="nav-link" href="form.php">Nou Article</a>
        </li>
      </ul>
      <ul class="navbar-nav">
        <li class="nav-item">
          <?php if (!isset($_SESSION['user'])) {
           echo '
              <a class="nav-link" href="login.php">
                Login
              </a>';
          } else {
            echo '
              <a class="nav-link" href="login.php?isLogout=true">
                Logout
              </a>';
          }
          ?>
        </li>
      </ul>
    </div>
  </div>
</nav>