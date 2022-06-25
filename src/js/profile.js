let logout, copyProfileUrl;

if (serverData.showPageContent) {
  let postsButton = $('.posts-button');
  let commentsButton = $('.comments-button');
  let aboutButton = $('.about-button');

  let posts = $('.posts');
  let comments = $('.comments');
  let about = $('.about');

  postsButton.onclick = () => {
    postsButton.classList.add('selected');
    commentsButton.classList.remove('selected');
    aboutButton.classList.remove('selected');

    posts.classList.remove('hidden');
    comments.classList.add('hidden');
    about.classList.add('hidden');
  }

  commentsButton.onclick = () => {
    postsButton.classList.remove('selected');
    commentsButton.classList.add('selected');
    aboutButton.classList.remove('selected');

    posts.classList.add('hidden');
    comments.classList.remove('hidden');
    about.classList.add('hidden');
  }

  aboutButton.onclick = () => {
    postsButton.classList.remove('selected');
    commentsButton.classList.remove('selected');
    aboutButton.classList.add('selected');

    posts.classList.add('hidden');
    comments.classList.add('hidden');
    about.classList.remove('hidden');
  }


  logout = () => {
    fetch('/api/v1/logout.php').then(res => res.json()).then(data => {
      if (data.success) {
        redirect('/', ["Success!", data.message, "success"])
      } else {
        toasteur.error(data.error, "Error!")
      }
    })
  }


  if (serverData.loggedInUserProfile) {
    let banner = $('.bannerContainer')
    let avatar = $('.avatarContainer')

    banner.style.cursor = 'pointer'
    avatar.style.cursor = 'pointer'

    banner.onmouseover = () => banner.style.opacity = '0.5'

    avatar.onmouseover = () => avatar.style.opacity = '0.5'

    avatar.onmouseout = () => avatar.style.opacity = '1'

    banner.onmouseout = () => banner.style.opacity = '1'



    banner.onclick = () => {
      new MessageBox()
        .setTitle("Change Banner")
        .setMessage("Please select a file to upload for your new banner, it must be an image or a gif.")
        .askForFile(false, "image/*")
        .show()
        .then(file => {
          if (file) {
            let data = new FormData()
            data.append('banner', file)
            fetch('/api/v1/updateMedia.php?media=banner', {
              method: 'POST',
              body: data
            }).then(res => res.json()).then(data => {
              if (data.success) {
                redirect('/profile', ["Success!", data.message, "success"])
              } else {
                toasteur.error(data.error, "Error!")
              }
            })
          }
        })
    }

    avatar.onclick = () => {
      new MessageBox()
        .setTitle("Change Avatar")
        .setMessage("Please select a file to upload for your new avatar, it must be an image or a gif.")
        .askForFile(false, "image/*")
        .show()
        .then(file => {
          if (file) {
            let data = new FormData()
            data.append('avatar', file)
            fetch('/api/v1/updateMedia.php?media=avatar', {
              method: 'POST',
              body: data
            }).then(res => res.json()).then(data => {
              if (data.success) {
                redirect('/profile', ["Success!", data.message, "success"])
              } else {
                toasteur.error(data.error, "Error!")
              }
            })
          }
        })
    }
  }


  let followButton = $('.followButton')
  let unfollowButton = $('.unfollowButton')
  let followerCount = $('.followerCount')

  if (followButton) {
    followButton.onclick = () => {
      fetch('/api/v1/follow.php', {
        method: 'POST',
        body: JSON.stringify({
          id: serverData.profile.id
        }),
        headers: {
          'Content-Type': 'application/json'
        }
      }).then(res => res.json()).then(data => {
        if (data.success) {
          followButton.style.display = 'none'
          unfollowButton.style.display = 'block'
          followerCount.innerHTML = parseInt(followerCount.textContent) + 1
        } else {
          toasteur.error(data.error, "Error!")
        }
      })
    }
  }

  if (unfollowButton) {
    unfollowButton.onclick = () => {
      fetch('/api/v1/unfollow.php', {
        method: 'POST',
        body: JSON.stringify({
          id: serverData.profile.id
        }),
        headers: {
          'Content-Type': 'application/json'
        }
      }).then(res => res.json()).then(data => {
        if (data.success) {
          followButton.style.display = 'block'
          unfollowButton.style.display = 'none'
          followerCount.innerHTML = parseInt(followerCount.textContent) - 1
        } else {
          toasteur.error(data.error, "Error!")
        }
      })
    }
  }


  copyProfileUrl = () => {
    copy(serverData.profile.profileHTML)
    toasteur.success("Profile URL copied to clipboard!", "Success!")
  }
}
