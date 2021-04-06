$(function(){
    
	let className = 'bg-purple-500 text-white active';
	
	$('.phone').inputmask('+7(999)999-9999');

	function clearForm(){
		
		$('.resume-field').removeClass(className);

		$( ".resume-field" ).each(function( index ) {
			$(this).val('');	
		});
	}
	
    $(".send-resume-btn").click(function(e){		
		
		let formData = {};
		let fields = {};
		let expFields = [];
		let eduFields = []; 
		let filesFields = [];
		let arErr = [];
		
		let htmlEr = '';
		let hasErr = false;

        let _token   = $('meta[name="csrf-token"]').attr('content');

		
		$('.resume-err').fadeOut();

		$( ".resume-field" ).each(function( index ) {

			if($(this).attr('type') == 'checkbox'){
				fields[$(this).data("label")] = $(this).is(":checked") ? 1 : 0;

			}else if($(this).hasClass('active')){
				fields[$(this).data("label")] = $(this).html();
			}else{
				fields[$(this).data("label")] = $(this).val();
			}
			
		});
						
		$( ".experience-field" ).each(function( index ) {
			
			let company_name = $(this).find('input[data-label="company_name"]').val();
			let position = $(this).find('input[data-label="position"]').val();
			let period = $(this).find('input[data-label="period"]').val();
			let description = $(this).find('textarea[data-label="description"]').val();

			expFields.push({company_name, position, period, description});				
		});

		$( ".education-field" ).each(function( index ) {
			
			let place = $(this).find('input[data-label="place"]').val();
			let specialisation = $(this).find('input[data-label="specialisation"]').val();
			let period = $(this).find('input[data-label="period"]').val();
			
			eduFields.push({place,specialisation, period});				
		});

		$( ".file-field" ).each(function( index ) {	
			
			let name = $(this).data('name');
			let original_name = $(this).data('original-name');
			let url = $(this).val();
			let description = '';

			filesFields.push({name, original_name, url, description});				
		});
		
		$( ".required" ).each(function( index ) {

			if(fields[$(this).data('label')]){	
				$(this).addClass('border-gray-300');
				$(this).removeClass('border-red-300');
			}else {
				$(this).addClass('border-red-300');
				$(this).removeClass('border-gray-300');
				hasErr = true;
			}
				
		});
		
		formData._token = _token;
		formData.info = fields;
		formData.files = filesFields;
		formData.experience = expFields;
		formData.education = eduFields;
		formData.form_id = $('#fid').val();
		formData.company_code = $('#cid').val();
		
		console.log( formData);
		
		
		if( $('.confirmation').prop( 'checked' )){
			arErr.push('Для сохранения нажмите на галочку согласие');
		}		
		

		if(arErr.length == 0 && !hasErr){
		
		Wait.show();	
			
		$.ajax({
			url: "/resume/save",
			type: "POST",
			data: formData,
			dataType : 'json',
			success: function(data){
				

				if( data['success'] == "Y" ) {
					
					Wait.hide();
					clearForm();
					Message.showSuccess('Инфо','Спасибо! Ваше резюме было отправлено!','Ок, понятно');
					
					
				} else {
					console.log( data['error'] );
				}
			},
			error : function(e) {
				console.log(e);
			}
		});

		}else{

			/* arErr.forEach(function(item, i, arr) {
				htmlEr +=  item + '<br/>';
				}); */
				
				$('.resume-err').html('Заполнены не все поля! Проверьте заполнение полей.');
				$('.resume-err').fadeIn();
		
				var body = $("html, body");
				body.stop().animate({scrollTop:0}, 800, 'linear', function() { 
				});


		}
			
		e.preventDefault();
	});
	
	if($('#user-photo').length > 0){

	var userPhoto = new Dropzone("#user-photo", { 
		url : '/resume/photo',
		paramName: 'file',
		maxFilesize: 5, // MB,
		addedfile : function(file) {
			$('#user-photo').html('<div>'+file.name+'</div>');
			let totalsize = parseFloat((file.size / (1024*1024)).toFixed(2));
			$('#user-photo').append('<div>'+totalsize+'Mb</div>');
			$('#user-photo').append('<div class="progress-file"></div>');
		},
		sending: function(file, xhr, formData) {
			let _token   = $('meta[name="csrf-token"]').attr('content');
			formData.append("_token",  _token);
		},
		uploadprogress: function(file, progress, bytesSent) {
			
			$('.progress-file').html(parseInt(progress)+'%');
			
		},
		success: function(file, response){
			let html = `<input class='file-field' value='${response.url}' data-name='${response.name}' data-original-name='${file.name}' type='hidden'/>`;
			$('.files-fields-wrap').append(html);
			console.log(response);
		},
		error: function(file, message) {
			$('.files-fields-wrap').html('Ошибка загрузки файла. Проверьте размер (не более 1Мб)');
		}
	});

	}

	
	let currentExperienceField = 1;
	let currentEducationField = 1;

	$(document).on("click", ".add-expreience", function (e) {
		let html = `<div class="mb-2 experience-field" data-id="${currentExperienceField}">
		<div class="md:flex">                  
		<div>
			<label class="text-xl my-2 block" for="">Организация</label>
			<input data-label="company_name"  class="border w-full border-gray-300 block focus:ring-purple-600" type="text" value="">
		</div>
		<div class="md:ml-5 md:mr-5">
			<label class="text-xl my-2 block" for="">Должность</label>
			<input data-label="position" class="border w-full border-gray-300 block focus:ring-purple-600" type="text" value="">
		</div>
		<div>
			<label class="text-xl my-2 block" for="">Период работы</label>
			<input data-label="period" class="border w-full border-gray-300 block focus:ring-purple-600" type="text" value="">
		</div>
		</div>
		<div class="mb-2">
			<div><label class="text-xl my-2 block" for="">Должностные обязанности</label></div>
			<textarea data-label="description" class="mw-728 border lg:w-4/6 w-full border-gray-300 block resize-none focus:ring-purple-600" ></textarea>
		</div>
	</div>`;

		$('.experience-wrap').append(html);
		currentExperienceField++;

	});

	$(document).on("click", ".add-education", function (e) {
		let html = `<div data-id="${currentEducationField}" class="md:flex mb-2 education-field">
		<div>
			<label class="text-xl my-2 block" for="">Учеб. заведение</label>
			<input data-label="place" class="border w-full border-gray-300 block focus:ring-purple-600" type="text" value="">
		</div>
		<div class="md:ml-5 md:mr-5">
			<label class="text-xl my-2 block" for="">Специальность</label>
			<input data-label="specialisation" class="border w-full border-gray-300 block focus:ring-purple-600" type="text" value="">
		</div>
		<div>
			<label class="text-xl my-2 block" for="">Период обучения</label>
			<input  data-label="period" class="border w-full border-gray-300 block focus:ring-purple-600" type="text" value="">
		</div>
		</div>`;

		$('.education-wrap').append(html);
		currentEducationField++;
	});

	let currentFormTab = 1;

	$(document).on("click", ".next-form-btn", function () {
		
		hasErr = false;
		$('.resume-err').fadeOut();

		$( ".form-tab.active .required" ).each(function( index ) {

			if($(this).val()){	
				$(this).addClass('border-gray-300');
				$(this).removeClass('border-red-300');
			}else {
				$(this).addClass('border-red-300');
				$(this).removeClass('border-gray-300');
				hasErr = true;
			}
				
		});

		if(!hasErr){
			currentFormTab++;
			$('.form-tab').removeClass('active');
			$('.form-step li').removeClass('active');
			$('.form-tab[data-id="'+currentFormTab+'"]').addClass('active');
			$('.form-step li[data-id="'+currentFormTab+'"]').addClass('active');
		}else{
			$('.resume-err').html('Заполнены не все поля! Проверьте заполнение полей.');
			$('.resume-err').fadeIn();
				
		}
		
	});

	$(document).on("click", ".prev-form-btn", function () {
		currentFormTab--;
		$('.form-tab').removeClass('active');
		$('.form-step li').removeClass('active');
		$('.form-tab[data-id="'+currentFormTab+'"]').addClass('active');
		$('.form-step li[data-id="'+currentFormTab+'"]').addClass('active');
	});

    $(document).on('click', '.field-variant', function(e){
		
		$(this).toggleClass(className);

	});

	/**
	 * Test
	 */
	let lastItemOrder = {value : $('#last-item-order').val()};
	let lastItemLeft = {value : $('#last-item-left').val()};
	let lastItemRight = {value : $('#last-item-right').val()};

	 $(document).on('click', '.answer-clickable', function(e){
		
		let item = '';

		if($(this).hasClass('answer-order')){
			item = lastItemOrder;
		}

		if($(this).hasClass('answer-choice')){
			$(this).toggleClass('active');
		}

		if($(this).hasClass('answer-compare')){
			
			if($(this).data('type') == 'left'){
				item = lastItemLeft;
			}else{
				item = lastItemRight;
			}

		}

		if($(this).hasClass('answer-compare') || $(this).hasClass('answer-order')){

			if(!$(this).hasClass('active')){
				$(this).html(item.value++);
				$(this).addClass('active');
			}else{
				
				if($(this).hasClass('answer-compare')){

					$('.answer-compare').html('');
					$('.answer-compare').removeClass('active');
					
					lastItemLeft.value = 1;
					lastItemRight.value = 1;
					item.value = 1;

				}else{
					$('.answer-order').html('');
					$('.answer-order').removeClass('active');
					lastItemOrder.value = 1;
					item.value = 1;
				}
				
			}
		}
		
		
		
	});

	$(document).on('click', '.proccess-test', function(e){
		
		let code = $('#code').val();
		let companyId = $('#company').val();
		let _token   = $('meta[name="csrf-token"]').attr('content');

		$.ajax({
			url: "/tests/prepare",
			type: "POST",
			data: {code, companyId,_token},
			dataType : 'json',
			success: function(data){
				
				if( data['status'] == "success" ) {		
					location.href = `/tests/proccess/${companyId}/${code}`;
				} else {
					Message.showSuccess('Ошибка','Ошибка получения ответа сервера','Ок');
				}
			},
			error : function(e) {
				console.log(e);
			}
		});

	});

	$(document).on('click', '.question-page', function(e){
		
		let number = $(this).data('page');
		$('.question-page').removeClass('active');
		$('.question-page.prev').data('page', number-1);
		$('.question-page.next').data('page', number+1);

		if($(this).hasClass('prev') || $(this).hasClass('next')){
			
		}else{
			$(this).addClass('active');
		}
	
		showQuestion(number, $(this));

	});

	$(document).on('click', '.finish-test', function(e){
		
		$(this).fadeOut();
		let test_result_id = $('#trid').val();
		finishTest(test_result_id, 1);

	});

	function finishTest(test_result_id, type) {

		let _token   = $('meta[name="csrf-token"]').attr('content');

		$.ajax({
			url: "/tests/finish",
			type: "POST",
			data: {test_result_id, type, _token},
			dataType : 'html',
			success: function(data){
				$('.pagination-wrap').html('')			
				$('.test-wrap').html('Спасибо! Тестирование завершено.')			
			},
			error : function(e) {
				
			}
		});

	}

	function showQuestion(number, el){

		let test = $('#trid').val();
		let _token = $('meta[name="csrf-token"]').attr('content');
		let question = $('#qid').val();
		let questionType = $('#qtype').val();
		let answersRaw = []; 
		let answers = []; 

		
		lastItemOrder.value = $('#last-item-order').val();
		lastItemLeft.value = $('#last-item-left').val();
		lastItemRight.value = $('#last-item-right').val();
		

		$( ".answer-clickable.active" ).each(function( index ) {

			answers.push({id : $(this).data('id'), number : $(this).html()});
				
		});

		$.ajax({
			url: "/tests/question/show",
			type: "POST",
			data: {test, question, questionType, number, answers, _token},
			dataType : 'html',
			success: function(data){
				
				if(data) {		
					$('.test-wrap').html(data);	
				}else{
					Message.showSuccess('Ошибка','Ошибка получения ответа сервера','Ок');
				} 
			},
			error : function(e) {
				console.log(e);
			}
		});

	}
	
	startTimer(600, '#timer');
	
	function startTimer(duration, element) {
		let  timer = duration, minutes, seconds;
		
		let t = setInterval(function () {
			minutes = parseInt(timer / 60, 10);
			seconds = parseInt(timer % 60, 10);
	
			minutes = minutes < 10 ? "0" + minutes : minutes;
			seconds = seconds < 10 ? "0" + seconds : seconds;
	
			$(element).html(minutes + ":" + seconds);
	
			if (--timer < 0) {
				clearInterval(t);
				$('.finish-test').fadeOut();
				let test_result_id = $('#trid').val();
				finishTest(test_result_id, 2);
			}
		}, 1000);
	}

	

});