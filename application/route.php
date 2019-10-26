<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2018 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

return [
    '__pattern__' => [
        'name' => '\w+',
    ],
    '[hello]'     => [
        ':id'   => ['index/hello', ['method' => 'get'], ['id' => '\d+']],
        ':name' => ['index/hello', ['method' => 'post']],
    ],
    'index' => 'index/index',
    'Cloud'   => ['Cloud/index', ['method' => 'get|post']],
    'lst/:cataid'   => ['lst/index', ['method' => 'get|post'], ['cataid' => '\d+']],
    'tags/:tagid'   => ['tags/index', ['method' => 'get|post'], ['tagid' => '\d+']],
    'article/:imgid'   => ['article/index', ['method' => 'get|post'], ['imgid' => '\d+']],
    // '[videolst]'     => [
    //     ':cateid'   => ['videolst/videolst', ['method' => 'get|post'], ['cateid' => '\d{1}']],
    //     ':keyword' => ['videolst/videolst', ['method' => 'get|post'], ['keyword' => '/[\x7f-\xff]/']],
    //     ':time' => ['videolst/videolst', ['method' => 'get|post'], ['time' => '\d{0,4}']],
    // ],

];
