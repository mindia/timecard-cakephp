class Issues

	get_issues: (elm) ->
		$.ajax
			type: 'get',
			url: elm.attr('href'),
			dataType: 'json',
			success: (data) ->
				if(data.error != "")
					alert data.error
				$('#issues').html(data.html);
$ ->
	issues = new Issues

	$(document).on 'click', '.btn-iss-status', ->
		issues.get_issues $(this)
		return false

