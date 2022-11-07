<?php $this->view('includes/header')?>
<?php $this->view('includes/nav')?>

<div class="container-fluid p-4 mt-5 shadow mx-auto text-center" style="max-width: 1050px;">
    <div class="row">
        <nav class="navbar navbar-light bg-light p-2">
            <form class="form-inline mb-0">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <button class="input-group-text" id="basic-addon1"><i class="bi bi-search"></i>&nbsp</button>
                    </div>
                    <input name="find" value="<?=isset($_GET['find'])?$_GET['find']:'';?>" type="text"
                        class="form-control" placeholder="Search" aria-label="Search" aria-describedby="basic-addon1">
                </div>
            </form>
            <a href="<?=ROOT?>/signup">
                <button class="btn btn-sm btn-primary"><i class="fa fa-plus"></i>Add New</button>
            </a>
        </nav>

        <div class="card-group justify-content-center">
            <?php if($users):?>
            <?php foreach ($users as $user):?>

            <?php include(views_path('user'))?>

            <?php endforeach;?>
            <?php else:?>
            <h4>No users were found.</h4>
            <?php endif;?>
        </div>

        <?php $pager->display()?>
    </div>

</div>

<?php $this->view('includes/footer')?>