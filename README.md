# YaoGuang-PHP-Cache-Class
## 摇光PHP缓存类

***

## 这是一个简单的PHP缓存类 

**引用 `./src/calss_cache.php` 文件后，请实例化命名空间中的 `cache()` 类后再进行操作。**

**使用以下类方法设置缓存，缓存数据请使用数组存储，建议使用索引数组。**

```php
/**
 * 设置缓存
 * @param string $cache_name 缓存名称
 * @param array $cache_data 缓存数据
 * @param string $cache_file 缓存文件名称
 * @param int $cache_update_time 缓存更新时间
 * @return array|bool
 * @throws Exception
*/
    public function set_cache($cache_name , $cache_data , $cache_file = "data.json" , $cache_update_time = 120)
```

**使用以下类方法静态获取缓存，缓存数据包括缓存设置时间将会以数组形式返回，且在获取后不会刷新缓存注册时间。**

```php
/**
 * 获取缓存
 * @param string $cache_name 缓存名称
 * @param string $cache_file 缓存文件名称
 * @return array|bool
*/
    public function cache_static_get_data($cache_name , $cache_file = "data.json")
```

**使用以下类方法查询缓存是否超时，超时返回true，未超时返回false。**
```php
/**
 * 检测缓存是否过期
 * @param string $cache_name 缓存名称
 * @param string $cache_file 缓存文件名称
 * @return bool
*/
    public function cache_is_overtime($cache_name, $cache_file = "data.json")
```

**注意：缓存文件名参数若是不写的话，会自动使用data.json文件作为缓存。**
