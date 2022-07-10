<?php
include $_SERVER['DOCUMENT_ROOT'] . "/php/global.php";
$response = api_response();

api();

if (requirePost("q", 'searchFor')) {
  $q = $_POST['q'];
  $searchFor = $_POST['searchFor'];

  if (!in_array($searchFor, ['posts', "users"])) {
    $response["error"] = "You can only search for : posts, and users";
    http_response_code(409);
    echo json_encode($response);
  }

  $page = $_POST['page'] ?? 1;
  $perPage = $_POST['perPage'] ?? 10;

  $searchColumn = [
    'posts' => 'title',
    'users' => 'username'
  ][$searchFor];

  $total_results_sql = "SELECT COUNT(*) as total_results FROM " . $searchFor . " WHERE " . $searchColumn . " LIKE ?";
  $total_results_stmt = $db->prepare($total_results_sql);
  $total_results_stmt->execute(["%$q%"]);
  $total_results = $total_results_stmt->fetch()['total_results'];

  $total_pages = ceil($total_results / $perPage);

  $sql = "SELECT id FROM " . $searchFor . " WHERE " . $searchColumn . " LIKE ? ORDER BY id DESC LIMIT " . ($page - 1) * $perPage . "," . $perPage;
  $stmt = $db->prepare($sql);
  $stmt->execute(["%$q%"]);

  $query_results = $stmt->fetchAll();


  if ($searchFor == "posts")
    $results = array_map(function ($result) {
      $post = new Post($result['id']);
      return $post->toArray(true);
    }, $query_results);
  else if ($searchFor == "users")
    $results = array_map(function ($result) {
      $user = new User($result['id']);
      return $user->toArray(true);
    }, $query_results);

  $response['success'] = true;
  $response['data'] = [
    'results' => $results,
    'total_results' => $total_results
  ];

  echo json_encode($response);
  http_response_code(200);
} else {
  $response["error"] = "Missing post parameters, required : q, searchFor";
  http_response_code(422);
  echo json_encode($response);
}
