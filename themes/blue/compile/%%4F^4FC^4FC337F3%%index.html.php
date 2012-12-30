<?php /* Smarty version 2.6.12, created on 2011-01-23 03:33:08
         compiled from c:/Files/webopac/themes/blue//index.html */ ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN"
"http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
<title>WEB OPAC</title>
<meta http-equiv="content-type" content="text/html; charset=utf-8">
<meta name="generator" content="HAPedit 3.1">
<link rel="stylesheet" type="text/css" href="themes/blue/css.css">
<link rel="stylesheet" type="text/css" href="themes/blue/jquery/themes/cupertino/jquery.ui.all.css">
<script type="text/javascript" src="themes/blue/jquery/jquery-1.4.4.js"></script>
<script type="text/javascript" src="themes/blue/jquery/ui/jquery-ui-1.8.9.custom.js"></script>
<script type="text/javascript" src="themes/blue/jquery/ui/jquery.ui.dialog.js"></script>
<?php if ($this->_tpl_vars['islogon']): ?><script type="text/javascript" src="themes/blue/sessiontimeout.js"></script><?php endif; ?>

<script type="text/javascript" src="include/nifty.js"></script>
<script type="text/javascript" src="themes/blue/vk_loader.js?vk_layout=US US&amp;vk_skin=winxp"></script>

<script type="text/javascript">
<?php echo '
/* WebOPAC
 * @author: Dionylon Briones
 * deform_perspective@yahoo.co.uk
 * Copyright DesignBytes, Inc. 2007
 */
function selectall(){
	//for (#)
	//chkbox = document.getElementById(\'checkitem\');
	//alert(chkbox.length);
	var checkallbutton = document.getElementById(\'checkall\');
	
	var formobj = document.ListViewForm;
	var checkboxes = formobj.checkitem;
	if (checkboxes == undefined) return;
	var len = checkboxes.length;
	var j =0;
	for (i=0;i<len;i++){
		if (checkboxes[i].checked) {
			j++;
		}
	}
	if (j != 0 && j < len) {
		checkallbutton.checked = true;
	}
	for (i=0;i<checkboxes.length;i++){
		checkboxes[i].checked = checkallbutton.checked;
	}
	//alert(formobj.checkitem.length);
}
function deleteselected(){
	if (!SelectCount()) { alert(\'Please select items\'); return }
	if (!confirm(\'Are you sure you want to delete the selected items\')){
		 return false;
	}
	var formobj = document.ListViewForm;
		formobj.submit();
	//var checkboxes = formobj.checkitem;
}
function SelectCount(){
	var formobj = document.ListViewForm;
	var checkboxes = formobj.checkitem;
	if (checkboxes == undefined) return false;
	var len = checkboxes.length;
	var marc = [];
	var j=0;
	for (i=0;i<len;i++){
		if (checkboxes[i].checked) {
			j++;
		}
	}
	return j;
	
}
function deleteall(){
	if (SelectCount() === false) { alert(\'No more items\'); return }
	if (confirm(\'Are you sure you want to delete all saved items\')) {
		formobj = document.getElementById(\'ListViewForm\');
		var hiddenobj = document.createElement(\'INPUT\');
		hiddenobj.type = \'hidden\';
		hiddenobj.name = \'deleteall\';
		hiddenobj.value = \'1\';
		formobj.appendChild(hiddenobj);
		formobj.submit();
	} else 
		return false;
}
function checkthis(){
	var formobj = document.ListViewForm;
	var checkboxes = formobj.checkitem;
	var len = checkboxes.length;
	j = 0;
	for (i=0;i<len;i++){
		if (checkboxes[i].checked) j++;
	}
	if (j == len){
		document.getElementById(\'checkall\').checked = true;
	}else if(j < len){
		document.getElementById(\'checkall\').checked = false;
	}
}
function sort(field,sortdir){

	var strHref = window.location.href;
	document.location = strHref+\'&sort=\'+field+\'&sortdir=\'+sortdir;
	//alert(getURLParam(\'sort\'));
}

function getURLParam(strParamName){
  var strReturn = "";
  var strHref = window.location.href;
  if ( strHref.indexOf("?") > -1 ){
    var strQueryString = strHref.substr(strHref.indexOf("?")).toLowerCase();
    var aQueryString = strQueryString.split("&");
    for ( var iParam = 0; iParam < aQueryString.length; iParam++ ){
      if (
aQueryString[iParam].indexOf(strParamName.toLowerCase() + "=") > -1 ){
        var aParam = aQueryString[iParam].split("=");
        strReturn = aParam[1];
        break;
      }
    }
  }
  return unescape(strReturn);
}
function SaveMarcHandler(){
	if (!SelectCount()) { alert(\'Please select items\'); return};
	var hostname = document.ListViewForm.hostname.value;
	var curhost = document.ListViewForm.curhost.value;
	var formobj = document.ListViewForm;
	var checkboxes = formobj.checkitem;
	var len = checkboxes.length;
	var marc = [];
	for (i=0;i<len;i++){
		if (checkboxes[i].checked) {
			var chkitem = checkboxes[i];
			var ident = i+\'_\'+chkitem.value;
			marc.push(ident);
		}
	}
	
	var request = httpReq();
	request.onreadystatechange = function () {
		if (request.readyState == 4) {
			if (request.status == 200) {
				var resp = request.responseText;
				var a = document.getElementById(curhost+\'_savednum\');
				a.innerHTML = resp;
				setTimeout("alert(\'Items saved.\');",1);
			}
		}
	}
	
	request.open(\'GET\', "SaveMarcHandler.php?marcsessid="+marc+"&hostname="+hostname, true);
	request.send(null);
}
function httpReq() {
	if (window.XMLHttpRequest) {// if Mozilla, Safari etc
		var page_request = new XMLHttpRequest()
		if (page_request.overrideMimeType) {
			page_request.overrideMimeType(\'text/html\');
		}
		return page_request;
	} else if (window.ActiveXObject){ // if IE
		try {
			var page_request = new ActiveXObject("Msxml2.XMLHTTP")
			return page_request;
		}catch (e){
			try{
				var page_request = new ActiveXObject("Microsoft.XMLHTTP")
				return page_request;
			} catch (e){ alert(\'httpreq:\'+e);}
		}
	}else 
		return false
}
function toggleart(idx){
	var divname = document.getElementById(\'art_\'+idx);
	divname.style.display = (divname.style.display == "block")?"none":"block";
}

/*********************/

'; ?>

</script>
<script type="text/javascript" src="themes/blue/final.js"></script>
</head>
<body>
<div id="container">
  <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "header.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
    <div id="content">
     <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => $this->_tpl_vars['content'], 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	 <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "footer.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
    </div>
</div>
</body>
</html>