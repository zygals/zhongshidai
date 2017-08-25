
//焦点图切换
$(function(){
	$(".focusBox").slide({ titCell:".num li", mainCell:".pic",effect:"fold", autoPlay:true,trigger:"click",prevCell:".prev",nextCell:".next"});
	
	$(".scrollVideo").slide({ titCell:".list li", mainCell:".piclist", effect:"leftLoop",vis:5,scroll:2,delayTime:800,trigger:"click", pnLoop:true,autoPage:true,autoPlay:true});
	
	$(".scrollShangjia").slide({ titCell:".list li", mainCell:".shjlist", effect:"leftLoop",vis:5,scroll:2,delayTime:800,trigger:"click", pnLoop:true,autoPage:true,autoPlay:true});
})



$(document).ready(function() {
	$('.scerji_nav li:last,.syfl_li li:last').css('background','none');
	$('.sc_fenlili >li:last').css('border-bottom',0);
	
	$('.syfl_li li:first').addClass('active');
	$('.syfl_li li').hover(function(){
		$(this).addClass('active').siblings().removeClass('active');
		})
	$('.tab_list >li:nth-child(4n)').css('margin-right',0);
	$('.sc_subnavul dl:last').css('border-bottom',0);
	
	//全部商品下拉菜单
	$('.span_all').click(function(){
		$('.sc_subbox').slideToggle(500);	
	})
	
	//商品二级折叠菜单
	$('.sc_subbox li').hover(function(){
		var li_h=$(this).height();
		var i=$(this).index();
		$(this).addClass('on').siblings().removeClass('on');
		$(this).find('.sc_subnavul').show().css('top',-li_h*i);
	},function(){
		$('.sc_subnavul').hide();
		$('.sc_subbox li').removeClass('on');
	})

	//鼠标点击背景停留
	var tabs=function(tab_tit,tab_con){
		$(tab_con).find('.tab_cont').first().show();
		$(tab_tit).find('li').first().addClass('active').end().bind('click',function(){
			var index_active=$(tab_tit).find('li').index(this);
				$(this).addClass('active').siblings().removeClass('active')
				$(tab_con).find('.tab_cont').eq(index_active).show().siblings().hide();
			})
		};
		
		//调用
		tabs('#tab_1');
		tabs('#tab_2');
		tabs('#tab_3');
	
	//鼠标经过文字显示隐藏	
	$(".xpsj_list >li").hover(function() {
			var oheight = $(this).find('p').height();
			$(this).find('p').css({'height':0}).show().animate({'height':oheight},300);
    },function(){
			$(this).find('p').hide().fadeOut(500);
	});
	
	//图片列表切换调用	
	$('.function_class').DB_gallery({
		thumWidth:30,            
		thumGap:6,                
		thumMoveStep:1,           
		moveSpeed:300,            
		fadeSpeed:500            
	});
	$('.function_class_big').DB_gallery({
		thumWidth:50,            
		thumGap:8,                
		thumMoveStep:1,           
		moveSpeed:300,            
		fadeSpeed:500            
	});

});

//点击更多显示全部
$(function(){
	var qiehuan=function(fl_cen,fl_more){
	var more_a=$(fl_cen).find('li:gt(8)');
	more_a.hide();
	$(fl_more).click(function(){
		if(more_a.is(':visible')){
			$(this).html('更多');
			more_a.slideUp(500);
			$(this).removeClass('down_ico');
			}
			else{
			$(this).html('收起')	
			more_a.slideDown(500);
			$(this).addClass('down_ico');
			}
		})
	}
	
	//调用
	qiehuan('#fl_cen1','#fl_more1');
	qiehuan('#fl_cen2','#fl_more2');
	qiehuan('#fl_cen3','#fl_more3');
	qiehuan('#fl_cen4','#fl_more4');
	
	})

//筛选条件下拉选项	
$(function(){
		$('#xiala1').addClass('active')
		var diaoyong=function(xiala,synl_li){
		$(xiala).click(function(){
			$(this).addClass('active on').siblings().removeClass('active on');
			$(synl_li).slideToggle(500);
			})
		}
		
		//调用
		diaoyong('#xiala1','#synl_li1');
		diaoyong('#xiala2','#synl_li2');
		diaoyong('#xiala3','#synl_li3');
		diaoyong('#xiala4','#synl_li4');
		diaoyong('#xiala5','#synl_li5');
		
		$('#xiala1').click(function(){$('#synl_li2,#synl_li3,#synl_li4,#synl_li5').hide();});
		$('#xiala2').click(function(){$('#synl_li1,#synl_li3,#synl_li4,#synl_li5').hide();});
		$('#xiala3').click(function(){$('#synl_li2,#synl_li1,#synl_li4,#synl_li5').hide();});
		$('#xiala4').click(function(){$('#synl_li2,#synl_li3,#synl_li1,#synl_li5').hide();});
		$('#xiala5').click(function(){$('#synl_li2,#synl_li3,#synl_li4,#synl_li1').hide();});
	})	

//分数页码切换
$(function(){
var rnum=$(".mkeUl >ul >li").size();
var cnum=0;
$(".mke_ns2").html(rnum);
$(".mkeUl >ul").width(rnum*918);
$(".mkeRbtn").click(function(){
	cnum++;
	if(cnum>(rnum-1)){
	cnum=0	
	}
	$(".mkeUl >ul").animate({"left":-cnum*918},300);
	$(".mke_ns1").html(cnum+1);
});
$(".mkeLbtn").click(function(){
	cnum--;
	if(cnum<0){
	cnum=rnum-1;	
	}
	$(".mkeUl >ul").animate({"left":-cnum*918},300);
	$(".mke_ns1").html(cnum+1);
});

//自动播放
/*function autoPlay(){
  	cnum++;
	if(cnum>(rnum-1)){
	cnum=0	
	}
	$(".mkeUl >ul").animate({"left":-cnum*918},300);
	$(".mke_ns1").html(cnum+1);
}
var Timer=setInterval(autoPlay,4000);
$(".mkeFocus").hover(function(){clearInterval(Timer)},function(){Timer=setInterval(autoPlay,4000);});
*/
})
	
//返回顶部
$(function(){
	function showScroll(){
	$(window).scroll( function() { 
	var scrollValue=$(window).scrollTop();
	if(scrollValue>300){
	$('.return_top').fadeIn()
	}
	else{
	$('.return_top').fadeOut();
	}
	} );	
	$('.return_top').click(function(){
	$("html,body").animate({scrollTop:0},1000);	
	});	
	}
	showScroll();
})	
	
$(function(){
	$('#next_id').click(function(){
		var j=$('.num_start').text();
		var i=parseInt(j);
		if(j>1){i=i-1;}
		$(".num_start").text(i);
	})
})	
	
//点击按钮分数数字切换	
$(function(){
	$('#next_id').click(function(){
		var j=$('.num_start').text();
		var i=parseInt(j);
		var m=$('.num_last').text();
		var n=parseInt(m);
		if(j<n){i=i+1};
			$(".num_start").text(i);
		 if (j==n){i=1};
			$(".num_start").text(i);
	});
	
	$('#prev_id').click(function(){
		var j=$(".num_start").text();
		var i= parseInt(j);
		var m=$('.num_last').text();
		var n=parseInt(m);
		if(j>1){i=i-1;}
			$(".num_start").text(i);
		if (j==1){i=m};
			$(".num_start").text(i);
	})
})	
	
	jQuery(document).ready(function(){
	jQuery('#select_btna li:first')
	if (jQuery('#zSlidera').length) {
		zSlider();
		jQuery('#h_sns').find('img').hover(function(){
			jQuery(this).fadeTo(200,0.5);
		}, function(){
			jQuery(this).fadeTo(100,1);
		});
	}
	function zSlider(ID, delay){
		var ID=ID?ID:'#zSlidera';
		var delay=delay?delay:5000;
		var currentEQ=0, picnum=jQuery('#picshow_imga li').size(), autoScrollFUN;
		jQuery('#select_btna li').eq(currentEQ).addClass('current');
		jQuery('#picshow_imga li').eq(currentEQ).show();
		jQuery('#picshow_txa li').eq(currentEQ).show();
		autoScrollFUN=setTimeout(autoScroll, delay);
		function autoScroll(){
			clearTimeout(autoScrollFUN);
			currentEQ++;
			if (currentEQ>picnum-1) currentEQ=0;
			jQuery('#select_btna li').removeClass('current');
			jQuery('#picshow_imga li').hide();
			jQuery('#picshow_txa li').hide().eq(currentEQ).slideDown(400);
			jQuery('#select_btna li').eq(currentEQ).addClass('current');
			jQuery('#picshow_imga li').eq(currentEQ).show();
			autoScrollFUN = setTimeout(autoScroll, delay);
		}
		jQuery('#picshowa').hover(function(){
			clearTimeout(autoScrollFUN);
		}, function(){
			autoScrollFUN = setTimeout(autoScroll, delay);
		});
		jQuery('#select_btna li').hover(function(){
			var picEQ=jQuery('#select_btna li').index(jQuery(this));
			if (picEQ==currentEQ) return false;
			currentEQ = picEQ;
			jQuery('#select_btna li').removeClass('current');
			jQuery('#picshow_imga li').hide();
			jQuery('#picshow_txa li').hide().eq(currentEQ).slideDown(100);
			jQuery('#select_btna li').eq(currentEQ).addClass('current');
			jQuery('#picshow_imga li').eq(currentEQ).show();
			return false;
		});
	};
	
	
}) 

	
	
	
	