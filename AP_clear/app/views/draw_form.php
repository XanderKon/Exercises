<h1>Draw new Figure</h1>
<table>
<form name="query_form" action="<?php echo !empty($params) ? '/Index/draw' : NULL; ?>">
    <tr>
        <td>What do you want to draw?</td>
        <td>
            <select name="type" id="type" onchange="change_handler()">
                <option value=""></option>
                <?php foreach($draw_types as $type): ?>
                    <?php $selected = ($type == $get['type'] ? 'selected="selected"': NULL);?>
                    <option <?php echo $selected; ?> value="<?php echo $type; ?>"><?php echo $type; ?></option>
                <?php endforeach; ?>
            </select>
        </td>
    </tr><br />

    <!-- Figure params -->
    <tr>
        <td colspan="2"><h2>Figure params</h2></td>
    </tr>
    <?php if (!empty($params)): ?>
        <?php foreach($params as $key => $param): ?>
            <tr>
                <td><?php echo $key; ?></td>
                <td><input type="text" name="params[<?php echo $key; ?>]" class="<?php echo $key; ?>" value="<?php echo $param; ?>"></td>
            </tr>
        <?php endforeach; ?>
    <?php endif; ?>
    <tr>
        <td></td>
        <td><input type="submit"></td>
    </tr>
</form>
</table>
<script type="text/javascript">
    function change_handler()
    {
        var form = document.query_form;
        form.action = '/Index';
        form.submit();
    }
</script>