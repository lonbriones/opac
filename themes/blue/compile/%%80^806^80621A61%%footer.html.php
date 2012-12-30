<?php /* Smarty version 2.6.12, created on 2011-01-23 03:44:38
         compiled from footer.html */ ?>
<div id="footer" align="center">
<br>
<?php echo $this->_tpl_vars['libraryname']; ?>
<br>
<?php echo $this->_tpl_vars['libraryaddress']; ?>
<br>
<?php echo $this->_tpl_vars['libraryphone']; ?>
<br>
</div>

<!--Dialog box contents-->
<?php if ($this->_tpl_vars['islogon']): ?>
<div id="dialogExpired" title="Session (Page) Expired!" style="display:none"><p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 0 0;"></span> Your session has expired!<p id="dialogText-expired"></p></div>

<div id="dialogWarning" title="Session (Page) Expiring!" style="display:none"><p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 0 0;"></span>Hello <?php echo $this->_tpl_vars['borrower_name']; ?>
, are you still there?<br/>Your session will expire in <span id="dialogText-warning"></span> seconds!</div>
<?php endif; ?>