/* 	-	-	-	-	-	-	-	-	-	-	-	-	-	-	-	-	-	-	-	-
-							Autor: Uziel Trujillo Colón 						-
-	-	-	-	-	-	-	-	-	-	-	-	-	-	-	-	-	-	-	-	*/

(function(){
	$.fn.boxShow = function(options){
		
		var settings = {
			in : 1000,
			out: 1000,
			toShow : ".boxLogin"
		}
		
		var o = $.extend(settings,options);
		
		
		return this.each(function(){
			
			$(this).toggle(function(){
				$(o.toShow).fadeIn(o.in);
				},
					function(){
					$(o.toShow).fadeOut(o.out);
			});
			
		});
	};
})($);