<?php $this->view('includes/header')?>
<?php $this->view('includes/nav')?>

<div class="container-fluid">
    <div class="row mx-auto" style="max-width: 800px;">
        <form method="post">

            <div class="card p-4 mx-auto mr-4 mt-5 shadow rounded" style="width:100%;">
                <div class="row text-center">
                    <div class="col">
                        <label for="image_browser" class="btn-sm btn btn-info text-white w-auto">
                            <input onchange="display_image_name(this.files[0].name)" id="image_browser" type="file"
                                name="image" style="display: none;">
                            Add Image
                        </label>
                        <br>
                        <small class="file_info text-muted"></small>
                    </div>
                </div>
                <?php if(count($errors) > 0):?>
                    <div class="alert alert-danger alert-dismissible fade show my-2">
                    <strong>Error!</strong>
                    <?php foreach($errors as $error):?>
                    <br><?=$error?>
                    <?php endforeach;?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
                <?php endif;?>
                <div class="row">
                    <div class="col">
                        <input class="my-2 form-control" value="<?=get_var('name')?>" name="name"
                            placeholder="Recipe name...">
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <textarea class="my-2 form-control" name="description"
                            placeholder="Recipe description..."><?=get_var('description')?></textarea>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6 d-flex align-items-center">
                        <label>Category</label>
                    </div>
                    <div class="col-6 py-2">
                        <select name="category_id" class="form-select" id="select_box">
                            <?php foreach($allCategories as $category):?>
                            <option value="<?=($category->getId())?>" <?=check_select('category_id',$category->getId())?>>
                                <?=($category->getName())?></option>
                            <?php endforeach;?>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6 d-flex align-items-center">
                        <label>Difficulty</label>
                    </div>
                    <div class="col-6 py-2">
                        <select name="difficulty" class="form-select" id="select_box2">
                            <option <?=check_select('difficulty','Beginner')?> value="Beginner">Beginner</option>
                            <option <?=check_select('difficulty','Intermediate')?> value="Intermediate">Intermediate
                            </option>
                            <option <?=check_select('difficulty','Expert')?> value="Expert">Expert</option>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6 d-flex align-items-center">
                        <label>Servings</label>
                    </div>
                    <div class="col-6 py-2">
                        <input class="form-control" value="<?=get_var('servings')?>" type="number" min="1"
                            name="servings" placeholder="Number of servings...">
                    </div>
                </div>
                <div class="row">
                    <div class="col-6 d-flex align-items-center">
                        <label>Preparation time</label>
                    </div>
                    <div class="col-6 py-2">
                        <input class="form-control" value="<?=get_var('prep_time')?>" type="number" min="1"
                            name="prep_time" placeholder="Preparation time in minutes...">
                    </div>
                </div>
                <div class="row">
                    <div class="col-6 d-flex align-items-center">
                        <label>Cooking time</label>
                    </div>
                    <div class="col-6 py-2">
                        <input class="form-control" value="<?=get_var('cook_time')?>" type="number" min="1"
                            name="cook_time" placeholder="Cooking time in minutes...">
                    </div>

                </div>
            </div>
            <div class="card p-4 mx-auto shadow rounded" style="margin-top: 50px;width:100%;max-width: 800px;">
                <div class="card-title text-center">
                    <h4>Ingredients</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <table id="sortable" style="border-collapse: separate; border-spacing:0 10px;">
                                <tbody id="tbIngredients">
                                    <?php if (!isset($_POST['quantities'])):?>
                                    <td>
                                        <input type="number" min="0" step="any" value="1" class="form-control"
                                            name="quantities[][quantity]" placeholder="Quantity">
                                    </td>
                                    <td>
                                        <select name="measurements[][measurement_id]" class="form-select"
                                            id="select_box2">
                                            <?php foreach($allMeasurements as $measurement):?>
                                            <option value="<?=($measurement->getId())?>"><?=($measurement->getName())?></option>
                                            <?php endforeach;?>
                                        </select>
                                    </td>
                                    <td><input type="text" class="form-control" name="ingredientsName[][name]"
                                            placeholder="Ingredient name"></td>
                                    <td><input type="text" class="form-control"
                                            name="ingredientsDescription[][description]" placeholder="Description"></td>
                                    <?php else:?>
                                    <?php foreach ($_POST['quantities'] as $key => $value):?>
                                    <tr class="mt-3">
                                        <td><input type="number" min="0" step="any" class="form-control"
                                                name="quantities[][quantity]" placeholder="Quantity"
                                                value="<?=$value['quantity']?>">
                                        </td>
                                        <td>
                                            <select name="measurements[][measurement_id]" class="form-select"
                                                id="select_box2">
                                                <?php foreach($allMeasurements as $measurement):?>
                                                <option value="<?=($measurement->getId())?>"
                                                    <?=check_select_when_equal($key,$measurement->getId())?>>
                                                    <?=($measurement->getName())?>
                                                </option>
                                                <?php endforeach;?>
                                            </select>
                                        </td>
                                        <td><input type="text" class="form-control" name="ingredientsName[][name]"
                                                placeholder="Ingredient name"
                                                value="<?=$_POST['ingredientsName'][$key]['name']?>"></td>
                                        <td><input type="text" class="form-control"
                                                name="ingredientsDescription[][description]" placeholder="Description"
                                                value="<?=$_POST['ingredientsDescription'][$key]['description']?>">
                                        </td>
                                        <?php if ($key > 0):?>
                                        <td class="text-danger">
                                            <button type="button" data-toggle="tooltip" data-placement="right"
                                                title="Click To Remove"
                                                onclick="if(confirm('Are you sure to remove?')){$(this).closest('tr').remove();}"
                                                class="btn btn-danger">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </td>
                                        <?php endif;?>
                                    </tr>
                                    <?php endforeach;?>
                                    <?php endif;?>
                                </tbody>
                            </table>
                        </div>
                        <div class="mt-3 text-center">
                            <a href="javascript:;" class="btn btn-success" id="addIngredient"><i
                                    class="fa fa-fw fa-plus-circle"></i> Add Ingredient</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card p-4 mx-auto shadow rounded" style="margin-top: 50px;width:100%;max-width: 800px;">
                <div class="card-title text-center">
                    <h4>Preparation</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <table id="sortable" class="col-12"
                                style="border-collapse: separate; border-spacing:0 10px;">
                                <tbody id="tbSteps">
                                    <?php if (!isset($_POST['steps'])):?>
                                    <td>
                                        <textarea type="text" class="form-control" name="steps[][description]"
                                            placeholder="Step description..."></textarea>
                                    </td>
                                    <?php else:?>
                                    <?php foreach ($_POST['steps'] as $key => $value):?>
                                    <tr>
                                        <td>
                                            <textarea type="text" class="form-control" name="steps[][description]"
                                                placeholder="Step description..."><?=$value['description'];?></textarea>
                                        </td>
                                        <?php if ($key > 0):?>
                                        <td class="text-danger">
                                            <button type="button" data-toggle="tooltip" data-placement="right"
                                                title="Click To Remove"
                                                onclick="if(confirm('Are you sure to remove?')){$(this).closest('tr').remove();}"
                                                class="btn btn-danger">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </td>
                                        <?php endif;?>
                                    </tr>
                                    <?php endforeach;?>
                                    <?php endif;?>
                                </tbody>
                            </table>
                        </div>
                        <div class="mt-3 text-center">
                            <a href="javascript:;" class="btn btn-success" id="addStep">
                                <i class="fa fa-fw fa-plus-circle"></i> Add Step</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="m-2">
                <button class="btn btn-primary float-end">Add Recipe</button>
                <a href="<?=ROOT?>/home">
                    <button type="button" class="btn btn-secondary">Cancel</button>
                </a>
            </div>
        </form>
    </div>
</div>
<script>

function display_image_name(file_name) {
    document.querySelector(".file_info").innerHTML = '<b>Selected file:</b><br>' + file_name;
}

$(document).ready(function(e) {
    $("#addStep").on("click", function() {
        $.ajax({
            type: 'POST',
            url: '/recipe-website/private/views/steps-row.inc.php',
            data: {
                'data': 'addDataRow'
            },
            success: function(data) {
                $('#tbSteps').append(data);
            }
        });
    });
});

$(document).ready(function(e) {
    var measurementsData = <?php echo json_encode($allMeasurements) ?>;
    $("#addIngredient").on("click", function() {
        $.ajax({
            type: 'POST',
            url: '/recipe-website/private/views/ingredients-row.inc.php',
            data: {
                'measurements': measurementsData
            },
            success: function(data) {
                $('#tbIngredients').append(data);
            }

        });
    });
});
</script>
<?php $this->view('includes/footer')?>