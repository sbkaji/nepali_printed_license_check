<?php
 //Code by Subarna Basnet
 //Nepali License Print Check PHP
$dlno = $_POST['licno'];
if($dlno!=""){
    try{
        $url = "https://dotm.gov.np/CheckLicense/ShowDetails?name=&DlNo=".$dlno."&_=1655698386810";
        //dotm is the url which returns in json format. Do not misuse this url.
        $decoder_json = file_get_contents($url);
        $decoded_json = json_decode($decoder_json, true);
      //jscon decoded
        $dldata = $decoded_json['0'];
        //do not touch this
        $type = $dldata['Type'];
        $name = $dldata['Name'];
        $appid = $dldata['DLId'];
        $licno = $dldata['DINo'];
        $branch = $dldata['SentBranch'];
        $bdate = $dldata['DispatchDate'];
        $remark = $dldata['Remarks'];
        //variable = json(key) 
    }
    catch(Exception $e) {
        echo $e;
         echo $error="Sorry License Not Printed yet";
    }
    //pro coder
   
}
else{
     $error="Accepted Format:</br> 00-00-00000000";
}



?>
<!-- Html starts here -->
<html>
<head>
<title>Printed License Check</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- Css starts here -->
<style>
.card {
  box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
  transition: 0.3s;
  width: 80%;
  max-width:90%;
}

.card:hover {
  box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2);
}

.container {
  padding: 2px 16px;
}
input[type=text] {
  width: 80%;
  padding: 12px 20px;
  margin: 8px 0;
  box-sizing: border-box;
  border: none;
  border-radius:5px;
  background-color: #3CBC8D;
  color: white;
}
.button {
  background-color: #4CAF50; /* Green */
  border: none;
  color: white;
  border-radius:5px;
  padding: 10px 40px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
  margin: 4px 2px;
  cursor: pointer;
  box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2), 0 6px 20px 0 rgba(0,0,0,0.19);
  -webkit-transition-duration: 0.4s; /* Safari */
  transition-duration: 0.4s;
}
.button:hover {
    box-shadow: 0 15px 19px 0 rgba(0,0,0,0.24),0 17px 50px 0 rgba(0,0,0,0.19);
}
.footer {  
position: fixed;  
left: 10px;  
bottom: 5px;  
right: 10px;   
width: 95%;  
text-align: center;  
}  
</style>
</head>
<body>
    <center>
<div class="card">
  <!-- Form to collect license no -->
<form action="" method="POST">
</br>
<label><h3 style="color:blue;">Enter License No:<h3> </label>
<input type="text" name="licno" value="<?php echo $dlno;?>" placeholder="License No"/></br>
<input class="button" type="submit" value="Check" name="submit"/>
</form>
<div class="container">
<hr>
<?php
if ($decoded_json==""){
    ?>
    <h4 style="color:orange;"><?php echo $error;?></h4>
<?php
}
elseif($name==""){
    ?>
    <h4 style="color:red;">License not Printed Yet</h4>
<?php

}
else{
    ?>
    <h4 style="color:green;">Congrats your License is Printed</h4>
<label>Type: </br> <?php echo $type; ?><hr></label>
<label>Name: </br> <?php echo $name; ?><hr></label>
<label>Applicant ID: </br> <?php echo $appid; ?><hr></label>
<label>License No: </br><?php echo $licno; ?><hr></label>
<label>Printed Date: </br><?php echo $bdate; ?><hr></label>
<label>Sent to: </br><?php echo $branch; ?> Branch<hr></label>
<label>Remarks: </br><?php echo $remark; ?><hr></label>
    
    <?php
}
?>
</div>
</div>
</center>
<div class="footer">
    <p>Embeed link : <textarea disabled rows="2" cols="50"><iframe src="https://itic.org.np/lic/" width="50%" height="400px" frameborder="0"></iframe></textarea>

</textarea></p>
    <p>@Copyright <a href="https://itic.org.np"> ITIC </a> 2022- All Right Reserved. </p>
    </div>
</body>
</html>
<!--Thank You Fellows -->
