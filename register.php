<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="styles.css" />
    <title>Web Design Mastery | Learning Landing Page</title>
  </head>
  <body>
    <nav>
      <div class="nav__logo"><a href="#">Suivi Reactions</a></div>
      <ul class="nav__links">
        <li class="link"><a href="register.php" class="nav__btn">Register</a></li>
        <li class="link"><a href="login.php" class="nav__btn">Login</a></li>
        <li class="link"><a href="index.php" class="nav__btn">Homepage</a></li>
        
      </ul>
    </nav>
    <section class="container">
      <div class="content__container">
        <h1>
          
          <span class="heading__1">Register your account</span><br />
          
        </h1>
        <form action="register_process.php" method="post">
          <input type="text" placeholder="username" required name="pseudo">
          <input type="password" placeholder="Password" required name="password">
          <div class="link">
            <button type="submit" class="login">Register</button>
            <a href="Login.php" class="forgot">Login now</a>
          </div>
          <hr>
       
      </div>
      <div class="image__container">
        <img src="assets/img1.jpg" alt="header" />
        <img src="assets/img2.jpg" alt="header" />
        
      </div>
    </section>
  </body>
</html>
