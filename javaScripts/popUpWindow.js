var popUpWin=0;
function popUpWindow(URLStr, left, top, width, height)
{
  if(popUpWin)
  {
    if(!popUpWin.closed) popUpWin.close();
  }
  var wint=0;
  var winl=0;
  if(screen.width){
	  winl=(screen.width-width)/2;
	  wint=(screen.height-height)/2;
  }
  if (winl < 0) winl = 0;
  if (wint < 0) wint = 0;
  
  popUpWin = open(URLStr, 'popUpWin', 'toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=no,resizable=no,copyhistory=yes,width='+width+',height='+height+',left='+winl+', top='+wint+',screenX='+winl+',screenY='+wint+'');
}