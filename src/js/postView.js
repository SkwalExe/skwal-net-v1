if (serverData.showPageContent) {
  let id = serverData.post.id

  if (serverData.isPostAuthor) {
    $('.postDeleteButton').onclick = () => {
      new MessageBox()
        .setTitle('Confirmation')
        .setMessage('Are you sure you want to delete this post?')
        .addButton('Yes', 'red')
        .addButton('Cancel', 'green')
        .show()
        .then(res => {
          if (res === 'Yes') {
            fetch('/api/v1/deletePost.php', {
              method: 'POST',
              headers: {
                'Content-Type': 'application/json'
              },
              body: JSON.stringify({
                id
              })
            }).then(res => res.json()).then(data => {
              if (data.success) {
                redirect('/profile', ['Success', 'Post deleted successfully', 'success'])
              } else {
                new MessageBox.setTitle('Error')
                  .setMessage(data.message)
                  .show()
              }
            })
          }
        })

    }
  }
}
