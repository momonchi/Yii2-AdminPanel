<?php
namespace backend\models\admin;  

use Yii;

class AdminPageAccess{

    public $access_pages = array();
    public $role_accesses = array();

    function __construct( array $access_pages, $role_accesses){
        $this->access_pages = $access_pages;
        $this->role_accesses = $role_accesses;
    }

    public function isChecked ($pageno_needle)
    {
        $return_flag = false;
        foreach($this->role_accesses as $pageno){
                if ($pageno == $pageno_needle){
                    return true;
                }
        }
        return $return_flag;
    }

    public function ifHasAccess($module, $page_url)
    {
        $access_pages = Yii::$app->params["access_pages"];
        $access_pages = $access_pages[$module];
        //get the page no
        $page_no = null;
        
        foreach ($access_pages as $key => $page){
                foreach($page as $page_inner){
                    if ($page_inner[1] == $page_url){
                        $page_no = $page_inner[0];
                    }    
                }
                
        }

        //check if has access
        $return_status = false;
        $session = Yii::$app->session;
        $page_permissions = $session->get('page_permissions');
        if ($page_permissions == "*"){
            $return_status = true;
        }else{
            if($page_permissions == NULL){
                Yii::$app->user->logout();   
                return Yii::$app->getResponse()->redirect(Yii::$app->getHomeUrl()); 
            }else{
                 foreach ($page_permissions as $permitted_pages){
                     if ($permitted_pages == $page_no){
                        $return_status = true;
                        return $return_status;
                    } 
                 }  
            } 
        }     
        return $return_status;
    }
    
    

}
