<tr class="mt-3">
    <td><input type="number" min="0"  step="any" value="1" class="form-control" name="quantities[][quantity]" placeholder="Quantity">
    </td>
    <td>
        <select name="measurements[][measurement_id]" class="form-select" id="select_box2">
            <?php $test =$_REQUEST['measurements']; foreach($test as $measurement):?>
            <option value="<?=($measurement['id'])?>"><?=($measurement['name'])?></option>
            <?php endforeach;?>
        </select>
    </td>
    <td><input type="text" class="form-control" name="ingredientsName[][name]" placeholder="Ingredient name"></td>
    <td><input type="text" class="form-control" name="ingredientsDescription[][description]" placeholder="Description"></td>
    <td class="text-danger">
        <button type="button" data-toggle="tooltip" data-placement="right" title="Click To Remove"
            onclick="$(this).closest('tr').remove()" class="btn btn-danger">
            <i class="bi bi-trash"></i>
        </button>
    </td>
</tr>