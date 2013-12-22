class Members
	delete: (id) ->
		$.ajax
			type: 'post',
			url: '/members/' + id + '/delete',
			dataType: 'json',
			data: {
				'method': "delete",
				'project_id': $('#project').data('projectid')
			},

			success: (data) ->
				if data.status is 'error'
					alert data.error
				else
					location.href = '/projects/' + $('#project').data('projectid') + '/members'
$ ->
	members = new Members

	$('.btn-delete-member').click ->
		members.delete $(this).data('id')
		return false

