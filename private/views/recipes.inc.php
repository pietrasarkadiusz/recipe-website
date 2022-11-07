<?php if($rows):?>
    //TODO: i think its not used 
<?php foreach ($rows as $row):?>
    <?php
 			$image = get_image($row->image);
 		?>
<div class="card m-2 shadow-sm" style="max-width: 23rem;min-width: 23rem;">
    <div class="bg-image hover-overlay ripple" data-mdb-ripple-color="light">
        <a href="<?=ROOT?>/recipe/<?=$row->id?>">
            <img src="<?=$image?>" class="img-fluid" />
        </a>
    </div>
    <div class="card-body">
        <h5 class="card-title font-weight-bold"><a><?=$row->name?></a></h5>
        <p class="card-text"><?=$row->description?></p>
        <hr class="my-4" />
        <ul class="list-unstyled list-inline d-flex justify-content-between">
            <li class="list-inline-item me-0">
                <div><i class="bi bi-clock"></i> <?=($row->prep_time+$row->cook_time)?> Minutes</div>
            </li>
            <li class="list-inline-item me-0">
                <div><i class="bi bi-diamond"></i> <?=$row->difficulty?></div>
            </li>
            <li class="list-inline-item me-0">
                <div><i class="bi bi-person-circle"></i> <?=$row->servings?> Servings</div>
            </li>
        </ul>
        <hr class="my-4" />
        <a href="#!" class="btn btn-link link-secondary p-md-1 mb-0">Button</a>
    </div>
</div>
<?php endforeach;?>
<?php else:?>
<center>
    <h4>No recipes were found.</h4>
</center>
<?php endif;?>