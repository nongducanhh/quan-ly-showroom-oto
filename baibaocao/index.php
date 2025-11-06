<?php
session_start();
// Nếu đã đăng nhập, chuyển thẳng vào showroom
if (isset($_SESSION['user'])) {
  header("Location: showroom.php");
  exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Login</title>
  
  <!-- Import font Poppins -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
  
  <style>
    /* CSS để căn giữa form */
    body {
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      background-color: #111; /* Nền tối cho hợp form */
      font-family: 'Poppins', sans-serif;
      margin: 0;
      overflow: hidden; 
    }

    /* From Uiverse.io by Praashoo7 */
    .form {
      display: flex;
      flex-direction: column;
      gap: 10px;
      padding-left: 2em;
      padding-right: 2em;
      padding-bottom: 0.4em;
      background-color: #171717;
      border-radius: 25px;
      transition: .4s ease-in-out;
      z-index: 1; /* Đảm bảo form nổi lên */
    }

    .form:hover {
      transform: scale(1.05);
      border: 1px solid black;
    }

    #heading {
      text-align: center;
      margin: 2em;
      color: rgb(255, 255, 255);
      font-size: 1.2em;
    }

    .field {
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 0.5em;
      border-radius: 25px;
      padding: 0.6em;
      border: none;
      outline: none;
      color: white;
      background-color: #171717;
      box-shadow: inset 2px 5px 10px rgb(5, 5, 5);
    }

    .input-icon {
      height: 1.3em;
      width: 1.3em;
      fill: white;
    }

    .input-field {
      background: none;
      border: none;
      outline: none;
      width: 100%;
      color: #d3d3d3;
      font-family: 'Poppins', sans-serif; /* Thêm font */
    }

    .form .btn {
      display: flex;
      justify-content: center;
      flex-direction: row;
      margin-top: 2.5em;
    }

    .button1 {
      padding: 0.5em;
      padding-left: 1.1em;
      padding-right: 1.1em;
      border-radius: 5px;
      margin-right: 0.5em;
      border: none;
      outline: none;
      transition: .4s ease-in-out;
      background-color: #252525;
      color: white;
      font-family: 'Poppins', sans-serif; /* Thêm font */
      cursor: pointer;
    }

    .button1:hover {
      background-color: black;
      color: white;
    }

    .button2 {
      padding: 0.5em;
      padding-left: 2.3em;
      padding-right: 2.3em;
      border-radius: 5px;
      border: none;
      outline: none;
      transition: .4s ease-in-out;
      background-color: #252525;
      color: white;
      font-family: 'Poppins', sans-serif; /* Thêm font */
      cursor: pointer;
    }

    .button2:hover {
      background-color: black;
      color: white;
    }

    .button3 {
      margin-bottom: 3em;
      padding: 0.5em;
      border-radius: 5px;
      border: none;
      outline: none;
      transition: .4s ease-in-out;
      background-color: #252525;
      color: white;
      font-family: 'Poppins', sans-serif; /* Thêm font */
      cursor: pointer;
    }

    .button3:hover {
      background-color: red;
      color: white;
    }

    /* === ĐÃ THÊM CSS ANIMATION NỀN === */
    /* From Uiverse.io by Cobp */
    .container {
      --color-0: #fff;
      --color-1: #111;
      --color-2: #222;
      --color-3: #333;
      --color-4: #2e2e2e;
      --color-5: #d2b48c;
      --color-6: #b22222;
      --color-7: #871a1a;
      --color-8: #ff6347;
      --color-9: #ff3814;
      width: 100%;
      height: 100%;
      background-color: var(--color-1);
      background-image: linear-gradient(
          to top,
          var(--color-2) 5%,
          var(--color-1) 6%,
          var(--color-1) 7%,
          transparent 7%
        ),
        linear-gradient(to bottom, var(--color-1) 30%, transparent 80%),
        linear-gradient(to right, var(--color-2), var(--color-4) 5%, transparent 5%),
        linear-gradient(
          to right,
          transparent 6%,
          var(--color-2) 6%,
          var(--color-4) 9%,
          transparent 9%
        ),
        linear-gradient(
          to right,
          transparent 27%,
          var(--color-2) 27%,
          var(--color-4) 34%,
          transparent 34%
        ),
        linear-gradient(
          to right,
          transparent 51%,
          var(--color-2) 51%,
          var(--color-4) 57%,
          transparent 57%
        ),
        linear-gradient(to bottom, var(--color-1) 35%, transparent 35%),
        linear-gradient(
          to right,
          transparent 42%,
          var(--color-2) 42%,
          var(--color-4) 44%,
          transparent 44%
        ),
        linear-gradient(
          to right,
          transparent 45%,
          var(--color-2) 45%,
          var(--color-4) 47%,
          transparent 47%
        ),
        linear-gradient(
          to right,
          transparent 48%,
          var(--color-2) 48%,
          var(--color-4) 50%,
          transparent 50%
        ),
        linear-gradient(
          to right,
          transparent 87%,
          var(--color-2) 87%,
          var(--color-4) 91%,
          transparent 91%
        ),
        linear-gradient(to bottom, var(--color-1) 37.5%, transparent 37.5%),
        linear-gradient(
          to right,
          transparent 14%,
          var(--color-2) 14%,
          var(--color-4) 20%,
          transparent 20%
        ),
        linear-gradient(to bottom, var(--color-1) 40%, transparent 40%),
        linear-gradient(
          to right,
          transparent 10%,
          var(--color-2) 10%,
          var(--color-4) 13%,
          transparent 13%
        ),
        linear-gradient(
          to right,
          transparent 21%,
          var(--color-2) 21%,
          #1a1a1a 25%,
          transparent 25%
        ),
        linear-gradient(
          to right,
          transparent 58%,
          var(--color-2) 58%,
          var(--color-4) 64%,
          transparent 64%
        ),
        linear-gradient(
          to right,
          transparent 92%,
          var(--color-2) 92%,
          var(--color-4) 95%,
          transparent 95%
        ),
        linear-gradient(to bottom, var(--color-1) 48%, transparent 48%),
        linear-gradient(
          to right,
          transparent 96%,
          var(--color-2) 96%,
          #1a1a1a 99%,
          transparent 99%
        ),
        linear-gradient(
          to bottom,
          transparent 68.5%,
          transparent 76%,
          var(--color-1) 76%,
          var(--color-1) 77.5%,
          transparent 77.5%,
          transparent 86%,
          var(--color-1) 86%,
          var(--color-1) 87.5%,
          transparent 87.5%
        ),
        linear-gradient(
          to right,
          transparent 35%,
          var(--color-2) 35%,
          var(--color-4) 41%,
          transparent 41%
        ),
        linear-gradient(to bottom, var(--color-1) 68%, transparent 68%),
        linear-gradient(
          to right,
          transparent 78%,
          var(--color-3) 78%,
          var(--color-3) 80%,
          transparent 80%,
          transparent 82%,
          var(--color-3) 82%,
          var(--color-3) 83%,
          transparent 83%
        ),
        linear-gradient(
          to right,
          transparent 66%,
          var(--color-2) 66%,
          var(--color-4) 85%,
          transparent 85%
        );
      background-size: 300px 150px;
      background-position: center bottom;
      /* Điều chỉnh để làm nền cố định */
      position: fixed;
      top: 0;
      left: 0;
      z-index: -1;
    }

    .container:before {
      content: "";
      width: 100%;
      height: 100%;
      position: absolute;
      inset: 0;
      background-color: var(--color-1);
      background-image: linear-gradient(
          to top,
          var(--color-5) 5%,
          var(--color-1) 6%,
          var(--color-1) 7%,
          transparent 7%
        ),
        linear-gradient(to bottom, var(--color-1) 30%, transparent 30%),
        linear-gradient(to right, var(--color-6), var(--color-7) 5%, transparent 5%),
        linear-gradient(
          to right,
          transparent 6%,
          var(--color-8) 6%,
          var(--color-9) 9%,
          transparent 9%
        ),
        linear-gradient(
          to right,
          transparent 27%,
          #556b2f 27%,
          #39481f 34%,
          transparent 34%
        ),
        linear-gradient(
          to right,
          transparent 51%,
          #fa8072 51%,
          #f85441 57%,
          transparent 57%
        ),
        linear-gradient(to bottom, var(--color-1) 35%, transparent 35%),
        linear-gradient(
          to right,
          transparent 42%,
          #008080 42%,
          #004d4d 44%,
          transparent 44%
        ),
        linear-gradient(
          to right,
          transparent 45%,
          #008080 45%,
          #004d4d 47%,
          transparent 47%
        ),
        linear-gradient(
          to right,
          transparent 48%,
          #008080 48%,
          #004d4d 50%,
          transparent 50%
        ),
        linear-gradient(
          to right,
          transparent 87%,
          #789 87%,
          #4f5d6a 91%,
          transparent 91%
        ),
        linear-gradient(to bottom, var(--color-1) 37.5%, transparent 37.5%),
        linear-gradient(
          to right,
          transparent 14%,
          #bdb76b 14%,
          #989244 20%,
          transparent 20%
        ),
        linear-gradient(to bottom, var(--color-1) 40%, transparent 40%),
        linear-gradient(
          to right,
          transparent 10%,
          #808000 10%,
          #4d4d00 13%,
          transparent 13%
        ),
        linear-gradient(
          to right,
          transparent 21%,
          #8b4513 21%,
          #5e2f0d 25%,
          transparent 25%
        ),
        linear-gradient(
          to right,
          transparent 58%,
          #8b4513 58%,
          #5e2f0d 64%,
          transparent 64%
        ),
        linear-gradient(
          to right,
          transparent 92%,
          #2f4f4f 92%,
          #1c2f2f 95%,
          transparent 95%
        ),
        linear-gradient(to bottom, var(--color-1) 48%, transparent 48%),
        linear-gradient(
          to right,
          transparent 96%,
          #2f4f4f 96%,
          #1c2f2f 99%,
          transparent 99%
        ),
        linear-gradient(
          to bottom,
          transparent 68.5%,
          transparent 76%,
          var(--color-1) 76%,
          var(--color-1) 77.5%,
          transparent 77.5%,
          transparent 86%,
          var(--color-1) 86%,
          var(--color-1) 87.5%,
          transparent 87.5%
        ),
        linear-gradient(
          to right,
          transparent 35%,
          #cd5c5c 35%,
          #bc3a3a 41%,
          transparent 41%
        ),
        linear-gradient(to bottom, var(--color-1) 68%, transparent 68%),
        linear-gradient(
          to right,
          transparent 78%,
          #bc8f8f 78%,
          #bc8f8f 80%,
          transparent 80%,
          transparent 82%,
          #bc8f8f 82%,
          #bc8f8f 83%,
          transparent 83%
        ),
        linear-gradient(
          to right,
          transparent 66%,
          #a52a2a 66%,
          #7c2020 85%,
          transparent 85%
        );
      background-size: 300px 150px;
      background-position: center bottom;
      clip-path: circle(150px at center center);
      animation: flashlight 20s ease infinite;
    }

    .container:after {
      content: "";
      width: 25px;
      height: 10px;
      position: absolute;
      left: calc(50% + 59px);
      bottom: 100px;
      background-repeat: no-repeat;
      background-image: radial-gradient(circle, #fff 50%, transparent 50%),
        radial-gradient(circle, #fff 50%, transparent 50%);
      background-size: 10px 10px;
      background-position:
        left center,
        right center;
      animation: eyes 20s infinite;
    }

    @keyframes flashlight {
      0% {
        clip-path: circle(150px at -25% 10%);
      }

      38% {
        clip-path: circle(150px at 60% 20%);
      }

      39% {
        opacity: 1;
        clip-path: circle(150px at 60% 86%);
      }

      40% {
        opacity: 0;
        clip-path: circle(150px at 60% 86%);
      }

      41% {
        opacity: 1;
        clip-path: circle(150px at 60% 86%);
      }

      42% {
        opacity: 0;
        clip-path: circle(150px at 60% 86%);
      }

      54% {
        opacity: 0;
        clip-path: circle(150px at 60% 86%);
      }

      55% {
        opacity: 1;
        clip-path: circle(150px at 60% 86%);
      }

      59% {
        opacity: 1;
        clip-path: circle(150px at 60% 86%);
      }

      64% {
        clip-path: circle(150px at 45% 78%);
      }

      68% {
        clip-path: circle(150px at 85% 89%);
      }

      72% {
        clip-path: circle(150px at 60% 86%);
      }

      74% {
        clip-path: circle(150px at 60% 86%);
      }

      100% {
        clip-path: circle(150px at 150% 50%);
      }
    }

    @keyframes eyes {
      0%,
      38% {
        opacity: 0;
      }

      39%,
      41% {
        opacity: 1;
        transform: scaleY(1);
      }

      40% {
        transform: scaleY(0);
        filter: none;
        background-image: radial-gradient(circle, #fff 50%, transparent 50%),
          radial-gradient(circle, #fff 50%, transparent 50%);
      }

      41% {
        transform: scaleY(1);
        background-image: radial-gradient(circle, #ff0000 50%, transparent 50%),
          radial-gradient(circle, #ff0000 50%, transparent 50%);
        filter: drop-shadow(0 0 4px #ff8686);
      }

      42%,
      100% {
        opacity: 0;
      }
    }
  </style>
</head>
<body>

  <!-- Nền CSS động -->
  <div class="container"></div>

  <!-- From Uiverse.io by Praashoo7 -->
  <!-- Đã thêm action, method và các thuộc tính 'name' -->
  <form class="form" action="login_process.php" method="POST">
    <p id="heading">Login</p>
    <div class="field">
      <svg class="input-icon" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
        <path d="M13.106 7.222c0-2.967-2.249-5.032-5.482-5.032-3.35 0-5.646 2.318-5.646 5.702 0 3.493 2.235 5.708 5.762 5.708.862 0 1.689-.123 2.304-.335v-.862c-.43.199-1.354.328-2.29.328-2.926 0-4.813-1.88-4.813-4.798 0-2.844 1.921-4.881 4.594-4.881 2.735 0 4.608 1.688 4.608 4.156 0 1.682-.554 2.769-1.416 2.769-.492 0-.772-.28-.772-.76V5.206H8.923v.834h-.11c-.266-.595-.881-.964-1.6-.964-1.4 0-2.378 1.162-2.378 2.823 0 1.737.957 2.906 2.379 2.906.8 0 1.415-.39 1.709-1.087h.11c.081.67.703 1.148 1.503 1.148 1.572 0 2.57-1.415 2.57-3.643zm-7.177.704c0-1.197.54-1.907 1.456-1.907.93 0 1.524.738 1.524 1.907S8.308 9.84 7.371 9.84c-.895 0-1.442-.725-1.442-1.914z"></path>
      </svg>
      <input name="username" autocomplete="off" placeholder="Username" class="input-field" type="text" required>
    </div>
    <div class="field">
      <svg class="input-icon" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
        <path d="M8 1a2 2 0 0 1 2 2v4H6V3a2 2 0 0 1 2-2zm3 6V3a3 3 0 0 0-6 0v4a2 2 0 0 0-2 2v5a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2z"></path>
      </svg>
      <input name="password" placeholder="Password" class="input-field" type="password" required>
    </div>
    <div class="btn">
      <button class="button1" type="submit">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Login&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</button>
      <button class="button2" type="button">Sign Up</button>
    </div>
    <button class="button3" type="button">Forgot Password</button>
  </form>

</body>
</html>

