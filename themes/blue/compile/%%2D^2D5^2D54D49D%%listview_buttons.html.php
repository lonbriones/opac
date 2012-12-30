<?php /* Smarty version 2.6.12, created on 2010-05-14 07:15:40
         compiled from listview_buttons.html */ ?>
<?php echo '
<script>
function selected_checkbox(){
	var obj = document.getElementById(\'checkbox\');
		alert(obj);
}
</script>
'; ?>

<br>
<table border="0" cellspacing="1" cellpadding="0" align="center">
  <tr>
    <td><form style="padding:0;margin:0;">
      <?php echo $this->_tpl_vars['hidden']; ?>

      <input type="hidden" name="listview" value="1" />
      <input name="submit" type="submit" class="button" value="New Search" />
    </form></td>
    <td>
	<form method="get" style="padding:0;margin:0;" >
        <input name="submit2" type="button" class="button" value="Save Record" onclick="javascript:SaveMarcHandler();"/>
        <input type="hidden" name="marc_view" value="true" />
        <input type="hidden" name="m" value="<?php echo $_GET['m']; ?>
" />
        <input type="hidden" name="a" value="<?php echo $_GET['a']; ?>
" />
        <input type="hidden" name="curhost" value="<?php echo $_GET['curhost']; ?>
" />
        <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>
" />
	</form>
	
	</td>
    <td>
	<form method="get" style="padding:0;margin:0;">
        <input type="hidden" name="save_marc" value="true" />
        <input type="hidden" name="m" value="<?php echo $_GET['m']; ?>
" />
        <input type="hidden" name="a" value="<?php echo $_GET['a']; ?>
" />
        <input type="hidden" name="s" value="<?php echo $_GET['s']; ?>
" />
        <input type="hidden" name="curhost" value="<?php echo $_GET['curhost']; ?>
" />
        <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>
" />
	</form>
    </td>
  </tr>
</table>