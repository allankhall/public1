package com.pacobass.event
{
	import flash.events.Event;

	public class ForgotPasswordHelperEvent extends Event
	{
		/**
		 * pass on what login alternative
		 *     (register/forgot password/...)
		 * was cchosen to application
		 */
		public static const FORGOT_PASSWORD_HELPER:String = "forgotPasswordHelper";
		public var button:String;
		public function ForgotPasswordHelperEvent(button:String)
		{
			super(FORGOT_PASSWORD_HELPER);
			this.button = button;
		}
		
	}
}