<?php /* Smarty version 2.6.12, created on 2011-03-07 07:50:51
         compiled from c:/Files/webopac/themes/blue/detailview_limited_preview.html++++++++ */ ?>
<div id="detailview">
    <div class="title">
    <h2>Detail Info</h2>
	
    <a href="<?php echo $this->_tpl_vars['detailview_link']; ?>
">Back to item details</a>
	<div class="clear">&nbsp;</div>
  </div>
  
  <div class="preview" align="center">
	<strong>Limited Preview</strong>
	<div class="preview_content">
		<script src="http://books.google.com/books/previewlib.js"></script>
		<script>GBS_setLanguage('en');</script>
		<script>GBS_insertEmbeddedViewer('ISBN:<?php echo $this->_tpl_vars['isbn']; ?>
',800,600);</script>
	</div>
	</div>
</div>




	<div style="clear:both"></div>

<script type="text/javascript">
var isbn_key = 'ISBN:'+<?php echo $this->_tpl_vars['isbn']; ?>
;

<?php echo '
function mycallback(bookinfo) {
	$.each(bookinfo, function(index, value){
		if ($(\'.cover\').length == 0 && value[\'thumbnail_url\']) {
			$(\'.holdings\').children().before(\'<div class="cover"><img src="\'+value[\'thumbnail_url\']+\'"/></div>\');
		}
		if (value[\'embeddable\']) {
			$(\'.cover\').append(\'<div class="limited_preview_link" align="center"><strong>Available<br>Limited<br>Preview</strong></div>\');
			$(\'.preview\').show();
			/*
			$(\'.limited_preview_link a\').click(function(){
				$(\'.holdings\').toggle();
				$(\'.preview\').toggle();
			})
			$(\'.limited_preview_close_link a\').click(function(){
				$(\'.holdings\').toggle();
				$(\'.preview\').toggle();
			})
			*/
		}
	})

}
'; ?>

</script>
<script src="http://books.google.com/books?bibkeys=ISBN:<?php echo $this->_tpl_vars['isbn']; ?>
&jscmd=viewapi&callback=mycallback"></script>