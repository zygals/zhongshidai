// JavaScript Document


$(function(){
		$(".mid .xxk ul li:eq(0)").click(function(){
		$(".zhongjiye_right h1,#list2,#list3").show();
		})
		
	$(".mid .xxk ul li:eq(1)").click(function(){
		$(".zhongjiye_right h1,#list2,#list3").hide();
		})
	$(".mid .xxk ul li:eq(1)").click(function(){
		$(".zhongjiye_right h1,#list2,#list3").hide();
		})
	$(".mid .xxk ul li:eq(2)").click(function(){
		$(".zhongjiye_right h1,#list2,#list3").hide();
		})
	$(".mid .xxk ul li:eq(2)").click(function(){
		$(".zhongjiye_right h1,#list2,#list3").hide();
		})	
		
	$(window).scroll(function(){
		
		if($(this).scrollTop()>1030){
			$(".list_a0").addClass("tofix");
			$(".zhongjiye_right").addClass("tofixs");
			}else{
			$(".list_a0").removeClass("tofix");	
			$(".zhongjiye_right").removeClass("tofixs");	
				}
			
	})	
	

	
})
//返回顶部
$(function(){
	showScroll();
	function showScroll(){
	$(window).scroll( function() { 
	var scrollValue=$(window).scrollTop();
	if(scrollValue>300){
	$('.dibu').fadeIn()
	}
	else{
	$('.dibu').fadeOut();
	}
	} );	
	$('.dibu').click(function(){
	$("html,body").animate({scrollTop:0},1000);	
	});	
	}
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

$(function(){
	$('.zhongjiye_ps .zhongjiye_kdmy .pt').click(function(){
	  if($('.zhongjiye_ps .zhongjiye_kdmy  ul').css('display')=='none'){
		  $('.zhongjiye_ps .zhongjiye_kdmy ul').slideDown(500);
		  $(this).addClass("zhongjiye_ack");
		
		  $('.zhongjiye_ps .zhongjiye_kdmy  ul li').click(function(){
			  $('.zhongjiye_ps .zhongjiye_kdmy .pt').text($(this).text());
			  $('#hiddeninput').val($(this).text());
			  $('.zhongjiye_ps .zhongjiye_kdmy  ul').hide();
			  })
		  }
		  else{
		  $('.zhongjiye_ps .zhongjiye_kdmy  ul').slideUp(500);
		  $(this).removeClass("zhongjiye_ack");
			  }
	  })
	})
	
	$(function(){
				$("span.down").click(function(){
					$(".demo").show();
					$("span.down").hide();
					$("span.up").show();
					})
				
				$('#birthprovince, #birthcity, #birtharea').on('change', function(){
	                var a=$("#birthprovince option:selected").val();
					var b=$("#birthcity option:selected").val();
					var c=$("#birtharea option:selected").val();
					$("#btn").val(a+b+c);
				})
				$("span.up").click(function(){
					$(".demo").hide();
					$("span.down").show();
					$("span.up").hide();
					})
				
			})
	$(function(){ 
   $(".zhongjiye_plus").click(function(){ 
     var t=$(this).parent().find('input[class*=zhongjiye_xts]'); 
     t.val(parseInt(t.val())+1) 
	 
     setTotal(); 
   }) 
   $(".zhongjiye_mouse").click(function(){ 
     var t=$(this).parent().find('input[class*=zhongjiye_xts]'); 
     t.val(parseInt(t.val())-1) 
     if(parseInt(t.val())<1){ 
       t.val(1); 
     } 
     setTotal(); 
   }) 
 }) 
 
 
 $(function(){
	//tab选项卡
	$.DOTA = function(tit,con){
		$(con).find(".tab_con").hide().end().find(".tab_con:first").show();
		$(tit).find("li:first").addClass("active").end().find('li').bind('click',function(){
			var activeindex = $(tit).find("li").index(this);
			$(this).addClass("active").siblings("li").removeAttr("class");
			$(con).children().eq(activeindex).show().siblings().hide();
		});
	};
	//调用
	$.DOTA('#tab_tit_a1','#tab_con_a1');

	
})

function s2(num,n){
	 for(var i=1;i<n;i++){
		 if(num==i){
			 document.getElementById("c_s_"+i).className="curse";
			 }else{
			 	document.getElementById("c_s_"+i).className="cursb";
				 }
		 }
	 }

function s3(num,n){
	 for(var i=1;i<n;i++){
		 if(num==i){
			 document.getElementById("c_m_"+i).className="crbs";
			 }else{
			 	document.getElementById("c_m_"+i).className="crb";
				 }
		 }
	 }
  
