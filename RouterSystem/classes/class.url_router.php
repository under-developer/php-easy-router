<?php

class urlRouter{
    /** Path list */
    public $urlList = [];

    /** Web Adress */
    public $URL;
    
    /** Path names */
    public $QueryLink;
    public $SplitedQuery;
    public $getLink;

    /** Paths dont have a null values */
    public $SplitedQueryFiltered;


    /** Actucal */
    public $ActucalPath;
    public $ActucalURL;

    /** Actucal for dont have null values */
    public $ActucalPathFiltered;
    public $ActucalURLFiltered;

    /** The page the user sees */
    public $currnectPath;

    /** Extra : Web Language */
    public $webLang = "en";

    /** Extra : CSS and Javascript files that will always stay within the site */
    public $webCSS = [];
    public $webJS = [];


    public function __construct(){
        
        $this->QueryLink = $_SERVER["QUERY_STRING"];
        $this->SplitedQuery = explode("/",$this->QueryLink);
        $this->SplitedQueryFiltered = $this->SplitedQuery;

        $this->ActucalPath = str_replace($this->QueryLink,"",$_SERVER["REQUEST_URI"]);
    

        /** Delete null values */
        for ($i=0; $i < count($this->SplitedQueryFiltered); $i++) { 
            if(empty($this->SplitedQueryFiltered[$i])){
                unset($this->SplitedQueryFiltered[$i]);
            }
        }

        if(!empty($this->ActucalPath)){
            $tempActucalPath = explode("/",$this->ActucalPath);
           
            for ($i=0; $i < count($tempActucalPath); $i++) { 
                if(empty($tempActucalPath[$i])){
                    unset($tempActucalPath[$i]);
                }else{
                    $this->ActucalPathFiltered .= $tempActucalPath[$i]."/";
                }
            }
            unset($tempActucalPath);
        }

        $this->URL = $_SERVER["REQUEST_SCHEME"]."://".$_SERVER["HTTP_HOST"];
        $this->ActucalURL = $this->URL.$this->ActucalPath;
        $this->ActucalURLFiltered = $this->URL."/".$this->ActucalPathFiltered;
    }


    public function startRouter(){

        $this->getLink = $this->QueryLink;

        $tempData = @$this->urlList[$this->SplitedQueryFiltered[0]];
        
        if($tempData != null){
            $testCount = count($this->SplitedQueryFiltered) > $tempData["settings"]["path_count"];
             
            if($tempData["settings"]["path_count"] > 1 && !$testCount){
                $this->getLink = $this->SplitedQueryFiltered[0];
            }
            unset($testCount);

        }

        if(empty($this->urlList[$this->getLink])){
            return false;
        }else{
            $callBackFunc = $this->urlList[$this->getLink]["settings"]["callBackFunc"];
            if(!empty($callBackFunc)){
                is_string($callBackFunc) == true && is_callable($callBackFunc) ? call_user_func($callBackFunc) : $callBackFunc();; 
            }
            return true;
        }
    }
  
 
    
    /** Add a new url */
    public function add_url($url_name,$title,$path_count,$path_val_req = false,$meta_keys,$css = [],$js = [],$callBackFunc = ""){
        
        if(!is_array($meta_keys)){
            throw new Exception("URL Meta keys just be an array");
        }else if(!is_int($path_count)){
            throw new Exception("URL Path just be an Integer");
        }else if(!is_array($css)){
            throw new Exception("Css list just be an array");
        }else if(!is_array($js)){
            throw new Exception("Js list just be an array");
        }else{
            $tempURLData = [
                $url_name => [
                    "settings" => [
                        "path_count" => $path_count,
                        "path_val_req" => $path_val_req,
                        "callBackFunc" => $callBackFunc
                    ],
                    "html" => [
                        "meta_keys" => $meta_keys,
                        "title" => $title,
                        "css" => $css,
                        "js" => $js
                    ]
                ]
            ];
            
            
            $this->urlList += $tempURLData;
            unset($tempURLData);
            return true;
        }
    }

    /**
    *Usage @add_urlFromArray();
    *$array = [
    *   "url_name" => [
    *       "path_count" => 1,
    *       "path_val_req" => true, // if true it need a the value to start
    *       "meta_keys" => ["key" => "value"],
    *       "title" => "Web title",
    *       "css" => ["css1.css","css2.css"],
    *       "js" => ["js1.js","js2.js"]
    *   ]
    *]
    */
    public function add_urlFromArray($array){
        foreach ($array as $url_name => $get_url_settings) {
            $this->add_url(
                $url_name,$get_url_settings["title"],$get_url_settings["path_count"],
                $get_url_settings["path_val_req"],$get_url_settings["meta_keys"],$get_url_settings["css"],$get_url_settings["js"],
                $get_url_settings["callBackFunc"]
            );
        }
         
    }

    public function getValueFromSQL($mysqli_server,$query,$colmn){
        return mysqli_fetch_assoc(mysqli_query($mysqli_server,$query))[$colmn];
    }

    public function getPathValue($path_no){
        if(empty($this->SplitedQuery[$path_no])){
            return false;
        }
        return $this->SplitedQuery[$path_no];
    }

    public function getPathValueActucly($path_no){
        if(empty($this->SplitedQueryFiltered[$path_no])){
            return false;
        }
        return $this->SplitedQueryFiltered[$path_no];
    }

    public function extractLinkHTMLValue($value){
        return $this->urlList[ $this->getLink ]["html"][$value];
    }


}