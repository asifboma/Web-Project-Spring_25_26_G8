function postComment(taskId) {
    let body = document.getElementById("commentBody").value;

    let formData = new FormData();
    formData.append("task_id", taskId);
    formData.append("body", body);

    fetch("../../controllers/api/postComment.php", {
        method: "POST",
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.ok) {
            let commentsList = document.getElementById("commentsList");

            let commentDiv = document.createElement("div");
            commentDiv.id = "comment-" + data.comment_id;
            commentDiv.style.border = "1px solid #ccc";
            commentDiv.style.padding = "8px";
            commentDiv.style.margin = "8px 0";

            commentDiv.innerHTML = `
                <p><strong>${data.author}</strong> at ${data.created_at}</p>
                <p>${data.body}</p>
                <button onclick="deleteComment(${data.comment_id})">Delete</button>
            `;

            commentsList.appendChild(commentDiv);

            document.getElementById("commentBody").value = "";
        } else {
            alert(data.message);
        }
    })
    .catch(error => {
        alert("Something went wrong.");
    });
}

function deleteComment(commentId) {
    if (!confirm("Are you sure you want to delete this comment?")) {
        return;
    }

    let formData = new FormData();
    formData.append("comment_id", commentId);

    fetch("../../controllers/api/deleteComment.php", {
        method: "POST",
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.ok) {
            let comment = document.getElementById("comment-" + commentId);

            if (comment) {
                comment.style.opacity = "0";
                setTimeout(function () {
                    comment.remove();
                }, 500);
            }
        } else {
            alert(data.message);
        }
    })
    .catch(error => {
        alert("Something went wrong.");
    });
}