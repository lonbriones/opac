<?php /* Smarty version 2.6.12, created on 2011-02-01 13:57:16
         compiled from c:/Files/webopac/themes/blue/listview_tab.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'parse', 'c:/Files/webopac/themes/blue/listview_tab.html', 39, false),)), $this); ?>

<form action="" method="" name="ListViewForm" id="ListViewForm">
<input type="hidden" name="hostname" value="<?php echo $this->_tpl_vars['hostname']; ?>
">
<input type="hidden" name="curhost" value="<?php echo $this->_tpl_vars['curhost']; ?>
">
<div id="hostdetail">
  <table width="100%" border="0" cellpadding="0" cellspacing="0">
    <tr>
      <td>Search Result: <strong><?php echo $this->_tpl_vars['hostname']; ?>
</strong></td>
      <td align="right"><img src="themes/blue/images/disk.jpg" /><a href="index.php?m=search&s=saved&hostname=<?php echo $this->_tpl_vars['hostname']; ?>
&curhost=<?php echo $this->_tpl_vars['curhost']; ?>
">&nbsp;<span id="<?php echo $this->_tpl_vars['curhost']; ?>
_savednum" style="font-weight:bold"><?php echo $this->_tpl_vars['savednum']; ?>
</span> items saved</a></td>
    </tr>
  </table>
</div>
<div id="listviewtab">
<table width="99%" align="center" cellpadding="0" cellspacing="0" >
  <tr>
    <td></td>
    </tr>
  <tr>
    <td><table width="100%" border="0">
      <tr>
        <td><?php echo $this->_tpl_vars['hitsinfo']; ?>
</td>
        <td align="right"><?php echo $this->_tpl_vars['nav']; ?>
</td>
      </tr>
    </table></td>
    </tr>
  <tr>
    <td bgcolor="#FFFFFF"><table width="100%" border="0">
      <tr>
		<td bgcolor="#FFFFFF" class="sr_header"><input type="checkbox" name="checkall" id="checkall" onclick="javascript:selectall()"/></td>
        <td bgcolor="#FFFFFF" class="sr_header">Fmt.</td>
        <td bgcolor="#FFFFFF" class="sr_header"><?php echo $this->_tpl_vars['callno_sortdir']; ?>
<a href="javascript:sort('callno','<?php echo $this->_tpl_vars['sortdir']; ?>
')">Callno</a></td>
        <td bgcolor="#FFFFFF" class="sr_header"><?php echo $this->_tpl_vars['title_sortdir']; ?>
<a href="javascript:sort('title','<?php echo $this->_tpl_vars['sortdir']; ?>
')">Title</a></td>
        <td bgcolor="#FFFFFF" class="sr_header"><?php echo $this->_tpl_vars['author_sortdir']; ?>
<a href="javascript:sort('author','<?php echo $this->_tpl_vars['sortdir']; ?>
')">Author</a></td>
        <td bgcolor="#FFFFFF" class="sr_header"><?php echo $this->_tpl_vars['publisher_sortdir']; ?>
<a href="javascript:sort('publisher','<?php echo $this->_tpl_vars['sortdir']; ?>
')">Publisher</a></td>
        <td bgcolor="#FFFFFF" class="sr_header"><?php echo $this->_tpl_vars['year_sortdir']; ?>
<a href="javascript:sort('year','<?php echo $this->_tpl_vars['sortdir']; ?>
')">Year</a></td>
      </tr>
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
    <td bgcolor="#FFFFFF" class="sr_header"><input type="checkbox" name="checkall[]" id="checkitem" value="<?php echo parsefromtpl(array('marc' => $this->_tpl_vars['marc'][$this->_sections['index']['index']],'field' => 'code'), $this);?>
" onclick="javascript:checkthis()"/></td>
    <td bgcolor="#FFFFFF" class="sr_row"><img src="<?php echo $this->_tpl_vars['THEMESDIR']; ?>
images/<?php echo parsefromtpl(array('marc' => $this->_tpl_vars['marc'][$this->_sections['index']['index']],'field' => 'fmt'), $this);?>
.gif" /></td>
    <td bgcolor="#FFFFFF" class="sr_row"><?php echo parsefromtpl(array('marc' => $this->_tpl_vars['marc'][$this->_sections['index']['index']],'field' => 'callno'), $this);?>
&nbsp;</td>
    <td bgcolor="#FFFFFF" class="sr_row"><a href="?m=search&a=details&id=<?php echo parsefromtpl(array('marc' => $this->_tpl_vars['marc'][$this->_sections['index']['index']],'field' => 'code'), $this);?>
&curhost=<?php echo $this->_tpl_vars['curhost']; ?>
&mode=<?php echo $this->_tpl_vars['mode']; ?>
"><?php echo parsefromtpl(array('marc' => $this->_tpl_vars['marc'][$this->_sections['index']['index']],'field' => 'title'), $this);?>
</a>&nbsp;</td>
    <td bgcolor="#FFFFFF" class="sr_row"><?php echo parsefromtpl(array('marc' => $this->_tpl_vars['marc'][$this->_sections['index']['index']],'field' => 'author'), $this);?>
&nbsp;</td>
    <td bgcolor="#FFFFFF" class="sr_row"><?php echo parsefromtpl(array('marc' => $this->_tpl_vars['marc'][$this->_sections['index']['index']],'field' => 'publisher'), $this);?>
&nbsp;</td>
    <td bgcolor="#FFFFFF" class="sr_row"><?php echo parsefromtpl(array('marc' => $this->_tpl_vars['marc'][$this->_sections['index']['index']],'field' => 'year'), $this);?>
&nbsp;</td>
  </tr>
      <?php endfor; endif; ?>
    </table></td>
    </tr>
  

  
  <tr>
    <td></td>
    </tr>
</table>
</form>
</div>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "listview_buttons.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php if ($this->_tpl_vars['otherhits'] != ""): ?>
<table width="" border="0" class="box1" align="center">
  <tr><td><strong>Hits of Other Resources</strong><blockquote><?php echo $this->_tpl_vars['otherhits']; ?>
</blockquote></td></tr>
</table>
<?php endif; ?>