$(document).ready(function(){

	$("#btn_update_link").click(function(){
		var facebook_link 	= $("#facebook").val();
		var twitter_link    = $("#twitter").val();
		var linkedin_link 	= $("#linkedin").val();
		var gplus  = $("#gplus").val();
		var pinterest_link  = $("#pinterest").val();
		var filter = /^(http|https|ftp):\/\/(www+\.)?[a-zA-Z0-9]+\.([a-zA-Z]{2,4})\/?/;

		$("#err_faecbook").html("");
		$("#err_twitter").html("");
		$("#err_linkedin").html("");
		$("#err_google").html("");
		$("#err_pinterest").html("");

		/*if(facebook_link=="")
		{
			$("#err_faecbook").html("Please enter facebook link.");
			return false;
		}*/
		if(!filter.test(facebook_link) && facebook_link!="")	
		{	
			$("#err_faecbook").html("Please enter facebook link.");	
			return false;

		}
		/*if((twitter_link==""))
		{
			$("#err_twitter").html("Please enter twitter link.");
			return false;
		}*/
		if(!filter.test(twitter_link) && twitter_link!="")
		{
			$("#err_twitter").html("Please enter valid twitter link.");
			return false;

		}
		/*if(linkedin_link=="")
		{
			$("#err_linkedin").html("Please enter  linkedin link.");
			return false;
		}*/
		if(!filter.test(linkedin_link) && linkedin_link!="")
		{
			$("#err_linkedin").html("Please enter  linkedin link.");
			return false;

		}
		/*if((gplus==""))
		{
			$("#err_google").html("Please enter google plus link.");
			return false;
		}*/
		if(!filter.test(gplus) && gplus!="")
		{
			$("#err_google").html("Please enter valid google plus link.");
			return false;

		}
		/*if((pinterest_link==""))
		{
			$("#err_pinterest").html("Please enter pinterest link.");
			return false;
		}*/
		if(!filter.test(pinterest_link) && pinterest_link!="")
		{
			$("#err_pinterest").html("Please enter valid pinterest link.");
			return false;

		}
	});

	/*****************Laxmi Pagare(Date: 18-10-16)***************************************/

	$("#btn_speciality_save").click(function(){
	
	var speciality        = $('#speciality').val();
	var meta_title        = $('#meta_title').val();
	var meta_keyword      = $('#meta_keyword').val();
	var meta_desc         = $('#meta_desc').val();

	if(speciality=='')
	{		
        $('#err_speciality').html('Please enter doctor speciality.');
        $('#err_speciality').keyup(function(){$('#err_speciality').html(''); });        
        $('#err_speciality').focus();
        return false;
	}
	else if(meta_title=='')
	{		
        $('#err_meta_title').html('Please enter meta title.');
        $('#err_meta_title').keyup(function(){ $('#err_meta_title').html(''); });        
        $('#err_meta_title').focus();
        return false;
	}	
	else if(meta_keyword=='')
	{		
        $('#err_meta_keyword').html('Please enter meta keyword.');
        $('#err_meta_keyword').keyup(function(){ $('#err_meta_keyword').html(''); });        
        $('#err_meta_keyword').focus();
        return false;
	}	
	else if(meta_desc=='')
	{		
        $('#err_meta_desc').html('Please enter meta description.');
        $('#err_meta_desc').keyup(function(){ $('#err_meta_desc').html(''); });        
        $('#err_meta_desc').focus();
        return false;
	}	
	else
	{
		return true;
	}
 });

});