if (serverData.showPageContent) {
  let form = $('form')

  const toBase64 = file => new Promise((resolve, reject) => {
    const reader = new FileReader();
    reader.readAsDataURL(file);
    reader.onload = () => resolve(reader.result);
    reader.onerror = error => reject(error);
  });

  form.addEventListener('submit', e => {
    e.preventDefault();
    const formData = new FormData(e.target);
    let data = {};
    formData.forEach((value, key) => { if (value !== "") { data[key] = value } })


    if ((data.oldpassword && !data.newpassword) || (!data.oldpassword && data.newpassword)) {
      toasteur.error("Please enter both your old and new passwords.", "Error!")
      return
    }

    data = JSON.stringify(data);


    fetch('/api/v1/updateUserInformations.php', {
        method: 'POST',
        body: data,
        headers: { 'Content-Type': 'application/json' }

      })
      .then(res => res.json()).then(data => {
        if (data.success) {
          redirect('/profile', ["Success!", data.message, "success"])
        } else {
          toasteur.error(data.error, "Error!")
        }
      })
  })


  $('.delete-account-button').onclick = () => {
    new MessageBox()
      .setTitle("Delete Account")
      .setMessage("Are you sure you want to delete your account? This action is permanent and cannot be undone.")
      .addButton("Cancel", "green")
      .addButton("Delete", "red")
      .show()
      .then(res => {
        if (res === "Delete") {
          fetch('/api/v1/deleteUser.php')
            .then(res => res.json()).then(data => {
              if (data.success) {
                new MessageBox()
                  .setTitle("Email sent")
                  .setMessage("We have sent you an email to confirm your account deletion. Please check your inbox/spams")
                  .show();
              } else {
                toasteur.error(data.error, "Error!")
              }
            })
        }
      })

  }

  $('.logout-all-devices').onclick = () => {
    new MessageBox()
      .setTitle("Logout")
      .setMessage("Are you sure you want to logout from all your devices?")
      .addButton("Cancel", "green")
      .addButton("Logout", "red")
      .show()
      .then(res => {
        if (res === "Logout") {
          fetch('/api/v1/logoutAllDevices.php')
            .then(res => res.json()).then(data => {
              if (data.success) {
                new MessageBox()
                  .setTitle("Logout")
                  .setMessage("You have been logged out from all your devices.")
                  .show();
              } else {
                toasteur.error(data.error, "Error!")
              }
            })
        }
      })
  }
}
