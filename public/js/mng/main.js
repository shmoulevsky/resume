$(function(){
    
	let currentId = 100;
	
	function changeStatus(resume_id, status_id, el) {
		
		$.ajax({
			url: "/mng/resume/status-change",
			type: "POST",
			data: {
				'resume_id' : resume_id, 
				'status_id' : status_id,
				'_token' : $('meta[name="csrf-token"]').attr('content')
			},
			dataType : 'json',
			success: function(data){
				
				if( data['status'] == "success" ) {
					
					$('.status-field').removeClass('active');
					if(el){
						el.addClass('active');
					}
					
				
				} 
			},
			error : function(e) {
				console.log(e);
			}
		});


	}

	$('#status-column-not,#status-column-inwork,#status-column-test,#status-column-interview,#status-column-employment,#status-column-reject').sortable({

		connectWith: '.status-column',
		receive: function(event, ui) {
		  
		let resume_id = ui.item[0].dataset.id;
	   	let status_id = ui.item[0].parentElement.dataset.status;
		changeStatus(resume_id, status_id, null);
		  
	  }
  	}).disableSelection();
  
  

	$('.date-time').datetimepicker({
		format: 'd.m.Y H:i',
		formatTime: 'H:i',
		formatDate: 'd.m.Y',
		defaultDate : new Date()
	});

	
	$(document).on("click", ".delete-item", function (e) {
		
		let url = $(this).data('url');
		CommonMessage.show('Подтвердите удаление записи', '<a class="delete-item-confirm inline-block my-2 bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 mr-2 rounded mb-6 mr-5" data-url="'+url+'" href="#">Удалить</a><a id="close-message-btn" class="close-btn" href="#">Отмена</a>', 20);
		e.preventDefault();

	});


	$(document).on("click", ".delete-item-confirm", function (e) {
		
		let url = $(this).data('url');
		CommonForm.deleteRow(url);
		e.preventDefault();

	});

	$(document).on("click", ".delete-comment-btn", function (e) {
		
		let url = $(this).data('url');
		CommonForm.deleteRow(url);
		e.preventDefault();

	});

	$(document).on("click", ".delete-field", function (e) {
		
		let id = $(this).data('id');
		CommonMessage.show('Подтвердите удаление поля. Все ответы на данный вопрос также будут удалены.', '<a class="delete-field-confirm inline-block my-2 bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 mr-2 rounded mb-6 mr-5" data-id="'+id+'" href="#">Удалить</a><a id="close-message-btn" class="close-btn" href="#">Отмена</a>', 20);
		e.preventDefault();

	});

	$(document).on("click", ".delete-field-confirm", function (e) {
		
		
		let id = $(this).data('id');

		$.ajax({
			url: '/mng/fields/delete/' + id,
			type: "GET",
			data: {
				'_token' : $('meta[name="csrf-token"]').attr('content')
			},
			dataType : 'json',
			success: function(data){
				
				if( data['status'] == "deleted" ) {
					
					$('.field-wrap[data-id='+id+']').remove();					
					CommonMessage.hide();
				} 
			},
			error : function(e) {
				console.log(e);
			}
		});
		e.preventDefault();

	});

	$(document).on("click", "#close-message-btn", function (e) {

		CommonMessage.hide();
		e.preventDefault();
	});

	$(document).on("change", ".form-field-variant-points", function () {
		let points = parseInt($(this).val());
		
		if(isNaN(points)){
			points = 0;
		}

		if(points > 100){
			points = 100;
		}
		$(this).val(points);
		$(this).parent().find(".form-field-variant").data('points', points);
	});
	
	$(document).on("click", ".plus-form-field-variant", function () {
		
		const form_id = $(this).data('form-id');;
		let html = `<div class="flex"><input data-id="new-${currentId}" data-points="10" data-field-id="${form_id}" data-sort="100" class="form-field-variant mt-1" name="" type="text" value=""><input  class="form-field-variant-points mt-1" type="text" data-field-variant-id="new-${currentId}" value="10"></div>`;
		$(this).parent().find('.form-field-variant-wrap').append(html);
		currentId++;

	});
	
	$(document).on("click", ".question-required", function () {
		$(this).toggleClass("active");
		let is_required = $(this).hasClass("active") ? 1 : 0;
		
		$(this).parent().find(".form-field").data("required", is_required);
		
	});

	$(document).on("click", ".add-field-button", function (e) {
		const type = $(this).data('type');
		
		$('#empty-form-text').fadeOut();

		let html = '';
		
		switch (type) {
			case 1:
				html = `<label class="question-title" for="">Вопрос:</label><span class="question-required">Обязательный</span><input data-type="1" data-id="new-${currentId}" data-step="1" data-sort="100" data-required="0" data-size="100" class="form-field" name="" type="text" value="">`;
				break;
			case 2:
				html = `<label class="question-title" for="">Вопрос:</label><span class="question-required">Обязательный</span><textarea data-type="2" data-id="new-${currentId}" data-step="1" data-sort="0" data-required="0" data-size="100" class="form-field" name="" ></textarea>`;
				break;
			case 3:
				html = `<label class="question-title" for="">Вопрос:</label><span class="question-required">Обязательный</span><input data-type="3" data-id="new-${currentId}" data-step="1" data-sort="100" data-required="0" data-size="100" class="form-field" name="" type="text" value=""><div class="mt-1 relative"><span data-form-id="new-${currentId}" class="plus-form-field-variant">+</span><div class="flex relative"><label class="mb-1" for="">Варианты ответа:</label><div class="form-field-variant-wrap"><div class="flex"><input data-id="new-${currentId+1}" data-points="10" data-field-id="new-${currentId}" data-sort="100" class="form-field-variant mt-1" name="" type="text" value=""><input  class="form-field-variant-points mt-1" type="text" data-field-variant-id="new-${currentId+1}" value="10"></div><div class="flex"><input data-id="new-${currentId+2}" data-points="10" data-field-id="new-${currentId}" data-sort="100" class="form-field-variant mt-1"  name="" type="text" value=""><input  class="form-field-variant-points mt-1" type="text" data-field-variant-id="new-${currentId+2}" value="10"></div></div></div>`;
				currentId = currentId + 2;

				break;	

			default:
				break;
		}

		html = '<div class="mb-5 ">'+html+'</div>';
		currentId++;

		$('#resume-form').append(html);
	});

	/**
	 * resume
	 */

	 $(document).on("click", ".tab-wrap_links li", function () {
		$(".tab-wrap_links li").removeClass("active");
		$(".links-tab").removeClass("active");
		$(this).addClass("active");
		let tab = $(this).data("tab");
		$('.links-tab[data-tab="'+tab+'"]').addClass("active");
	});

	$(".status-field-btn").click(function(e){

		let resume_id = $(this).data('resume-id');
		let status_id = $(this).data('status-id');
		let el = $(this);
		changeStatus(resume_id, status_id, el);

	});

	$(document).on("click", ".copy-public-resume-url", function () {
		
		let textArea = document.createElement("textarea");
        textArea.value = $(this).data('url');
        document.body.appendChild(textArea);
        textArea.select();

        try {
            var successful = document.execCommand('copy');
        } catch (err) {
            console.log('Oops, unable to copy');
        }
		
        document.body.removeChild(textArea);
	});

    $(".store-form-btn, .update-form-btn").click(function(e){		
	
		let formData = {};
		let fieldsMain = {};
		let fields = {};
		let fieldsVariant = {};

		let htmlEr = '';
		let arErr = [];
		let hasErr = false;

        let _token   = $('meta[name="csrf-token"]').attr('content');

		let url = "/mng/forms/store";

		if($(this).hasClass('update-form-btn')){
			formData.form_id = $('#fid').val();
		}
				
		$('.form-err').fadeOut();

		$( ".form-main-field" ).each(function( index ) {

			fieldsMain[$(this).data("name")] = $(this).val();
			
		});

		$( ".form-field" ).each(function( index ) {

			fields[$(this).data("id")] = {
				'name' : $(this).val(),
				'type' : $(this).data('type'),
				'step' : 1,
				'description' : '-',
				'sort' : $(this).data('sort'),
				'size' : $(this).data('size'),
				'required' : $(this).data('required')
			};
			
		});
		
		$( ".form-field-variant" ).each(function( index ) {


			fieldsVariant[$(this).data('id')] = {
				'field_id' : $(this).data('field-id'),
				'name' : $(this).val(),
				'sort' : $(this).data('sort'),
				'points' : $(this).data('points'),
				'description' : '-',
				'required' : $(this).data('required')
			};
			
		});
				
		formData._token = _token;
		formData.form = fieldsMain;
		formData.fields = fields;
		formData.fieldsVariant = fieldsVariant;				

		if(arErr.length == 0 && !hasErr){

		$.ajax({
			url: url,
			type: "POST",
			data: formData,
			dataType : 'json',
			success: function(data){
				
				if( data['status'] == "success" ) {
					
					Message.showSuccess('Инфо','Спасибо! Форма была сохранена!','Ок, понятно', function () {
						location.reload();
					});
					
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
			
		e.preventDefault();
	});

	$(document).on("click", ".change-points", function (e) {
		
		$(this).addClass('active');
		$(this).html('Сохранить оценку');
		$('.points-field-wrap').css('display', 'block');

		e.preventDefault();

	});

	$(document).on("click", ".change-points.active", function (e) {
		
		let formData = {};
		let fields = {};
		let arErr = [];
		let hasErr = false;
        let _token   = $('meta[name="csrf-token"]').attr('content');
		
		$( '.points-field' ).each(function( index ) {
			fields[$(this).data('id')] = $(this).val();		
		});
		
		formData._token = _token;
		formData.fields = fields;
		formData.resume_id = $('#rid').val();
		
		if(arErr.length == 0 && !hasErr){

		$.ajax({
			url: '/mng/resume/points-change',
			type: "POST",
			data: formData,
			dataType : 'json',
			success: function(data){
				
				if( data['status'] == "success" ) {
					
					CommonForm.success('Сообщение', 'Баллы были изменены', 'Ок, понятно', function() {
						location.reload();
					});
					
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

		e.preventDefault();
	});

	$(document).on("click", "#comment-save-btn", function (e) {

		let url = '/comments/store';
		let title = 'Инфо';
		let text = 'Спасибо. Ваш комментарий был добавлен.';
		let button = 'Ок';

		CommonForm.store(url, title, text, button, 'comment', function(){$('#comment').val('');}, function(){ location.reload();});
		e.preventDefault();
	});

	$(document).on("click", "#interview-save-btn", function (e) {

		let url = '/mng/interviews/store';
		let title = 'Инфо';
		let text = 'Спасибо. Новое собеседование было добавлено.';
		let button = 'Ок';

		CommonForm.store(url, title, text, button, 'interview', function(){}, function(){ location.reload();});
		e.preventDefault();
	});

	$(document).on("click", "#test-save-btn", function (e) {

		let url = '/mng/tests/store';
		let title = 'Инфо';
		let text = 'Спасибо. Новый тест был добавлен.';
		let button = 'Ок';

		CommonForm.store(url, title, text, button, 'test', function(){}, function(){ location.reload();});
		e.preventDefault();
	});

	$(document).on("click", "#test-edit-btn", function (e) {

		let url = '/mng/tests/update';
		let title = 'Инфо';
		let text = 'Спасибо. Тест был отредактирован.';
		let button = 'Ок';

		CommonForm.store(url, title, text, button, 'test', function(){}, function(){ location.reload();});
		e.preventDefault();
	});

	/**
	 * questions
	 */

	 $(document).on("click", ".plus-answer-variant", function () {
		let htmlType = [];
		let type = $('.question-type').val();

		const answersCount = document.querySelectorAll('.question-type-'+type+' .answer-title').length + 1;
		htmlType.push(`<div class="mb-3"><label class="answer-title answer-title-1" for="">Ответ №${answersCount}:</label>
		<span class="right-answer state-label">Правильный</span><textarea data-id="new-${currentId}" data-is_right="" class="form-answer-field" name="answer" type="text" value=""></textarea>
	</div>`);
		htmlType.push(``);
		htmlType.push(`
		<div class="mb-3">
		<label class="answer-title answer-title-3" for="">Ответ-сопоставление №${answersCount}:</label>
		<div class="flex">
			<textarea data-id="new-${currentId}" data-pair="new-${currentId}" class="form-answer-field mr-3" name="answer" type="text" value=""></textarea>
			<textarea data-id="new-${currentId++}" data-pair="new-${currentId-1}" class="form-answer-field" name="answer" type="text" value=""></textarea>
		</div>
		</div>
		`);

		htmlType.push(`
		<div class="mb-3">
		<label class="answer-title answer-title-3" for="">Ответ-хронология №${answersCount}:</label>
		<div class="flex">
			<textarea data-id="new-${currentId}" data-chrono="${answersCount}" class="form-answer-field" name="answer" type="text" value=""></textarea>
		</div>
		</div>
		`);
		
		$(this).parent().parent().find('.question-type-'+type).find('.answers-wrap').append(htmlType[type-1]);
		currentId++;

	});

	$(document).on("click", ".right-answer", function () {
		$(this).toggleClass("active");
		let is_right = $(this).hasClass("active") ? 1 : 0;
		$(this).parent().find(".form-answer-field").data("is_right", is_right);
		
	});

	$(document).on("click", ".question-type-tab-title li", function () {
		$(".question-type-tab-title li").removeClass("active");
		$(".question-type-tab").removeClass("active");
		$(this).addClass("active");
		let type = $(this).data("type");
		$(".question-type").val(type);
		$(".question-type-"+type).addClass("active");
		
	});

	$(".store-question-btn").click(function(e){		
	
		let formData = {};
		let fieldsMain = {};
		let fields = {};

		let htmlEr = '';
		let arErr = [];
		let hasErr = false;

        let _token   = $('meta[name="csrf-token"]').attr('content');
		let type = $('.question-type').val();
		
		$('.form-err').fadeOut();

		$( ".form-main-field" ).each(function( index ) {
			fieldsMain[$(this).data("name")] = $(this).val();
		});

		$( ".question-type-" + type + " .form-answer-field" ).each(function( index ) {
			fields[$(this).data("id")] = {
				'answer' : $(this).val(),
				'is_right' : $(this).data('is_right'),
				'pair' : $(this).data('pair'),
				'chrono' : $(this).data('chrono'),
			};
		});
		
				
		formData._token = _token;
		formData.form = fieldsMain;
		formData.fields = fields;			

		if(arErr.length == 0 && !hasErr){

		$.ajax({
			url: "/mng/questions/store",
			type: "POST",
			data: formData,
			dataType : 'json',
			success: function(data){
				
				if( data['status'] == "success" ) {
					
					Message.showSuccess('Инфо','Спасибо! Вопрос был сохранен!','Ок, понятно', function () {
						location.reload();
					});
					
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
			
		e.preventDefault();
	});

	/**
	 * actions in resume
	 */

	$(document).on("click", "#assign-test", function (e) {
				 
		let id = $('#rid').val();
		let btn = '<a id="store-assign-btn" class="store-assign-btn inline-block my-2 bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 mr-2 rounded mb-6" href="#">Сохранить</a><a id="close-message-btn" class="close-btn" href="#">Закрыть</a>';


		CommonForm.getData('/mng/tests/getlist', {id}, btn, 40, function(){
			
		});
		
		e.preventDefault();
		
	});

	$(document).on("click", "#store-assign-btn", function (e) {
		
		let params = {};
		let testId = [];
		let htmlEr = '';

		$('.message-err').html('');
		$('.message-err').fadeOut();

		params._token = $('meta[name="csrf-token"]').attr('content'); 
		params.resume_id = $('#rid').val();
		$( ".test-field" ).each(function( index ) {
			if($(this).prop('checked')) {testId.push($(this).data('id'));}
		});

		params.test_id = testId; 

		if(testId.length > 0){
	

			$.ajax({
				url: '/mng/tests/assign',
				type: "POST",
				dataType: "json",
					data: (params),
				success: function(data){
					
					let url = '';

					for (let k in data.url) {
						url += '<br/><a href='+data.url[k]+'>перейти к тестированию</a>'
					}
					
					CommonMessage.change('Тест успешно назначен! Ссылка на тест: ' + url,'<a id="close-message-btn" class="close-btn inline-block my-2 bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 mr-2 rounded mb-6" href="#">Закрыть</a>');
									   
				},
				error : function(e) {
				   console.log(e);
				}
	   });

		}else{
			htmlEr = 'Выберите назначаемый тест';
			$('.message-err').html(htmlEr);
			$('.message-err').fadeIn();
		}

		e.preventDefault();
	});

	$(document).on("click", "#create-interview", function (e) {
				 
		let id = $('#rid').val();
		let btn = '<a id="store-interview-btn" class="store-interview-btn inline-block my-2 bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 mr-2 rounded mb-6" href="#">Сохранить</a><a id="close-message-btn" class="close-btn" href="#">Закрыть</a>';


		CommonForm.getData('/mng/interviews/ajax/create', {id}, btn, 25, function(){
			
			$('.date-time').datetimepicker({
				format: 'd.m.Y H:i',
				formatTime: 'H:i',
				formatDate: 'd.m.Y',
				defaultDate : new Date()
			});

		});
		
		e.preventDefault();
		
	});

	$(document).on("click", "#store-interview-btn", function (e) {
		
		let params = {};
		let htmlEr = '';
		let fields = {};

		$('.message-err').html('');
		$('.message-err').fadeOut();

		let _token = $('meta[name="csrf-token"]').attr('content'); 
		
		fields['resume-id'] = $('#rid').val();
		fields['datetime'] = $('.date-time').val(); 
		
		params.fields = fields;
		params._token = _token;

		if(params.fields['datetime']){
	

			$.ajax({
				url: '/mng/interviews/store',
				type: "POST",
				dataType: "json",
				data: params,
				success: function(data){
					
					
					CommonMessage.change('Собеседование назначено на '+params.fields['datetime'],'<a id="close-message-btn" class="close-btn inline-block my-2 bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 mr-2 rounded mb-6" href="#">Закрыть</a>');
									   
				},
				error : function(e) {
				   console.log(e);
				}
	   });

		}else{
			htmlEr = 'Выберите дату собеседования';
			$('.message-err').html(htmlEr);
			$('.message-err').fadeIn();
		}

		e.preventDefault();
	});

	


})