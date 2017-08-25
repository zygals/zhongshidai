/*--页面
$(function(){
$(".subNav").click(function(){
		$(this).toggleClass("currentDd").siblings(".subNav").removeClass("currentDd")
		$(this).toggleClass("currentDt").siblings(".subNav").removeClass("currentDt")
		// 修改数字控制速度， slideUp(500)控制卷起速度
		$(this).next(".navContent").slideToggle(500).siblings(".navContent").slideUp(500);
	})	
})
左边--*/

$(".poit").click(function(){
		var classname = $(this).attr('class');
		$(this).siblings("dl").toggle();
			if(classname == 'poit'){
				$(this).removeClass('poit').addClass('on');
				
				$(this).siblings().hide();
			}else{
				$(this).removeClass('on').addClass('poit');
				$(this).siblings().css('display','none');
				alert('ss');
			}

	});



/*--222--*/
$(".diji_three dl dd.dd_first").click(function(){
		var classname = $(this).attr('class');
		$(this).siblings("dl").toggle();
			if(classname == 'poit'){
				$(this).removeClass('poit').addClass('on');
			}else{
				$(this).removeClass('on').addClass('poit');
			}

	});