let form = $('form')

form.addEventListener('submit', e => {
  e.preventDefault();
  const formData = new FormData(e.target);
  let data = {};
  formData.forEach((value, key) => data[key] = value)

  data = JSON.stringify(data);

  fetch('/api/v1/login.php', {
    method: 'POST',
    body: data,
    headers: { 'Content-Type': 'application/json' }

  }).then(res => res.json()).then(data => {
    if (data.success) {
      redirect('/profile?username=' + data.data.username, ["Success!", data.message, "success"])
    } else {
      toasteur.error(data.error, "Error!")
    }
  })
})
