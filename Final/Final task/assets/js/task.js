function openTaskModal() {
    document.getElementById("taskModal").style.display = "block";
}

function closeTaskModal() {
    document.getElementById("taskModal").style.display = "none";
}

function moveTask(taskId, newStatus) {
    let formData = new FormData();
    formData.append("task_id", taskId);
    formData.append("status", newStatus);

    fetch("../../controllers/api/moveTaskStatus.php", {
        method: "POST",
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.ok) {
            let taskCard = document.getElementById("task-" + taskId);
            let targetColumn = document.getElementById(data.new_status);

            if (taskCard && targetColumn) {
                taskCard.setAttribute("data-status", data.new_status);
                targetColumn.appendChild(taskCard);
                location.reload();
            }
        } else {
            alert(data.message);
        }
    })
    .catch(error => {
        alert("Something went wrong.");
    });
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