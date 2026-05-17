function archiveProject(projectId) {
    if (!confirm("Are you sure you want to archive this project?")) {
        return;
    }

    let formData = new FormData();
    formData.append("project_id", projectId);

    fetch("../../controllers/api/archiveProject.php", {
        method: "POST",
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.ok) {
            alert("Project archived successfully.");
            window.location.href = "projectList.php";
        } else {
            alert(data.message);
        }
    })
    .catch(error => {
        alert("Something went wrong.");
    });
}