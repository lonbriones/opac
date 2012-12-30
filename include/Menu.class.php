<?php
// +----------------------------------------------------------------------+
// | Copyright (c) 2006-2009 Kyung IL Tech, Inc.                          |
// +----------------------------------------------------------------------+
// |                                                                      |
// +----------------------------------------------------------------------+
// | Author: Dionylon Briones <deform_perspective@yahoo.co.uk>           |
// +----------------------------------------------------------------------+
//
// $Id: Menu.class.php,v 1.1 2006/09/04 08:26:17 lon.briones Exp $
class menu {
	var $menulist;
	var $sublist;
	var $mainmenu;
	var $submenu;
	
	function addMainItem($id,$name){
		$this->menulist[$id] = array($name,"?m=$id");		
		$this->mainmenu[] = array('label'=>$name,'id'=>$id,'link'=>"?m=$id");
	}
	function addSubItem($id,$subid,$name){		
		if (isset($this->menulist[$id])) {
			$this->sublist[$id][$subid]=array($name,"?m=$id&s=$subid");
			$this->submenu[][$id][$subid] = array('label'=>$name,'id'=>$subid,'link'=>"?m=$id&s=$subid");
		} else {
			return false;
		}
	}
	function inMainItems($mainitem) {
		return (isset($this->menulist[$mainitem])) ? true : false;
	}
	function inSubItems($mainitem,$subitem) {
		return ($this->inMainItems($mainitem) && in_array($subitem,array_keys($this->sublist[$mainitem]))) ? true : false;
	}
	function getMenuList() {
		
		$menulist = $this->menulist;
		
		foreach ($menulist as $id => $info) {
			if ($id == $activemenu) {
				$id = '<b>'.$id.'</b>';
			}
			$html[] = ' <a href="'.$info[1].'">'.$id.'</a> |';
		}
		$html[] = '<hr>';

		if ($this->inMainItems($activemenu)) {
			$sublist = $this->sublist[$activemenu];
			foreach ($sublist as $id => $info) {
				if ($id == $activesub) {
					$id = '<b>'.$id.'</b>';
				}
				
				$html[] = ' <a href="'.$info[1].'">'.$id.'</a> |';
			}		
		}

		return implode('',$html);	
	}
	function getMainMenu($activemenu,$activesub) {
		
	    $menulist = $this->menulist;
		$html=array();
		foreach ($menulist as $id => $info) {
			if ($id == $activemenu) {
				$class = "menulink";
				$info[0] = '<b>'.$info[0].'</b>';
			} else {
			    $class = "menulink";
			}
			$html[] = '<a href="'.$info[1].'" class="'.$class.'">'.$info[0].'</a>';
		}	    		
		return implode('',$html);
	}
	function getSubMenu($activemenu,$activesub) {
		$html=array();
	    if ($this->inMainItems($activemenu)) {
			$sublist = $this->sublist[$activemenu];
			
			foreach ($sublist as $id => $info) {
				if (count($info)) {
			    if ($id == $activesub) {
					$class = "submenulink_a";
					$info[0] = '<b>'.$info[0].'</b>';
				} else {
					$class = "submenulink";
				}			

				
				$html[] = '<a href="'.$info[1].'" class="'.$class.'">'.$info[0].'</a>';
				}
			}		
		}

		return implode('',$html);			    
	}
	function render($activemenu,$activesub){
		return $this->getMainMenu($activemenu,$activesub).$this->getSubMenu($activemenu,$activesub);
	}
}
?>