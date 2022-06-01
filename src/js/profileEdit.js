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
