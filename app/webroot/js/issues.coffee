class Issues

	get_issues: (elm) ->
		$.ajax
			type: 'get',
			url: elm.attr('href'),
			dataType: 'json',
			success: (data) ->
				if(data.error != "")
					alert data.error
				$('#issues').html(data.html)
	get_assignee: (elm) ->
		project_id = $('#IssueProjectId').attr('value')
		checked = if elm.prop('checked') then '1' else ''
		$.ajax
			type: 'get'
			url: "/issues/" + project_id + "/assignee/"
			data:
				github: checked
			dataType: 'json'
			success: (collection, dataType) ->
				$('#assignee-select-box').html(collection.html)
			error: (XMLHttpRequest, textStatus, errorThrown) ->
				alert("ERROR: " + textStatus)
$ ->
	issues = new Issues

	$(document).on 'click', '.btn-iss-status', ->
		issues.get_issues $(this)
		return false
	$(document).on 'change', '#IssueGithub', ->
		issues.get_assignee $(this)
		return false
