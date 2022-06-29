$(document).ready(function() {
	$("form").submit(function() {
		
		var $form = $(this);

		if (validateForm($form)) {
			var data_utm = {
				'utm_source'   : $_GET('utm_source'),
				'utm_medium'   : $_GET('utm_medium'),
				'utm_campaign' : $_GET('utm_campaign'),
				'utm_content'  : $_GET('utm_content'),
				'utm_term'     : $_GET('utm_term'),
			};
			
			var data = $form.serialize();
			$.post(
				"./mail/mail.php",
				data + '&' + $.param(data_utm),
				function(resp) {
					// yaCounter45735288.reachGoal('order');
					// ga('send', 'event', 'order', 'order');
					// alert('Ваши данные переданы. Благодарим за заявку!');
					// document.location.href = 'thx.html';
				}
			);
			
			$.fancybox.close();
			
			setTimeout(function() {
				$.fancybox.open({
					href: '#thx'
				});
			}, 1000);
			
			
		} else {
			return false;
		}
		return false;
	});

});

function validateForm($form) {
	var valid = true;
	$form.find(".required").each(function(index, element) {
		if ($(element).val() == "") {
			$(element).addClass("error");
			valid = false;
		}
		else {
			$(element).removeClass("error");
		}
	});
	return valid;
}


function $_GET(key) {
	var s = window.location.search;
	s = s.match(new RegExp(key + '=([^&=]+)'));
	return s ? s[1] : '';
}