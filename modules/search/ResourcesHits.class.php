<?php
class ResourcesHits {
    
    function ResourcesHits($query) {
        
        $hosts = array_keys(Language::getHosts());
        global $curhost;
        global $yazconn;
        $arr = array();
        for ($i=0;$i<count($hosts);$i++) {
            if ($hosts[$i] != $curhost) {            
                if ($yazconn->connect($hosts[$i],$query))
                    $arr[YazConnectionManager::getHostName($hosts[$i])] = $yazconn->getHits($hosts[$i]);
                else
                    $arr[YazConnectionManager::getHostName($hosts[$i])] = $yazconn->ErrMsg[$hosts[$i]];
            }
        }
        return $arr;
    }
    function getHits(){
        
    }
    
}

?>