var checkSessionTimeEvent;

$(document).ready(function() {
	//event to check session time left (times 1000 to convert seconds to milliseconds)
    checkSessionTimeEvent = setInterval("checkSessionTime()",10*1000);
});
//Your timing variables in number of seconds

//total length of session in seconds
var sessionLength = 300; 
//time warning shown (10 = warning box shown 10 seconds before session starts)
var warning = 10;  
//time redirect forced (10 = redirect forced 10 seconds after session ends)     
var forceRedirect = 10; 

//time session started
var pageRequestTime = new Date();

//session timeout length
var timeoutLength = sessionLength*1000;

//set time for first warning, ten seconds before session expires
var warningTime = timeoutLength - (warning*1000);

//force redirect to log in page length (session timeout plus 10 seconds)
var forceRedirectLength = timeoutLength + (forceRedirect*1000);

//set number of seconds to count down from for countdown ticker
var countdownTime = warning;

//warning dialog open; countdown underway
var warningStarted = false;

function checkSessionTime()
{
	//get time now
	var timeNow = new Date(); 
	
	//event create countdown ticker variable declaration
	var countdownTickerEvent; 	
	
	//difference between time now and time session started variable declartion
	var timeDifference = 0;
	
	timeDifference = timeNow - pageRequestTime;

    if (timeDifference > warningTime && warningStarted === false)
        {            
            //call now for initial dialog box text (time left until session timeout)
            countdownTicker(); 
            
            //set as interval event to countdown seconds to session timeout
            countdownTickerEvent = setInterval("countdownTicker()", 1000);
            
            $('#dialogWarning').dialog('open');
			warningStarted = true;
        }
    else if (timeDifference > timeoutLength){
    		//close warning dialog box
            if ($('#dialogWarning').dialog('isOpen')) $('#dialogWarning').dialog('close');
            
            //$("p#dialogText-expired").html(timeDifference);
            $('#dialogExpired').dialog('open');
            
             //clear (stop) countdown ticker
            clearInterval(countdownTickerEvent);
        }
        
    if (timeDifference > forceRedirectLength)
     	{    
        	//clear (stop) checksession event
            clearInterval(checkSessionTimeEvent);
            //force relocation
            window.location="index.php?m=mylib&s=login";
        }

}

function countdownTicker()
{
	//put countdown time left in dialog box
	$("span#dialogText-warning").html(countdownTime);
	
	//decrement countdownTime
	countdownTime--;
}

$(function(){              
                // jQuery UI Dialog    
                $('#dialogWarning').dialog({
                    autoOpen: false,
                    width: 400,
                    modal: true,
                    resizable: false,
                    buttons: {
                        "Restart Session": function() {
                            location.reload();
                        }
                    }
                });
                
                $('#dialogExpired').dialog({
                    autoOpen: false,
                    width: 400,
                    modal: true,
                    resizable: false,
					close: function() {
                            window.location="index.php?m=mylib&s=login";
                        },
                    buttons: {
                        "Login": function() {
                            window.location="index.php?m=mylib&s=login";
                        }
                    }
                });
});
