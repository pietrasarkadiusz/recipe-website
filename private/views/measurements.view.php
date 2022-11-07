<?php $this->view('includes/header')?>
<?php $this->view('includes/nav')?>

<div class="container-fluid p-4 mt-5 shadow mx-auto" style="max-width: 600px;">

    <h5>Measurements</h5>
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
        <?php if(Auth::access('super_admin') || Auth::access('admin')):?>
        <a href="<?=ROOT?>/measurements/add">
            <button class="btn btn-sm btn-primary"><i class="fa fa-plus"></i>Add New</button>
        </a>
        <?php endif;?>
    </nav>

    <?php include(views_path('measurements'))?>

</div>

<?php $this->view('includes/footer')?>