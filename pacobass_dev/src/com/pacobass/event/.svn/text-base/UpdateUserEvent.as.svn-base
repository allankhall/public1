package com.pacobass.event
{
	import com.pacobass.amfobject.userData;
	
	import flash.events.Event;

	public class UpdateUserEvent extends Event
	{
		/**
		 * pass updated user to parent
		 */
		public static const UPDATE_USER:String = "updateUserEvent";
		public var user:userData;
		public function UpdateUserEvent(user:userData, bubbles:Boolean)
		{
			super(UPDATE_USER, bubbles);
			this.user=user;
		}
		
	}
}