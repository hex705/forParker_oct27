

Free Wifi Processing Print

with thanks to David Bouchard for he always awesome insights.



Parker:

2 more files to add to your system 

1) no more need for NODE

2) add the images.php file to the same folder you have all the other PHP files. MAKE SURE it is an executable on your server.

3) the processing sketch is going to run separately on your gallery computer.  this keeps the printing separate from delay. PUT IT ON DESKTOP OR SOMEWHERE WITH NO SPACES IN PATH. spaces in LOCAL folder tree breaks printing.

4) in the processing sketch you need to point at a bunch of stuff with urls and file names.  here they are: 


there is a file called printedImagesList.txt -- on first run it may not get found and you may see a null pointer -- just restart sketch.  if it is still throwing the error add the file manually to your sketch folder as an empty text file.  (it may all go smoothly).


in void printNextImage()

there is a link to the server FOLDER that contains upload folder.

same method put  the string name of your printer.

use lpstat -a in your terminal to see printers. 



in void checkForNewImages() 

change url to match the location of the new PHP file.




my computer was throwing memory errors -- I increased size of memory to processing in processing prefs and this solved that ( a reboot helped as well)

thanks to some bouchard magic -- the system will remember who is printed so if this gets turned off -- it will not repeat any old files when restarted.

cool.

good-luck.

s (and d) 