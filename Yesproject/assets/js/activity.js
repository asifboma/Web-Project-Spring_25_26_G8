function filterActivity(projectId) {
    let userId = document.getElementById("memberFilter").value;

    fetch("../../controllers/api/filterActivity.php?project_id=" + projectId + "&user_id=" + userId)
    .then(response => response.json())
    .then(data => {
        if (data.ok) {
            let activityList = document.getElementById("activityList");
            activityList.innerHTML = "";

            if (data.activities.length == 0) {
                activityList.innerHTML = "<p>No activity found.</p>";
                return;
            }

            data.activities.forEach(activity => {
                let div = document.createElement("div");
                div.className = "activity-item";

                div.innerHTML = `
                    <span class="avatar">${activity.initial}</span>
                    <strong>${activity.name}</strong> ${activity.action_text}
                    <br>
                    <small>${activity.time_ago}</small>
                `;

                activityList.appendChild(div);
            });
        } else {
            alert(data.message);
        }
    })
    .catch(error => {
        alert("Something went wrong.");
    });
}