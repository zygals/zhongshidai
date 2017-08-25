//tab选项卡
(function($){
    $.fn.tabHoverDelay = function(conId, options){
        var defaults = {
			tabConId : conId,
			tabTitClass : 'active',
			tabConClass : 'tab_con',
            hoverDuring: 200,
            outDuring: 200,
            hoverEvent: function(){
                var index = $(this).index();
				$(this).addClass(defaults.tabTitClass).siblings().removeClass(defaults.tabTitClass);
				$(defaults.tabConId+' div.'+defaults.tabConClass).hide().eq(index).show();
            },
            outEvent: function(){
                $.noop();    
            }
        };
        var sets = $.extend(defaults,options || {});
		var it = this;
		var init = function(){
			$(this).first().addClass(sets.tabTitClass);
			$(sets.tabConId+' div.'+sets.tabConClass).first().show();
		};
		init.call(it);
        var hoverTimer, outTimer;
        return $(this).each(function(){
        	var that = this;
            $(this).hover(function(){
                clearTimeout(outTimer);
                hoverTimer = setTimeout(function () { if (typeof sets.hoverEvent == 'function') sets.hoverEvent.call(that) }, sets.hoverDuring);
            },function(){
                clearTimeout(hoverTimer);
                outTimer = setTimeout(function () { if (typeof sets.outEvent == 'function') sets.outEvent.call(that) }, sets.outDuring);
            });    
        });
    };
    $.fn.hoverSlide = function(boxId, options){
        var defaults = {
            titOnClass : 'active',
            conElement : 'div',
            conClass : 'con',
            hoverDuring : 200,
            outDuring : 200,
            hoverEvent : function(){
                var index = $(this).index();
                $(this).addClass(defaults.titOnClass).siblings().removeClass(defaults.titOnClass);
                $(this).next(defaults.conElement + '.' + defaults.conClass).slideDown('fast').siblings(defaults.conElement + '.' + defaults.conClass).slideUp('fast');
            },
            outEvent : function(){
                $.noop();
            }
        };
        var sets = $.extend(defaults, options || {});
        var it = this;
        var init = function(){
            $(this).first().addClass(sets.titOnClass);
            $(boxId + ' ' + defaults.conElement + '.' + defaults.conClass + ':first').show();
        }
        init.call(it);
        var hoverTimer, outTimer;
        return $(this).each(function(){
            var that = this;
            $(this).hover(function(){
                clearTimeout(outTimer);
                hoverTimer = setTimeout(function(){
                    if(typeof sets.hoverEvent == 'function'){
                        sets.hoverEvent.call(that);
                    }
                }, sets.hoverDuring);
            }, function(){
                clearTimeout(hoverTimer);
                outTimer = setTimeout(function(){
                    if(typeof sets.outEvent == 'function'){
                        sets.outEvent.call(that);
                    }
                }, sets.outDuring);
            });
        });
    }      

})(jQuery);

//上面是程序主体，可以根据需要进行扩展

//焦点图切换
(function($){

    $.bannerSwitch = function(options){
        var defaults = {
            boxId : '#box1',
            titId : '#tit1',
            conId : '#con1',
            titElement : 'li',
            conElement : 'li',
            titOnClass : 'active',
            conOnClass : 'div_con',
            auto : true,
            autoTime : 3500,
            hoverDuring : 200,
            outDuring : 200,
            button : true
        }
        var sets = $.extend(defaults, options || {});
        var outEvent = function(){
            $.noop();
        }
        var init = function(){
            $(sets.titId+' '+sets.titElement).removeClass(sets.titOnClass).first().addClass(sets.titOnClass);
            $(sets.conId+' '+sets.conElement+'.'+sets.conOnClass).hide().first().show();

        }
        init();
        var autoSwitch = function(){
            if(defaults.auto === true){
                var nowIndex = $(sets.titId+' '+sets.titElement+'.'+sets.titOnClass).index();
                nowIndex++;
                if(nowIndex >= $(sets.conId+' '+sets.conElement).length){ nowIndex = 0};
                $(sets.titId+' '+sets.titElement).removeClass(sets.titOnClass).eq(nowIndex).addClass(sets.titOnClass);
                $(sets.conId+' '+sets.conElement+'.'+sets.conOnClass).hide().eq(nowIndex).show();
            }
        }
        var hoverTimer, outTimer, autoTimer;

        $(sets.titId+' '+sets.titElement).hover(function(){
            var that = this;
            clearTimeout(outTimer);
            var hoverEvent = function(){
                var index = $(this).index();
                $(this).addClass(sets.titOnClass).siblings().removeClass(sets.titOnClass);
                $(sets.conId+' '+sets.conElement+'.'+sets.conOnClass).hide().eq(index).show();
            }
            hoverTimer = setTimeout(function(){
                hoverEvent.call(that);
            }, sets.hoverDuring);
        },function(){
            clearTimeout(hoverTimer);
            outTimer = setTimeout(outEvent, sets.outDuring);
        });
        if(sets.auto === true){
            $(sets.boxId).hover(function(){
                clearTimeout(autoTimer);
            },function(){
                autoTimer = setInterval(autoSwitch, sets.autoTime);
            }).trigger('mouseleave');
        }
        if(sets.button){
            var _next = $('<span class="button e_next"></span>');
            var _prev = $('<span class="button e_prev"></span>');
            $(sets.boxId).append(_next, _prev);
            _next.click(function(){
                var index = $(sets.titId+' '+sets.titElement+'.'+sets.titOnClass).index();
                var length = $(sets.titId+' '+sets.titElement).length;
                index++;
                if(index >= length){ index = 0};
                $(sets.titId+' '+sets.titElement).removeClass(sets.titOnClass).eq(index).addClass(sets.titOnClass);
                $(sets.conId+' '+sets.conElement+'.'+sets.conOnClass).hide().eq(index).show();
            });

            _prev.click(function(){
                var index = $(sets.titId+' '+sets.titElement+'.'+sets.titOnClass).index();
                var length = $(sets.titId+' '+sets.titElement).length;
                index--;
                if(index < 0){ index = length-1};
                $(sets.titId+' '+sets.titElement).removeClass(sets.titOnClass).eq(index).addClass(sets.titOnClass);
                $(sets.conId+' '+sets.conElement+'.'+sets.conOnClass).hide().eq(index).show();
            });
        }
    }

})(jQuery)

//手风琴效果



/***
*
*	by 332962963@qq.com
*	2016-05-19
*
*/