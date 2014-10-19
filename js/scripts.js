$(document).ready(function(){	

/***************************************************
	MENU
***************************************************/
jQuery('ul.nav li.dropdown').hover(function (){
    jQuery(this).find('.dropdown-menu').stop(true, true).delay(200).fadeIn();
    jQuery('a').hover(function() {
        var height = jQuery(this).offset();
        jQuery(this).parent().find('.sub-menu').css('top', height.top - +106);
    });
}, function (){
    jQuery(this).find('.dropdown-menu').stop(true, true).delay(200).fadeOut();      
});

jQuery('.btn-navbar').on('click',function(){
    jQuery('nav#main_menu > .nav-collapse > ul.navbar-nav').slideDown();
});

/***************************************************
		TOOLTIP & POPOVER
***************************************************/
$("[rel=tooltip]").tooltip();
$("[data-rel=tooltip]").tooltip();

/***************************************************
		CAROUSEL - STOP AUTO CYCLE
***************************************************/
 $('.carousel').carousel({
    interval: false});

/***************************************************
		HOVERS
***************************************************/
	$(".hover_img, .hover_colour").on('mouseover',function(){
			var info=$(this).find("img");
			info.stop().animate({opacity:0.1},500);
		}
	);
	$(".hover_img, .hover_colour").on('mouseout',function(){
			var info=$(this).find("img");
			info.stop().animate({opacity:1},800);
		}
	);
	
/***************************************************
		BACK TO TOP LINK
***************************************************/
			$(window).scroll(function() {
				if ($(this).scrollTop() > 200) {
					$('.go-top').fadeIn(200);
				} else {
					$('.go-top').fadeOut(200);
				}
			});
			
			// Animate the scroll to top
			$('.go-top').click(function(event) {
				event.preventDefault();
				
				$('html, body').animate({scrollTop: 0}, 300);
			})
		});	

/***************************************************
	IFRAME
***************************************************/
	$("iframe").each(function(){
		var ifr_source = $(this).attr('src');
		var wmode = "wmode=transparent";
		if(ifr_source.indexOf('?') != -1) {
		var getQString = ifr_source.split('?');
		var oldString = getQString[1];
		var newString = getQString[0];
		$(this).attr('src',newString+'?'+wmode+'&'+oldString);
		}
		else $(this).attr('src',ifr_source+'?'+wmode);
	});
	
/***************************************************
	ANIMATIONS
***************************************************/

$(function() { 	
$('.welcome').show().addClass("animated fadeInDown");
$('.welcome_index').show().addClass("animated fadeInDown");
$('.intro_sections h6').show().addClass("animated fadeInUp");
$('.fadeinup').show().addClass("animated fadeInUp");
$('.fadeindown').show().addClass("animated fadeInDown");
}); 

/***************************************************
		PRETTYPHOTO
***************************************************/
$('a[data-rel]').each(function() {
$(this).attr('rel', $(this).attr('data-rel')).removeAttr('data-rel');
});

var ppCount = $("a[rel^='prettyPhoto']").length;

if(ppCount > 0)
{
	$("a[rel^='prettyPhoto']").prettyPhoto();
	jQuery("a[rel^='prettyPhoto'], a[rel^='lightbox']").prettyPhoto({
		overlay_gallery: false, social_tools: false,  deeplinking: false
	});
}

/***************************************************
 *         Custom Functions
 ***************************************************/
/*
function RemoveURL(URL,ID,H)
{
console.log(URL);
console.log(ID);
console.log(H);

	var combinedObj = {'password': $("#edit_password").val(), 'url': URL, 'update': 'remove_url', 'ID': ID, 'hash': H };
        var str = "hello";
        $.ajax({
                                        type: "POST",
                                        url: "https://routingpacketsisnotacrime.uk/update_pac.php",
                                        data: combinedObj,
                                        contentType: "application/x-www-form-urlencoded",
                                        success: function(msg)
                                        {
                                                var jsonMsg = $.parseJSON(msg);
                                                if(jsonMsg.success == 'ok')
                                                {
                                                        result = '<div id="notif" class="notification_ok">URL removed, it will take up to 5 minutes for all proxy servers to update.</div>';
							$("#row-"+ID).fadeOut(2000);
                                                }
                                                else
                                                {
                                                        result = '<div class="alert alert-danger">' + jsonMsg.message +'</div>'
                                                }
                                                $('#note').html(result);
						window.setInterval(function(){$('#notif').fadeOut(2000); window.clearInterval(this);}, 5000);
                                        },
                                        error: function(a, b, c)
                                        {
                                                console.log(a);
                                                console.log(b);
                                                console.log(c);
                                        }
	});
}

function AddURLs(H)
{
	var combinedObj = {'password': $("#edit_password").val(), 'urls': $("#urls").val(), 'update': 'add_url', 'hash': H };
                                $.ajax({
                                        type: "POST",
                                        url: "https://routingpacketsisnotacrime.uk/update_pac.php",
                                        data: combinedObj,
                                        contentType: "application/x-www-form-urlencoded",
                                        success: function(msg)
                                        {
                                                var jsonMsg = $.parseJSON(msg);
                                                if(jsonMsg.success == 'ok')
                                                {
                                                        result = '<div class="notification_ok">Your additional URLs have been added, it will take a few minutes for all PAC and proxy servers to update.</div>';
                                                }
                                                else
                                                {
                                                        result = '<div class="alert alert-danger">' + jsonMsg.message +'</div>'
                                                }
                                                $('#note').html(result);
                                        },
                                        error: function(a, b, c)
                                        {
                                                console.log(a);
                                                console.log(b);
                                                console.log(c);
                                        }
                                });

}



function PushToS3(H)
{
        var combinedObj = {'hash': H };
                                $.ajax({
                                        type: "POST",
                                        url: "https://routingpacketsisnotacrime.uk/put_to_s3.php",
                                        data: combinedObj,
                                        contentType: "application/x-www-form-urlencoded",
                                        success: function(msg)
                                        {
                                                var jsonMsg = $.parseJSON(msg);
                                                if(jsonMsg.success == 'ok')
                                                {
                                                        result = '<div class="notification_ok" style="text-transform: none !important;">Your PAC has been pushed to S3 and your URL is: <a href="'+jsonMsg.url+'">'+ jsonMsg.url+ '</a></div>';
                                                }
                                                else
                                                {
                                                        result = '<div class="alert alert-danger">' + jsonMsg.message +'<br/>Contact <a href="mailto:Security@RoutingPacketsIsNotACrime.uk">Security@RoutingPacketsIsNotACrime.uk</a> for assistance.</div>'
                                                }
                                                $('#note').html(result);
                                        }
                                });

}
*/
