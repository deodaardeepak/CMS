  <?php
   session_start(); //starts the session
   if($_SESSION['user']){ // checks if the user is logged in  
   }
   else{
      header("location: index.php"); // redirects if user is not logged in
   }
   $user = $_SESSION['user']; //assigns user value
   ?>



<br><br><br><br><br><form method="post" enctype="multipart/form-data">

<table border="1">

<tr>

<Td>Upload  Video</td></tr>

<Tr><td><input type="file" name="fileToUpload"/></td></tr>

<tr><td>

<input type="submit" value="Uplaod Video" name="upd"/>

<input type="submit" value="Display Video" name="disp"/>

</td></tr>

</table>

</form>	


<a href="adminhome.php"><button>Click Here to Go Back</button></a>

<?php

error_reporting(1);

$con=mysql_connect("localhost","root","");

mysql_select_db("transven",$con);

extract($_POST);

$target_dir = "test_upload/";

$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);

if($upd)
{
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);

if($imageFileType != "mp4" && $imageFileType != "avi" && $imageFileType != "mov" && $imageFileType != "3gp" && $imageFileType != "mpeg")
{
    echo "File Format Not Suppoted";
} 

else
{

$video_path=$_FILES['fileToUpload']['name'];

$abc=mysql_query("insert into video(video_name) values('$video_path')");

if($abc)
	{echo "Inserted";
}
else{

	echo "Na ho";
}

move_uploaded_file($_FILES["fileToUpload"]["tmp_name"],$target_file);

echo "uploaded ";

}

}

//display all uploaded video

if($disp)

{

$query=mysql_query("select * from video");

	while($all_video=mysql_fetch_array($query))

	{
?>
	 
	 <video width="300" height="200" controls>
	<source src="test_upload/<?php echo $all_video['video_name']; ?>" type="video/mp4">
	</video> 
	
	<?php } } ?>
	
	
