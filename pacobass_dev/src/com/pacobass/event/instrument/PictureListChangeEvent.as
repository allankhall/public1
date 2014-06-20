package com.pacobass.event.instrument
{
	import flash.events.Event;
	
	public class PictureListChangeEvent extends Event
	{
		public static const PICTURE_LIST_CHANGED:String = "PictureListChangeEvent";
		public var instID:int;
		public function PictureListChangeEvent(instID:int)
		{
			super(PICTURE_LIST_CHANGED, true,true);
			this.instID=instID;
		}
	}
}