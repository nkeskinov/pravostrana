package org.most.righttoknow.controls
{
	import flash.events.ProgressEvent;
	
	import mx.preloaders.*;
	import mx.resources.ResourceManager;
	
	
	
	public class Preloader extends DownloadProgressBar
	{
		public function Preloader()
		{   
			super();
			
		 	
			//resourceManager.localeChain = ["mk_MK"];
			// Set the download label.
			downloadingLabel="Вчитување..."
			// Set the initialization label.
			initializingLabel="Имаш и ти право да знаеш!";
		    
			// Set the minimum display time to 2 seconds.
			MINIMUM_DISPLAY_TIME=2000;
		}
		
		// Override to return true so progress bar appears
		// during initialization.       
		override protected function showDisplayForInit(elapsedTime:int, 
													   count:int):Boolean {
			return true;
		}
		
		// Override to return true so progress bar appears during download.     
		override protected function showDisplayForDownloading(
			elapsedTime:int, event:ProgressEvent):Boolean {
			return true;
		}
	}
	
}
