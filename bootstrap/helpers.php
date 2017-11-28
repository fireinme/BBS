<?php
//路由名称改为视图名
function route_class()
{
    return str_replace('.', '-', Route::currentRouteName());
}

