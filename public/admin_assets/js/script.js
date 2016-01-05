$(document).ready( function () {
	$('.adduploadimagesinput').click(function () {
		$('#uploadimages .inputs').append("<input type='file' name='images[]'><br>");
	});
	$('.addvars').click(function (event) {
		event.preventDefault();
		$.ajax({
			url: "ajax.php",
			type: "GET",
			data: "do=addvars",
			success: function (data) {
				var data = $.parseJSON(data);
				if (data.st == 'ok') {
					$(".content .clear").prepend('<div class="inline-block" id="' + data.id + '"><div class="inline-title"><span>Содержимое</span></div><div class="inline-value"><input class="inputbox" type="text" name="value" value=""></div><div class="inline-title"><span>Код вставки</span></div><div class="inline-value"><input class="inputbox" type="text" name="code" value="{var id=' + data.id + '}" disabled=""></div><a href="" class="btn add savevar"><i class="fa pull-left fa-floppy-o"></i>Сохранить</a><a href="" class="btn del delvar"><i class="fa pull-left fa-minus-square-o"></i>Удалить</a></div>');
				} else alert('Возникла ошибка при выполнении запроса');
			}
		});
	});
	$(document).on('click', '.savevar', function (event) {
		event.preventDefault();
		var val = $(this).parents('.inline-block').find("input[name='value']").val();
		var id = $(this).parents('.inline-block').attr('id');

		$.ajax({
			url: "ajax.php",
			type: "GET",
			data: "do=savevar&val=" + val + "&id=" + id,
			success: function (data) {
				var data = $.parseJSON(data);
				if (data.st == 'ok') {
					alert('Успешно сохранено');
				} else alert('Возникла ошибка при выполнении запроса');
			}
		});
	})
	$(document).on('click', '.delvar', function (event) {
		event.preventDefault();
		var id = $(this).parents('.inline-block').attr('id');

		$.ajax({
			url: "ajax.php",
			type: "GET",
			data: "do=delvar&id=" + id,
			success: function (data) {
				var data = $.parseJSON(data);
				if (data.st == 'ok') {
					$(".content .clear #" + id).remove();
				} else alert('Возникла ошибка при выполнении запроса');
			}
		});
	});
	$(document).on('click', '.changepass', function (event) {
		event.preventDefault();
		var oldpass = $(this).parents('.clear').find('input[name="oldpass"]').val();
		var newpass = $(this).parents('.clear').find('input[name="newpass"]').val();
		var newpass2 = $(this).parents('.clear').find('input[name="newpass2"]').val();

		if (oldpass != "" && newpass != "" && newpass2 != "") {
			if (newpass2 == newpass) {
				$.ajax({
					url: "ajax.php",
					type: "GET",
					data: "oldpass=" + oldpass + "&newpass=" + newpass + "&newpass2=" + newpass2,
					success: function (data) {
						var data = $.parseJSON(data);
						if (data.st == 'ok') {
							alert("Пароль был изменён. Вам нужно будет перезайти");
							location.reload();
						} else if (data.st == 'empty') alert("Заполните все поля");
						else if (data.st == 'newpass') alert("Новые пароли не совпадают");
						else if (data.st == 'oldpass') alert("Старый пароль введен не верно");
						else alert("Возникла ошибка при выполнении запроса");
					}
				});
			} else alert("Новые пароли не совпадают");
		} else alert("Заполните все поля");
	});
	$(document).on('click', '.showupload', function (event) {
		event.preventDefault();

		$(".upload-group").show();
	});
	$(document).on('click', '.delfotos', function (event) {
		event.preventDefault();

		var data = "do=delfotos";
		var del_arr = [];
		$(".images-list .image-item input[type='checkbox']:checked").each( function (index, value) {
			var id = $(value).parents(".image-item").attr('id');
			data = data + "&id[]=" + id;
			del_arr.push(id);
		});
		$.ajax({
			url: "ajax.php",
			type: "GET",
			data: data,
			success: function (data) {
				var data = $.parseJSON(data);
				if (data.st == 'ok') {
					$.each(del_arr, function(index, value) {
						$(".images-list #" + value).remove();
					});
				} else alert("Возникла ошибка при выполнении запроса");
			}
		});
	});
	$(document).on('click', '.uploadpreview', function (event) {
		event.preventDefault();
		var data = new FormData($(".uploadpreviewform")[0]);

		$.ajax({
			url: "ajax.php",
			type: "POST",
			contentType: false,
			processData: false,
			data: data,
			success: function (data) {
				var data = $.parseJSON(data);
				if (data.st == 'ok') {
					$(".viewuploadpreview").empty().append('<div class="image-item" id="' + data.name + '"><div class="controls"><a onclick=\'delete_foto_path("preview", "' + data.name + '")\' class="del delimage" title=""><i class="fa fa-trash"></i></a></div><div class="image"><img src="../fotos/preview/' + data.name + '.jpg" alt=""></div></div>');
					$(".uploadpreviewform").append("<input name='path' type='hidden' value='" + data.name +  "''>");
				}
			}
		});
	});
	$(document).on('click', '.uploadspreview', function (event) {
		event.preventDefault();
		var data = new FormData($(".uploadspreviewform")[0]);

		$.ajax({
			url: "ajax.php",
			type: "POST",
			contentType: false,
			processData: false,
			data: data,
			success: function (data) {
				var data = $.parseJSON(data);
				if (data.st == 'ok') {
					$.each(data.arr, function(index, value) {
						$(".viewuploadspreview .images-list").append('<div class="image-item" id="' + value + '"><input type="hidden" name="paths[]" value="' + value + '"><div class="controls"><a onclick=\'delete_foto_path("spreview", "' + value + '")\' class="del delimage" title=""><i class="fa fa-trash"></i></a></div><div class="image"><img src="../fotos/spreview/' + value + '.jpg" alt=""></div></div>');
					});
				}
			}
		});
	});
	$(document).on('click', '.addevent', function(event) {
		event.preventDefault();

		$.ajax({
			url: "ajax.php",
			type: "GET",
			data: $(".pathsform").serialize() + "&" +  $(".uploadpreviewform").serialize(),
			success: function (data) {
				var data = $.parseJSON(data);
				if (data.st == 'ok') {
					alert("Событие добавлено, перенаправление на страницу редактирования");
					window.location = "?do=events&subaction=add&id=" + data.id;
				} else if (data.st == 'save') {
					alert("Событие сохранено");
					window.location = "?do=events";
				} else alert("Возникла ошибка при выполнении запроса");
			}
		});
	});
	$(document).on('click', 'input[name="deleventsall"]', function () {
		if ($("input[name='deleventsall']").prop("checked")) {
			$("input[name='delevents[]']").prop("checked", "checked");
		} else $("input[name='delevents[]']").prop("checked", "");
	});
	$(document).on('click', '.delevents', function (event) {
		event.preventDefault();
		var del = "do=delevents";
		var delarr = [];
		$(".events-list input[name='delevents[]']:checked").each(function (index, value) {
			var id = $(value).parents('tr').attr('id');
			del = del + "&delevents[]=" + id;
			delarr.push(id);
		});

		$.ajax({
			url: "ajax.php",
			type: "GET",
			data: del,
			success: function (data) {
				var data = $.parseJSON(data);
				if (data.st == 'ok') {
					$.each(delarr, function(index, value) {
						$(".events-list #" + value).remove();
					});
				} else alert("Возникла ошибка при выполнении запроса");
			}
		});
	});	
	$(document).on('click', '.saveseances', function(event) {
		event.preventDefault();
		var data = "do=saveseances";

		$(".box-content .inline-block").each(function (index, value) {
			var id = $(value).attr('id');
			var cid = $(value).parent().attr('id');
			if (cid != undefined && cid > 14000000) var more = "&type[" + id + "]=1";
			else var more = "&type[" + id + "]=0";
			var time = $(value).find("input[name='time']").val();
			var price = $(value).find("input[name='price']").val();
			data = data + "&time[" + id + "]=" + time + "&price[" + id + "]=" + price + more;
		});

		$.ajax({
			url: "ajax.php",
			type: "GET",
			data: data,
			success: function (data) {
				var data = $.parseJSON(data);
				if (data.st == 'ok') {
					alert("Сеансы сохранены");
				} else alert("Возникла ошибка при выполнении запроса");
			}
		});
	});
	$(document).on('click', '.droplist-group', function () {
		var display = $(this).find(".droplist").css('display');
		if (display == 'none') $(this).find(".droplist").show();
		else $(this).find(".droplist").hide();
	});
	$(document).on('click', '.delsubmitted', function (event) {
		event.preventDefault();
		var data = "do=delsubmitted";
		var del_arr = [];

		$(".clear td input[type='checkbox']:checked").each(function (index, value) {
			var id = $(value).parents('tr').attr('id');
			data = data + "&dsuid[]=" + id;
			del_arr.push(id);
		});

		$.ajax({
			url: "ajax.php",
			type: "GET",
			data: data,
			success: function (data) {
				var data = $.parseJSON(data);
				if (data.st == 'ok') {
					$.each(del_arr, function(index, value) {
						$(".clear #" + value).remove();
					});
				} else alert("Возникла ошибка при выполнении запроса");
			}
		});
	}); 
	$(document).on('click', '.delstatic', function (event) {
		event.preventDefault();
		var data = "do=delstatic";
		var del_arr = [];

		$(".clear td input[type='checkbox']:checked").each(function (index, value) {
			var id = $(value).parents('tr').attr('id');
			data = data + "&spid[]=" + id;
			del_arr.push(id);
		});

		$.ajax({
			url: "ajax.php",
			type: "GET",
			data: data,
			success: function (data) {
				var data = $.parseJSON(data);
				if (data.st == 'ok') {
					$.each(del_arr, function(index, value) {
						$(".clear #" + value).remove();
					});
				} else alert("Возникла ошибка при выполнении запроса");
			}
		});
	}); 
	$(document).on('click', '.addstatic', function (event) {
		event.preventDefault();

		var id = $("input[name='id']").val();
		var name = $("input[name='title']").val();
		var text = $("textarea[name='text']").val();
		var preview = $("input[name='path']").val();
		var price = $("input[name='price']").val();

		$.ajax({
			url: "ajax.php",
			type: "GET",
			data: "do=addstatic&id=" + id + "&name=" + name + "&text=" + text + "&preview=" + preview + "&price=" + price,
			success: function (data) {
				var data = $.parseJSON(data);
				if (data.st == 'ok') {
					if (data.id != undefined) location.href = '?do=static&subaction=edit&id=' + data.id; 
					else location.href = '?do=static';
				} else alert("Произошла ошибка при выполнении запроса");
			}
		})
	});
	$(document).on('click', '.makestats', function(event) {
		event.preventDefault();
		var quest = $("select[name='quest-name'] option:selected").val();
		var start_date = $("#dateinput-from").val();
		var end_date = $("#dateinput-to").val()

		$.ajax({
			url: "ajax.php",
			type: "GET",
			data: "do=makestats&quest=" + quest + "&datefrom=" + start_date + "&dateto=" + end_date,
			success: function (data) {
				var data = $.parseJSON(data);
				if (data.st == 'ok') {
					location.href = 'ajax.php?do=download';
				} else alert('Возникла ошибка при выполнении запроса');
			}
		});
	});
	$(function() {
	  $('.tabs').on('click', 'li:not(.active)', function() {
		$(this).addClass('active').siblings().removeClass('active')
		  .parents('.tab-block').find('section').eq($(this).index()).fadeIn(150).siblings('section').hide();
	  })
	});
});

function delete_vars(id) {
	$.ajax({
		url: "ajax.php",
		type: "GET",
		data: "id=" + id,
		success: function (data) {
			var data = $.parseJSON(data);
			if (data.st == 'ok') $(".content .clear #" + id).remove();
			else alert('Возникла ошибка при выполнении запроса');
		}
	});
}
function delete_foto(id) {
	$.ajax({
		url: "ajax.php",
		type: "GET",
		data: "pid=" + id,
		success: function (data) {
			var data = $.parseJSON(data);
			if (data.st == 'ok') $(".images-list #" + id).remove();
		 	else alert('Возникла ошибка при выполнении запроса');
		}
	});
}
function delete_foto_path(path, value) {
	$.ajax({
		url: "ajax.php",
		type: "GET",
		data: "delpath=" + path + "&pathid=" + value,
		success: function (data) {
			var data = $.parseJSON(data);
			if (data.st == 'ok') $("#" + value).remove();
			else alert('Возникла ошибка при выполнении запроса');
		}
	})
}
function change_display(id, value) {
	$.ajax({
		url: "ajax.php",
		type: "GET",
		data: "cdid=" + id + "&value=" + value,
		success: function (data) {
			var data = $.parseJSON(data);
			if (data.st == 'ok') {
				if (value == 0) $(".events-list #" + id + " .show").empty().append('<a onclick="change_display(' + id + ', 1)" class="btn status disabled"><i class="fa fa-plug"></i></a>');
				else $(".events-list #" + id + " .show").empty().append('<a onclick="change_display(' + id + ', 0)" class="btn status enabled"><i class="fa fa-chevron-down"></i></a>');
			} else alert("Возникла ошибка при выполнении запроса");
		}
	});
}
function add_seance(id, day) {
	$.ajax({
		url: "ajax.php",
		type: "GET",
		data: "asid=" + id + "&asday=" + day,
		success: function (data) {
			var data = $.parseJSON(data);
			if (data.st == 'ok') {
				$("#" + data.day).prepend('<div class="inline-block" id="' + data.id + '"><div class="inline-title">Время</div><div class="inline-value"><input class="inputbox" type="text" name="time" value="0"></div><div class="inline-title">Цена</div><div class="inline-value"><input class="inputbox" type="text" name="price" value="0"></div><div class="btn-group"><a onclick="delete_seance(' + data.id + ')" class="btn del"><i class="fa pull-left fa-minus-square-o"></i>Удалить</a></div></div>');
			} else alert("Возникла ошибка при выполнении запроса");
		}
	});
}
function delete_seance(id) {
	$.ajax({
		url: "ajax.php",
		type: "GET",
		data: "dsid=" + id,
		success: function (data) {
			var data = $.parseJSON(data);
			if (data.st == 'ok') {
				$("#" + id).remove();
			} else alert("Возникла ошибка при выполнении запроса");
		}
	});
}
function date_seance() {
	$.ajax({
		url: "ajax.php",
		type: "GET",
		data: "do=getfile&filename=popup",
		success: function (data) {
			$("body").append(data);
		}
	})
}
function close_popup() {
	$("#popup").remove();
}
function add_date_seance() {
	var date = $("#popup input[name='date']").val();
	var id = $(".dateseances").attr('id');

	$.ajax({
		url: "ajax.php",
		type: "GET",
		data: "do=add_date_seance&date=" + date + "&id=" + id,
		success: function (data) {
			var data = $.parseJSON(data);
			if (data.st == 'ok') {
				location.reload();
			} else alert("Возникла ошибка при выполнении запроса");
		}
	});
}
function add_seance_date(id, time) {
	$.ajax({
		url: "ajax.php",
		type: "GET",
		data: "asdid=" + id + "&asdtime=" + time,
		success: function(data) {
			var data = $.parseJSON(data);
			if (data.st == 'ok') {
				$("#" + time).prepend('<div class="inline-block" id="' + data.id + '"><div class="inline-title">Время</div><div class="inline-value"><input class="inputbox" type="text" name="time" value="0"></div><div class="inline-title">Цена</div><div class="inline-value"><input class="inputbox" type="text" name="price" value="0"></div><div class="btn-group"><a onclick="delete_seance_date(' + data.id + ')" class="btn del delvar"><i class="fa pull-left fa-minus-square-o"></i>Удалить</a></div></div>');
			} else alert("Возникла ошибка при выполнении запроса");
		}
	})
}
function delete_seance_date(id) {
	$.ajax({
		url: "ajax.php",
		type: "GET",
		data: "dsdid=" + id,
		success: function (data) {
			var data = $.parseJSON(data);
			if (data.st == 'ok') {
				$(".dateseances #" + id).remove();
			} else alert("Возникла ошибка при выполнении запроса");
		}
	})
}
function accept(id) {
	$.ajax({
		url: "ajax.php",
		type: "GET",
		data: "do=accept&id=" + id,
		success: function (data) {
			var data = $.parseJSON(data);
			if (data.st == 'ok') {
				$(".clear #" + id).remove();
			} else if (data.st == 'busy') {
				alert("Данный сеанс уже занят");
			} else alert("Возникла ошибка при выполнении запроса");
		}
	});
}
function deny(id) {
	$.ajax({
		url: "ajax.php",
		type: "GET",
		data: "do=deny&id=" + id,
		success: function (data) {
			var data = $.parseJSON(data);
			if (data.st == 'ok') {
				$(".clear #" + id).remove();
			} else alert("Возникла ошибка при выполнении запроса");
		}
	});
}
function r_delete(id) {
	$.ajax({
		url: "ajax.php",
		type: "GET",
		data: "do=delete&id=" + id,
		success: function (data) {
			var data = $.parseJSON(data);
			if (data.st == 'ok') {
				$(".clear #" + id).remove();
			} else alert("Возникла ошибка при выполнении запроса");
		}
	});
}