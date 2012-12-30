<?php /* Smarty version 2.6.12, created on 2011-03-13 10:40:06
         compiled from c:/Files/webopac/themes/blue/request.html */ ?>
<link href="css.css" rel="stylesheet" type="text/css">
<h3>Request Book </h3>
<span class="error"><?php echo $this->_tpl_vars['error']; ?>
</span>
<?php echo $this->_tpl_vars['message']; ?>

<form name="form1" method="post" action="">
  <table cellpadding="5" cellspacing="0">
    <tr>
      <td><strong>Title</strong></td>
      <td bgcolor="#FFFFFF"><label>
        <input name="title" type="text" id="title" size="50">
      </label></td>
    </tr>
    <tr>
      <td><strong>Author</strong></td>
      <td bgcolor="#FFFFFF"><input name="author" type="text" id="author" size="50"></td>
    </tr>
    <tr>
      <td><strong>Publisher</strong></td>
      <td bgcolor="#FFFFFF"><input name="publisher" type="text" id="publisher" size="50"></td>
    </tr>
    <tr>
      <td><strong>ISBN</strong></td>
      <td bgcolor="#FFFFFF"><input name="isbn" type="text" id="isbn" size="50"></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td bgcolor="#FFFFFF">&nbsp;</td>
    </tr>
    <tr>
      <td><strong>Notes</strong></td>
      <td bgcolor="#FFFFFF"><label>
        <textarea name="note" cols="40" rows="5" id="note"></textarea>
      </label></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td bgcolor="#FFFFFF"><label>
        <input type="submit" name="Submit" value="Send Request">
      </label>
        <label>
        <input type="reset" name="Submit2" value="Reset">
      </label></td>
    </tr>
  </table>
  <input name="sendrequest" type="hidden" id="sendrequest" value="1">
</form>
<p>&nbsp;</p>