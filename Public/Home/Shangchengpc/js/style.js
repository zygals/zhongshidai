$(function(){
	//头部关闭
	$(".advice>p").click(function(){
    	$(".header_adv").fadeOut(3000);
	});
	//今日推荐
	$("#count1").dayuwscroll({
		parent_ele:'#wrapBox1',
		list_btn:'#tabT04',
		pre_btn:'#left1',
		next_btn:'#right1',
		path: 'left',
		auto:true,
		time:3000,
		num:5,
		gd_num:5,
		waite_time:1000
	});
	//
	//
})

