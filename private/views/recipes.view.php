<?php $this->view('includes/header')?>
<?php $this->view('includes/nav')?>

<div class="container-fluid p-4 mt-5 shadow mx-auto" style="max-width: 1200px;">
    <nav class="navbar navbar-light bg-light p-2">
        <form class="form-inline mb-0">
            <div class="input-group">
                <div class="input-group-prepend">
                    <button class="input-group-text" id="basic-addon1"><i class="bi bi-search"></i>&nbsp</button>
                </div>
                <input name="find" value="<?=isset($_GET['find'])?$_GET['find']:'';?>" type="text" class="form-control"
                    placeholder="Search" aria-label="Search" aria-describedby="basic-addon1">
            </div>
        </form>
    </nav>

    <div class="card-group justify-content-center">
        <?php if($recipes):?>
        <?php foreach ($recipes as $recipe):?>
        <?php include(views_path('recipe'))?>
        <?php endforeach;?>
        <?php else:?>
        <h4>No recipes were found.</h4>
        <?php endif;?>
    </div>

    <?php $pager->display()?>

</div>

<?php $this->view('includes/footer')?>