<?php /* Smarty version 2.6.12, created on 2010-06-02 07:21:28
         compiled from c:/Files/webopac/themes/blue//notice_archive.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'getDisplayDate', 'c:/Files/webopac/themes/blue//notice_archive.html', 11, false),)), $this); ?>
<h2>Notice Archive
  </h2>
<table width="100%" border="0" cellpadding="10" cellspacing="0">
              <tr>
                <td valign="top" bgcolor="#DFEFFF" class="linebottom"><strong>Dates</strong></td>
                <td valign="top" bgcolor="#DFEFFF" class="linebottom"><strong>Notice</strong> (<u><?php echo $this->_tpl_vars['curdate']; ?>
</u>)</td>
  </tr>
              <tr>
                <td width="200" valign="top" class="lineright"><p><a href="?m=home&amp;s=notice_archive">Display all notices</a></p>
                  <p>
                  <?php unset($this->_sections['outer']);
$this->_sections['outer']['name'] = 'outer';
$this->_sections['outer']['loop'] = is_array($_loop=$this->_tpl_vars['notice_dates']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
?> <strong><a href="?m=home&amp;s=notice_archive&amp;date=<?php echo $this->_tpl_vars['notice_dates'][$this->_sections['outer']['index']]['PDATE']; ?>
"><?php echo getDisplayDatefromtpl(array('pdate' => $this->_tpl_vars['notice_dates'][$this->_sections['outer']['index']]['PDATE']), $this);?>
</a></strong> (<?php echo $this->_tpl_vars['notice_dates'][$this->_sections['outer']['index']]['PDATE_COUNT']; ?>
) <br />
<?php endfor; endif; ?></p></td>
                <td valign="top" bgcolor="#FFFFFF">
                  <p><?php unset($this->_sections['outer']);
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
?> <strong><?php echo $this->_tpl_vars['notice'][$this->_sections['outer']['index']]['TITLE']; ?>
</strong> <br />
                    <?php echo $this->_tpl_vars['notice'][$this->_sections['outer']['index']]['MSG']; ?>
 <br/>
                    <br/>
                  <?php endfor; endif; ?> </p></td>
              </tr>
</table>
			<p>&nbsp;</p>