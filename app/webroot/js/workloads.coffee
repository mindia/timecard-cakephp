class Workloads
  Workloads = ->
  computeDuration = (ms) ->
    h = String(Math.floor(ms / 3600000) + 100).substring(1)
    m = String(Math.floor((ms - h * 3600000) / 60000) + 100).substring(1)
    s = String(Math.round((ms - h * 3600000 - m * 60000) / 1000) + 100).substring(1)
    h + ":" + m + ":" + s
  get_workloads: (elm) ->
    user_id = $('#user-name').data('user-id')
    year = elm.data('year')
    month = elm.data('month')
    day = elm.data('day')
    $.ajax
    	type: 'get',
    	url: "/users/#{user_id}/workloads/#{year}/#{month}/#{day}",
    	dataType: 'json',
    	success: (data) ->
          $(elm).closest('ul').find('li.active').removeClass('active')
          $(elm).closest('li').addClass('active')
          if(data.error != "")
            alert data.error
            return

          if(data.length == 0)
            $('.table-workload-complete tbody').html('')
            return
          html = ''
          $.each data, (i, val) ->
            project = val['Project']['name']
            issue = val['Issue']['subject']
            work_hour = val['Workload']['start_at'].slice(10) + ' - ' + val['Workload']['end_at'].slice(10)
            time = val['Workload']['progress_time']
            html += '<tr><td><a href="/projects/' + val['Issue']['project_id'] + '">' + project + '</a></td>'
            html += '<td><a href="/issues/' + val['Issue']['id']  + '">' + issue + '</td>'
            html += '<td>' + work_hour + '</td>'
            html += '<td>' + time + '</td></tr>'
          $('.table-workload-complete tbody').html(html)

$ ->
  workload = new Workloads
  workload.get_workloads $('li.active a')
  $('.dashboards').on 'click', '.js-workloads-on-day-link', ->
  	workload.get_workloads $(this)
  	return false

