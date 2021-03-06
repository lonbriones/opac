<?php /* Smarty version 2.6.12, created on 2011-01-23 02:22:11
         compiled from c:/Files/webopac/themes/blue//circ.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'date_format', 'c:/Files/webopac/themes/blue//circ.html', 21, false),)), $this); ?>
<h3>Circulation History</h3>
<p><a href="?m=mylib&amp;s=hist">Display All</a> | <a href="?m=mylib&amp;s=hist&amp;action=borrowed">Borrowed Books</a> | <a href="?m=mylib&amp;s=hist&amp;action=unreturned">Unreturned Books</a> | <a href="?m=mylib&amp;s=hist&amp;action=overdue">Overdue</a> </p>
<table width="100%" border="0" cellpadding="0" cellspacing="2" bgcolor="#FFE2A5">
  <tr>
    <td><table cellpadding="5" cellspacing="0" bgcolor="#FFE2A5" class="box1">
      <tr >
        <td width="1%" class="line1"><strong>Access No. </strong></td>
        <td width="1%" class="line1"><strong>Borrowed Date </strong></td>
        <td width="1%" class="line1"><strong>Returned Date </strong></td>
        <td width="1%" class="line1"><strong>Due Date </strong></td>
        <td class="line1"><strong>Callno</strong></td>
        <td class="line1"><strong>Title</strong></td>
        <td class="line1"><strong>Author</strong></td>
      </tr>
      <?php unset($this->_sections['outer']);
$this->_sections['outer']['name'] = 'outer';
$this->_sections['outer']['loop'] = is_array($_loop=$this->_tpl_vars['items']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
  <tr>
    <td bgcolor="#FFFFFF" class="line2"><?php echo $this->_tpl_vars['items'][$this->_sections['outer']['index']]['ACCESSNO']; ?>
</td>
    <!-- Wilson edited
    <td bgcolor="#FFFFFF" class="line2"><?php echo $this->_tpl_vars['items'][$this->_sections['outer']['index']]['CHKIN']; ?>
</td> 
	to this one :) -->
    <td bgcolor ="#FFFFFF" class ="line2"><?php echo ((is_array($_tmp=$this->_tpl_vars['items'][$this->_sections['outer']['index']]['CHKOUT'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%m/%d/%Y") : smarty_modifier_date_format($_tmp, "%m/%d/%Y")); ?>
</td>
    <td bgcolor="#FFFFFF" class="line2"><?php echo ((is_array($_tmp=$this->_tpl_vars['items'][$this->_sections['outer']['index']]['CHKIN'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%m/%d/%Y") : smarty_modifier_date_format($_tmp, "%m/%d/%Y")); ?>
</td>
    <td bgcolor="#FFFFFF" class="line2"><?php echo ((is_array($_tmp=$this->_tpl_vars['items'][$this->_sections['outer']['index']]['DUE'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%m/%d/%Y") : smarty_modifier_date_format($_tmp, "%m/%d/%Y")); ?>
</td>
    <td bgcolor="#FFFFFF" class="line2"><?php echo $this->_tpl_vars['items'][$this->_sections['outer']['index']]['CALLNO']; ?>
</td>
    <td bgcolor="#FFFFFF" class="line2"><?php echo $this->_tpl_vars['items'][$this->_sections['outer']['index']]['TITLE']; ?>
</td>
    <td bgcolor="#FFFFFF" class="line2"><?php echo $this->_tpl_vars['items'][$this->_sections['outer']['index']]['AUTHOR']; ?>
</td>
  </tr>
      <?php endfor; endif; ?>
    </table></td>
  </tr>
</table>
<p>&nbsp;</p>