$(document).ready(function(){
	$(".btn-slide-passwd").click(function(){
		$("#passwd-panel").slideToggle("slow");
		$(this).toggleClass("active");
		return false;
	});
	
	$(".btn-slide-homepage").click(function(){
		$("#homepage-panel").slideToggle("slow");
		$(this).toggleClass("active");
		return false;
	});
	
	$(".btn-slide-pasconvention").click(function(){
		$("#pasconvention-panel").slideToggle("slow");
		$(this).toggleClass("active");
		return false;
	});
	
	$(".btn-slide-pagevalidation").click(function(){
		$("#pagevalidation-panel").slideToggle("slow");
		$(this).toggleClass("active");
		return false;
	});
	
	
	$(".btn-slide-domaine").click(function(){
		$("#domaine-panel").slideToggle("slow");
		$(this).toggleClass("active");
		return false;
	});

	$(".btn-slide-mail-1").click(function(){
		$("#mail-1-panel").slideToggle("slow");
		$(this).toggleClass("active");
		return false;
	});
	
	$(".btn-slide-mail-2").click(function(){
		$("#mail-2-panel").slideToggle("slow");
		$(this).toggleClass("active");
		return false;
	});
	
	$(".btn-slide-mail-3").click(function(){
		$("#mail-3-panel").slideToggle("slow");
		$(this).toggleClass("active");
		return false;
	});
	
	$(".btn-slide-mail-4").click(function(){
		$("#mail-4-panel").slideToggle("slow");
		$(this).toggleClass("active");
		return false;
	});
	
	$(".btn-slide-mail-5").click(function(){
		$("#mail-5-panel").slideToggle("slow");
		$(this).toggleClass("active");
		return false;
	});
	
	$(".btn-slide-mail-6").click(function(){
		$("#mail-6-panel").slideToggle("slow");
		$(this).toggleClass("active");
		return false;
	});

	$(".btn-slide-mail-7").click(function(){
		$("#mail-7-panel").slideToggle("slow");
		$(this).toggleClass("active");
		return false;
	});

	$(".btn-slide-mail-8").click(function(){
		$("#mail-8-panel").slideToggle("slow");
		$(this).toggleClass("active");
		return false;
	});
		
	$(".btn-slide-mail-9").click(function(){
		$("#mail-9-panel").slideToggle("slow");
		$(this).toggleClass("active");
		return false;
	});

	$(".btn-slide-mail-10").click(function(){
		$("#mail-10-panel").slideToggle("slow");
		$(this).toggleClass("active");
		return false;
	});

	$(".DomaineActivite").change(function(){
		
		$("select#DomaineActivite_1 option").each(function (){
			$(this).removeAttr("disabled");
		});
		$("select#DomaineActivite_2 option").each(function (){
			$(this).removeAttr("disabled");
		});
		$("select#DomaineActivite_3 option").each(function (){
			$(this).removeAttr("disabled");
		});
		/*$("select#DomaineActivite_4 option").each(function (){
			$(this).removeAttr("disabled");
		});
		$("select#DomaineActivite_5 option").each(function (){
			$(this).removeAttr("disabled");
		});
		$("select#DomaineActivite_6 option").each(function (){
			$(this).removeAttr("disabled");
		});*/
				
		//Desactiver
		$("select#DomaineActivite_1 option:selected").each(function (){
			if($(this).val()!='0')
			{
				$("select#DomaineActivite_2 option[value="+$(this).val()+"]").attr("disabled", true);
				$("select#DomaineActivite_2 option[value="+$(this).val()+"]").removeAttr("selected");
				$("select#DomaineActivite_3 option[value="+$(this).val()+"]").attr("disabled", true);
				$("select#DomaineActivite_3 option[value="+$(this).val()+"]").removeAttr("selected");
				/*$("select#DomaineActivite_4 option[value="+$(this).val()+"]").attr("disabled", true);
				$("select#DomaineActivite_4 option[value="+$(this).val()+"]").removeAttr("selected");
				$("select#DomaineActivite_5 option[value="+$(this).val()+"]").attr("disabled", true);
				$("select#DomaineActivite_5 option[value="+$(this).val()+"]").removeAttr("selected");
				$("select#DomaineActivite_6 option[value="+$(this).val()+"]").attr("disabled", true);
				$("select#DomaineActivite_6 option[value="+$(this).val()+"]").removeAttr("selected");*/
			}
		});
		
		//Desactiver
		$("select#DomaineActivite_2 option:selected").each(function (){
			if($(this).val()!='0')
			{
				$("select#DomaineActivite_1 option[value="+$(this).val()+"]").attr("disabled", true);
				$("select#DomaineActivite_1 option[value="+$(this).val()+"]").removeAttr("selected");
				$("select#DomaineActivite_3 option[value="+$(this).val()+"]").attr("disabled", true);
				$("select#DomaineActivite_3 option[value="+$(this).val()+"]").removeAttr("selected");
				/*$("select#DomaineActivite_4 option[value="+$(this).val()+"]").attr("disabled", true);
				$("select#DomaineActivite_4 option[value="+$(this).val()+"]").removeAttr("selected");
				$("select#DomaineActivite_5 option[value="+$(this).val()+"]").attr("disabled", true);
				$("select#DomaineActivite_5 option[value="+$(this).val()+"]").removeAttr("selected");
				$("select#DomaineActivite_6 option[value="+$(this).val()+"]").attr("disabled", true);
				$("select#DomaineActivite_6 option[value="+$(this).val()+"]").removeAttr("selected");*/
			}
		});
		//Desactiver
		$("select#DomaineActivite_3 option:selected").each(function (){
			if($(this).val()!='0')
			{
				$("select#DomaineActivite_1 option[value="+$(this).val()+"]").attr("disabled", true);
				$("select#DomaineActivite_1 option[value="+$(this).val()+"]").removeAttr("selected");
				$("select#DomaineActivite_2 option[value="+$(this).val()+"]").attr("disabled", true);
				$("select#DomaineActivite_2 option[value="+$(this).val()+"]").removeAttr("selected");
				/*$("select#DomaineActivite_4 option[value="+$(this).val()+"]").attr("disabled", true);
				$("select#DomaineActivite_4 option[value="+$(this).val()+"]").removeAttr("selected");
				$("select#DomaineActivite_5 option[value="+$(this).val()+"]").attr("disabled", true);
				$("select#DomaineActivite_5 option[value="+$(this).val()+"]").removeAttr("selected");
				$("select#DomaineActivite_6 option[value="+$(this).val()+"]").attr("disabled", true);
				$("select#DomaineActivite_6 option[value="+$(this).val()+"]").removeAttr("selected");*/
			}
		});
		/*//Desactiver
		$("select#DomaineActivite_4 option:selected").each(function (){
			if($(this).val()!='0')
			{
				$("select#DomaineActivite_1 option[value="+$(this).val()+"]").attr("disabled", true);
				$("select#DomaineActivite_1 option[value="+$(this).val()+"]").removeAttr("selected");
				$("select#DomaineActivite_2 option[value="+$(this).val()+"]").attr("disabled", true);
				$("select#DomaineActivite_2 option[value="+$(this).val()+"]").removeAttr("selected");
				$("select#DomaineActivite_3 option[value="+$(this).val()+"]").attr("disabled", true);
				$("select#DomaineActivite_3 option[value="+$(this).val()+"]").removeAttr("selected");
				$("select#DomaineActivite_5 option[value="+$(this).val()+"]").attr("disabled", true);
				$("select#DomaineActivite_5 option[value="+$(this).val()+"]").removeAttr("selected");
				$("select#DomaineActivite_6 option[value="+$(this).val()+"]").attr("disabled", true);
				$("select#DomaineActivite_6 option[value="+$(this).val()+"]").removeAttr("selected");
			}	
		});
		//Desactiver
		$("select#DomaineActivite_5 option:selected").each(function (){
			if($(this).val()!='0')
			{
				$("select#DomaineActivite_1 option[value="+$(this).val()+"]").attr("disabled", true);
				$("select#DomaineActivite_1 option[value="+$(this).val()+"]").removeAttr("selected");
				$("select#DomaineActivite_2 option[value="+$(this).val()+"]").attr("disabled", true);
				$("select#DomaineActivite_2 option[value="+$(this).val()+"]").removeAttr("selected");
				$("select#DomaineActivite_3 option[value="+$(this).val()+"]").attr("disabled", true);
				$("select#DomaineActivite_3 option[value="+$(this).val()+"]").removeAttr("selected");
				$("select#DomaineActivite_4 option[value="+$(this).val()+"]").attr("disabled", true);
				$("select#DomaineActivite_4 option[value="+$(this).val()+"]").removeAttr("selected");
				$("select#DomaineActivite_6 option[value="+$(this).val()+"]").attr("disabled", true);
				$("select#DomaineActivite_6 option[value="+$(this).val()+"]").removeAttr("selected");
			}
		});
		//Desactiver
		$("select#DomaineActivite_6 option:selected").each(function (){
			if($(this).val()!='0')
			{
				$("select#DomaineActivite_1 option[value="+$(this).val()+"]").attr("disabled", true);
				$("select#DomaineActivite_1 option[value="+$(this).val()+"]").removeAttr("selected");
				$("select#DomaineActivite_2 option[value="+$(this).val()+"]").attr("disabled", true);
				$("select#DomaineActivite_2 option[value="+$(this).val()+"]").removeAttr("selected");
				$("select#DomaineActivite_3 option[value="+$(this).val()+"]").attr("disabled", true);
				$("select#DomaineActivite_3 option[value="+$(this).val()+"]").removeAttr("selected");
				$("select#DomaineActivite_4 option[value="+$(this).val()+"]").attr("disabled", true);
				$("select#DomaineActivite_4 option[value="+$(this).val()+"]").removeAttr("selected");
				$("select#DomaineActivite_5 option[value="+$(this).val()+"]").attr("disabled", true);
				$("select#DomaineActivite_5 option[value="+$(this).val()+"]").removeAttr("selected");
			}
		});*/
	});
	
	$(".btn-slide-domaine").click(function(){
		$("select#DomaineActivite_1 option").each(function (){
			$(this).removeAttr("disabled");
		});
		$("select#DomaineActivite_2 option").each(function (){
			$(this).removeAttr("disabled");
		});
		$("select#DomaineActivite_3 option").each(function (){
			$(this).removeAttr("disabled");
		});
		/*$("select#DomaineActivite_4 option").each(function (){
			$(this).removeAttr("disabled");
		});
		$("select#DomaineActivite_5 option").each(function (){
			$(this).removeAttr("disabled");
		});
		$("select#DomaineActivite_6 option").each(function (){
			$(this).removeAttr("disabled");
		});*/
				
		//Desactiver
		$("select#DomaineActivite_1 option:selected").each(function (){
			if($(this).val()!='0')
			{
				$("select#DomaineActivite_2 option[value="+$(this).val()+"]").attr("disabled", true);
				$("select#DomaineActivite_2 option[value="+$(this).val()+"]").removeAttr("selected");
				$("select#DomaineActivite_3 option[value="+$(this).val()+"]").attr("disabled", true);
				$("select#DomaineActivite_3 option[value="+$(this).val()+"]").removeAttr("selected");
				/*$("select#DomaineActivite_4 option[value="+$(this).val()+"]").attr("disabled", true);
				$("select#DomaineActivite_4 option[value="+$(this).val()+"]").removeAttr("selected");
				$("select#DomaineActivite_5 option[value="+$(this).val()+"]").attr("disabled", true);
				$("select#DomaineActivite_5 option[value="+$(this).val()+"]").removeAttr("selected");
				$("select#DomaineActivite_6 option[value="+$(this).val()+"]").attr("disabled", true);
				$("select#DomaineActivite_6 option[value="+$(this).val()+"]").removeAttr("selected");*/
			}
		});
		
		//Desactiver
		$("select#DomaineActivite_2 option:selected").each(function (){
			if($(this).val()!='0')
			{
				$("select#DomaineActivite_1 option[value="+$(this).val()+"]").attr("disabled", true);
				$("select#DomaineActivite_1 option[value="+$(this).val()+"]").removeAttr("selected");
				$("select#DomaineActivite_3 option[value="+$(this).val()+"]").attr("disabled", true);
				$("select#DomaineActivite_3 option[value="+$(this).val()+"]").removeAttr("selected");
				/*$("select#DomaineActivite_4 option[value="+$(this).val()+"]").attr("disabled", true);
				$("select#DomaineActivite_4 option[value="+$(this).val()+"]").removeAttr("selected");
				$("select#DomaineActivite_5 option[value="+$(this).val()+"]").attr("disabled", true);
				$("select#DomaineActivite_5 option[value="+$(this).val()+"]").removeAttr("selected");
				$("select#DomaineActivite_6 option[value="+$(this).val()+"]").attr("disabled", true);
				$("select#DomaineActivite_6 option[value="+$(this).val()+"]").removeAttr("selected");*/
			}
		});
		//Desactiver
		$("select#DomaineActivite_3 option:selected").each(function (){
			if($(this).val()!='0')
			{
				$("select#DomaineActivite_1 option[value="+$(this).val()+"]").attr("disabled", true);
				$("select#DomaineActivite_1 option[value="+$(this).val()+"]").removeAttr("selected");
				$("select#DomaineActivite_2 option[value="+$(this).val()+"]").attr("disabled", true);
				$("select#DomaineActivite_2 option[value="+$(this).val()+"]").removeAttr("selected");
				/*$("select#DomaineActivite_4 option[value="+$(this).val()+"]").attr("disabled", true);
				$("select#DomaineActivite_4 option[value="+$(this).val()+"]").removeAttr("selected");
				$("select#DomaineActivite_5 option[value="+$(this).val()+"]").attr("disabled", true);
				$("select#DomaineActivite_5 option[value="+$(this).val()+"]").removeAttr("selected");
				$("select#DomaineActivite_6 option[value="+$(this).val()+"]").attr("disabled", true);
				$("select#DomaineActivite_6 option[value="+$(this).val()+"]").removeAttr("selected");*/
			}
		});
		/*//Desactiver
		$("select#DomaineActivite_4 option:selected").each(function (){
			if($(this).val()!='0')
			{
				$("select#DomaineActivite_1 option[value="+$(this).val()+"]").attr("disabled", true);
				$("select#DomaineActivite_1 option[value="+$(this).val()+"]").removeAttr("selected");
				$("select#DomaineActivite_2 option[value="+$(this).val()+"]").attr("disabled", true);
				$("select#DomaineActivite_2 option[value="+$(this).val()+"]").removeAttr("selected");
				$("select#DomaineActivite_3 option[value="+$(this).val()+"]").attr("disabled", true);
				$("select#DomaineActivite_3 option[value="+$(this).val()+"]").removeAttr("selected");
				$("select#DomaineActivite_5 option[value="+$(this).val()+"]").attr("disabled", true);
				$("select#DomaineActivite_5 option[value="+$(this).val()+"]").removeAttr("selected");
				$("select#DomaineActivite_6 option[value="+$(this).val()+"]").attr("disabled", true);
				$("select#DomaineActivite_6 option[value="+$(this).val()+"]").removeAttr("selected");
			}	
		});
		//Desactiver
		$("select#DomaineActivite_5 option:selected").each(function (){
			if($(this).val()!='0')
			{
				$("select#DomaineActivite_1 option[value="+$(this).val()+"]").attr("disabled", true);
				$("select#DomaineActivite_1 option[value="+$(this).val()+"]").removeAttr("selected");
				$("select#DomaineActivite_2 option[value="+$(this).val()+"]").attr("disabled", true);
				$("select#DomaineActivite_2 option[value="+$(this).val()+"]").removeAttr("selected");
				$("select#DomaineActivite_3 option[value="+$(this).val()+"]").attr("disabled", true);
				$("select#DomaineActivite_3 option[value="+$(this).val()+"]").removeAttr("selected");
				$("select#DomaineActivite_4 option[value="+$(this).val()+"]").attr("disabled", true);
				$("select#DomaineActivite_4 option[value="+$(this).val()+"]").removeAttr("selected");
				$("select#DomaineActivite_6 option[value="+$(this).val()+"]").attr("disabled", true);
				$("select#DomaineActivite_6 option[value="+$(this).val()+"]").removeAttr("selected");
			}
		});
		//Desactiver
		$("select#DomaineActivite_6 option:selected").each(function (){
			if($(this).val()!='0')
			{
				$("select#DomaineActivite_1 option[value="+$(this).val()+"]").attr("disabled", true);
				$("select#DomaineActivite_1 option[value="+$(this).val()+"]").removeAttr("selected");
				$("select#DomaineActivite_2 option[value="+$(this).val()+"]").attr("disabled", true);
				$("select#DomaineActivite_2 option[value="+$(this).val()+"]").removeAttr("selected");
				$("select#DomaineActivite_3 option[value="+$(this).val()+"]").attr("disabled", true);
				$("select#DomaineActivite_3 option[value="+$(this).val()+"]").removeAttr("selected");
				$("select#DomaineActivite_4 option[value="+$(this).val()+"]").attr("disabled", true);
				$("select#DomaineActivite_4 option[value="+$(this).val()+"]").removeAttr("selected");
				$("select#DomaineActivite_5 option[value="+$(this).val()+"]").attr("disabled", true);
				$("select#DomaineActivite_5 option[value="+$(this).val()+"]").removeAttr("selected");
			}
		});*/
		return false;
	});
	
});



$(document).load(function(){
	
});