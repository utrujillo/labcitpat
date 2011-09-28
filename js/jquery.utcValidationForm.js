/* 	-	-	-	-	-	-	-	-	-	-	-	-	-	-	-	-	-	-	-	-
-							Autor: Uziel Trujillo Colón 						-
-	-	-	-	-	-	-	-	-	-	-	-	-	-	-	-	-	-	-	-	*/
(function(){
	
    function _toValidate(elem,opts){
		var errorFlag = true;
		
		if(elem.hasClass("regExp")){
			if (!(opts.regExp.test(elem.val()))){ 
				elem.addClass(opts.errorClass);
				if(opts.showTips){
					elem.after("<span class='"+ opts.errorTipClass +"'>Ingrese un valor correcto</span>");	}			
				return true;
			}else
				return false;
		}else{
			if(elem.val().length < opts.dataMin){
				elem.addClass(opts.errorClass);
				if(opts.showTips){
					elem.after("<span class='"+ opts.errorTipClass +"'>El valor minimo debe ser "+ opts.dataMin +" caracter</span>");}
				return true;
			}else{
				return false;
			}
				
		}
	}
    
	$.fn.utcValidationForm = function(options){
		
		var settings = {
			errorClass  	: "datoRequerido",
			showTips		: true,
			errorTipClass	: "errorTip",
            dataMin     	: 1,
			regExp			: /^((([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+(\.([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+)*)|((\x22)((((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(([\x01-\x08\x0b\x0c\x0e-\x1f\x7f]|\x21|[\x23-\x5b]|[\x5d-\x7e]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(\\([\x01-\x09\x0b\x0c\x0d-\x7f]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))))*(((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(\x22)))@((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?$/i
		};
		
		
		var o = $.extend(settings,options);
		
		return this.each(function(){
			var form = $(this);
			
			if(!form.is("form")){return;}
			
			form.submit(function(event){	
				
				$(":input",this).each(function(index,element){
					var e = $(element);
                   
					                
						e.removeClass(o.errorClass);
						e.remove("span");
													  
						if(e.hasClass("required")){				
							var bValid = _toValidate(e,o);							
							if(bValid)
								event.preventDefault();
						}
					
					e.keyup(function(){
						if( e.val() != "" ){
							e.next().fadeOut();
						}
					});
										
				});//fin input, this				
			});//fin form.submit
		});//fin this.each
	};
})($);