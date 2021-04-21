(function(){

	var scripts = document.getElementsByTagName("script"),
	    src = scripts[scripts.length-1].src;
	    parser = document.createElement('a');
	    parser.href = src;
		host = parser.protocol;
	var domain = parser.protocol+'//'+parser.hostname//+"/connectcrm"

	var jQuery;
	if (window.jQuery === undefined || window.jQuery.fn.jquery !== '2.1.0') {
    var script_tag = document.createElement('script');
    script_tag.setAttribute("type","text/javascript");
    script_tag.setAttribute("src",
        "https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.0/jquery.min.js");
    if (script_tag.readyState) {
      script_tag.onreadystatechange = function () { // For old versions of IE
          if (this.readyState == 'complete' || this.readyState == 'loaded') {
              scriptLoadHandler();
          }
      };
    } else { // Other browsers
      script_tag.onload = scriptLoadHandler;
    }
    // Try to find the head, otherwise default to the documentElement
    (document.getElementsByTagName("head")[0] || document.documentElement).appendChild(script_tag);
	} else {
	    // The jQuery version on the window is the one we want to use
	    jQuery = window.jQuery;
	    main();
	}

	/******** Called once jQuery has loaded ******/
	function scriptLoadHandler() {
	    // Restore $ and window.jQuery to their previous values and store the
	    // new jQuery in our local jQuery variable
	    jQuery = window.jQuery.noConflict(true);
	    // Call our main function
	    main();
	}
	function getUrlVars()
	{

	    var vars = [], hash;
	    var hashes = src.slice(src.indexOf('?') + 1).split('&');
	    for(var i = 0; i < hashes.length; i++)
	    {
	        hash = hashes[i].split('=');
	        vars.push(hash[0]);
	        vars[hash[0]] = hash[1];
	    }
	    return vars;
	}
	/******** Our main function ********/
	function main() {
	    jQuery(document).ready(function($) {

			var  _floatbox = $("#contact_form"), _floatbox_opener = $(".contact-opener") ;
			_floatbox.css("right", "-260px");
			_floatbox_opener.html("Quick Enquiry");

			_floatbox_opener.click(function(){
				if (_floatbox.hasClass('visiable')){
				_floatbox.animate({"right":"-260px"}, {duration: 300}).removeClass('visiable');
				}else{
				  _floatbox.animate({"right":"0px"},  {duration: 300}).addClass('visiable');
				}
			});
	        /******* Load CSS *******/
	        var container = $('#connectcrm');
	        var css_link = $("<link>", {
	            rel: "stylesheet",
	            type: "text/css",
	            href: domain+"/public/widget/style.css"
	        });
	        css_link.appendTo('head');
	        var form_html = $("<form>",{
	        	action:domain+'/save-widget-inquiry',
	        	method:'POST',
	        });
	        var project = $("<input/>", {type: 'hidden',id: 'project_id',name: 'project_id',value:getUrlVars()["p"], });
	        var is_global = $("<input/>", {type: 'hidden',id: 'is_global',name: 'is_global',value:0});
	        if(getUrlVars()["g"] == 1){
	        	is_global = $("<input/>", {type: 'hidden',id: 'is_global',name: 'is_global',value:1,required:'required'});
	           	var option = '<option val="">Select Project*</option>';
	        	var project = $("<select/>", {id: 'project_id',name: 'project_id',value:getUrlVars()["p"]});
	        	var jsonp_url = domain+"/api/projects";
		        $.getJSON(jsonp_url, function(data) {
		        	$.each(data, function( index, value ) {
			 		  option +='<option val="">'+value.name+'</option>';
					});
			        project.append(option);
		        });

	        }

			var name = $("<input/>", {type: 'text',id: 'name', name: 'name',required:'required',placeholder: 'Name',class: 'form-control slideformInput'});
			var mobile = $("<input/>", {type: 'text',id: 'mobile',name: 'email',required:'required',placeholder: 'Mobile',class: 'form-control slideformInput'});
			var project = $("<input/>", {type: 'hidden',id: 'project_id',name: 'project_id',value:getUrlVars()["p"],class: 'form-control slideformInput'});
			var email = $("<input/>", {type: 'email',id: 'email',name: 'email',required:'required',placeholder: 'Email',class: 'form-control slideformInput'});
			var butSubmit = $("<input/>", {type: 'submit',id: 'submit',name: 'submit',value: 'Submit',class: 'btn btn-info form-control  waves-effect'});
			form_html.append(name,mobile,email,project,butSubmit);
	        container.html(form_html);
	        /******* Load HTML *******/

	    });
	}

})();
