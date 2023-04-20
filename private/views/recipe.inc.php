<?php
	 	$image = get_image($recipe->getImage());
	 ?>
<div class="card m-2 shadow-sm" style="max-width: 23rem;min-width: 23rem;">
    <div class="bg-image hover-overlay ripple" data-mdb-ripple-color="light">
        <a href="<?=ROOT?>/recipe/<?=$recipe->getId()?>">
            <img src="<?=$image;?>" class="img-fluid" />
        </a>
    </div>
    <div class="card-body">
        <h5 class="card-title font-weight-bold"><a><?=$recipe->getName()?></a></h5>
        <p class="card-text"><?=$recipe->getDescription()?></p>
        <hr class="my-4" />
        <ul class="list-unstyled list-inline d-flex justify-content-between">
            <li class="list-inline-item me-0">
                <div><i class="bi bi-clock"></i> <?=$recipe->getAllTime()?> Minutes</div>
            </li>
            <li class="list-inline-item me-0">
                <div><i class="bi bi-diamond"></i> <?=$recipe->getDifficulty()?></div>
            </li>
            <li class="list-inline-item me-0">
                <div><i class="bi bi-person-circle"></i> <?=$recipe->getServings()?> Servings</div>
            </li>
        </ul>
    </div>
</div>