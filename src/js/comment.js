$$('.comment .likeButton').forEach(button => {
  button.addEventListener('click', function(e) {
    e.preventDefault();
    e.stopPropagation();
    if (!serverData.loggedIn)
      return toasteur.error('You must be logged in to like a comment.', "Error");
    const id = button.parentElement.parentElement.getAttribute('comment-id');

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
