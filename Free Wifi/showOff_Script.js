
var oldCount = -1;
var newCount = -2;
var timeoutCount = 0;

var loopCount = 0;
 
 
$(document).ready(function(){
   startTimer();
   
   
   // load all those pics the first time
               $('#pics').load('photoDisplay.php');
               
   //  hide some stuff we need but don;t want to see
			         $('#reset').hide();
						 // $('#debug').hide();
						   

});

function startTimer()
  {
      setInterval(function() {pollServer()},2000);  // change 1000 to change how often this happens
                                                    // this is 1/second - I would go bigger but
                                                   // not smaller
  }

// gets called ever second -- not a page reload!

function pollServer() {

  // increment counter
    loopCount++;
    var howMany = 0;
	
	    $('#debug').html('top' + loopCount);
    
    // display check to indicate we are doing this every second
    //   $('#proveWeAreTestingRegularly').html('check for new pic ' + count);
    
   
    // go get the file that is holding new info
    //      $('#debug').load("newUpload.txt", function(returnedData) {

    // get eh file count
    $('#debug').load("pictureCount.txt", function(returnedData) {
        
        newCount = returnedData;
        $('#debug').html('newCount ' + newCount);
      
        // wired JS scope shit around variables
        if (newCount != oldCount ||  timeoutCount > 10 ) { 
            
            // go get the new pics and reload the other stuff
            // you have this already --  i think ?
       // $('#images').html('** NEW PIC HERE **  This one added at count = ' + count).insertAfter('#first');
          //  $('#pics').load('photoDisplay.php');

            
            // reset the remote text file via a PHP script because now we have a pic
            // kind of a hack -- .load() needs a selector -- but we want this to be invisible
            // in practice add an empty tag in the HTML file and hide it always.
            // $('#reset').load('setUploadToZero.php');
            timeoutCount = 0;

            
        } else  { 
        
            $("#theVar").html('no new pictures (YET) ' + howMany); 
            timeoutCount ++;
        }
        
        oldCount = newCount;
        
      });

  
} // end pollServer()
