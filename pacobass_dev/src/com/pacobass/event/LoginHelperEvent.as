package com.pacobass.event
{
	import flash.events.Event;

	public class LoginHelperEvent extends Event
	{
		/**
		 * pass on what login alternative
		 *     (register/forgot password/...)
		 * was cchosen to application
		 */
		public static const LOGIN_HELPER:String = "loginHelper";
		public var link:String;
		public function LoginHelperEvent(link:String)
		{
			super(LOGIN_HELPER);
			this.link = link;
		}
		
	}
}