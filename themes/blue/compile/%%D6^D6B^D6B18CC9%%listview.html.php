<?php /* Smarty version 2.6.12, created on 2011-03-15 05:28:25
         compiled from c:/Files/webopac/themes/blue/listview.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'parse', 'c:/Files/webopac/themes/blue/listview.html', 28, false),array('function', 'has_cover', 'c:/Files/webopac/themes/blue/listview.html', 30, false),array('function', 'display_holdings', 'c:/Files/webopac/themes/blue/listview.html', 41, false),array('function', 'get_isbns', 'c:/Files/webopac/themes/blue/listview.html', 90, false),)), $this); ?>
Search Result: <strong><?php echo $this->_tpl_vars['hostname']; ?>
</strong> 
<div id="listview">
<div class="bar">
	<div class="hitsinfo">
	<?php echo $this->_tpl_vars['hitsinfo']; ?>

	</div>

	<div class="nav">
	<?php echo $this->_tpl_vars['nav']; ?>

	</div>
	<div class="clear"></div>
</div>


<?php $this->assign('Color1', '#edf1ff'); ?>   <?php $this->assign('Color2', '#fff'); ?>    

  <?php unset($this->_sections['index']);
$this->_sections['index']['name'] = 'index';
$this->_sections['index']['loop'] = is_array($_loop=$this->_tpl_vars['marc']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['index']['show'] = true;
$this->_sections['index']['max'] = $this->_sections['index']['loop'];
$this->_sections['index']['step'] = 1;
$this->_sections['index']['start'] = $this->_sections['index']['step'] > 0 ? 0 : $this->_sections['index']['loop']-1;
if ($this->_sections['index']['show']) {
    $this->_sections['index']['total'] = $this->_sections['index']['loop'];
    if ($this->_sections['index']['total'] == 0)
        $this->_sections['index']['show'] = false;
} else
    $this->_sections['index']['total'] = 0;
if ($this->_sections['index']['show']):

            for ($this->_sections['index']['index'] = $this->_sections['index']['start'], $this->_sections['index']['iteration'] = 1;
                 $this->_sections['index']['iteration'] <= $this->_sections['index']['total'];
                 $this->_sections['index']['index'] += $this->_sections['index']['step'], $this->_sections['index']['iteration']++):
$this->_sections['index']['rownum'] = $this->_sections['index']['iteration'];
$this->_sections['index']['index_prev'] = $this->_sections['index']['index'] - $this->_sections['index']['step'];
$this->_sections['index']['index_next'] = $this->_sections['index']['index'] + $this->_sections['index']['step'];
$this->_sections['index']['first']      = ($this->_sections['index']['iteration'] == 1);
$this->_sections['index']['last']       = ($this->_sections['index']['iteration'] == $this->_sections['index']['total']);
?>
  
<?php if ((1 & ($this->_tpl_vars['i']++ / 1))): ?>
   <?php $this->assign('color', $this->_tpl_vars['Color1']); ?>
<?php else: ?>
   <?php $this->assign('color', $this->_tpl_vars['Color2']); ?>
<?php endif; ?> 



<div class="search-item" style="background-color: <?php echo $this->_tpl_vars['color']; ?>
" id="item-<?php echo parsefromtpl(array('marc' => $this->_tpl_vars['marc'][$this->_sections['index']['index']],'field' => 'code'), $this);?>
">
	
	<?php echo has_cover(array('marc' => $this->_tpl_vars['marc'][$this->_sections['index']['index']],'field' => 'isbn'), $this);?>

	<div class="info">
		<div class="title"><a href="?m=search&a=details&id=<?php echo parsefromtpl(array('marc' => $this->_tpl_vars['marc'][$this->_sections['index']['index']],'field' => 'code'), $this);?>
&curhost=<?php echo $this->_tpl_vars['curhost']; ?>
&mode=<?php echo $this->_tpl_vars['mode']; ?>
"><?php echo parsefromtpl(array('marc' => $this->_tpl_vars['marc'][$this->_sections['index']['index']],'field' => 'title'), $this);?>
</a></div>
		<div class="format">Format: <span><?php echo parsefromtpl(array('marc' => $this->_tpl_vars['marc'][$this->_sections['index']['index']],'field' => 'fmt'), $this);?>
</span></div>
		<div class="author">Author: <span><?php echo parsefromtpl(array('marc' => $this->_tpl_vars['marc'][$this->_sections['index']['index']],'field' => 'author'), $this);?>
</span></div>
		<div class="callno">Call No. <span><?php echo parsefromtpl(array('marc' => $this->_tpl_vars['marc'][$this->_sections['index']['index']],'field' => 'callno'), $this);?>
</span></div>
		<div class="publisher">Publisher: <span><?php echo parsefromtpl(array('marc' => $this->_tpl_vars['marc'][$this->_sections['index']['index']],'field' => 'publisher'), $this);?>
</span></div>
		<div class="year">Year: <span><?php echo parsefromtpl(array('marc' => $this->_tpl_vars['marc'][$this->_sections['index']['index']],'field' => 'year'), $this);?>
</span></div>
		<div class="isbn">ISBN: <span><?php echo parsefromtpl(array('marc' => $this->_tpl_vars['marc'][$this->_sections['index']['index']],'field' => 'isbn'), $this);?>
</span></div>
	<div class="holdings">
		<?php $this->assign('fid', 'parse'); ?>
		<?php echo display_holdings(array('marc' => $this->_tpl_vars['marc'][$this->_sections['index']['index']]), $this);?>

		<?php echo $this->_tpl_vars['collection_status']; ?>

	</div>

	</div>
	
	  
	<div class="clear"></div>
	
</div>

  <?php endfor; endif; ?>
<div class="bar">
	<div class="hitsinfo">
	<?php echo $this->_tpl_vars['hitsinfo']; ?>

	</div>

	<div class="nav">
	<?php echo $this->_tpl_vars['nav']; ?>

	</div>
	<div class="clear"></div>
</div>    
  </div>

  <?php echo '
<script type="text/javascript">
function mycallback(bookinfo) {

	$.each(bookinfo, function(index, value){
		
		
		
		if (value[\'thumbnail_url\']) {
			//alert(\'here\');
			console.log(index);
			//$(\'.search-item\').children().before(\'<div class="cover"><img src="\'+value[\'thumbnail_url\']+\'"/></div>\');
			$(\'#isbn-\'+index).html(\'<img src="\'+value[\'thumbnail_url\']+\'"/>\');
		}
		if (value[\'embeddable\']) {
			var link = $(\'#isbn-\'+index).next().find(\'.preview_link\').html();
			$(\'#isbn-\'+index).next().find(\'table\').before(\'<div class="limited_preview_link"><a href="\'+link+\'">Available Limited Preview</a></div>\');
		}
		
	})

}
</script>

'; ?>

<script src="http://books.google.com/books?bibkeys=<?php echo get_isbns(array('marc' => $this->_tpl_vars['marc']), $this);?>
&jscmd=viewapi&callback=mycallback"></script>