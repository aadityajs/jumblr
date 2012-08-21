function CreatePopup(url, height, duration, description, lifetime) {
    // Exit if the current browser has already received the popup, or 
    // the browser is not supported (IE6).
    if (HasAlreadyReceivedPopup(description) || IsUnsupportedUserAgent())
    	return;
	
	$.get(url, function(data) { 
		
		var popup = $("<div>" + data + "</div>")
			.attr({ "id": "sliding_popup" })
			.css({"bottom": -1 * height})
	    	.height(height)
			.hide()
			.appendTo("body");
		
		ShowPopup(description, lifetime, popup, duration); 
	});
}

function ShowPopup(description, lifetime, popup, duration) 
{ 
	popup.show().animate( { bottom: 0 }, duration);
	//ReceivedPopup(description, lifetime);
}

function HasAlreadyReceivedPopup(description) { 
	return document.cookie.indexOf(description) > -1; 
}

function ReceivedPopup(description, lifetime) { 
	var date = new Date(); 
	date.setDate(date.getDate() + lifetime); 
	document.cookie = description + "=true;expires=" + date.toUTCString() + ";path=/"; 
}

function IsUnsupportedUserAgent() { 
	return (!window.XMLHttpRequest); 
}

function DestroyPopup(duration) {
	$("#sliding_popup").animate({ bottom: $("#sliding_popup").height() * -1 }, duration, function () { $("#sliding_popup").remove(); })
}