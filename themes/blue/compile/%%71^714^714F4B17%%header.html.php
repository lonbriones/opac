<?php /* Smarty version 2.6.12, created on 2011-03-15 06:55:25
         compiled from header.html */ ?>
<table width="100%" border="0">
  <tr>
    <td><img src="<?php echo $this->_tpl_vars['THEMESDIR']; ?>
/images/logo.jpg" border="0"/></td>
    <td valign=center><div align="right"><div id="language_container">Select Language: <?php echo $this->_tpl_vars['language_dropdown']; ?>
</div> <div id="utils"><?php echo $this->_tpl_vars['utils']; ?>
</div></div></td>

  </tr>
</table>
<div id="menu">
  <ul id="nav">
<?php unset($this->_sections['index']);
$this->_sections['index']['name'] = 'index';
$this->_sections['index']['loop'] = is_array($_loop=$this->_tpl_vars['menu']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
 if ($this->_tpl_vars['menu'][$this->_sections['index']['index']]['id'] == $this->_tpl_vars['menu_sel']): ?>
	<li class="active"><?php else: ?><li><?php endif; ?><table border=0 cellpadding="0" cellspacing="0">
	  <tr><td><a href="<?php echo $this->_tpl_vars['menu'][$this->_sections['index']['index']]['link']; ?>
"><img src="<?php echo $this->_tpl_vars['THEMESDIR']; ?>
/images/<?php echo $this->_tpl_vars['menu'][$this->_sections['index']['index']]['id']; ?>
.gif" border=0/></a></td><td><a href="<?php echo $this->_tpl_vars['menu'][$this->_sections['index']['index']]['link']; ?>
"><?php echo $this->_tpl_vars['menu'][$this->_sections['index']['index']]['label']; ?>
</a></td></tr></table></li>
<?php endfor; endif; ?>
  </ul>
</div>
<div id="submenu">
<ul id="subnav"><?php unset($this->_sections['index']);
$this->_sections['index']['name'] = 'index';
$this->_sections['index']['loop'] = is_array($_loop=$this->_tpl_vars['submenu']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
?><li><a href="<?php echo $this->_tpl_vars['submenu'][$this->_sections['index']['index']]['link']; ?>
"><?php echo $this->_tpl_vars['submenu'][$this->_sections['index']['index']]['label']; ?>
</a></li>
		  <?php endfor; endif; ?></ul>
</div>