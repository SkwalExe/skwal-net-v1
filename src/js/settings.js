let form = $('form')

form.addEventListener('submit', e => {
  e.preventDefault();
  const formData = new FormData(e.target);
  let data = {};
  formData.forEach((value, key) => { data[key] = value })

  data = JSON.stringify(data);


  fetch('/api/v1/updateUserSettings.php', {
      method: 'POST',
      body: data,
      headers: { 'Content-Type': 'application/json' }

    })
    .then(res => res.json()).then(data => {
      if (data.success) {
        document.location.reload();
      } else {
        toasteur.error(data.error, "Error!")
      }
    })
})


$('.borders-input').addEventListener('change', e => {
  if (e.target.value == "show")
    document.body.classList.add("settings-borders")
  else
    document.body.classList.remove("settings-borders")
})
