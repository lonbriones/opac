<?php /* Smarty version 2.6.12, created on 2011-05-07 14:58:45
         compiled from form.BasicSearch.html */ ?>
<h3 align="center"><?php echo $this->_tpl_vars['searchtitle']; ?>
</h3>
<form action="" method="get" name="form1" id="form1">
<?php echo $this->_tpl_vars['hidden']; ?>

<div align="center"><span class="error"><?php echo $this->_tpl_vars['errormsg']; ?>
 </span>
</div>
<table width="500" align="center" cellpadding="5" cellspacing="0" class="box1"> 
 

  
  <tr>
    <td width="1%" bgcolor="#FCFFD2"><strong><?php echo $this->_tpl_vars['field_label']; ?>
</strong></td>
    <td bgcolor="#FCFFD2"><strong><?php echo $this->_tpl_vars['search_term']; ?>
</strong></td>
    </tr>
  <tr>
    <td><?php echo $this->_tpl_vars['field0']; ?>
</td>
    <td><input name="term[0]" type="text" class="input" id="keyword" value="<?php echo $this->_tpl_vars['term0']; ?>
" size="70"  onfocus="VirtualKeyboard.attachInput(this)" class="keyboardInput"/></td>
	<td width="20"><div id="keyboard_icon" onclick="VirtualKeyboard.toggle('keyword','keyboard'); return false;">&nbsp;</div></td>
    </tr>
  <tr>
    <td colspan="3" align="center"><div id="keyboard"></div><?php echo $this->_tpl_vars['wordopt']; ?>
</td>
    </tr>
  <tr>
    <td colspan="3"><?php echo $this->_tpl_vars['databases']; ?>
</td>
    </tr>
  <tr>
    <td>&nbsp;</td>
    <td align="center"><input type="submit" name="Submit" value="  Search  " class="button" />
      <input type="reset" name="Submit2" value="  Reset  " class="button" />
	  <?php echo $this->_tpl_vars['saveditems']; ?>

	  <input name="mode" type="hidden" id="mode" />
	    <input type="hidden" name="search" value="1" />	  </td>
    </tr>
</table>

</form>
          <div align="center"><a href="?m=search&amp;s=<?php echo $this->_tpl_vars['base']; ?>
&amp;mode=advanced">
                
                  <?php echo $this->_tpl_vars['advancedsearch']; ?>
</a>          </div>
				  
				  
				  