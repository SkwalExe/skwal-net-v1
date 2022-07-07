# The User class 👤

The `User` class contains useful methods for working with users.

First create your user like this:

```php
$user = new User("skwal", "username");
```

- `skwal` : Identification of the user (his username, id, email...)
- `username` : The identification type (username, id, email...)

Then you can use the following methods and properties:

```php
// Properties
$user->id // The id of the user
$user->username // The username of the user
$user->email // The email of the user
$user->password // The password of the user (hashed)
$user->banner // The filename of the banner of the user
$user->avatar // The filename of the avatar of the user
$user->bannerVersion // The number of times the user changed his banner
$user->avatarVersion // The number of times the user changed his avatar
$user->bannerUrl // The url of the user's banner
$user->avatarUrl // The url of the user's avatar
$user->createdAt // The date of the creation of the user's account
$user->bio // The biography of the user
$user->newEmail // The new email of the user after he confirmed the modification from the email sent by the system
$user->newEmailToken // The token required to confirm the modification of the account's email
$user->newPasswordToken // The token required to change the account's password
$user->profileHTML // The url of the user's profile page
$user->roles // The roles of the user
$user->accountDeletionToken // The token required to confirm the deletion of the user's account
$user->logout_before // The date of the last email/password modification, every sessions created before this date will be closed
$user->settings // The user's settings
$user->followerCount // The number of followers of the user

// Methods

$user->toArray() // returns an array with some information about the user, useful to pass user informations to the frontend etc
$user->verifyPassword($password) // returns true if $password matches the user's password
$user->isFollowedBy($id) // Returns true if the user with id $id is following the user
$user->follow($id) // Make the user follow the user with id $id
$user->unfollow($id) // Make the user unfollow the user with id $id
$user->loadPosts() // Load the user's posts into the $user->posts property
$user->loadComments() // Load the user's comments into the $user->comments property
$user->printRoles() // Print the user's roles as fontawesome icons
$user->delete() // Delete the user's account and all his informations
$user->loadFollowings() // Load the user's followings into the $user->followings property
$user->loadLikes() // Load the user's likes into the $user->likes property
$user->requireLogin() // Logout all devices from the account
$user->loginAs() // Make the current session to be logged in as the user
```