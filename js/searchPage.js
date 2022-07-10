if (serverData['showPageContent']) {
  let q = serverData['query'];
  let page = serverData['page'];
  let searchFor = serverData['searchFor'];

  let resultsDiv = $('.results');

  let postsTabButton = $('.posts-tab');
  let usersTabButton = $('.users-tab');

  fetch(`/api/v1/search.php`, {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json'
    },
    body: JSON.stringify({
      q,
      page,
      "perPage": 10,
      searchFor
    })
  }).then(res => res.json()).then(res => {
    if (!res.success) {
      resultsDiv.innerHTML = `<h3> Error : ${res.error} </h3>`
      return;
    }

    if (res.data.results.length === 0) {
      resultsDiv.innerHTML = `<h3> No results found </h3>`
      return;
    } else {
      res.data.results.forEach(result => {
        if (searchFor == "posts") {
          resultsDiv.innerHTML += result.HTML;
        } else if (searchFor == "users") {
          resultsDiv.innerHTML += "<a href='/profile?username=" + result.username + "'>" + result.HTML + "</a>";
        }
      })
    }
  })

  postsTabButton.onclick = () => {
    if (searchFor == "posts")
      return;

    let currentUrl = new URL(window.location.href);
    currentUrl.searchParams.set('searchFor', 'posts');
    window.location.href = currentUrl.href;
  }

  usersTabButton.onclick = () => {
    if (searchFor == "users")
      return;

    let currentUrl = new URL(window.location.href);
    currentUrl.searchParams.set('searchFor', 'users');
    window.location.href = currentUrl.href;
  }
}
