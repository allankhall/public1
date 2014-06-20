package com.pacobass.event
{
	import flash.events.Event;

	public class RegisterHelperEvent extends Event
	{
		/**
		 * pass on what login alternative
		 *     (register/forgot password/...)
		 * was cchosen to application
		 */
		public static const REGISTER_HELPER:String = "registerHelper";
		public var button:String;
		public function RegisterHelperEvent(button:String)
		{
			super(REGISTER_HELPER);
			this.button = button;
		}
		
	}
}