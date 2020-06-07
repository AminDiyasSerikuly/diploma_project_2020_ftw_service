$(document).ready(function(){
		$(document).on('click','#btn-more',function(){
			var id = $(this).data('id');
			var find = '{{ request("find") }}';
			var offers = [];
			$.each($("input[name='offers']:checked"), function(){            
	            offers.push($(this).val());
	        });
			var bs = [];
			$.each($("input[name='bs']:checked"), function(){            
	            bs.push($(this).val());
	        });
			var beside = [];
			$.each($("input[name='beside']:checked"), function(){            
	            beside.push($(this).val());
	        });
			var status 	= $(this).children("option:selected").val();
			if(status === ''){
				status = 0;
			}
			var cat = [];
			$.each($("input[name='cat']:checked"), function(){            
	            cat.push($(this).val());
	        });
			$("#btn-more").html("Загрузка....");
			$.ajax({
				url : '{{ url("/tasks/ajaxupload") }}',
				method : "POST",
				data : {id:id, find:find, cat:cat.join(","), offers:offers, beside:beside, status:status, _token:"{{ csrf_token() }}"},
				dataType : "text",
				success : function (data) {
					if(data != '') {
						$('#remove-row').remove();
						$('#load-data').append(data);
					} else {
						$("#btn-more").hide();
						M.toast({html: 'Больше нет заданий'})
					}
				}
			});
		}); 
		$(document).on('change','#btn-status',function(){
			var find 	= $('#__js-filter-search').val();
			var offers = [];
			$.each($("input[name='offers']:checked"), function(){            
	            offers.push($(this).val());
	        });
			var bs = [];
			$.each($("input[name='bs']:checked"), function(){            
	            bs.push($(this).val());
	        });
			var beside = [];
			$.each($("input[name='beside']:checked"), function(){            
	            beside.push($(this).val());
	        });
			var status 	= $(this).children("option:selected").val();
			if(status === ''){
				status = 0;
			}
			var cat = [];
			$.each($("input[name='cat']:checked"), function(){            
	            cat.push($(this).val());
	        });
			window.location.href="/tasks?sortBy={{ request("sortBy") }}find="+find+"&status="+status+"&offers="+offers+"&bs="+bs+"&beside="+beside+"&cat="+cat.join(",");
		});
		$(document).on('click','#btn-search',function(){
			var find 	= $('#__js-filter-search').val();
			var offers = [];
			$.each($("input[name='offers']:checked"), function(){            
	            offers.push($(this).val());
	        });
			var bs = [];
			$.each($("input[name='bs']:checked"), function(){            
	            bs.push($(this).val());
	        });
			var beside = [];
			$.each($("input[name='beside']:checked"), function(){            
	            beside.push($(this).val());
	        });
			var status 	= $(this).children("option:selected").val();
			if(status === ''){
				status = 0;
			}
			var cat = [];
			$.each($("input[name='cat']:checked"), function(){            
	            cat.push($(this).val());
	        });
			window.location.href="/tasks?sortBy={{ request("sortBy") }}&find="+find+"&status="+status+"&offers="+offers+"&bs="+bs+"&beside="+beside+"&cat="+cat.join(",");
		});
		$(document).on('click','.__js-filter-sortby-time',function(){
			var find 	= $('#__js-filter-search').val();
			var offers = [];
			$.each($("input[name='offers']:checked"), function(){            
	            offers.push($(this).val());
	        });
			var bs = [];
			$.each($("input[name='bs']:checked"), function(){            
	            bs.push($(this).val());
	        });
			var beside = [];
			$.each($("input[name='beside']:checked"), function(){            
	            beside.push($(this).val());
	        });
			var status 	= $(this).children("option:selected").val();
			if(status === ''){
				status = 0;
			}
			var cat = [];
			$.each($("input[name='cat']:checked"), function(){            
	            cat.push($(this).val());
	        });
			window.location.href="/tasks?sortBy=urgently&find="+find+"&status="+status+"&offers="+offers+"&bs="+bs+"&beside="+beside+"&cat="+cat.join(",");
		});
		$(document).on('click','.__js-filter-sortby-date',function(){
			var find 	= $('#__js-filter-search').val();
			var offers = [];
			$.each($("input[name='offers']:checked"), function(){            
	            offers.push($(this).val());
	        });
			var bs = [];
			$.each($("input[name='bs']:checked"), function(){            
	            bs.push($(this).val());
	        });
			var beside = [];
			$.each($("input[name='beside']:checked"), function(){            
	            beside.push($(this).val());
	        });
			var status 	= $(this).children("option:selected").val();
			if(status === ''){
				status = 0;
			}
			var cat = [];
			$.each($("input[name='cat']:checked"), function(){            
	            cat.push($(this).val());
	        });
			window.location.href="/tasks?sortBy=last&find="+find+"&status="+status+"&offers="+offers+"&bs="+bs+"&beside="+beside+"&cat="+cat.join(",");
		});
		$(document).on('change','.check',function(){
			var find 	= $('#__js-filter-search').val();
			var offers = [];
			$.each($("input[name='offers']:checked"), function(){            
	            offers.push($(this).val());
	        });
			var bs = [];
			$.each($("input[name='bs']:checked"), function(){            
	            bs.push($(this).val());
	        });
			var beside = [];
			$.each($("input[name='beside']:checked"), function(){            
	            beside.push($(this).val());
	        });
			var status 	= $(this).children("option:selected").val();
			if(status === ''){
				status = 0;
			}
			var cat = [];
			$.each($("input[name='cat']:checked"), function(){            
	            cat.push($(this).val());
	        });
			window.location.href="/tasks?sortBy={{ request("sortBy") }}&find="+find+"&status="+status+"&offers="+offers+"&bs="+bs+"&beside="+beside+"&cat="+cat.join(",");
		});
	});