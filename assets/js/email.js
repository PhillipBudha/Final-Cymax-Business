function sendMail() {
  let params = {
    name: document.getElementById("name").value,
    email: document.getElementById("email_id").value,
    message: document.getElementById("message").value,
  };
  emailjs
    .send("service_xepdick", "template_vtlthae", params)
    .then(function (res) {
      alert("Email Sent !!" + res.status);
    });
}
