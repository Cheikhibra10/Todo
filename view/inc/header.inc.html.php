<!doctype html>
<html lang="en">

<head>
 <meta charset="utf-8">
 <meta name="viewport" content="width=device-width, initial-scale=1">
 <title>Transit Bank</title>
 <!-- <link rel="stylesheet" href="WEB_ROUTE."/css/bootstrap.min.css"?>"> -->
 <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
 <!-- <link rel="stylesheet" href="WEB_ROUTE."/css/sidebar.css"?>"> -->
 <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
 <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
 <style>
  @import url("https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap");

  :root {
   --header-height: 3rem;
   --nav-width: 68px;
   --first-color: #18206f;
   --first-color-light: #d4af37;
   --white-color: #d4af37;
   --body-font: 'Nunito', sans-serif;
   --normal-font-size: 1rem;
   --z-fixed: 100;
   --black: #333;
   --border: .2rem solid var(--black);
    --box-shadow: 0 .5rem 1rem rgba(0, 0, 0, .1);
  }

  *,
  ::before,
  ::after {
   box-sizing: border-box
  }

  body {
   position: relative;
   margin: var(--header-height) 0 0 0;
   padding: 0 1rem;
   font-family: var(--body-font);
   font-size: var(--normal-font-size);
   transition: .5s
  }

  li a {
   text-decoration: none
  }
ul{
  list-style: none;
}
ul li{
  display: inline-block;
  position: relative;
}
ul li a{
  display: inline-block;
  padding: 20px 25px;
  text-decoration: none;
  color: #FFF;
}
ul li ul.dropdown li a{
  display: block;
  font-size: 12.5px;
  line-height: 1px
}
ul li ul.dropdown{
width: 140%;
background-color:#fff;
position: absolute;
z-index: 999;
display: none;

}
ul li:hover ul.dropdown{
  display: block
}
  .header {
   width: 100%;
   height: var(--header-height);
   position: fixed;
   top: 0;
   left: 0;
   display: flex;
   align-items: center;
   justify-content: space-between;
   padding: 0 1rem;
   background-color:#fff;
   z-index: var(--z-fixed);
   transition: .5s
   box-shadow: 0 .5rem 1rem black;
  }

  .sub-menu {
   display: none;
  }
  .fa-user{
    color: #18206f
  }

  .header_toggle {
   color: var(--first-color);
   font-size: 1.5rem;
   cursor: pointer
  }

  .header_img {
   width: 35px;
   height: 35px;
   display: flex;
   justify-content: center;
   border-radius: 50%;
   overflow: hidden
  }

  .header_img img {
   width: 40px
  }
  .header a{
   color: var(--first-color);
   text-decoration: none
  }
  .delete-btn{
    display: inline-block;
    border-radius: .5rem;
    margin-top: 1rem;
    font-size: 1.2rem;
    color:#d4af37;
    background-color:#fff;
    cursor: pointer;
    padding: 1rem 2rem;
    text-transform: capitalize;
}
  .show {
   left: 0
  }

  .body-pd {
   padding-left: calc(var(--nav-width) + 1rem)
  }

  .active {
   color: var(--white-color)
  }

  .active::before {
   content: '';
   position: absolute;
   left: 0;
   width: 2px;
   height: 32px;
   background-color: var(--white-color)
  }

  .height-100 {
   height: 100vh
  }
  .header .count-box {
    position: absolute;
    top: 120%;
    right: 2rem;
    width: 20rem;
    height: 25vh;
    box-shadow: var(--box-shadow);
    padding: -4rem;
    border-radius: .5rem;
    text-align: center;
    display: none;
    background-color: #18206f;
    animation: fadeIn .2s linear;
}
  .header .count-box p {
    font-size: 1rem;
    color: aquamarine;
    margin-bottom: .8em;
}

.header .count-box p span {
  color: aquamarine;
}

.header .count-box .delete-btn {
    margin-top: 0;
}

  @media screen and (min-width: 768px) {
   body {
    margin: calc(var(--header-height) + 1rem) 0 0 0;
    padding-left: calc(var(--nav-width) + 2rem)
   }

   .header {
    height: calc(var(--header-height) + 1rem);
    padding: 0 2rem 0 calc(var(--nav-width) + 2rem)
   }

   .header_img {
    width: 40px;
    height: 40px
   }

   .header_img img {
    width: 45px
   }

   .l-navbar {
    left: 0;
    padding: 1rem 1rem 0 0
   }

   .show {
    width: calc(var(--nav-width) + 156px)
   }

   .body-pd {
    padding-left: calc(var(--nav-width) + 188px)
   }
  }
 </style>
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
 <link rel="stylesheet" href="<?= WEB_ROUTE . '/css/style.css' ?>">
</head>

<body id="body-pd">