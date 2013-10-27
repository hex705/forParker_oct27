<?php
	 // header("Location: http://www.parkerkay.com/freewifi.html");

$_newfile = false;

$allowedExts = array("jpg", "jpeg", "gif", "png");
$extension = end(explode(".", $_FILES["file"]["name"]));
if ((($_FILES["file"]["type"] == "image/gif")
|| ($_FILES["file"]["type"] == "image/jpeg")
|| ($_FILES["file"]["type"] == "image/png")
|| ($_FILES["file"]["type"] == "image/pjpeg"))
&& ($_FILES["file"]["size"] < 2000000)
&& in_array($extension, $allowedExts))
  {
  if ($_FILES["file"]["error"] > 0)
    {
    echo "Return Code: " . $_FILES["file"]["error"] . "<br>";
    }
  else
    {
    echo "Upload: " . $_FILES["file"]["name"] . "<br>";
    echo "Type: " . $_FILES["file"]["type"] . "<br>";
    echo "Size: " . ($_FILES["file"]["size"] / 1024) . " kB<br>";
    echo "Temp file: " . $_FILES["file"]["tmp_name"] . "<br>";

    if (file_exists("upload/" . $_FILES["file"]["name"]))
      {
      echo $_FILES["file"]["name"] . " already exists. ";
      }
    else
      {
      move_uploaded_file($_FILES["file"]["tmp_name"],
      "upload/" . $_FILES["file"]["name"]);
      echo "Stored in: " . "upload/" . $_FILES["file"]["name"];
	    
	    
	    // $_newfile = true;
		  // echo "<br>new file" . $_newfile;
		  // set a flag that says new upload
		  // _______________________
		  $imageFolder = "upload/";
      $images = scandir($imageFolder);

      $imageCount = sizeof($images);
      echo 'files in folder ' , $imageCount;

       $filename = "pictureCount.txt";
      // clear the upload state file 
      $storedPictureCount = file_get_contents($filename);
      $storedPictureCount = $imageCount;
      file_put_contents($filename, $storedPictureCount);
      //+++++++++++++++++++++++++


		  
		  
		  /*
		  +++++++++++++++++++++++++++++++++++
		  write a 1 to a file -- but multiuser won;t work
		  
      $filename = "newUpload.txt";
      // clear the upload state file 
        $file = fopen($filename,"w");
        fclose($file);
        echo "<br><br>File cleared";
      // write the fact that a new file arrived
      $file = fopen($filename,"a");
      fwrite($file,"1\n"); 
      
      fclose($file);
      +++++++++++++++++++++++++++++++++++++
      */
	  
	  // Print Uploaded File //
	  
	  /* $command = 'lp -o media=letter -o fitplot -d Xerox_Phaser_3040 ';
       $printfile = 'test.jpg';
	  // $printfile = "upload/" . $_FILES["file"]["name"];
	   $run = $command . $printfile;
       echo $run . '<br>';
       echo exec($run);
	  
	  // command library – lpstat -a to see printer in terminal
	  // exec('lp ..... ' . $printfile);*/
      }
    }
  }
else
  {
  echo "Invalid file";
  
  }
  
  
?>
