<style>
	nav ul li a{
		width: 110px;
    text-align: center;
    border-left: solid thin #eee;
    border-right: solid thin #fff;
	}
  nav ul li a:hover{
    background-color: grey;
    color: white !important;
  }
  
</style>
<nav class="navbar navbar-expand-lg navbar-light bg-light p-2">
  	<a class="navbar-brand" href="<?=ROOT?>/home">
  		<img src="<?=ROOT?>/assets/logo.png" class="" style="width:50px;">
	</a>
  <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNavDropdown">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" href="<?=ROOT?>/recipes">Recipes</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="<?=ROOT?>/recipe/add/">Add Recipe</a>
      </li>
      <?php if(Auth::access('admin')):?>
      <li class="nav-item">
        <a class="nav-link" href="<?=ROOT?>/users">Users</a>
      </li>
      <?php endif;?>
      <li class="nav-item">
        <a class="nav-link" href="<?=ROOT?>/categories">Categories</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="<?=ROOT?>/measurements">Measurements</a>
      </li>
    </ul>
    <ul class="navbar-nav ms-auto">
      <?php if(!Auth::logged_in()):?>
				<li class="nav-item">
        <a class="nav-link" href="<?=ROOT?>/login">Login</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="<?=ROOT?>/signup">Signup</a>
      </li>
			<?php else:?>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <?=Auth::getFirstname()?>
        </a>
        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdownMenuLink">
          <a class="dropdown-item" href="<?=ROOT?>/profile">Profile</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="<?=ROOT?>/logout">Logout</a>
        </div>
      </li>
      <?php endif;?>
    </ul>
  </div>
</nav>