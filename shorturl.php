<?php
 include('_connection.php');
 
 if (!(isset($_SERVER['HTTPS']) && ($_SERVER['HTTPS'] == 'on' || $_SERVER['HTTPS'] == 1) ||  isset($_SERVER['HTTP_X_FORWARDED_PROTO']) &&   $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https'))
{
   $redirect = 'https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
   header('HTTP/1.1 301 Moved Permanently');
   header('Location: ' . $redirect);
   exit();
}
session_start();
if (!isset($_SESSION['web'])) {
   header("location:index.php");
}
 $genlink1=$_SESSION['genlink'];
 $web1=$_SESSION['web'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Link Shortner</title>
    <link rel="stylesheet" href="shorturl.css">
</head>
<body>
   <div class="div" id="div1">
       <h1 id="head">Short URL</h1>
       <div class="total">
           <h2 id="h2">Your shortened Link</h2>
           <div class="btn">
           <?php echo' <input type="text" disabled id="insert" value="'.$genlink1.'"> ' ?>
               <button id="btn" onclick="copy()" >Copy URL</button>
           </div>
          <?php echo' <p class="text">Long URL: <a href="'.$web1.'">'.$web1.'</a> </p>'?> <br>
            <p class="text" id="last"> Create other <a href="index.html" title="Click me to go back. ">shortened URL.</a></p>
       </div>
   </div>

   <!-- <footer>
    <p id="footer">Copyright &copy; 2022 All Rights Reserved by AA </p>
   </footer> -->
<script>
            function copy() {
            /* Get the text field */
            
            var copyText = document.getElementById("insert");
            var a=copyText.value;
               
            if(a!=="")
            {
                /* Select the text field */
                copyText.select();
            
                /* Copy the text inside the text field */
                if( navigator.clipboard.writeText(copyText.value))
                {
                document.getElementById('btn').innerHTML="Copied";
            }
            }
            else{
               alert("ERROR : URL is Empty");
            }
  }
</script>
   
</body>
</html>
