package com.pacobass.event.leftmenu
{
	import flash.events.Event;

	public class instbbCLKEvent extends Event
	{
		public static const BUTTON_CLICKED:String = "instbbCLKEvent";
		public var buttonClicked:String;
		public function instbbCLKEvent(buttonClicked:String)
		{
			super(BUTTON_CLICKED, true, true);
			//buttonClicked = buttonClicked.replace(" ","_");
			this.buttonClicked = buttonClicked;
		}
		
	}
}