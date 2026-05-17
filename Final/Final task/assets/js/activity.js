function filterActivity(projectId)
{
    var userId = document.getElementById("memberFilter").value;

    var xhttp = new XMLHttpRequest();

    xhttp.onreadystatechange = function()
    {
        if(this.readyState == 4 && this.status == 200)
        {
            var data = JSON.parse(this.responseText);

            if(data.ok == true)
            {
                var activityList = document.getElementById("activityList");

                activityList.innerHTML = "";

                if(data.activities.length == 0)
                {
                    activityList.innerHTML = "<p>No activity found.</p>";
                }
                else
                {
                    for(var i = 0; i < data.activities.length; i++)
                    {
                        var activity = data.activities[i];

                        var div = document.createElement("div");

                        div.setAttribute("style", "border-bottom:1px solid black; padding:10px;");

                        div.innerHTML = "<b>" + activity.initial + "</b>" +
                                        "&nbsp;" +
                                        "<b>" + activity.name + "</b> " +
                                        activity.action_text +
                                        "<br>" +
                                        "<small>" + activity.time_ago + "</small>";

                        activityList.appendChild(div);
                    }
                }
            }
            else
            {
                alert(data.message);
            }
        }
    };

    xhttp.open("GET", "../../controllers/api/filterActivity.php?project_id=" + projectId + "&user_id=" + userId, true);
    xhttp.send();
}