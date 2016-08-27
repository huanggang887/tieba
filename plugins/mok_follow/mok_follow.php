<?php
/*
Plugin Name: 不关注xx贴吧不给绑定
Version: 1.0
Plugin URL: http://www.longtings.com
Description: 禁止没有关注指定贴吧并达到x级的账号绑定
Author: mokeyjay
Author Email: longting@longtings.com
Author URL: http://www.longtings.com
For: V3.4+
*/
if (!defined('SYSTEM_ROOT')) {
    die('Insufficient Permissions');
}

function mok_follow_check()
{
    $head = array('User-Agent:Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.99 Safari/537.36', 'Cookie:BDUSS=' . $_GET['bduss']);
    $opt = unserialize(option::get('mok_follow'));
    foreach ($opt['mustTieba'] as $tb => $lv) {
        $c = new wcurl('http://tieba.baidu.com/mo/m?kw=' . urlencode($tb), $head);
        $t = $c->get();
        $c->close();
        if (textMiddle($t, '&#160;(等级', ')') < $lv) {
            msg($opt['error'][0]);
        }
    }
    if (count($opt['optionTieba']) > 0) {
        $check = false;
        foreach ($opt['optionTieba'] as $tb => $lv) {
            $c = new wcurl('http://tieba.baidu.com/mo/m?kw=' . urlencode($tb), $head);
            $t = $c->get();
            $c->close();
            if (textMiddle($t, '&#160;(等级', ')') >= $lv) {
                $check = true;
                break;
            }
        }
        if ($check == false) {
            msg($opt['error'][0]);
        }
    }
}

addAction('baiduid_set_2', 'mok_follow_check');
?>