<?php
/**
 * 所有公用函数
 * common.php
 */
use \MLNPHP\MLNPHP;

/**
 * 调试函数，MLNPHP::debug的别名函数
 *
 * @return void
 */
function debug()
{
    $args = func_get_args();
    MLNPHP::debug($args);
}

/**
 * 转换HTML安全实体
 *
 * @param string $string to encode
 * 
 * @return string
 */
function h($string)
{
	return htmlspecialchars($string, ENT_QUOTES, 'utf-8');
}

/**
 * 使用<pre>标签包围字符输出
 *
 * @param mixed
 * 
 * @return string
 */
function dump()
{
	$string = '';
	foreach(func_get_args() as $value)
	{
		$string .= '<pre>' . h($value === NULL ? 'NULL' : (is_scalar($value) ? $value : print_r($value, TRUE))) . "</pre>\n";
	}
	return $string;
}

/**
 * 返回模型
 * 
 * @param string $modelName 模型名称
 * 
 * @return Model
 */
function model($modelName)
{
    $conf = MLNPHP::getApplication()->conf;
    call_user_func($conf->path->model . '\\' . $modelName . '::init');
    return $conf->path->model . '\\' . $modelName;
}