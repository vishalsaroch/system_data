

$(function(){
		$('.mob_icon').click(function(){
		$('.menu ul').slideToggle(200);
		
	
	});
		$('.home_form .txt1').click(function(){
		$('.slide_toggle').slideToggle(200);
	});
		$('.count').each(function () {
    $(this).prop('Counter',0).animate({
        Counter: $(this).text()
    }, {
        duration: 20000,
        easing: 'swing',
        step: function (now) {
            $(this).text(Math.ceil(now));
        }
    });
});

	
	});
	
	
	
jQuery(function($){
				
var windowWidth = $(window).width();

$(window).resize(function() {
    if(windowWidth != $(window).width()){
    location.reload();
    return;
    }
});


});


	
	$(window).scroll(function() {
	
	var $win = $(window);
	var winH = $win.height();

	if ($(this).scrollTop()>winH)
	{
		$('.menu').addClass('fixed');
	}
	else{
		$('.menu').removeClass('fixed');
	}

});
	
	$(function(){
			   if ($(window).width()>550 )
{	
			$width = $('.home_form').width();	
			$(".home_banner").width($(window).width() - $width);
		
}
	});	
	$(function(){
	$('.box_btm').each(function(){
if ($('ul li',this).size() <= 3) {
    $('.more',this).hide();
}
		$('ul li:gt(5)',this).hide();
		
		$('.more',this).click(function(){
								   
			if ($(this).html() == '+ View Full Features') {	
			$(this).hide();
			$(this).parent().parent().find('ul li:gt(5)').slideDown();
			
			}
			else {
				$(this).text('+ View Full Features');
				$(this).parent().parent().find('ul li:gt(5)').slideUp();
				 
				}
			
		});
		
	});
 });	
	$(document).ready(function() {

      var owl = $("#portfolio");

      owl.owlCarousel({

       
        
        itemsCustom : [
          [0, 1]
    
        ],
        navigation : true

      });
	  var owl = $("#testomonials");

      owl.owlCarousel({

       
        
        itemsCustom : [
          [0, 1]
    
        ],
        navigation : true

      });
	  
	  var owl = $("#packages");

      owl.owlCarousel({

       
        
        itemsCustom : [
          [0, 1],
		  [400, 2],
		  [700, 3],
		  [850, 4],
		  [1050, 5]
		  
    
        ],
        navigation : true

      });
	  
	  
	  var owl = $("#services");

      owl.owlCarousel({

       
        
        itemsCustom : [
          [0, 1],
		  
		  [550, 2],
		  [900, 3]
		  
    
        ],
        navigation : true

      });
	  
	  });
	  
	$(function(){ 
$('a').click(function(){
	
  	 $('html, body').animate({
        scrollTop: $( $(this).attr('href') ).offset().top
    }, 500);
	return false;
});
})
	
  $(document).ready(function() {
		if ($(window).width()>900 )
{					 
  function setHeight() {
    windowHeight = $(window).innerHeight();
    $('.home_slide1, .home_form, .home_banner, .slide, .royalSlider').css('min-height', windowHeight);
  };
  setHeight();
  
  $(window).resize(function() {
    setHeight();
  });
}
});
 
	
	jQuery(document).ready(function($) {
  jQuery('#full-width-slider').royalSlider({
    arrowsNav: true,
    loop: true,
    keyboardNavEnabled: true,
    controlsInside: false,
    imageScaleMode: 'fill',
    arrowsNavAutoHide: false,
    autoScaleSlider: true, 
    autoScaleSliderWidth: 960,     
    autoScaleSliderHeight: 350,
    controlNavigation: 'bullets',
    thumbsFitInViewport: false,
    navigateByClick: false,
    startSlideId: 0,
   
    transitionType:'fade',
    globalCaption: false,
    deeplinking: {
      enabled: true,
      change: false
    },
    
    imgWidth: 1400,
    imgHeight: 1280
  });
 });
	$(document).ready(function() {
	
	
			$('.fancybox').fancybox();
			
			$('.fancybox-media')
				.attr('rel', 'media-gallery')
				.fancybox({
					openEffect : 'none',
					closeEffect : 'none',
					prevEffect : 'none',
					nextEffect : 'none',

					arrows : false,
					helpers : {
						media : {},
						buttons : {}
					}
				});

		
		});
		
	
	
	
(function() {
                var link_element = document.createElement("link"),
                    s = document.getElementsByTagName("script")[0];
                if (window.location.protocol !== "http:" && window.location.protocol !== "https:") {
                    link_element.href = "http:";
                }
                link_element.href += "//fonts.googleapis.com/css?family=Open+Sans:300italic,300,400italic,400,600italic,600,700italic,700,800italic,800";
                link_element.rel = "stylesheet";
                link_element.type = "text/css";
                s.parentNode.insertBefore(link_element, s);
            })();
			
			
			//plugin definition
(function($){
    $.fn.extend({

    //pass the options variable to the function
    accordion: function(options) {
        
		var defaults = {
			accordion: 'true',
			speed: 300,
			closedSign: '[+]',
			openedSign: '[-]'
		};

		// Extend our default options with those provided.
		var opts = $.extend(defaults, options);
		//Assign current element to variable, in this case is UL element
 		var $this = $(this);
 		
 		//add a mark [+] to a multilevel menu
 		$this.find("li").each(function() {
 			if($(this).find("ul").size() != 0){
 				//add the multilevel sign next to the link
 				$(this).find("a:first").append("<span>"+ opts.closedSign +"</span>");
 				
 				//avoid jumping to the top of the page when the href is an #
 				if($(this).find("a:first").attr('href') == "#"){
 		  			$(this).find("a:first").click(function(){return false;});
 		  		}
 			}
 		});

 		//open active level
 		$this.find("li.active").each(function() {
 			$(this).parents("ul").slideDown(opts.speed);
 			$(this).parents("ul").parent("li").find("span:first").html(opts.openedSign);
 		});

  		$this.find("li a").click(function() {
  			if($(this).parent().find("ul").size() != 0){
  				if(opts.accordion){
  					//Do nothing when the list is open
  					if(!$(this).parent().find("ul").is(':visible')){
  						parents = $(this).parent().parents("ul");
  						visible = $this.find("ul:visible");
  						visible.each(function(visibleIndex){
  							var close = true;
  							parents.each(function(parentIndex){
  								if(parents[parentIndex] == visible[visibleIndex]){
  									close = false;
  									return false;
  								}
  							});
  							if(close){
  								if($(this).parent().find("ul") != visible[visibleIndex]){
  									$(visible[visibleIndex]).slideUp(opts.speed, function(){
  										$(this).parent("li").find("span:first").html(opts.closedSign);
  									});
  									
  								}
  							}
  						});
  					}
  				}
  				if($(this).parent().find("ul:first").is(":visible")){
  					$(this).parent().find("ul:first").slideUp(opts.speed, function(){
  						$(this).parent("li").find("span:first").delay(opts.speed).html(opts.closedSign);
  					});
  					
  					
  				}else{
  					$(this).parent().find("ul:first").slideDown(opts.speed, function(){
  						$(this).parent("li").find("span:first").delay(opts.speed).html(opts.openedSign);
  					});
  				}
  			}
  		});
    }
});
})(jQuery);
$(function() {
	$(".topnav").accordion({
		accordion:false,
		speed:200,
		closedSign: '[+]',
		openedSign: '[-]'
	});
});

(function() {
                var link_element = document.createElement("link"),
                    s = document.getElementsByTagName("script")[0];
                if (window.location.protocol !== "http:" && window.location.protocol !== "https:") {
                    link_element.href = "http:";
                }
                link_element.href += "//fonts.googleapis.com/css?family=Roboto:100italic,100,300italic,300,400italic,400,500italic,500,700italic,700,900italic,900";
                link_element.rel = "stylesheet";
                link_element.type = "text/css";
                s.parentNode.insertBefore(link_element, s);
            })();
 (function() {
                var link_element = document.createElement("link"),
                    s = document.getElementsByTagName("script")[0];
                if (window.location.protocol !== "http:" && window.location.protocol !== "https:") {
                    link_element.href = "http:";
                }
                link_element.href += "//fonts.googleapis.com/css?family=Lato:100italic,100,300italic,300,400italic,400,700italic,700,900italic,900";
                link_element.rel = "stylesheet";
                link_element.type = "text/css";
                s.parentNode.insertBefore(link_element, s);
            })();