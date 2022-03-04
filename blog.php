<?php 

	session_start();

	if(isset($_SESSION['userId'])) {

		require('./config/db.php');

		$userId = $_SESSION['userId'];

		$stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");

		$stmt->execute([$userId]);

		$user = $stmt -> fetch();

		$stmt = $pdo->prepare("SELECT * FROM blog");
		$stmt->execute();
		$posts = $stmt->fetchAll();

		if(isset($_POST['createPost'])){
			$title = filter_var( $_POST["postTitle"], FILTER_SANITIZE_STRING);
      		$body = filter_var( $_POST["postBody"], FILTER_SANITIZE_STRING );

			$stmt = $pdo->prepare('INSERT INTO blog(title, body) VALUES(?, ?)');
			$stmt->execute([$title, $body]);
			header('Location: http://localhost/login-project/blog.php');
		}

		} else {
		    require('./config/db.php');
		    $user = 0;
		    $stmt = $pdo->prepare("SELECT * FROM blog");
		    $stmt->execute();
		    $posts = $stmt->fetchAll();
  		}

?>


<?php require('./inc/header.html'); ?>
<?php if($user) {  ?>
	<?php if($user->role == "moderator" || $user->role == "admin") { ?>
		<?php require('./inc/newPost.html'); ?>
	<?php } ?>
<?php } ?>



	<div class="container">
		<div class="row">
			<div class="col-sm-12" style="margin-top: 50px;">
				<?php if($user) {  ?>
				<?php if($user->role == "moderator" || $user->role == "admin") { ?>
				<button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModal">
					Create New Post
				</button>
			<?php } ?>
			<?php } ?>
			</div>
		</div>


<?php  foreach($posts as $post) { ?>

	<div class="card">
		<div class="card-header bg-light mb-3"><?php  echo $post->title  ?></div>
		<div class='card-body'>
			<p><?php echo $post->body ?></p>
      </div>
    </div>
  <?php } ?> 
</div>

<?php require('./inc/footer.html'); ?>
