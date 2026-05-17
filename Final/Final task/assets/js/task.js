function openTaskModal() {
    document.getElementById("taskModal").style.display = "block";
}

function closeTaskModal() {
    document.getElementById("taskModal").style.display = "none";
}

function moveTask(taskId, newStatus)
{
    var formData = new FormData();

    formData.append("task_id", taskId);
    formData.append("status", newStatus);

    var xhttp = new XMLHttpRequest();

    xhttp.onreadystatechange = function()
    {
        if(this.readyState == 4 && this.status == 200)
        {
            var data = JSON.parse(this.responseText);

            if(data.ok == true)
            {
                location.reload();
            }
            else
            {
                alert(data.message);
            }
        }
    };

    xhttp.open("POST", "../../controllers/api/moveTaskStatus.php", true);
    xhttp.send(formData);
}
window.onload = function () {
    let cards = document.getElementsByClassName("task-card");
    let today = new Date();
    today.setHours(0, 0, 0, 0);

    for (let i = 0; i < cards.length; i++) {
        let dueDateValue = cards[i].getAttribute("data-due-date");
        let status = cards[i].getAttribute("data-status");

        if (dueDateValue && status !== "done") {
            let dueDate = new Date(dueDateValue);
            dueDate.setHours(0, 0, 0, 0);

            if (dueDate < today) {
                cards[i].classList.add("overdue-card");
            }
        }
    }
};