function updateProgress(courseId, newProgress) {
  fetch("update_progress.php", {
    method: "POST",
    headers: { "Content-Type": "application/json" },
    body: JSON.stringify({ course_id: courseId, progress: newProgress }),
  })
    .then((response) => response.json())
    .then((data) => {
      if (data.success) {
        location.reload(); // Reload to reflect updated progress
      } else {
        alert("Failed to update progress");
      }
    });
}
