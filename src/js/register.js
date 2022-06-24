if (serverData.showPageContent) {
  let form = $('form')

  form.addEventListener('submit', e => {
    e.preventDefault();

    let passwordInput = $('.password');
    let passwordConfirmationInput = $('.passwordConfirmation');

    if (passwordInput.value !== passwordConfirmationInput.value) {
      toasteur.error("Passwords don't match!", "Error!")
      return;
    }

    const formData = new FormData(e.target);
    let data = {};
    formData.forEach((value, key) => data[key] = value)

    data = JSON.stringify(data);

    fetch('/api/v1/register.php', {
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
}
