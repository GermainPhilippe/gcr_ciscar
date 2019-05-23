$(document).ready(function(){

	
	$("#ModuleSite").click(function(){
		$("#LinkSite").toggle();
		$("#LinkInfosCISCAR").hide();
		$("#LinkDocsUtiles").hide();
	});
	
	$("#ModuleInfosCISCAR").click(function(){
		$("#LinkSite").hide();
		$("#LinkInfosCISCAR").toggle();
		$("#LinkDocsUtiles").hide();
	});

	$("#ModuleDocsUtiles").click(function(){
		$("#LinkSite").hide();
		$("#LinkInfosCISCAR").hide();
		$("#LinkDocsUtiles").toggle();
	});
	
	$("#Recherche").click(function(){
		$(this).val('');
	});
});