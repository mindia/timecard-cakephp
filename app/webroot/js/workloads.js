var Workloads;

Workloads = (function() {

  function Workloads() {}

  function computeDuration(ms){
    var h = String(Math.floor(ms / 3600000) + 100).substring(1);
    var m = String(Math.floor((ms - h * 3600000)/60000)+ 100).substring(1);
    var s = String(Math.round((ms - h * 3600000 - m * 60000)/1000)+ 100).substring(1);
    return h+':'+m+':'+s;
  }

  Workloads.prototype.get_workloads = function(elm) {
    var day, month, user_id, year;
    user_id = $('#user-name').data('user-id');
    year = elm.data('year');
    month = elm.data('month');
    day = elm.data('day');
    return $.ajax({
      type: 'get',
      url: "/users/" + user_id + "/workloads/" + year + "/" + month + "/" + day,
      dataType: 'json',
      success: function(data) {
        var html;
        $(elm).closest('ul').find('li.active').removeClass('active');
        $(elm).closest('li').addClass('active');

        if (data.length == 0) {
          $('.table-workload-complete tbody').html('');
          return;
        }
        html = '';
        $.each(data, function(i, val) {
          var issue, project, time, work_hour;
          project = val['Project']['name'];
          issue = val['Issue']['subject'];
          work_hour = val['Workload']['start_at'].slice(10) + ' - ' + val['Workload']['end_at'].slice(10);
          time = val['Workload']['progress_time'];
          html += '<tr><td><a href="/projects/' + val['Issue']['project_id'] + '">' + project + '</a></td>'
          html += '<td><a href="/issues/' + val['Issue']['id']  + '">' + issue + '</td>'
          html += '<td>' + work_hour + '</td>';
          html += '<td>' + time + '</td></tr>';
        });
        return $('.table-workload-complete tbody').html(html);
      }
    });
  };

  return Workloads;

})();

$(function() {
  var workload;
  workload = new Workloads;
  workload.get_workloads($('li.active a'));
  return $('.dashboards').on('click', '.js-workloads-on-day-link', function() {
    workload.get_workloads($(this));
    return false;
  });
});
