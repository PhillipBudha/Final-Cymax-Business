function startCountdown(timeLimit, testId) {
  const timerElement = document.getElementById(`time_${testId}`);

  const countdown = () => {
    if (timeLimit <= 0) {
      clearInterval(timerInterval);
      timerElement.textContent = "Time's up!";
      document.getElementById(`uploadBtn_${testId}`).disabled = true;
      return;
    }

    const minutes = Math.floor(timeLimit / 60);
    const seconds = timeLimit % 60;
    timerElement.textContent = `${String(minutes).padStart(2, "0")}:${String(
      seconds
    ).padStart(2, "0")}`;
    timeLimit--;
  };

  countdown(); // Initialize immediately
  const timerInterval = setInterval(countdown, 1000);
}

function handleUpload(testId) {
  const formData = new FormData(
    document.getElementById(`uploadForm_${testId}`)
  );
  fetch("upload_submission.php", {
    method: "POST",
    body: formData,
  })
    .then((response) => response.text())
    .then((data) => {
      alert(data);
      document.getElementById(`uploadBtn_${testId}`).disabled = true;
    });
}

function handleDelete(testId) {
  if (confirm("Are you sure you want to delete this test?")) {
    fetch(`delete_test.php?id=${testId}`, {
      method: "DELETE",
    }).then((response) => {
      if (response.ok) {
        alert("Test deleted successfully!");
        location.reload();
      } else {
        alert("Error deleting test.");
      }
    });
  }
}

function deleteLastUpload() {
  if (confirm("Are you sure you want to delete the last uploaded record?")) {
    fetch("delete_last_upload.php", { method: "POST" })
      .then((response) => response.text())
      .then((data) => alert(data))
      .catch((error) => console.error("Error:", error));
  }
}
