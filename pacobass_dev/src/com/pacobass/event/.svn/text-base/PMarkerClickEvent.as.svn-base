package com.pacobass.event{
	import com.pacobass.amfobject.pMarkerData;
	
	import flash.events.Event;
	
	public class PMarkerClickEvent extends Event{
		public static const CLICKED:String = "clicked";
		public static const ROLL_OVER:String = "rollover";
		public static const ROLL_OUT:String = "rollout";
		public var pMarkerD:pMarkerData;

		public function PMarkerClickEvent(type:String,pMarkerD:pMarkerData, bubbles:Boolean){
			super(type, bubbles, false);
			this.pMarkerD = pMarkerD;
		}
	}
}