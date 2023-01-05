<?php
namespace YaoGuang;

class cache{

    const EH = 3600;

    const ERROR_NOT_FOUND = "缓存文件不存在.";

    public function __construct(){
        //检测是否存在缓存目录
        if(!file_exists("./cache/")){
            //创建缓存目录
            mkdir("./cache/");
        }
	}

    public function set_cache($cache_name , $cache_data , $cache_file = "data.json" , $cache_update_time = 120){
        if(!is_array($cache_data)){
            return "错误: 传入的数据必须是数组";
        }
        //检测是否存在缓存目录
        if(!file_exists("./cache/".$cache_name."/")){
            //创建缓存目录及默认文件
            mkdir("./cache/".$cache_name);
        }
        $cache_config = array("cache_name"=>$cache_name,"cache_update_time"=>$cache_update_time);
        $cache_data["cache_regtime"] = time();
        
        if ( file_put_contents("./cache/".$cache_name."/config.json",json_encode($cache_config,JSON_UNESCAPED_UNICODE)) == false
        || file_put_contents("./cache/$cache_name/$cache_file",json_encode($cache_data,JSON_UNESCAPED_UNICODE)) == false ){
            return false;
        }
        return $cache_data;
	}

    public function cache_static_get_data($cache_name , $cache_file = "data.json"){
        //检测是否存在缓存
        if(!file_exists("./cache/".$cache_name."/".$cache_file)){
            return cache::ERROR_NOT_FOUND;
        }
        $cache_data_json = file_get_contents("./cache/".$cache_name."/".$cache_file);
        $cache_data = json_decode($cache_data_json , true);
        return $cache_data;
	}

    public function cache_is_overtime($cache_name , $cache_file = "data.json"){
        //检测是否存在缓存
        if(!file_exists("./cache/".$cache_name."/".$cache_file)){
            return cache::ERROR_NOT_FOUND;
        }
        $cache_config = $this->cache_static_get_data($cache_name , "config.json");
        $cache_data = $this->cache_static_get_data($cache_name , $cache_file);

        $time = time();
        $dvalue = $time-$cache_data["cache_regtime"];
        if($dvalue > $cache_config["cache_update_time"]){
            return true;
        }
        return false;
	}
}
?>