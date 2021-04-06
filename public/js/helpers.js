$(function(){

    class Message{
		
        static showSuccess(title,text, buttonText, callback = function(){}){
            Swal.fire({
                title: title,
                text: text,
                icon: 'success',
                confirmButtonText: buttonText,
                onClose: callback
            })
        }
    }

	Wait = {

		show: function(){
			$('.wait-bg').css("display", "flex").hide().fadeIn();
		},
		hide: function(){
			$('.wait-bg').fadeOut();
		}

	}

    CommonForm = {
    
		show: function(html) {

			CommonMessage.show(html);	

		},
		success: function(title, text, button, callback) {
			Message.showSuccess(title, text, button, callback);						
		},
		store: function(url, title, text, button, prefix = 'common', callback = function(){}, callbackClose = function(){}){
			
		let formData = {};
		let fields = {};
		let arErr = [];
		let hasErr = false;
        let _token   = $('meta[name="csrf-token"]').attr('content');

		
		$('.'+prefix+'-form-err').fadeOut();

		$( '.'+prefix+'-form-field' ).each(function( index ) {
			if($(this).attr('type') == 'checkbox'){
				fields[$(this).data('name')] = $(this).prop('checked');
			}else{
				fields[$(this).data('name')] = $(this).val();
			}
				
		});
		
		formData._token = _token;
		formData.fields = fields;
		
		if(arErr.length == 0 && !hasErr){

		$.ajax({
			url: url,
			type: "POST",
			data: formData,
			dataType : 'json',
			success: function(data){
				
				if( data['status'] == "success" ) {
					
					callback();
					CommonForm.success(title, text, button, callbackClose);
					
				} else {
					console.log( data['error'] );
				}
			},
			error : function(e) {
				console.log(e);
			}
		});

		}else{

		}
		
			
		},
		getData: function(url, params, btn = '', width = 40, callback = function(){}){

			params._token = $('meta[name="csrf-token"]').attr('content'); 

			$.ajax({
				url: url,
				type: "POST",
				dataType: "html",
					data: (params),
				success: function(data){
					
					CommonMessage.show(data, btn, width);
					callback();
									   
				},
				error : function(e) {
				   console.log(e);
				}
	   		});


		},
		deleteRow: function(url, params = ''){

			params._token = $('meta[name="csrf-token"]').attr('content'); 

			$.ajax({
				url: url,
				type: "GET",
				dataType: "html",
					data: params,
				success: function(data){
					
					location.reload();
									   
				},
				error : function(e) {
				   console.log(e);
				}
	   		});


		}


		
	}

	CommonMessage = {

		show: function(desc, buttons, width = 40) {                		
			
			if(desc != 'undefined')
			{
				$(".message-wrap").find(".desc").html(desc);
			};

			$('.message-wrap .inner').css('width', width + '%');

			var buttonsEl = $(".message-wrap").find( ".buttons" );
			if( buttons != 'undefined' ) {
				buttonsEl.html( buttons );
			};		      
			$(".message-bg").fadeIn();
			Animator.animateIn(".message-wrap", "fadeInUp");

		},
		hide: function(){		
			//Animator.animateOut(".message-wrap", "fadeOutDown");
			$(".message-wrap").fadeOut();
			$(".message-bg").fadeOut();       
		},
		change: function(desc, buttons) {

			if(desc != 'undefined')
			{
				$(".message-wrap").find(".desc").html(desc);
			};

			var buttonsEl = $(".message-wrap").find( ".buttons" );
			if( buttons != 'undefined' ) {
				buttonsEl.html( buttons );
			};
		}
		
	}
	
	Animator = {
		animate : function(element_class, animation) {
	
			$(element_class).addClass("animated");
			$(element_class).addClass(animation);
			
			var wait = window.setTimeout( function(){
			$(element_class).removeClass(animation)}, 1300);
			
		},
		
		animateIn : function(element_class, animation) {
	
			$(element_class).css("display","block");
			$(element_class).addClass("animated");
			$(element_class).addClass(animation);
			
			var wait = window.setTimeout( function(){
			$(element_class).removeClass(animation)}, 1300);
			
		},
		animateOut : function(element_class, animation) {
	
			$(element_class).addClass("animated");
			$(element_class).addClass(animation);
		   
			var wait = window.setTimeout( function(){
			$(element_class).removeClass(animation)
			$(element_class).css("display","none");
			}, 1300);
			
		}
		,
		animateScroll : function(element_class, animation){
			
		$(window).scroll(function() {
		$(element_class).each(function(){
		  var imagePos = $(this).offset().top;
		  var topOfWindow = $(window).scrollTop();
		  if (imagePos < topOfWindow+500) {
				$(this).addClass(animation);
		  }
		});
	  });
	
			
		}
		
	}

    window.Message = Message;
});
