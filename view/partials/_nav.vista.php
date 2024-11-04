<!-- Anna Escribano -->
<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container">
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
      aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li id="home" class="nav-item">
          <a class="nav-link" href="index.php">Home</a>
        </li>
        <li id="myArticles" class="nav-item <?php echo !isset($_SESSION['user']) ? "hidden" : "" ?>">
          <a class="nav-link" href="index.php?myArticles=true">Els meus articles</a>
        </li>
        <li id="newArticle" class="nav-item  <?php echo !isset($_SESSION['user']) ? "hidden" : "" ?>">
          <a class="nav-link" href="form.php">Nou Article</a>
        </li>
      </ul>
      <ul class="navbar-nav">
        <?php if (!isset($_SESSION['user'])): ?>

          <li id="login" class="nav-item">
            <a class="nav-link" href="login.php">
              Login
            </a>
          </li>
        <?php else: ?>

          <div class="dropdown">
            <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown"
              aria-expanded="false">
              <?= $_SESSION['user'] ?>
            </button>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="#">Perfil</a></li>
              <li><a class="dropdown-item" href="login.php?isLogout=true">Logout</a></li>
            </ul>
          </div>
        <?php endif; ?>
      </ul>
    </div>
  </div>
</nav>