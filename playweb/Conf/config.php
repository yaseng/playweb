<?php
$arr_config= array(
	'URL_MODEL'=>0,
    'URL_HTML_SUFFIX'=>'',

   'TMPL_PARSE_STRING'  =>array(
    '__STATIC__'=>__ROOT__.'/PlayWeb/Static',
    '__JS__'=>__ROOT__.'/PlayWeb/Static/js',
    '__CSS__'=>__ROOT__.'/PlayWeb/Static/css',
    '__IMAGE__'=>__ROOT__.'/PlayWeb/Static/image',
    '__EDITOR__'=>__ROOT__.'/PlayWeb/Static/kindeditor'
   ),
   
     'DB_TYPE'   => 'mysql', // 数据库类型
        'DB_HOST'   => 'localhost', // 服务器地址
        'DB_NAME'   => 'playweb', // 数据库名
        'DB_USER'   => 'root', // 用户名
        'DB_PWD'    => '', // 密码
        'DB_PORT'   => 3306, // 端口
        'DB_PREFIX' => 'pb_', // 数据库表前缀 
   
   'URL_CASE_INSENSITIVE'=>true,  //  url不区分大小写
   'COOKIE_PREFIX'		=>	'cv_', //cookie 前缀
   'LOG_RECORD' => true, // 开启日志记录
'LOG_LEVEL'  =>'EMERG,ALERT,CRIT,ERR,SQL', // 只记录EMERG ALERT CRIT ERR 错误
);
 
return  $arr_config;