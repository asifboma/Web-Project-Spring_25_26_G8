function removeMember(memberId) {
    if (!confirm("Are you sure you want to remove this member?")) {
        return;
    }

    let formData = new FormData();
    formData.append("member_id", memberId);

    fetch("../../controllers/api/removeWorkspaceMember.php", {
        method: "POST",
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.ok) {
            let row = document.getElementById("member-" + memberId);

            if (row) {
                row.style.opacity = "0";
                setTimeout(function () {
                    row.remove();
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
