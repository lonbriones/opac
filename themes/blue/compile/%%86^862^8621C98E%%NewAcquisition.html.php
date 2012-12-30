<?php /* Smarty version 2.6.12, created on 2010-06-02 04:41:25
         compiled from c:/Files/webopac/themes/blue/NewAcquisition.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'parse', 'c:/Files/webopac/themes/blue/NewAcquisition.html', 35, false),)), $this); ?>
<h3 align="center">Acquisitions
</h3>
<div id="hostdetail">
  <table width="100%" border="0" cellpadding="5" cellspacing="4" bgcolor="#DFF4FF">
    <tr><?php unset($this->_sections['outer']);
$this->_sections['outer']['name'] = 'outer';
$this->_sections['outer']['loop'] = is_array($_loop=$this->_tpl_vars['countbymonths']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['outer']['show'] = true;
$this->_sections['outer']['max'] = $this->_sections['outer']['loop'];
$this->_sections['outer']['step'] = 1;
$this->_sections['outer']['start'] = $this->_sections['outer']['step'] > 0 ? 0 : $this->_sections['outer']['loop']-1;
if ($this->_sections['outer']['show']) {
    $this->_sections['outer']['total'] = $this->_sections['outer']['loop'];
    if ($this->_sections['outer']['total'] == 0)
        $this->_sections['outer']['show'] = false;
} else
    $this->_sections['outer']['total'] = 0;
if ($this->_sections['outer']['show']):

            for ($this->_sections['outer']['index'] = $this->_sections['outer']['start'], $this->_sections['outer']['iteration'] = 1;
                 $this->_sections['outer']['iteration'] <= $this->_sections['outer']['total'];
                 $this->_sections['outer']['index'] += $this->_sections['outer']['step'], $this->_sections['outer']['iteration']++):
$this->_sections['outer']['rownum'] = $this->_sections['outer']['iteration'];
$this->_sections['outer']['index_prev'] = $this->_sections['outer']['index'] - $this->_sections['outer']['step'];
$this->_sections['outer']['index_next'] = $this->_sections['outer']['index'] + $this->_sections['outer']['step'];
$this->_sections['outer']['first']      = ($this->_sections['outer']['iteration'] == 1);
$this->_sections['outer']['last']       = ($this->_sections['outer']['iteration'] == $this->_sections['outer']['total']);
?>
        <td align="center" bgcolor="#F4FCFF"><a href="?<?php echo $this->_tpl_vars['countbymonths'][$this->_sections['outer']['index']]['QRYSTR']; ?>
"><?php echo $this->_tpl_vars['countbymonths'][$this->_sections['outer']['index']]['DATE']; ?>
</a> (<strong><?php echo $this->_tpl_vars['countbymonths'][$this->_sections['outer']['index']]['COUNT']; ?>
</strong>) </td>
      <?php endfor; endif; ?></tr>
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
        <td bgcolor="#FFFFFF" class="sr_header">Fmt.</td>
        <td bgcolor="#FFFFFF" class="sr_header">Callno</td>
        <td bgcolor="#FFFFFF" class="sr_header">Title</td>
        <td bgcolor="#FFFFFF" class="sr_header">Author</td>
        <td bgcolor="#FFFFFF" class="sr_header">Publisher</td>
        <td bgcolor="#FFFFFF" class="sr_header">Year</td>
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
    <td bgcolor="#FFFFFF" class="sr_row"><img src="<?php echo $this->_tpl_vars['THEMESDIR']; ?>
images/<?php echo parsefromtpl(array('marc' => $this->_tpl_vars['marc'][$this->_sections['index']['index']],'field' => 'fmt'), $this);?>
.gif" /></td>
    <td bgcolor="#FFFFFF" class="sr_row"><?php echo parsefromtpl(array('marc' => $this->_tpl_vars['marc'][$this->_sections['index']['index']],'field' => 'callno'), $this);?>
&nbsp;</td>
            <td bgcolor="#FFFFFF" class="sr_row"><a href="?m=search&a=details&id=<?php echo parsefromtpl(array('marc' => $this->_tpl_vars['marc'][$this->_sections['index']['index']],'field' => 'code'), $this);?>
&curhost=0&mode=<?php echo $this->_tpl_vars['mode']; ?>
"><?php echo parsefromtpl(array('marc' => $this->_tpl_vars['marc'][$this->_sections['index']['index']],'field' => 'title'), $this);?>
</a></td>
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
</div>