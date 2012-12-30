<?php /* Smarty version 2.6.12, created on 2011-03-13 10:40:19
         compiled from c:/Files/webopac/themes/blue//viewrequest_user.html */ ?>
<h3><strong>View your requested books </strong></h3>
<table width="100%" border="0" cellpadding="0" cellspacing="0">
  
  <?php unset($this->_sections['outer']);
$this->_sections['outer']['name'] = 'outer';
$this->_sections['outer']['loop'] = is_array($_loop=$this->_tpl_vars['requestdat']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
      <td colspan="5" bgcolor="#FFFFFF">&nbsp;</td>
    </tr>
  <tr>
    <td colspan="5" bgcolor="#FFFFFF"><p>Title: <strong><?php echo $this->_tpl_vars['requestdat'][$this->_sections['outer']['index']]['TITLE']; ?>
 
    </strong><br>
    Author: <?php echo $this->_tpl_vars['requestdat'][$this->_sections['outer']['index']]['AUTHOR']; ?>
<br>
    Publisher: <?php echo $this->_tpl_vars['requestdat'][$this->_sections['outer']['index']]['PUBLISHER']; ?>
<br>
    <?php if ($this->_tpl_vars['requestdat'][$this->_sections['outer']['index']]['RQYEAR'] != ""): ?> Year: <?php echo $this->_tpl_vars['requestdat'][$this->_sections['outer']['index']]['RQYEAR']; ?>
  <br><?php endif; ?>
    ISBN: <?php echo $this->_tpl_vars['requestdat'][$this->_sections['outer']['index']]['ISBN']; ?>
<br>
      Date of request: <?php echo $this->_tpl_vars['requestdat'][$this->_sections['outer']['index']]['RQDATE']; ?>
<br>
      <strong>Status:</strong> <?php echo $this->_tpl_vars['requestdat'][$this->_sections['outer']['index']]['STATUS']; ?>
<br>
    </p>    </td>
  </tr>
  
  <tr>
    <td colspan="5" class="linebottom">&nbsp;</td>
  </tr>
  
  <?php endfor; endif; ?>
</table>