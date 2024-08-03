<?php
    require_once "./src/class_cache.php";

    // 实例化缓存类
    $cache = new cache();
    
    // 缓存名
    $cache_name = "test";
    // 缓存数据
    $cache_data = array("name" => "xuanyuanyimo", "age" => 25);
    // 缓存文件名称
    $cache_file = "data.json";
    // 缓存过期时间
    $cache_update_time = 120;
    
    // 设置缓存
    $cache->set_cache($cache_name, $cache_data, $cache_file, $cache_update_time);
    
    // 获取缓存
    $get_cache_data = $cache->cache_static_get_data($cache_name, $cache_file);
    
    var_dump($get_cache_data);
