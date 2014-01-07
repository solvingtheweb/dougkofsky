<!DOCTYPE html>
<html>
  <head>
    <title>Facebook User Authentication for Justified Image Grid</title>
    <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.min.js"></script>
    <script type="text/javascript">
      jQuery(document).ready(function(jQuery) {
          jQuery('body').on("click", "textarea", function(event){
            jQuery(this).select();
          })
      });
    </script>
    <style type="text/css">
      body{
        padding: 20px;
        font-family: Verdana,Arial,Helvetica,sans-serif;
      }
      #message{
        display: block;
        float:left;
        margin-left:55px;
      }
      #message{
      }
      h1{
        font-size: 16px;
        margin:0;
      }
      p{
        font-size: 14px;
        color:#666;
        margin:0;
      }
      textarea{
        display: block;
        margin-top:12px;
        width: 100%;
      }
      #wrapper{
        border: 1px solid #DEDEE3;
        border-radius: 5px;
        padding:15px;
        background: url(images/facebook-icon.png) 10px 14px no-repeat #F3F3F7;
      }
      #clearfix{
        clear:both;
      }
    </style>
  </head>
  <body>
<div id="wrapper">
    <div id="message">
<?php
  $code = $_GET["code"];
  if(empty($code)) {
    echo '<h1>Authorization error.</h1></div>';
  }else{
    ?>
    <h1>Authorization complete, please send this code to the person who sent you the link.</h1><p>They'll have access to your photos and can load them in a gallery outside Facebook.</p>
     <textarea cols="60" rows="6"><?php echo base64_encode($code); ?></textarea>
    <?php
  }
?>
    </div>
    <div id="clearfix"></div>
</div>
  </body>
</html>
