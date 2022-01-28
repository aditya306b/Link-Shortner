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
//for redirecting

    if (isset($_GET)) {
        foreach($_GET as $key=>$val){
        $c=ltrim(mysqli_real_escape_string($conn,$key),'/');}
    //    echo $c;
    if (isset($c)) {
        $getdata=mysqli_query($conn, "SELECT reallink from user where code='$c' ");
        $count=mysqli_num_rows($getdata);    
        if ($count>0) {
            $row=mysqli_fetch_assoc($getdata);
        //  var_dump($row) ;
            $web=$row['reallink'];
            header('location:'.$web);
        }
    }
    }?>
    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Link Shortner</title>
    <link rel="stylesheet" href="index.css">
</head>
<body>
   <div class="div" id="div1">
       <h1 id="head">Link Shortner</h1>
       <div class="total">
           <h2 id="h2">Insert Your URL</h2>
           <form action="index.php" method="post">
           <div class="btn">
           <input type="text" id="insert" name="link" placeholder="Enter link to short">
               <button id="btn">Short URL</button>
            </div>
        </form>
        <p class="text">Link shortner is a free tool to shorten a URL or reduce a link
            Use our URL Shortener to create a shortened link making it easy to remember</p>
        </div>
    </div>
    <!-- <footer>
        <p id="footer">Copyright &copy; 2022 All Rights Reserved by AA </p> 
    </footer> -->
</body>
</html>


<?php
//for working....          
if (isset($_POST['link'])) {
    if ($_POST['link']!=="") {
         
    if (isset($_POST['link'])) { 
        $web = $_POST['link'];
        for ($i=0; $i <8 ; $i++) { 
            $stor[$i]=$web[$i];
        }
        for ($i=0; $i <7 ; $i++) { 
            $stor1[$i]=$web[$i];    
        }
        $store1="https://";
        $store2="http://";
    
        $store= implode("",$stor);
        $store3= implode("",$stor1);
        
        if ($store==$store1 || $store3==$store2) {
            // echo "true";
            $val = substr(md5(microtime()), rand(0,26),5); 
            $genlink='shortnerurl.rf.gd/'.$val;
           $insert = mysqli_query($conn, "INSERT into user (reallink, genlink , code) VALUES('$web','$genlink','$val') ");
            $_SESSION['genlink'] = $genlink;
            $_SESSION['web'] = $web;
            header('location:shorturl.php');
        }
        else {   
          $a="https://";
          $a.=$web;
         
          $val = substr(md5(microtime()), rand(0,26),5);
      
          $genlink='shortnerurl.rf.gd/'.$val;
    
          $insert = mysqli_query($conn, "INSERT into user (reallink, genlink , code) VALUES('$a','$genlink','$val') ");
          $_SESSION['genlink'] = $genlink;
          $_SESSION['web'] = $a;
          header('location:shorturl.php');
        }
    }  
}
else{
    echo"<script>
    alert('Enter URL');
    </script>";
}
}
    ?>