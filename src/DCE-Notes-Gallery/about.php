<?php include 'includes/connection.php';?>
<?php include 'includes/header.php';?>
<?php include 'includes/navbar.php';?>

<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <style>
      body {
        font-family: Arial, Helvetica, sans-serif;
        margin: 0;
      }

      html {
        box-sizing: border-box;
      }

      *, *:before, *:after {
        box-sizing: inherit;
      }

      .column {
        float: left;
        width: 33.3%;
        margin-bottom: 16px;
        padding: 0 8px;
      }

      .card {
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
        margin: 8px;
      }

      .about-section {
        padding: 50px;
        text-align: center;
        background-color: #474e5d;
        color: white;
      }

      .container {
        padding: 0 16px;
      }

      .container::after, .row::after {
        content: "";
        clear: both;
        display: table;
      }

      .title {
        color: grey;
      }

      .button {
        border: none;
        outline: 0;
        display: inline-block;
        padding: 8px;
        color: white;
        background-color: #000;
        text-align: center;
        cursor: pointer;
        width: 100%;
      }

      .button:hover {
        background-color: #555;
      }

      @media screen and (max-width: 650px) {
        .column {
          width: 100%;
          display: block;
        }
      }
  </style>
</head>
<br><br>
<link rel="stylesheet" type="text/css" href="styles.css" media="all" />
    <link rel="stylesheet" type="text/css" href="demo.css" media="all" />
    <!-- jQuery -->
    <script type="text/javascript" src="js/jquery.min.js"></script>
    <!-- FlexSlider -->
    <script type="text/javascript" src="js/jquery.flexslider-min.js"></script>
    <script type="text/javascript" charset="utf-8">
    var $ = jQuery.noConflict();
    $(window).load(function() {
    $('.flexslider').flexslider({
          animation: "fade"
    });
	
	$(function() {
		$('.show_menu').click(function(){
				$('.menu').fadeIn();
				$('.show_menu').fadeOut();
				$('.hide_menu').fadeIn();
		});
		$('.hide_menu').click(function(){
				$('.menu').fadeOut();
				$('.show_menu').fadeIn();
				$('.hide_menu').fadeOut();
		});
	});
  });
</script>
    <br/>
    <br/>

    <div class="about-section">
      <h1>About Us Page</h1>
      <p>Some text about who we are and what we do.</p>
      <p>Resize the browser window to see that this page is responsive by the way.</p>
    </div>

    <h2 style="text-align:center">Our Team</h2>
    <div class="row">
      <div class="column">
        <div class="card">
          <img src="images/team1.jpg" alt="Ankit" style="width:100%">
          <div class="container">
            <h2>Ankit Jangir</h2>
            <p class="title">CEO & Founder</p>
            <p>Batch 2018-2021 (IT)</p>
            <p>ankitjangir.1690@gmail.com</p>
            <p><button class="button">Contact</button></p>
          </div>
        </div>
      </div>

      <div class="column">
        <div class="card">
          <img src="images/team1.jpg" alt="Saurav" style="width:100%">
          <div class="container">
            <h2>Saurav Joshi</h2>
            <p class="title">Art Director</p>
            <p>Batch 2018-2021 (CSIT)</p>
            <p>saurav@example.com</p>
            <p><button class="button">Contact</button></p>
          </div>
        </div>
      </div>
      
      <div class="column">
        <div class="card">
          <img src="images/team1.jpg" alt="noone" style="width:100%">
          <div class="container">
            <h2>Vaccany available</h2>
            <p class="title">Designer</p>
            <p>Some text that describes me lorem ipsum ipsum lorem.</p>
            <p>Vaccany@example.com</p>
            <p><button class="button">Contact</button></p>
          </div>
        </div>
      </div>
  </div>


</body>
</html>





<?php include 'includes/footer.php';?>

        