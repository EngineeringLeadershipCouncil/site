jQuery(function() {
	var activebutton = jQuery('.PeopleRadioButton').find("[data-people='" + people + "']");
	var fullbuttonimg = "http://ec2-54-200-246-251.us-west-2.compute.amazonaws.com/wp-content/uploads/2013/11/button_full.png";
	var emptybuttonimg = "http://ec2-54-200-246-251.us-west-2.compute.amazonaws.com/wp-content/uploads/2013/11/button_empty.png";

    jQuery('.PeopleRadioButton').hover(function() {
		jQuery(this).attr("src", fullbuttonimg);
	}, function() {
        jQuery(this).attr("src", emptybuttonimg);
	});
	
	jQuery('.PeopleRadioButton').click(function() {
		activebutton = jQuery(this);
		activebutton.attr("src", fullbuttonimg);
	});
	
	jQuery('.HoverTriggersPopup').hover(function() {
		var profile ="#"+this.id + "profile";
        jQuery(this).find(".HeadShotText").animate({"height": "60px","opacity": "0.95"}, {duration: 300});
    }, function() {
        jQuery(this).find(".HeadShotText").animate({ "height": "0px","opacity": "0.7"}, {duration: 500});
    
	});
	jQuery('.HeadShotBox').click(function() {
	var profile ="#"+this.id + "profile";
	if(jQuery(profile).css("display")=="none"){
		jQuery(".HeadShotExpandedBox").children().css({display:"none", height: "0px", padding: "0px 30px 0px 30px"});

		jQuery(profile).animate({height: "400px",padding: "30px 30px 30px 30px"}, {duration: 300, start: function(){jQuery(profile).css("display","block");}});
		}
	else{
		jQuery(".HeadShotExpandedBox").children().animate({height: "0px", padding: "0px 30px 0px 30px"}, {duration: 300, complete: function(){jQuery(".HeadShotExpandedBox").children().css("display","none");}});
		}
	});
	jQuery(".HeadShotExpandedBox").click(function() {
		jQuery(".HeadShotExpandedBox").children().animate({height: "0px"}, {duration: 300, complete: function(){jQuery(".HeadShotExpandedBox").children().css("display","none");}});
	});

});

