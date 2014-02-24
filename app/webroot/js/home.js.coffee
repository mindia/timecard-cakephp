ready = ->
	navClick = ->
	  $("ul.project-nav li").each ->
	    $(this).removeClass "active"
	    return

	  $(this).parent().addClass "active"
	  location.href = $(this).attr("href")
	  getIssus $(this).attr("href")
	  return
	getIssus = (href) ->
	  path = href.split("/")
	  project_id = path[3]
	  issue_status = path[5]
	  $.ajax
	    type: "get"
	    url: "/issues/?project_id=" + project_id + "&status=" + issue_status
	    dataType: "json"
	    success: (data) ->
	      if data.error isnt ""
	        alert data.error
	        return
	      $(".btn-group-sm").html "<a href=\"/issues/?project_id=" + project_id + "&status=open\" class=\"btn btn-default btn-iss-status\" data-remote=\"true\">Open</a>" + "<a href=\"/issues/?project_id=" + project_id + "&status=closed\" class=\"btn btn-default btn-iss-status\" data-remote=\"true\">Closed</a>" + "<a href=\"/issues/?project_id=" + project_id + "&status=not_do_today\" class=\"btn btn-default btn-iss-status\" data-remote=\"true\">Don't do today</a>"
	      $("#issues").html data.html

	$("ul.project-nav li a").on "click", navClick
	location.href = $("ul.project-nav li a").first().attr("href")
	getIssus $("ul.project-nav li a").first().attr("href")
	return

$(document).ready ready
