<?php /* Smarty version 2.6.12, created on 2011-01-23 02:46:19
         compiled from c:/Files/webopac/themes/blue/login.html */ ?>
<form name="form1" method="post" action="<?php echo $this->_tpl_vars['action']; ?>
">
  <table width="50%" align="center" cellpadding="5">
    <tr>
      <td><h3 align="center">My Library </h3></td>
    </tr>
    <tr>
      <td valign="top"><table width="100%" border="0" align="center" class="box1">
        <tr>
          <td colspan="2" bgcolor="#CCCCCC"><strong>Login </strong></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td width="38%" align="right">Borrower's ID </td>
          <td width="62%"><input name="borrowid" type="text" id="borrowid" value="<?php echo $this->_tpl_vars['borrowid']; ?>
" size="25" maxlength="15" /></td>
        </tr>
        <tr>
          <td align="right">Password</td>
          <td><input name="password" type="password" id="password" size="25" maxlength="15" /></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td><input type="submit" name="Submit" value="Login" /></td>
        </tr>
      </table>        
        <p style="color:red;font-weight:bold;text-align:center"><span class="error"><?php echo $this->_tpl_vars['error']; ?>
</span></p>
        <p><strong>Why login? </strong></p>
        <p>Once logged in you can do following: </p>
        <ul>
          <li>View your circulation history</li>
          <li>Renew borrowed items</li>
          <li>Check request and reservation status</li>
          <li>Send requests to the librarian </li>
        </ul>
        <p>&nbsp;</p>      </td>
    </tr>
  </table>
  <?php echo $this->_tpl_vars['hidden']; ?>

</form>