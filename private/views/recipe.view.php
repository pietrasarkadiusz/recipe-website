<?php $this->view('includes/header')?>
<?php $this->view('includes/nav')?>

<div class="container-fluid">

    <?php if($recipe):?>
    <?php
 			$recipeImage = get_image($recipe->getImage());
            $profileImage = get_image($user->getImage(),'profile');
 		?>
    <div class="card p-4 shadow mx-auto mt-5" style="max-width: 1000px;">

        <?php if(Auth::i_own_content($recipe->getUserId())):?>
        <div class="d-grid gap-2 d-md-flex justify-content-end">
            <a href="<?=ROOT?>/recipe/edit/<?=$recipe->getId()?>">
                <button class="btn-sm btn btn-success">Edit</button>
            </a>
            <a href="<?=ROOT?>/recipe/delete/<?=$recipe->getId()?>">
                <button class="btn-sm btn btn-danger">Delete</button>
            </a>
        </div>
        <?php endif;?>
        <div class="row">
            <div class="d-flex justify-content-center">
                <h1 class="font-weight-bold"><a><?=$recipe->getName()?></a></h1>
            </div>
        </div>
        <div class="row mh-100">
            <div class="col-sm-4 col-md-8 p-2">
                <img src="<?=$recipeImage;?>" class="img-fluid" />
            </div>
            <div class="col-sm-2 col-md-4 p-2">
                <div class="card p-2 shadow-sm text-center">
                    <div class="bg-image hover-overlay ripple my-4" data-mdb-ripple-color="light">
                        <a href="<?=ROOT?>/profile/<?=$user->getId()?>">
                            <img src="<?=$profileImage;?>" class="border border-primary d-block mx-auto rounded-circle "
                                style="width:100px;height:100px;" />
                        </a>
                    </div>
                    <h5 class="card-title font-weight-bold"><a>Made by
                            <?=$user->getFullName()?></a></h5>
                </div>
                <div class="card p-2 shadow-sm mt-4 d-flex align-self-center">
                    <ul class="list-group list-group-flush justify-content-between">
                        <li class="list-group-item">
                            <div><i class="bi bi-clock"></i> <?=$recipe->getAllTime()?> Minutes</div>
                        </li>
                        <li class="list-group-item">
                            <div><i class="bi bi-diamond"></i> <?=$recipe->getDifficulty()?></div>
                        </li>
                        <li class="list-group-item">
                            <div><i class="bi bi-person-circle"></i> <?=$recipe->getServings()?> Servings</div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <br>
        <div class="card p-2 shadow-sm">
            <div class="card-title d-flex justify-content-center my-2">
                <h2 class="font-weight-bold"><a>RECIPE INGREDIENTS</a></h2>
            </div>
            <hr class="my-4" />
            <div class="card-body">
                <div class="row my-2">
                    <?php if($quantities):?>
                    <?php foreach ($quantities as $key => $quantity):?>
                    <div class="col-6 p-2 mt-2 d-flex justify-content-left">
                        <i class="bi bi-check-lg"> <?=$quantity->getQuantity()?> <?=$measurements[$key]->getName()?>
                            <?=$ingredients[$key]->getName()?>, <?=$ingredients[$key]->getDescription()?></i>
                    </div>
                    <?php endforeach;?>
                    <?php else:?>
                    <center>
                        <h4>Ingredients not found!</h4>
                    </center>
                    <?php endif;?>
                </div>
            </div>
        </div>
        <div class="card p-2 mt-3 shadow-sm">
            <div class="card-title d-flex justify-content-center my-2">
                <h2 class="font-weight-bold"><a>PREPARATION</a></h2>
            </div>
            <hr class="my-4" />
            <div class="card-body">
                <?php if($steps):?>
                <?php foreach ($steps as $step):?>
                <div class="row my-2">
                    <div class="col-2 p-2 d-flex justify-content-center" style="background-color: #ddd;">
                        <i class="bi bi-chevron-right">Step <?=$step->getNumber()?></i>
                    </div>
                    <div class="col-10 p-2">
                        <div class="text">
                            <?=$step->getDescription()?>
                        </div>
                    </div>
                </div>
                <?php endforeach;?>
                <?php else:?>
                <center>
                    <h4>Steps not found!</h4>
                </center>
                <?php endif;?>
            </div>
            <?php else:?>
            <center>
                <h4>That recipe was not found.</h4>
            </center>
            <?php endif;?>
        </div>
    </div>
</div>
<?php $this->view('includes/footer')?>