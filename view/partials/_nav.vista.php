<!-- Anna Escribano -->
<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container">
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li id="home" class="nav-item">
          <a class="nav-link" href="index.php">Home</a>
        </li>
        <li id="myArticles" class="nav-item <?php echo !isset($_SESSION['user'])? "hidden": "" ?>">
          <a class="nav-link" href="index.php?myArticles=true">Els meus articles</a>
        </li>
        <li id="newArticle" class="nav-item  <?php echo !isset($_SESSION['user'])? "hidden": "" ?>">
          <a class="nav-link" href="form.php">Nou Article</a>
        </li>
      </ul>
      <ul class="navbar-nav">
        <li class="nav-item">
          <?php if (!isset($_SESSION['user'])) {
           echo '
           <li id="login" class="nav-item">
              <a class="nav-link" href="login.php">
                Login
              </a>
            </li>';
          } else {
            echo '
            <li class="nav-item">
              <a class="nav-link" href="login.php?isLogout=true">
                Logout
              </a>
            </li>';
          }
          ?>
        </li>
      </ul>
    </div>
  </div>
</nav>