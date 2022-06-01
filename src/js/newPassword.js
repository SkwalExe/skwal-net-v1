let sendMailForm = $('.sendMailForm')
let newPasswordForm = $('.newPasswordForm')

if (sendMailForm)
  sendMailForm.addEventListener('submit', e => {
    e.preventDefault();

    const formData = new FormData(e.target);
    let data = {};
    formData.forEach((value, key) => { if (value !== "") { data[key] = value } })

    data = JSON.stringify(data);


    fetch('/api/v1/newPassword.php', {
        method: 'POST',
        body: data,
        headers: { 'Content-Type': 'application/json' }
      })
      .then(res => res.json()).then(data => {
        if (data.success) {
          redirect('/', ["Success!", data.message, "success"])
        } else {
          toasteur.error(data.error, "Error!")
        }
      })
  })

if (newPasswordForm)
  newPasswordForm.addEventListener('submit', e => {
    e.preventDefault();

    const formData = new FormData(e.target);
    let data = {};
    formData.forEach((value, key) => { if (value !== "") { data[key] = value } })

    data = JSON.stringify(data);


    fetch('/api/v1/saveNewPassword.php', {
        method: 'POST',
        body: data,
        headers: { 'Content-Type': 'application/json' }
      })
      .then(res => res.json()).then(data => {
        if (data.success) {
          redirect('/login', ["Success!", data.message, "success"])
        } else {
          toasteur.error(data.error, "Error!")
        }
      })
  })
