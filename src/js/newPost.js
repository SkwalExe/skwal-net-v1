if (serverData.showPageContent) {
  let form = $('form')

  form.addEventListener('submit', e => {
    e.preventDefault();
    const formData = new FormData(e.target);
    let data = {};
    formData.forEach((value, key) => { data[key] = value })

    data = JSON.stringify(data);


    fetch(serverData['editPost'] ? '/api/v1/editPost.php' : '/api/v1/newPost.php', {
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

  let content_textarea = form.querySelector("textarea[name='content']")
  let content_preview = $(".preview")

  const updatePreview = () => {
    let text = content_textarea.value;
    renderMarkdown(text).then(rendered => {
      if (rendered.success)
        content_preview.innerHTML = rendered.data
      else
        content_preview.innerHTML = rendered.error

    })
  }

  updatePreview();
  let timeout = null;
  content_textarea.oninput = () => {
    clearTimeout(timeout);
    timeout = setTimeout(updatePreview, 500);
  }
}
