let form = $('.commentForm')

form.addEventListener('submit', e => {
  e.preventDefault();
  const formData = new FormData(e.target);
  let data = {};
  formData.forEach((value, key) => { data[key] = value })

  if (data.content.length < 1) {
    toasteur.error('Comment cannot be empty', "Error!")
    return;
  }

  data = JSON.stringify(data);

  fetch('/api/v1/newComment.php', {
      method: 'POST',
      body: data,
      headers: { 'Content-Type': 'application/json' }
    })
    .then(res => res.json()).then(data => {
      if (data.success) {
        redirect(document.location.href, ["Success!", data.message, "success"])
      } else {
        toasteur.error(data.error, "Error!")
      }
    })
})
