<html lang="en" class="no-js" dir="ltr"><head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>HZAnnounce - Join The Horizon Network</title>
<meta name="description" content="Minimal Form Interface: Simplistic, single input view form">
<meta name="keywords" content="form, minimal, interface, single input, big form, responsive form, transition">
<meta name="author" content="Codrops">
<link rel="shortcut icon" href="../favicon.ico">
<link rel="stylesheet" type="text/css" href="css/style.css">
<script src="js/modernizr.custom.js"></script>
<script src='https://www.google.com/recaptcha/api.js'></script>
</head>
<body contenteditable="true">
<div class="container"> 
  <!-- Top Navigation -->
  <header class="codrops-header">
    <div class="grid grid-pad">
      <div class="col-1-12">
        <div class="content"> <img src="images/logo.png" alt="HZ Announce" style="width:100%; height:auto;"> </div>
      </div>
      <div class="col-5-12">
        <div class="content">
          <h1> HZ Announce </h1>
          <h2 class="submargin">The Quick And Easy Way To Start Using Horizon</h2>
        </div>
      </div>
      <div class="col-6-12">
        <div class="content">
          <h3>The Quick And Easy Way To Start Using Horizon</h3>
        </div>
      </div>
    </div>
  </header>
  
  <?php
  $q1 = '';
  if(isset($_GET['q1'])) {
  	$q1 = htmlspecialchars($_GET['q1']);
  }
  
  $q2 = '';
  if(isset($_GET['q1'])) {
  	$q2 = htmlspecialchars($_GET['q2']);
  }
  ?>
  
  <div class="grid grid-pad">
    <div class="col-6-12" style="padding:50px; padding-top:0px; padding-bottom:0px;">
      <section class="related box effect2" style="text-align:left;">
        <form id="theForm" class="simform" autocomplete="off">
          <div class="simform-inner">
            <ol class="questions">
              <li> <span>
                <label for="q1">Step 1. Enter Your Wallet Address</label>
                </span>
                <input id="q1" name="q1" type="text" placeholder="NHZ-____-____-____-_____" value="<?=$q1?>">
              </li>
              <li> <span>
                <label for="q2">Step 2. Enter Your Public Key</label>
                </span>
                <input id="q2" name="q2" type="text" placeholder="________________________________________________________________" value="<?=$q2?>">
              </li>
              <li> <span>
                <input type="hidden" value="void"/><div class="g-recaptcha" data-sitekey="6LentBATAAAAAJeXxfzhHZ_2c5Tt-1kYfVWdeZr1"></div>
              </li>
            </ol>
            <!-- /questions -->
            <button class="submit" type="submit">Send answers</button>
            <div class="controls">
              <button class="next"></button>
              <div class="progress"></div>
              <span class="number"> <span class="number-current"></span> <span class="number-total"></span> </span> <span class="error-message"></span> </div>
            <!-- / controls --> 
          </div>
          <!-- /simform-inner --> 
          <span class="final-message"></span>
        </form>
        <br>
        <br>
        <h1 class="submargin">!nstructions</h1>
        <h3 class="instructmargin">
          <ol>
            <li>Make sure that you have registered for a Horizon account and log into your wallet.</li>
            <br>
            <li>Make a note of your wallet address and public key.</li>
            <br>
            <li>Enter the information and click the arrow.</li>
          </ol>
        </h3>
        <!-- /simform --> 
      </section>
    </div>
    <div class="col-6-12" style="padding:50px; padding-top:0px; padding-bottom:0px;">
      <section class="instructions box effect2">
        <h1 class="submargin">Where To Find Your Info</h1>
        <h3 class="instructmargin">Simply log into your Horizon account and the info you require can be found as below:</h3>
        <img src="images/find-info.jpg" style="width:100%; height:auto; -webkit-border-radius: 20px;-moz-border-radius: 20px;border-radius: 20px; 
	border:2px solid rgba(255,255,255,0.5);" alt="Find your Horizon Information"> </section>
    </div>
  </div>
  <section class="footer"><a href="https://coinerz.com" target="_blank">Website Created By Coinerz</a></section>
</div>
<!-- /container --> 
<script src="js/jquery.js"></script> 
<script src="js/classie.js"></script> 
<script src="js/stepsForm.js"></script> 
<script>
            var theForm = document.getElementById('theForm');

            new stepsForm(theForm, {
                onSubmit: function (form) {
                    // hide form
                    classie.addClass(theForm.querySelector('.simform-inner'), 'hide');

                    /*
                     form.submit()
                     or
                     AJAX request (maybe show loading indicator while we don't have an answer..)
                     */

                    // let's just simulate something...
                    var messageEl = theForm.querySelector('.final-message');
                    messageEl.innerHTML = 'Congratulations!<br><span style="font-size:0.7em;">You have successfully announced<br>your Horizon account.</span>';
                    classie.addClass(messageEl, 'show');

                    $.ajax({
                      url: "/announce.php",
                      type: "POST",
                      data: {
                        "recipient":            $("#q1").val(),
                        "publicKey":            $("#q2").val(),
                        "g-recaptcha-response": grecaptcha.getResponse()
                      }
                    }).done(function(data){
                      console.log(data);
                    });
                }
            });
        </script>
        
        
        
        <script>
  var portrait = window.innerWidth < window.innerHeight;
  var PleaseRotateOptions = {
      onlyMobile: false,
      forcePortrait: !portrait
  }

</script>


</body></html>
