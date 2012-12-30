<?php /* Smarty version 2.6.12, created on 2011-03-13 10:50:17
         compiled from c:/Files/webopac/themes/blue//reservation.html */ ?>
<h3>Reservation</h3>
<?php if ($this->_tpl_vars['isempty'] > 0): ?>
<?php if ($this->_tpl_vars['msg'] != ""): ?><div id="dialogbox2"><?php echo $this->_tpl_vars['msg']; ?>
</div><?php endif; ?>
<table width="100%" border="0" cellpadding="0" cellspacing="2" bgcolor="#D3F8DE">
  <tr>
    <td>
<table width="100%" cellpadding="5" cellspacing="0" bgcolor="#D3F8DE" class="box1">
  <tr >
    <td class="line1"><strong>Cancel Reservation </strong></td>
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
    <td bgcolor="#FFFFFF" class="line2">
	<?php if ($this->_tpl_vars['items'][$this->_sections['outer']['index']]['RENEW_FLG'] == ""): ?><a href="?m=mylib&amp;s=reserv&amp;id=<?php echo $this->_sections['outer']['index']; ?>
">Cancel Reservation </a><?php else: ?>Renewed item<?php endif; ?>	</td>
    <!-- Wilson edited
    <td bgcolor="#FFFFFF" class="line2"><?php echo $this->_tpl_vars['items'][$this->_sections['outer']['index']]['CHKIN']; ?>
</td> 
	to this one :) -->
	<td bgcolor="#FFFFFF" class="line2"><?php echo $this->_tpl_vars['items'][$this->_sections['outer']['index']]['CALLNO']; ?>
</td>
    <td bgcolor="#FFFFFF" class="line2"><?php echo $this->_tpl_vars['items'][$this->_sections['outer']['index']]['TITLE']; ?>
</td>
    <td bgcolor="#FFFFFF" class="line2"><?php echo $this->_tpl_vars['items'][$this->_sections['outer']['index']]['AUTHOR']; ?>
</td>
  </tr>

<?php endfor; endif; ?>
</table>
</td>
  </tr>
</table>
<?php else: ?>
<div id="dialogbox2">No items found </div>
<?php endif; ?>
<p>&nbsp;</p>