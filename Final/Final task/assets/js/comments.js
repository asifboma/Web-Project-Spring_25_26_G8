function postComment(taskId)
{
    var body = document.getElementById("commentBody").value;

    if(body == "")
    {
        alert("Comment cannot be empty");
    }
    else
    {
        var formData = new FormData();

        formData.append("task_id", taskId);
        formData.append("body", body);

        var xhttp = new XMLHttpRequest();

        xhttp.onreadystatechange = function()
        {
            if(this.readyState == 4 && this.status == 200)
            {
                var data = JSON.parse(this.responseText);

                if(data.ok == true)
                {
                    var commentsList = document.getElementById("commentsList");

                    var commentDiv = document.createElement("div");

                    commentDiv.setAttribute("id", "comment-" + data.comment_id);
                    commentDiv.setAttribute("style", "border:1px solid black; padding:10px; margin-bottom:10px;");

                    commentDiv.innerHTML = "<b>" + data.author + "</b><br>" +
                                           data.created_at +
                                           "<p>" + data.body + "</p>" +
                                           "<button onclick='deleteComment(" + data.comment_id + ")'>Delete</button>";

                    commentsList.appendChild(commentDiv);

                    document.getElementById("commentBody").value = "";
                }
                else
                {
                    alert(data.message);
                }
            }
        };

        xhttp.open("POST", "../../controllers/api/postComment.php", true);
        xhttp.send(formData);
    }
}

function deleteComment(commentId)
{
    var confirmDelete = confirm("Are you sure you want to delete this comment?");

    if(confirmDelete == true)
    {
        var formData = new FormData();

        formData.append("comment_id", commentId);

        var xhttp = new XMLHttpRequest();

        xhttp.onreadystatechange = function()
        {
            if(this.readyState == 4 && this.status == 200)
            {
                var data = JSON.parse(this.responseText);

                if(data.ok == true)
                {
                    var comment = document.getElementById("comment-" + commentId);

                    if(comment != null)
                    {
                        comment.remove();
                    }
                }
                else
                {
                    alert(data.message);
                }
            }
        };

        xhttp.open("POST", "../../controllers/api/deleteComment.php", true);
        xhttp.send(formData);
    }
}