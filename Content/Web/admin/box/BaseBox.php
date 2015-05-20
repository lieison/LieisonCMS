<?php

include 'library/BoxAPI.class.php';


class BaseBox extends Box_API{
    
    
    var $client_id              = "nwv60huci6wgjiitowownynfqa1gwt1y";
    var $client_secret          = 'lpcu7GSqbu4J0nrvyQQMMY5Tv3RTA9O5';
    var $redirect_uri           = '';
    
    
    
    public function __construct($redirect_uri = null) {
        
        if($redirect_uri != null)
        {
             $this->redirect_uri = $redirect_uri;
             parent::__construct($this->client_id, $this->client_secret, $this->redirect_uri);
        }
    }
    
    public function ConecToBox(){
        if(!parent::load_token()){
		if(isset($_GET['code'])){
			$token = parent::get_token($_GET['code'], true);
			if(parent::write_token($token, 'file')){
				parent::load_token();
			}
		} else {
                   parent::get_code();
		}
	}
    }
    
    public function ShowAllPrimaryFolders(){
       $box_folders = parent::get_all_folders();
       $folders = array();
       if(isset($box_folders['type'])){
           if($this->Get_type($box_folders['type']) == 0){
               $items = $box_folders['item_collection']['entries'];
               foreach ($items as $values){
                   array_push($folders, array(
                       "name" => $values['name'],
                       "id" => $values['id'],
                       "type" => $values['type']
                   ));
               }
           }
       }
       return $folders;
    }
    
    
    public function ShowFiles($folder_id){
        
        $box_items = parent::get_folder_items($folder_id);
        
        $items = array();
        
        if(isset($box_items['entries'])){
            if(is_array($box_items['entries'])){
                foreach ($box_items['entries'] as $entries){
                    if($this->Get_type($entries['type']) == 0){
                       
                        array_push($items, array(
                            "name"              => $entries['name'],
                            "id"                => $entries['id'],
                            "type"              => $entries['type'],
                            "link"              => null,
                            "url"               => null,
                            "size"              => null,
                            "download_count"    => null
                        ));
                    }
                    else if($this->Get_type($entries['type']) == 1){
                       
                        $file_item = parent::get_file_details($entries['id']);
                        $shared = $file_item['shared_link'];
                        $url = null;
                        $link = null;
                        $download = null;
                        
                        if(count($shared) != 0 || $shared != null)
                        {
                             $url       = $shared['url'];
                             $link      = $shared['download_url'];
                             $download  = $shared['download_count'];
                        }
                        
                        array_push($items, array(
                            "name"              => $file_item['name'],
                            "id"                => $file_item['id'],
                            "type"              => $file_item['type'],
                            "link"              => $link,
                            "url"               => $url,
                            "size"              => round(($file_item['size'] / 1024) / 1024 , 2) . " Mb",
                            "download_count"    => $download
                        ));
                    }
                }
            }
        }
        
        return $items;
    }
    
    
    
    
    public function Get_type($type){
        switch ($type){
            case "folder":
                return 0;
            case "file":
                return 1;
            default :
                return -1;
        }
    
    }
    
    
    
    
}


