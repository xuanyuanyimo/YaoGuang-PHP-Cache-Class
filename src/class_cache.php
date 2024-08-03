<?php

/**
 * 缓存类
 * @author xuanyuanyimo
 */
class cache
{

    const EH = 3600;

    const CACHE_DIR = "./cache/";

    public function __construct()
    {
        //检测是否存在缓存目录
        if (!file_exists($this::CACHE_DIR)) {
            //创建缓存目录
            mkdir($this::CACHE_DIR);
        }
    }

    /**
     * 设置缓存
     * @author xuanyuanyimo
     * @param string $cache_name 缓存名称
     * @param array $cache_data 缓存数据
     * @param string $cache_file 缓存文件名称
     * @param int $cache_update_time 缓存更新时间
     * @return array|bool
     * @throws Exception
     */
    public function set_cache($cache_name, $cache_data, $cache_file = "data.json", $cache_update_time = 120)
    {

        if (!is_array($cache_data)) {
            throw new Exception("ERROR: The cache data must be an array.");
        }

        //检测是否存在缓存目录
        if (!file_exists($this::CACHE_DIR . $cache_name . "/")) {
            //创建缓存目录及默认文件
            mkdir($this::CACHE_DIR . $cache_name);
        }
        // 创建缓存数据
        $cache_config = array("cache_name" => $cache_name, "cache_update_time" => $cache_update_time);
        $cache_data["cache_regtime"] = time();

        // 写入缓存文件
        if (
            file_put_contents($this::CACHE_DIR . $cache_name . "/config.json", json_encode($cache_config, JSON_UNESCAPED_UNICODE)) == false
            || file_put_contents($this::CACHE_DIR . "$cache_name/$cache_file", json_encode($cache_data, JSON_UNESCAPED_UNICODE)) == false
        ) {
            throw new Exception("ERROR: Failed to write cache file.");
            return false;
        }
        return $cache_data;
    }

    /**
     * 获取缓存
     * @author xuanyuanyimo
     * @param string $cache_name 缓存名称
     * @param string $cache_file 缓存文件名称
     * @return array|bool
     */
    public function cache_static_get_data($cache_name, $cache_file = "data.json")
    {

        //检测是否存在缓存
        if (!file_exists($this::CACHE_DIR . $cache_name . "/" . $cache_file)) {
            return false;
        }

        // 读取缓存文件
        $cache_data_json = file_get_contents($this::CACHE_DIR . $cache_name . "/" . $cache_file);
        $cache_data = json_decode($cache_data_json, true);

        if ($cache_data === null) return false;
        return $cache_data;
    }

    /**
     * 检测缓存是否过期
     * @author xuanyuanyimo
     * @param string $cache_name 缓存名称
     * @param string $cache_file 缓存文件名称
     * @return bool
     */
    public function cache_is_overtime($cache_name, $cache_file = "data.json")
    {
        //检测是否存在缓存
        if (!file_exists($this::CACHE_DIR . $cache_name . "/" . $cache_file)) {
            return false;
        }
        $cache_config = $this->cache_static_get_data($cache_name, "config.json");
        $cache_data = $this->cache_static_get_data($cache_name, $cache_file);

        $time = time();
        $dvalue = $time - $cache_data["cache_regtime"];
        if ($dvalue > $cache_config["cache_update_time"]) {
            return true;
        }
        return false;
    }
}
