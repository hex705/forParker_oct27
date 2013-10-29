import deadpixel.command.*;
import java.util.LinkedList;

long timerStart;
int timerLength = 10000; // because printing is slow, this can be less frequent

ArrayList<String> printedImages = new ArrayList(); 
LinkedList<String> printQueue = new LinkedList();  // queue-style list 

void setup() {  
  size(700,700);
  println("start");

  timerStart = millis()-timerLength+1;
  
  // Load the cached data from printedImagesList
  try {
    String[] alreadyPrinted = loadStrings("printedImagesList.txt");
    for (String s : alreadyPrinted) {
      println("Already printed: " + s);
      printedImages.add(s); 
    }  
  }
  catch (Exception e) {
     e.printStackTrace(); // could crash the first time if the txt file is not there yet  
  }
}

void draw() {
  if ( millis() > (timerStart + timerLength)) {          
     checkForNewImages();
     
     // Check if we have a new image to print
     if (printQueue.size() > 0) { 
       printNextImage();
     }
     
     timerStart = millis(); // resetTimer
  }     
}


//////////////////////////////////////////////////////////////////////////////////
// Download and print the next available image
void printNextImage() {
     String nextImage = printQueue.removeFirst();
     
     println("Getting ready to print " + nextImage);
       
     // Parker add your URL to image folder here     
     String remoteUrl  = ( "http://www.spinningtheweb.org/sandbox/parker/Free%20Wifi/" );
     //String remoteUrl = "http://localhost:8888/parker/Free Wifi/";
     println("file to get " + remoteUrl + nextImage);
     // Load & display the image 
     println("Downloading.");
     PImage i = loadImage (remoteUrl + nextImage);
     image(i, 0, 0, width, height);
      
     // Save & print it  
     println("Saving and printing.");
     String absoluteImagePath = dataPath(nextImage);
     i.save(absoluteImagePath);
     println(" abs img path " + absoluteImagePath ) ;
     // parker set your printer name here
     
     // This should be the name of your printer
     // You can find out what that is by using the "lpstat -a" command
     // in a terminal 
     String yourPrinter = "Canon_MX420_series__617B7F6881F8"; 
     
     
     Command c = new Command("lp -o media=letter -o fitplot -d " + yourPrinter + " " + absoluteImagePath);
     c.run();
     
     
     // Add it to the printed list so that we don't try to print it again
     addToPrintList(nextImage); 
     println("Done.");
}

//////////////////////////////////////////////////////////////////////////////////
// Adds new images to the print queue as they are added on the server
void checkForNewImages() {
  
  // put URL for the new images.php file here
  String[] images = loadStrings("http://www.spinningtheweb.org/sandbox/parker/Free%20Wifi/images.php");  
  // If an image has not yet been printed, add it to the queue
  for (String img : images) {
    if (printedImages.contains(img) == false && printQueue.contains(img) == false) {
      println("Adding to queue: " + img);
      printQueue.add(img);     
    }
  }
}


//////////////////////////////////////////////////////////////////////////////////
// adds the image to the printed list
// also saves the list to a file that can be reloaded in case the program restarts
void addToPrintList(String imgFile) {
  printedImages.add(imgFile);
  String[] images = printedImages.toArray(new String[0]);  
  saveStrings("printedImagesList.txt", images);
}




