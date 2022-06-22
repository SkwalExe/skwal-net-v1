$$('.comment .likeButton').forEach(button => {
  button.addEventListener('click', function(e) {
    e.preventDefault();
    e.stopPropagation();
    if (!serverData.loggedIn)
      return toasteur.error('You must be logged in to like a comment.', "Error");
    const id = button.getAttribute('comment-id');

    let likeCount = button.querySelector('.likeCount');

    let url = "/api/v1/likeComment.php";
    let liked = button.classList.contains('liked')
    if (liked)
      url = "/api/v1/unlikeComment.php";

    fetch(url, {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json'
      },
      body: JSON.stringify({
        id
      })
    }).then(res => res.json()).then(data => {
      if (data.success) {
        button.classList.toggle('liked');

        likeCount.innerText = parseInt(likeCount.innerText) + (liked ? -1 : 1);
      } else {
        toasteur.error(data.error, "Error!")
      }
    })
  })
})

$$('.deleteButton').forEach(button => {
  button.addEventListener('click', (e) => {

    e.preventDefault();
    e.stopPropagation();
    if (!serverData.loggedIn)
      return toasteur.error('You must be logged in to delete posts.', "Error");
    const id = button.getAttribute('comment-id');

    new MessageBox()
      .setTitle('Confirmation')
      .setMessage('Are you sure you want to delete this comment ?')
      .addButton('Cancel', 'green')
      .addButton('Confirm', 'red')
      .show()
      .then(res => {
        if (res === "Confirm") {
          fetch("/api/v1/deleteComment.php", {
            method: 'POST',
            headers: {
              'Content-Type': 'application/json'
            },
            body: JSON.stringify({
              id
            })
          }).then(res => res.json()).then(data => {
            if (data.success) {
              toasteur.success('Comment deleted successfully', 'Success!')
              button.parentElement.parentElement.parentElement.remove();
            } else {
              toasteur.error(data.error, "Error!")
            }
          })
        }
      })
  })
})
