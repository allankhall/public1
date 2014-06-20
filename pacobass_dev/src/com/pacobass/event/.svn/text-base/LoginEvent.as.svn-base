package com.pacobass.event
{
	import com.pacobass.amfobject.userData;
	import com.pacobass.util.Constant;
	import mx.controls.Alert;
	import flash.events.Event;
	public class LoginEvent extends Event
	{
		/**
		 * pass user to application
		 * upon successful login
		 */
		public static const LOGIN:String = "login";
		public var user:userData;
		public function LoginEvent(user:userData)
		{
			super(LOGIN);
			this.user=user;
		}

	}
}