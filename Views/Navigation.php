<nav class="navbar navbar-default">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#">Games</a>
    </div>

    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li class="active"><a href="../Views/GameLoadAll.php">All Games<span class="sr-only">(current)</span></a></li>
        <li><a href="../Views/GameView.php">View Game</a></li>
        <li><a href="../Views/GameEdit.php">Add/Edit/Update Game</a></li>
        <li><a href="../Views/ViewUsers.php">View Players</a></li>
        <li><a href="../Views/Statistics.php">Statistics</a></li>
      </ul>
      <form class="navbar-form navbar-left" role="search" method="get" action="GameSearch.php">
        <div class="form-group">
          <input type="text" class="form-control" placeholder="Search" name="searchValue" id="searchValue">
        </div>
        <button type="submit" class="btn btn-default">Submit</button>
      </form>
      <ul class="nav navbar-nav navbar-right">
        <?php 
            $player = new Player;
            if(isset($_SESSION['loggedIn'])){
                if($_SESSION['loggedIn'] == true){
                    ?>
                    <li><a href="../Views/Logout.php">Logout</a></li>
                    <?php
                }
                else{ ?>
                     <li><a href="../Views/Login.php">Login</a></li>
                     <?php 
                     }
            }
            else{ ?>
                <li><a href="../Views/Login.php">Login</a></li>
                <?php 
            }
        ?>
      </ul>
    </div>
  </div>
</nav>