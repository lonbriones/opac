<?php /* Smarty version 2.6.12, created on 2011-05-07 15:10:18
         compiled from form.AdvancedSearch.html */ ?>
<h3 align="center"><?php echo $this->_tpl_vars['searchtitle']; ?>
</h3>

<div align="center" class="error"><?php echo $this->_tpl_vars['errormsg']; ?>
</div>

<form name="form1" method="get" action=""> 
<?php echo $this->_tpl_vars['hidden']; ?>

<input type="hidden" name="search" value="1">

 <table width="477" border="0" align="center" cellpadding="5" cellspacing="0" class="box1">
    <tr>
      <td width="62" bgcolor="#DFD2FF"><strong><?php echo $this->_tpl_vars['field_label']; ?>
</strong></td>
      <td width="247" bgcolor="#DFD2FF"><strong><?php echo $this->_tpl_vars['search_term']; ?>
</strong></td>
      <td width="143" bgcolor="#DFD2FF"><strong>Boolean</strong></td>
    </tr>
    <tr>
      <td><?php echo $this->_tpl_vars['field0']; ?>
      </td>
      <td><input name="term[0]" type="text" class="input" id="keyword" value="<?php echo $this->_tpl_vars['term0']; ?>
" size="40"></td>
      <td><?php echo $this->_tpl_vars['boolean0']; ?>
 </td>
    </tr>
    <tr>
      <td><?php echo $this->_tpl_vars['field1']; ?>
</td>
      <td><input name="term[1]" type="text" class="input" id="term[0]" value="<?php echo $this->_tpl_vars['term0']; ?>
" size="40" /></td>
      <td><?php echo $this->_tpl_vars['boolean1']; ?>
 </td>
    </tr>
    <tr>
      <td><?php echo $this->_tpl_vars['field2']; ?>
</td>
      <td><input name="term[2]" type="text" class="input" id="term[2]" value="<?php echo $this->_tpl_vars['term0']; ?>
" size="40" /></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td colspan="3"><table width="100%" border="0">
        <tr>
          <td width="52%"><?php echo $this->_tpl_vars['mtype']; ?>
</td>
          <td width="48%"><?php echo $this->_tpl_vars['location']; ?>
</td>
        </tr>
      </table></td>
    </tr>
    <tr>
      <td colspan="3"><?php echo $this->_tpl_vars['wordopt']; ?>
</td>
    </tr>
    <tr>
      <td colspan="3"><?php echo $this->_tpl_vars['databases']; ?>
</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><input type="submit" name="Submit" value="  <?php echo $this->_tpl_vars['search_term']; ?>
  " class="button" />
        <input type="reset" name="Submit2" value="  <?php echo $this->_tpl_vars['reset']; ?>
  " class="button" /></td>
      <td><a href="?m=search&s=<?php echo $this->_tpl_vars['base']; ?>
&mode=basic">Simple Search</a></td>
    </tr>
  </table>
  <input name="mode" type="hidden" id="mode" value="advanced" />
</form>
  <div align="center"></div>