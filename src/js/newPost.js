let form = $('form')

form.addEventListener('submit', e => {
  e.preventDefault();
  const formData = new FormData(e.target);
  let data = {};
  formData.forEach((value, key) => { data[key] = value })

  data = JSON.stringify(data);


  fetch('/api/v1/newPost.php', {
      method: 'POST',
      body: data,
      headers: { 'Content-Type': 'application/json' }

    })
    .then(res => res.json()).then(data => {
      if (data.success) {
        redirect('/post?id=' + data.data, ["Success!", data.message, "success"])
      } else {
        toasteur.error(data.error, "Error!")
      }
    })
})
