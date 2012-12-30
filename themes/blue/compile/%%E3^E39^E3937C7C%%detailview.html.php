<?php /* Smarty version 2.6.12, created on 2011-01-23 17:43:22
         compiled from c:/Files/webopac/themes/blue/detailview.html */ ?>
<div id="detailview">
  <div class="title">
    <h2>Detail Info</h2>
    <a href="#" onclick="javascript:history.back()">&lt;&lt; Back to search results</a>
	<div class="clear">&nbsp;</div>
  </div>
  
  
  <div class="content">
		<?php if ($this->_tpl_vars['has_cover']): ?><div class="cover"><img src="cover.php?isbn=<?php echo $this->_tpl_vars['isbn']; ?>
"/></div><?php endif; ?>
		<div class="holdings">
			<table>
			<?php unset($this->_sections['index']);
$this->_sections['index']['name'] = 'index';
$this->_sections['index']['loop'] = is_array($_loop=$this->_tpl_vars['marc']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['index']['show'] = true;
$this->_sections['index']['max'] = $this->_sections['index']['loop'];
$this->_sections['index']['step'] = 1;
$this->_sections['index']['start'] = $this->_sections['index']['step'] > 0 ? 0 : $this->_sections['index']['loop']-1;
if ($this->_sections['index']['show']) {
    $this->_sections['index']['total'] = $this->_sections['index']['loop'];
    if ($this->_sections['index']['total'] == 0)
        $this->_sections['index']['show'] = false;
} else
    $this->_sections['index']['total'] = 0;
if ($this->_sections['index']['show']):

            for ($this->_sections['index']['index'] = $this->_sections['index']['start'], $this->_sections['index']['iteration'] = 1;
                 $this->_sections['index']['iteration'] <= $this->_sections['index']['total'];
                 $this->_sections['index']['index'] += $this->_sections['index']['step'], $this->_sections['index']['iteration']++):
$this->_sections['index']['rownum'] = $this->_sections['index']['iteration'];
$this->_sections['index']['index_prev'] = $this->_sections['index']['index'] - $this->_sections['index']['step'];
$this->_sections['index']['index_next'] = $this->_sections['index']['index'] + $this->_sections['index']['step'];
$this->_sections['index']['first']      = ($this->_sections['index']['iteration'] == 1);
$this->_sections['index']['last']       = ($this->_sections['index']['iteration'] == $this->_sections['index']['total']);
?>
				<tr>
				<th width="10%" valign="top" scope="col"><?php echo $this->_tpl_vars['marc'][$this->_sections['index']['index']]['tag']; ?>
</th>
				<td width="90%" scope="col"><?php echo $this->_tpl_vars['marc'][$this->_sections['index']['index']]['value']; ?>
</td>
				</tr>	
			<?php endfor; endif; ?>			
			</table>    
		</div>
		<div class="clear">&nbsp;</div>
  </div>
</div>



	<div style="clear:both"></div>

<?php if ($_REQUEST['curhost'] < 2): ?>
 <div id="detailview" align="center">
<?php if ($this->_tpl_vars['collection_status'] != ""): ?>
<table width="100%" border="0" cellpadding="5" bgcolor="#DDE4FF">
  <tr>
    <td><strong>Accession</strong></td>
    <td><strong>Status</strong></td>
    <td><strong>Location</strong></td>
  </tr>
  <?php unset($this->_sections['index']);
$this->_sections['index']['name'] = 'index';
$this->_sections['index']['loop'] = is_array($_loop=$this->_tpl_vars['collection_status']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['index']['show'] = true;
$this->_sections['index']['max'] = $this->_sections['index']['loop'];
$this->_sections['index']['step'] = 1;
$this->_sections['index']['start'] = $this->_sections['index']['step'] > 0 ? 0 : $this->_sections['index']['loop']-1;
if ($this->_sections['index']['show']) {
    $this->_sections['index']['total'] = $this->_sections['index']['loop'];
    if ($this->_sections['index']['total'] == 0)
        $this->_sections['index']['show'] = false;
} else
    $this->_sections['index']['total'] = 0;
if ($this->_sections['index']['show']):

            for ($this->_sections['index']['index'] = $this->_sections['index']['start'], $this->_sections['index']['iteration'] = 1;
                 $this->_sections['index']['iteration'] <= $this->_sections['index']['total'];
                 $this->_sections['index']['index'] += $this->_sections['index']['step'], $this->_sections['index']['iteration']++):
$this->_sections['index']['rownum'] = $this->_sections['index']['iteration'];
$this->_sections['index']['index_prev'] = $this->_sections['index']['index'] - $this->_sections['index']['step'];
$this->_sections['index']['index_next'] = $this->_sections['index']['index'] + $this->_sections['index']['step'];
$this->_sections['index']['first']      = ($this->_sections['index']['iteration'] == 1);
$this->_sections['index']['last']       = ($this->_sections['index']['iteration'] == $this->_sections['index']['total']);
?>
  <tr>
    <td bgcolor="#FFFFFF"><?php echo $this->_tpl_vars['collection_status'][$this->_sections['index']['index']]['ACCESSNO']; ?>
</td>
    <td bgcolor="#FFFFFF"><table width="100%" border="0" cellspacing="1" cellpadding="0">
      <tr>
		<?php if ($this->_tpl_vars['collection_status'][$this->_sections['index']['index']]['RENTID'] == '1'): ?>
		<td><strong><font color="#FF0000"><?php echo $this->_tpl_vars['collection_status'][$this->_sections['index']['index']]['RENT']; ?>
</font></strong></td>

		<?php elseif ($this->_tpl_vars['collection_status'][$this->_sections['index']['index']]['FLAG'] > '3'): ?>
 	     <td><strong><font color="#FF0000"><?php echo $this->_tpl_vars['collection_status'][$this->_sections['index']['index']]['FLAG']; ?>
</font></strong></td>   
		<?php else: ?>
 	     <td><?php echo $this->_tpl_vars['collection_status'][$this->_sections['index']['index']]['RENT']; ?>
</td>
		<?php endif; ?> 

 

        <td><?php if ($this->_tpl_vars['collection_status'][$this->_sections['index']['index']]['RENTID'] == '1'): ?>
      <form id="form1" name="form1" method="post" action="" style="padding:0;margin:0">
        <label>
          <input type="submit" name="Submit" value="Reserve" />
          </label>
        <input name="m" type="hidden" id="m" value="mylib" />
        <input name="s" type="hidden" id="s" value="reserv" />
		<input name="rent" type="hidden" id="rent" value="<?php echo $this->_tpl_vars['collection_status'][$this->_sections['index']['index']]['RENTID']; ?>
" />
        <input name="act" type="hidden" id="act" value="reserve_item" />
      </form> <?php endif; ?> </td>
      </tr>
    </table>
	
	
      </td>
    <td bgcolor="#FFFFFF"> <?php echo $this->_tpl_vars['collection_status'][$this->_sections['index']['index']]['LOCATION']; ?>
 </td>
  </tr>
  <?php endfor; endif; ?>
</table>
<?php else: ?>
	
<?php endif; ?>

   <?php if ($this->_tpl_vars['AUTHOR_INTR'] != ""): ?>
      <table width="100%" border="0" cellpadding="5" bgcolor="#DDE4FF">
      <strong>Author Introduce</strong><br>
	  <?php echo $this->_tpl_vars['AUTHOR_INTR']; ?>

      </table>
   <?php endif; ?>

   <?php if ($this->_tpl_vars['book_INDEX'] != ""): ?>
      <table width="100%" border="0" cellpadding="5" bgcolor="#DDE4FF">
<!---      <strong>INDEX</strong><br> --->
	  <?php echo $this->_tpl_vars['book_INDEX']; ?>

      </table>
   <?php endif; ?>

   <?php if ($this->_tpl_vars['PREFACE'] != ""): ?>
      <table width="100%" border="0" cellpadding="5" bgcolor="#DDE4FF">
      <strong>PREFACE</strong><br>
	  <?php echo $this->_tpl_vars['PREFACE']; ?>

      </table>
   <?php endif; ?>

   <?php if ($this->_tpl_vars['ABSTRACT'] != ""): ?>
      <table width="100%" border="0" cellpadding="5" bgcolor="#DDE4FF">
      <strong>ABSTRACT</strong><br>
	  <?php echo $this->_tpl_vars['ABSTRACT']; ?>

      </table>
   <?php endif; ?>




<?php endif; ?>
</div>
<?php echo $this->_tpl_vars['serial']; ?>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "listview_buttons.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
		
        <script src="http://books.google.com/books/previewlib.js"></script>
        <script>GBS_setLanguage('en');</script>
        <script>var isbn = '<?php echo $this->_tpl_vars['isbn']; ?>
';GBS_insertEmbeddedViewer('ISBN:<?php echo $this->_tpl_vars['isbn']; ?>
',600,500);</script>
