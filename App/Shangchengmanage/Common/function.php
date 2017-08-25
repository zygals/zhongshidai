<?php
/**
 * Created by ZHSD VIDEO.
 * User: xp
 * Date: 2017/1/11 0011
 * Time: 下午 3:09
 */

function getCateName($cate_id){
    $mc=M('Helpcate')->where('id='.$cate_id)->find();
    return $mc['name'];
}