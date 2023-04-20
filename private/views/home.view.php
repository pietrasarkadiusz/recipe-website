<?php $this->view('includes/header')?>
<?php $this->view('includes/nav')?>

<div class="container-fluid w-100">
    <div class="card justify-content-center w-90 m-5 shadow-sm" style="height: 600px;">
        <div class="row d-flex justify-content-center text-center">
            <div class="col-md-6">
                <h2>Search for Recipes</h2><br>
                <form class="form-inline mb-0" action="<?=ROOT?>/recipes" method="get">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <button type="button" class="input-group-text" id="basic-addon1"><i
                                    class="bi bi-search"></i>&nbsp</button>
                        </div>
                        <input name="find" value="<?=isset($_GET['find'])?$_GET['find']:'';?>" type="text"
                            class="form-control" placeholder="Search" aria-label="Search"
                            aria-describedby="basic-addon1">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php $this->view('includes/footer')?>