var rated = false;function mwd_sum_grading_values(num, form_id) {	var sum = 0;	for(var k=0; k<100;k++) {		if(document.getElementById(num+'_element'+form_id+'_'+k))			if(document.getElementById(num+'_element'+form_id+'_'+k).value) {				sum = sum + parseInt(document.getElementById(num+'_element'+form_id+'_'+k).value);			}			        if(document.getElementById(num+'_total_element'+form_id)){			if(sum > document.getElementById(num+'_total_element'+form_id).innerHTML){				document.getElementById(num+'_text_element'+form_id).innerHTML =" "+ MWD_GRADING_TEXT+" " + document.getElementById(num+'_total_element'+form_id).innerHTML;			}			else{				document.getElementById(num+'_text_element'+form_id).innerHTML="";			}		}	}		if(document.getElementById(num+'_sum_element'+form_id))		document.getElementById(num+'_sum_element'+form_id).innerHTML = sum;}function mwd_change_src(id,el_id,form_id,color){	if(rated == false){		for(var j=0;j<=id;j++)			document.getElementById(el_id+'_star_'+j+'_'+form_id).src=mwd_objectL10n.plugin_url+"/images/star_"+color+'.png';	}}function mwd_reset_src(id,el_id, form_id){	if(rated == false){		for(var j=0;j<=id;j++)			document.getElementById(el_id+'_star_'+j+'_'+form_id).src=mwd_objectL10n.plugin_url+"/images/star.png";	}}function mwd_select_star_rating(id,el_id,form_id, color,star_amount) {	rated = true;	for(var j=0;j<=id;j++)		document.getElementById(el_id+'_star_'+j+'_'+form_id).src=mwd_objectL10n.plugin_url+"/images/star_"+color+".png";	for(var k=id+1;k<=star_amount-1;k++)		document.getElementById(el_id+'_star_'+k+'_'+form_id).src=mwd_objectL10n.plugin_url+"/images/star.png";	document.getElementById(el_id+'_selected_star_amount'+form_id).value=id+1;}function mwd_show_other_input(num, form_id){	var element_other = jQuery('.mwd-form [id^='+num+'_element'+form_id+'][other="1"]');	var parent_ = element_other.parent();	var br = document.createElement('br');		br.setAttribute("id", num+"_other_br"+form_id);	var el_other = document.createElement('input');		el_other.setAttribute("id", num+"_other_input"+form_id);		el_other.setAttribute("name", num+"_other_input"+form_id);		el_other.setAttribute("type", "text");		el_other.setAttribute("class", "other_input");	parent_.append(br);	parent_.append(el_other);}function mwd_set_checked(id,j,form_id) {	var checking = jQuery('.mwd-form #'+id+'_element'+form_id+j);	if(checking.attr('other') && checking.attr('other')==1){		if(!checking.is(":checked")) {				if(checking.parent().find('#'+id+"_other_input"+form_id)) {				checking.parent().find('#'+id+"_other_br"+form_id).remove();				checking.parent().find('#'+id+"_other_input"+form_id).remove();			}			return false;							}	}		return true;}function mwd_set_default(id, j, form_id){		if(jQuery('.mwd-form #'+id+'_other_input'+form_id)) {		jQuery('.mwd-form #'+id+'_other_input'+form_id).parent().find('#'+id+'_other_br'+form_id).remove();		jQuery('.mwd-form #'+id+'_other_input'+form_id).remove();	}}function mwd_delete_value(x) {	ofontStyle = jQuery(x).attr('class');	if(ofontStyle.indexOf("input_deactive")!=-1){		jQuery(x).val("").removeClass("input_deactive").addClass("input_active");	}}function mwd_return_value(x){	if(jQuery(x).val()==""){		jQuery(x).val(jQuery(x).attr('title')).removeClass("input_active").addClass("input_deactive");	}}function mwd_generate_page_nav(id, form_id, form_view_count, form_view_max){	form_view = id;	page_nav = document.getElementById('mwd_'+form_id+'page_nav'+id);		destroyChildren(page_nav);		form_view_elemet = document.getElementById(form_id+'form_view'+id);		remove_whitespace(form_view_elemet.parentNode.parentNode);	mwd_display_none_form_views_all(form_id);	mwd_generate_page_bar(id, form_id, form_view_count, form_view_max);	form_view_elemet.parentNode.style.display="";	var td = document.createElement("div");		td.setAttribute("valign", "middle");		td.setAttribute("align", "left");		td.style.display="table-cell";		td.style.width="40%";		page_nav.appendChild(td);	if(form_view_elemet.parentNode.previousSibling && form_view_elemet.parentNode.previousSibling.previousSibling) {		if(form_view_elemet.parentNode.previousSibling.tagName=="DIV" && form_view_elemet.parentNode.previousSibling.className=="wdform-page-and-images") {				table = form_view_elemet.parentNode.previousSibling;		}		else			if(form_view_elemet.parentNode.previousSibling.previousSibling.tagName=="DIV" && form_view_elemet.parentNode.previousSibling.className=="wdform-page-and-images") {				table = form_view_elemet.parentNode.previousSibling.previousSibling;		}		else			table = "none";		if(table!="none") {			if(!table.firstChild.tagName)				table.removeChild(table.firstChild);			previous_title = form_view_elemet.getAttribute('previous_title');			previous_type = form_view_elemet.getAttribute('previous_type');			if(previous_type=="text")				td.setAttribute("class", "previous-page");			previous_class = form_view_elemet.getAttribute('previous_class');			previous_checkable = form_view_elemet.getAttribute('previous_checkable');			next_or_previous = "previous";			previous = mwd_make_pagebreak_button(next_or_previous, previous_title, previous_type, previous_class, previous_checkable, id, form_id, form_view_count, form_view_max);			td.appendChild(previous);		}	}	var td = document.createElement("div");		td.setAttribute("id", form_id+"page_numbers"+form_view);		td.setAttribute("valign", "middle");		td.setAttribute("class", "page-numbers");		td.setAttribute("align", "center");		td.style.display="table-cell";	if(document.getElementById('mwd-pages'+form_id).getAttribute('show_numbers')=="true") {		k=0;		for(j=1; j<=form_view_max; j++) {			if(document.getElementById(form_id+'form_view'+j)) {				k++;						if(j==form_view)					page_number=k;			}		}				var cur = document.createElement('span');			cur.setAttribute("class", "page_numbers");			cur.innerHTML = page_number+'/'+k;		td.appendChild(cur);	}	page_nav.appendChild(td);	var td = document.createElement("div");		td.setAttribute("valign", "middle");		td.setAttribute("align", "right");		td.style.cssText = "display:table-cell; width:40%; text-align:right;";			page_nav.appendChild(td);	not_next = false;	if(form_view_elemet.parentNode.nextSibling) {		if(form_view_elemet.parentNode.nextSibling.tagName=="DIV" && form_view_elemet.parentNode.nextSibling.className=="wdform-page-and-images")			table=form_view_elemet.parentNode.nextSibling;		else			if(form_view_elemet.parentNode.nextSibling.nextSibling && form_view_elemet.parentNode.nextSibling.nextSibling.className=="wdform-page-and-images") {				if(form_view_elemet.parentNode.nextSibling.nextSibling.tagName=="DIV")					table = form_view_elemet.parentNode.nextSibling.nextSibling;				else					table = "none";			}			else				table = "none";			if(table!="none") {				next_title = form_view_elemet.getAttribute('next_title');				next_type = form_view_elemet.getAttribute('next_type');				if(next_type=="text")					td.setAttribute("class", "next-page");				next_class = form_view_elemet.getAttribute('next_class');				next_checkable = form_view_elemet.getAttribute('next_checkable');				next_or_previous = "next";								next = mwd_make_pagebreak_button(next_or_previous, next_title, next_type, next_class, next_checkable, id, form_id, form_view_count, form_view_max);				td.appendChild(next);			}			else {				not_next = true;			}	} else {		not_next = true;	}		jQuery('#mwd-form' + form_id + ' .wdform-element-section').each(function() {		if(!jQuery(this).parent()[0].style.width && parseInt(jQuery(this).width())!=0){			if(jQuery(this).css('display')=="table-cell") {				if(jQuery(this).parent().attr('type') != "type_captcha")					jQuery(this).parent().css('width', parseInt(jQuery(this).width()) + parseInt(jQuery(this).parent().find(jQuery(".wdform-label-section"))[0].style.width)+15);				else					jQuery(this).parent().css('width', (parseInt(jQuery(this).parent().find(jQuery(".mwd_captcha_input"))[0].style.width)*2+50) + parseInt(jQuery(this).parent().find(jQuery(".wdform-label-section"))[0].style.width)+15);			}		}	});}function mwd_display_none_form_views_all(form_id) {	for(t=1; t<30; t++){		if(document.getElementById(form_id+'form_view'+t))			document.getElementById(form_id+'form_view'+t).parentNode.style.display="none";}}function mwd_generate_page_bar(form_view, form_id, form_view_count, form_view_max){		if(document.getElementById('mwd-pages'+form_id).getAttribute('type')=='steps')		mwd_make_page_steps_front(form_view, form_id, form_view_count, form_view_max);	else		if(document.getElementById('mwd-pages'+form_id).getAttribute('type')=='percentage')			mwd_make_page_percentage_front(form_view, form_id, form_view_count, form_view_max);		else			mwd_make_page_none_front(form_id);		if(document.getElementById('mwd-pages'+form_id).getAttribute('type')=='show_numbers'){					td = document.getElementById(form_id+'page_numbers'+form_view);			if(td){					destroyChildren(td);				k=0;				for(j=1; j<=form_view_max; j++) {					if(document.getElementById(form_id+'form_view'+j)) {						k++;								if(j==form_view)							page_number=k;					}				}				var cur = document.createElement('span');					cur.setAttribute("class", "page_numbers");					cur.innerHTML=page_number+'/'+k;				td.appendChild(cur);			}		}		else {				td = document.getElementById(form_id+'page_numbers'+form_view);			if(td) {					destroyChildren(document.getElementById(form_id+'page_numbers'+form_view));			}		}			}function mwd_make_page_steps_front(form_view, form_id, form_view_count, form_view_max){	destroyChildren(document.getElementById('mwd-pages'+form_id));	show_title = (document.getElementById('mwd-pages'+form_id).getAttribute('show_title')=='true');	next_checkable = (document.getElementById(form_id+'form_view'+form_view).getAttribute('next_checkable')=='true');	previous_checkable = (document.getElementById(form_id+'form_view'+form_view).getAttribute('previous_checkable')=='true');	k=0;	for(j=1; j<=form_view_max; j++) {			if(document.getElementById(form_id+'form_view'+j)) {			if(document.getElementById(form_id+'form_view'+j).getAttribute('page_title'))				w_pages = document.getElementById(form_id+'form_view'+j).getAttribute('page_title');			else				w_pages = "";			k++;			page_number = document.createElement('span');			page_number.setAttribute('id','page_'+j);			if(j<form_view)				if(previous_checkable)					page_number.setAttribute('onClick','if(mwd_check'+form_id+'('+form_view+')) mwd_generate_page_nav("'+j+'", "'+form_id+'", "'+form_view_count+'", "'+form_view_max+'")');				else					page_number.setAttribute('onClick','mwd_generate_page_nav("'+j+'", "'+form_id+'", "'+form_view_count+'", "'+form_view_max+'")');							if(j>form_view)				if(next_checkable)					page_number.setAttribute('onClick','if(mwd_check'+form_id+'('+form_view+')) mwd_generate_page_nav("'+j+'", "'+form_id+'", "'+form_view_count+'", "'+form_view_max+'")');				else								page_number.setAttribute('onClick','mwd_generate_page_nav("'+j+'", "'+form_id+'", "'+form_view_count+'", "'+form_view_max+'")');			if(j==form_view)				page_number.setAttribute('class',"page_active");			else				page_number.setAttribute('class',"page_deactive");						if(show_title) {				page_number.innerHTML = w_pages;			}			else				page_number.innerHTML = k;			document.getElementById('mwd-pages'+form_id).appendChild(page_number);		}	}}function mwd_make_page_percentage_front(form_view, form_id, form_view_count, form_view_max) {	destroyChildren(document.getElementById('mwd-pages'+form_id));	show_title=(document.getElementById('mwd-pages'+form_id).getAttribute('show_title')=='true');    var div_parent = document.createElement('div');       	div_parent.setAttribute("class", "page_percentage_deactive");    var div = document.createElement('div');       	div.setAttribute("id", "div_percentage");       	div.setAttribute("class", "page_percentage_active");       	div.setAttribute("align", "right");		    var div_arrow = document.createElement('div');       	div_arrow.setAttribute("class", "wdform_percentage_arrow");			var b = document.createElement('b');       	b.setAttribute("class", "wdform_percentage_text");	div.appendChild(b);	k=0;	cur_page_title = '';	for(j=1; j<=form_view_max; j++) {			if(document.getElementById(form_id+'form_view'+j)) {			if(document.getElementById(form_id+'form_view'+j).getAttribute('page_title'))				w_pages=document.getElementById(form_id+'form_view'+j).getAttribute('page_title');			else				w_pages="";			k++;							if(j==form_view){				if(show_title){ 					var cur_page_title = document.createElement('div');						cur_page_title.innerHTML=w_pages;											cur_page_title.innerHTML=w_pages;															cur_page_title.setAttribute("class", "wdform_percentage_title");				}				page_number=k;			}		}	}	b.innerHTML=Math.round(((page_number-1)/k)*100)+'%';	div.style.width=((page_number-1)/k)*100+'%';	if(page_number==1)		div_arrow.style.display='none';	div_parent.appendChild(div);	div_parent.appendChild(div_arrow);	if(cur_page_title)		div_parent.appendChild(cur_page_title);	document.getElementById('mwd-pages'+form_id).appendChild(div_parent);}function mwd_make_page_none_front(form_id) {	destroyChildren(document.getElementById('mwd-pages'+form_id));}function mwd_make_pagebreak_button(next_or_previous,title,type, class_, checkable, id, form_id, form_view_count, form_view_max){	switch(type) {		case 'text': {				var element = document.createElement('div');				element.setAttribute('id', "page_"+next_or_previous+"_"+id);				element.setAttribute('class', class_);				if(checkable=="true")					element.setAttribute('onClick', "if(mwd_check"+form_id+"("+id+")) mwd_page_"+next_or_previous+"("+id+","+form_id+","+form_view_count+","+form_view_max+")");				else					element.setAttribute('onClick', "mwd_page_"+next_or_previous+"("+id+","+form_id+","+form_view_count+","+form_view_max+")");				var next_or_prev_button = next_or_previous == 'next' ? title + ' <span class="fa fa-angle-double-right"></span>' : '<span class="fa fa-angle-double-left"></span> '+title;						element.innerHTML = next_or_prev_button;			return element;			break;		}		case 'img':{ 						var element = document.createElement('img');				element.setAttribute('id', "page_"+next_or_previous+"_"+id);				element.setAttribute('class', class_);				if(checkable=="true")					element.setAttribute('onClick', "if(mwd_check"+form_id+"("+id+")) mwd_page_"+next_or_previous+"("+id+","+form_id+","+form_view_count+","+form_view_max+")");				else					element.setAttribute('onClick', "mwd_page_"+next_or_previous+"("+id+","+form_id+","+form_view_count+","+form_view_max+")");				if(title.indexOf("http")==0) {					element.src=title;				}				else					element.src=mwd_objectL10n.plugin_url+'/'+title;			return element;			break;		}	}}function mwd_page_previous(id, form_id, form_view_count, form_view_max) {	form_view_elemet=document.getElementById(form_id+'form_view'+id);	if(form_view_elemet.parentNode.previousSibling && form_view_elemet.parentNode.previousSibling.previousSibling) {		if(form_view_elemet.parentNode.previousSibling.tagName=="DIV")			table = form_view_elemet.parentNode.previousSibling;		else			table = form_view_elemet.parentNode.previousSibling.previousSibling;	}	if(!table.firstChild.tagName)		table.removeChild(table.firstChild);	mwd_generate_page_nav(table.firstChild.id.replace(form_id+'form_view', ""),form_id, form_view_count, form_view_max);	window.scroll(0, findPos(document.getElementById("mwd-form" + form_id)));}function mwd_page_next(id, form_id, form_view_count, form_view_max) {	form_view_elemet=document.getElementById(form_id+'form_view'+id);	if(form_view_elemet.parentNode.nextSibling) {		if(form_view_elemet.parentNode.nextSibling.tagName=="DIV")			table=form_view_elemet.parentNode.nextSibling;		else			table=form_view_elemet.parentNode.nextSibling.nextSibling;	}	if(!table.firstChild.tagName)		table.removeChild(table.firstChild);	mwd_generate_page_nav(table.firstChild.id.replace(form_id+'form_view', ""), form_id, form_view_count, form_view_max);	window.scroll(0, findPos(document.getElementById("mwd-form" + form_id)));}function check_isnum(e) {  	var chCode1 = e.which || e.keyCode;    if ( jQuery.inArray(chCode1,[46,8,9,27,13,190]) != -1 || e.ctrlKey === true || (chCode1 >= 35 && chCode1 < 39))        return true;	if (chCode1 > 31 && (chCode1 < 48 || chCode1 > 57))        return false;	return true;}function captcha_refresh(id, genid) {	srcArr = document.getElementById(id + genid).src.split("&r=");	document.getElementById(id + genid).src = srcArr[0] + '&r=' + Math.floor(Math.random()*100);	document.getElementById(id + "_input"+genid).value = '';	document.getElementById(id + genid).style.display = "inline-block";}function add_0(x) {	if(jQuery(x).val().length==1)		jQuery(x).val('0'+jQuery(x).val());}function check_hour(e, id, hour_interval){   	var chCode1 = e.which || e.keyCode;	if (chCode1 > 31 && (chCode1 < 48 || chCode1 > 57))        return false;	hour = ""+document.getElementById(id).value+String.fromCharCode(chCode1);	hour = parseFloat(hour);	if((hour<0) || (hour>hour_interval))        return false;	return true;} function check_minute(e, id) {	   	var chCode1 = e.which || e.keyCode;    if (chCode1 > 31 && (chCode1 < 48 || chCode1 > 57))        return false;	minute = ""+document.getElementById(id).value+String.fromCharCode(chCode1);	minute = parseFloat(minute);	if((minute<0) || (minute>59))        return false;	return true;} function mwd_check_second(e, id) {	   	var chCode1 = e.which || e.keyCode;    if (chCode1 > 31 && (chCode1 < 48 || chCode1 > 57))        return false;	second = ""+document.getElementById(id).value+String.fromCharCode(chCode1);	second = parseFloat(second);	if((second<0) || (second>59))        return false;	return true;} function check_isnum_interval(e, x, from, to) {	var chCode1 = e.which || e.keyCode;	if (jQuery.inArray(chCode1,[46,8,9,27,13,190]) != -1 || e.ctrlKey === true || (chCode1 >= 35 && chCode1 < 39)) {		return true;	}	if (chCode1 > 31 && (chCode1 < 48 || chCode1 > 57)) {		return false;	}	val1=""+jQuery(x).val()+String.fromCharCode(chCode1);	if (val1.length>2)		return false;	if (val1=='00')		return false;	if ((val1<from) || (val1>to))		return false;		return true;}function change_year(x) {	year = jQuery(x).val();	from = parseFloat(jQuery(x).attr('from'));	to = parseFloat(jQuery(x).attr('to'));	year = parseFloat(year);	if((year>=from) && (year<=to))		jQuery(x).val(year);	else		jQuery(x).val('');}function check_day(e, x) {	   	var chCode1 = e.which || e.keyCode;    if (chCode1 > 31 && (chCode1 < 48 || chCode1 > 57))        return false;	day = ""+jQuery(x).val()+String.fromCharCode(chCode1);	if(day.length>2)        return false;	if(day=='00')        return false;	day = parseFloat(day);	if((day<0) || (day>31))        return false;	return true;} function check_month(e, x) {	   	var chCode1 = e.which || e.keyCode;   	if (chCode1 > 31 && (chCode1 < 48 || chCode1 > 57))        return false;	month = ""+jQuery(x).val()+String.fromCharCode(chCode1);	if(month.length>2)        return false;	if(month=='00')        return false;	month=parseFloat(month);	if((month<0) || (month>12))        return false;	return true;} function check_year1(e, x) {	   	var chCode1 = e.which || e.keyCode;   	if (chCode1 > 31 && (chCode1 < 48 || chCode1 > 57))        return false;	year = ""+jQuery(x).val()+String.fromCharCode(chCode1);	to = parseFloat(jQuery(x).attr('to'));	year=parseFloat(year);	if(year>to)        return false;	return true;}function check_isnum_or_minus(e) {   	var chCode1 = e.which || e.keyCode;	if (chCode1 != 45 ) {    	if (chCode1 > 31 && (chCode1 < 48 || chCode1 > 57))        return false;	}		return true;} function destroyChildren(node){	while (node.firstChild)		node.removeChild(node.firstChild);}function findPos(obj) {	var curtop = 0;	if (obj.offsetParent) {		do {			curtop += obj.offsetTop;		} while (obj = obj.offsetParent);		return [curtop];	}}function getfileextension(filename, exten){ 	if( filename.length == 0 ) 		return true; 	var dot = filename.lastIndexOf("."); 	var extension = filename.substr(dot+1,filename.length); 	exten=exten.split(',');	for(var j=0 ; j<exten.length; j++) {		exten[j]=exten[j].replace(/\./g,'');		exten[j]=exten[j].replace(/ /g,'');		if(extension.toLowerCase()==exten[j].toLowerCase())			return true;	}	return false; } function remove_whitespace(node){	var ttt;	for (ttt=0; ttt < node.childNodes.length; ttt++){        if( node.childNodes[ttt] && node.childNodes[ttt].nodeType == '3' && !/\S/.test(  node.childNodes[ttt].nodeValue )){			node.removeChild(node.childNodes[ttt]);			ttt--;		}		else{			if(node.childNodes[ttt].childNodes.length)				remove_whitespace(node.childNodes[ttt]);		}	}	return;}function is_email_valid( wdid, form_id ){	if(jQuery("#mwd-form"+form_id+" #wdform_"+wdid+"_element"+form_id).val()!="" && jQuery("#mwd-form"+form_id+" #wdform_"+wdid+"_element"+form_id).val().search(/^\w+((-\w+)|(\.\w+))*\@[A-Za-z0-9]+((\.|-)[A-Za-z0-9]+)*\.[A-Za-z0-9]+$/) == -1 ) {		alert(MWD_ValidEmail);		old_bg=x.find(jQuery("div[wdid="+wdid+"]")).css("background-color");		x.find(jQuery("div[wdid="+wdid+"]")).effect( "shake", {}, 500 ).css("background-color","#FF8F8B").animate({backgroundColor: old_bg}, {duration: 500, queue: false });		jQuery("#mwd-form"+form_id+" #wdform_"+wdid+"_element"+form_id).focus();		return false;	}		return true;}