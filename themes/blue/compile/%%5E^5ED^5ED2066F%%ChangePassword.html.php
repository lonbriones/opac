<?php /* Smarty version 2.6.12, created on 2011-01-23 02:44:07
         compiled from c:/Files/webopac/themes/blue/ChangePassword.html */ ?>
<?php if ($this->_tpl_vars['success'] == 'false'): ?>
<form id="form1" name="form1" method="post" action="">
  <p><strong>Note: </strong>Your password must be at least 6 characters</p>
  <table class="box1">
    <tr>
      <td colspan="4" bgcolor="#EBEBEB"><h3><?php echo $this->_tpl_vars['change_password_title']; ?>
</h3></td>
    </tr>
    <tr>
      <td><img src="" width="10" height="1" alt="" /></td>
      <td><img name="" src="" width="1" height="8" alt="" /></td>
      <td>&nbsp;</td>
      <td><img src="" width="10" height="1" alt="" /></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>New Password : </td>
      <td><input name="p1" type="text" id="p1" /></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>Confirm Password:</td>
      <td><input name="p2" type="text" id="p2" /></td>
      <td>&nbsp;</td>
    </tr>
    
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td><input type="submit" name="Submit" value="Change Password" /></td>
      <td><label></label></td>
    </tr>
  </table>
  <p><?php echo $this->_tpl_vars['hidden']; ?>
</p>
</form>
<?php endif; ?>
<p><?php echo $this->_tpl_vars['message']; ?>
</p>