
//从下面开始是调用方法

$(function(){
	//tab选项卡插件1调用
	$('#tab_tit1 li').tabHoverDelay('#tab_con1');
    $('#tab_tit2 li').tabHoverDelay('#tab_con2');
    $('#tab_tit3 li').tabHoverDelay('#tab_con3');
    $('#tab_tit4 li').tabHoverDelay('#tab_con4');
    $('#tab_tit5 li').tabHoverDelay('#tab_con5');
    $('#tab_tit6 li').tabHoverDelay('#tab_con6');
    $('#tab_tit7 li').tabHoverDelay('#tab_con7');
    $('#tab_tit8 li').tabHoverDelay('#tab_con8');
    $('#tab_tit9 li').tabHoverDelay('#tab_con9');
    $('#tab_tit10 li').tabHoverDelay('#tab_con10');
    $('#tab_tit11 li').tabHoverDelay('#tab_con11');
	$('#tab_tit12 li').tabHoverDelay('#tab_con12');
	//另一种可设置参数的调用方法
//	$('#tab_tit1 li').tabHoverDelay('#tab_con1',{
//		tabTitClass : 'current',	//标题容器的class，熟悉吧
//		tabConClass : 'allic'		//内容容器的class
//	});

    //手风琴效果调用
    $('#slide_box h3').hoverSlide('#slide_box');    //参数为默认参数，即DEMO中的标签和CLASS

    //或者带参数的方法
    $('#slide_box2 dt').hoverSlide('#slide_box2', {
        titOnClass : 'on',
        conElement : 'dd',
        conClass : 'content'
    });

})

//焦点图
$(function(){
    //调用
    $.bannerSwitch({
            boxId : '#box1',            //容器的ID
            titId : '#tit1',            //控制按钮的容器ID
            conId : '#con1',            //切换内容的容器ID
            titElement : 'li',          //控制按钮容器内的HTML元素，默认为li
            conElement : 'li',          //切换内容容器内的HTML元素，默认为li
            titOnClass : 'active',      //控制按钮的class，用来表示ON状态，默认为active
            conOnClass : 'div_con',     //切换内容的class，默认为div_con
            auto : true,                //是否自动切换，true和false，默认为true
            autoTime : 3500,            //自动切换的间隔时间
            hoverDuring : 200,          //鼠标移入延迟时间
            outDuring : 200,             //鼠标移出的延迟时间
            button : true               //是否显示前进后退按钮
    });

    //调用示例2
    $.bannerSwitch({
            boxId : '#box2',            //容器的ID
            titId : '#tit2',            //控制按钮的容器ID
            conId : '#con2',            //切换内容的容器ID
            titElement : 'dd',          //控制按钮容器内的HTML元素，默认为li
            conElement : 'div',         //切换内容容器内的HTML元素，默认为li
            titOnClass : 'on',      //控制按钮的class，用来表示ON状态，默认为active
            conOnClass : 'con',     //切换内容的class，默认为div_con
            auto : true,                //是否自动切换，true和false，默认为true
            autoTime : 3500,            //自动切换的间隔时间
            hoverDuring : 200,          //鼠标移入延迟时间
            outDuring : 200,             //鼠标移出的延迟时间
            button : false
    });

    //
})


