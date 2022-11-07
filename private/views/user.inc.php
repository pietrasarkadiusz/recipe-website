<?php
	$image = get_image($user->getImage(),'profile');
?>
<div class="card m-2 shadow-sm" style="max-width: 14rem;min-width: 14rem;">
    <img src="<?=$image?>" class=" rounded-circle card-img-top w-75 h-75 d-block mx-auto mt-1" alt="Card image cap">
    <div class="card-body">
        <h5 class="card-title"><?=$user->getFirstname()?> <?=$user->getLastname()?></h5>
        <p class="card-text"><?=str_replace("_", " ", $user->getPermission())?></p>
        <a href="<?=ROOT?>/profile/<?=$user->getId()?>" class="btn btn-primary">Profile</a>
    </div>
</div>