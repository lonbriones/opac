<?php /* Smarty version 2.6.12, created on 2010-05-14 07:15:33
         compiled from c:/Files/webopac/themes/blue//home.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'getDisplayDate', 'c:/Files/webopac/themes/blue//home.html', 17, false),)), $this); ?>
<table width="100%" border="0">
  <tr> 
    <td width="70%"><div align="center">
        <p><font color="#0000FF" size="6"><strong><?php echo $this->_tpl_vars['libraryname']; ?>
</strong></font></p>
        <p><img src="themes/blue/images/LIBRARY_LOGO.jpg" width="396" height="260" /></p>
      </div></td>
  </tr>
  <tr> 
    <td><table width="100%" bgcolor="#D7E6FB" class="box1">
        <tr> 
          <td valign="middle"><strong>Notice </strong></td>
          <td align="right" valign="middle"><a href="?m=home&amp;s=notice_archive">Archive</a> 
            &gt;&gt;</td>
        </tr>
        <tr> 
          <td colspan="2" bgcolor="#FFFFFF"> <?php unset($this->_sections['outer']);
$this->_sections['outer']['name'] = 'outer';
$this->_sections['outer']['loop'] = is_array($_loop=$this->_tpl_vars['notice']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
            <p> <u><i><?php echo getDisplayDatefromtpl(array('pdate' => $this->_tpl_vars['notice'][$this->_sections['outer']['index']]['PDATE']), $this);?>
</i> </u><strong><u><br />
              <?php echo $this->_tpl_vars['notice'][$this->_sections['outer']['index']]['TITLE']; ?>
</u></strong><br />
              <?php echo $this->_tpl_vars['notice'][$this->_sections['outer']['index']]['MSG']; ?>
</p>
            <?php endfor; endif; ?></td>
        </tr>
      </table></td>
  </tr>
</table>
<p>&nbsp;</p>