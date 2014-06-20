package com.pacobass.util
{
	import flash.net.FileFilter;
	public class Constant
	{
		public function Constant()
		{
		}
		//pacobass
		public static const GOOGLE_MAPS_KEY:String = 'ABQIAAAAdqhTWe-Va6NKmCnqtKJJfRTJgbA5_8XGz5Krgmb_EQeHeNXgMhRKFmTsOwZIJzP3GrHSEbtT4frm3w';
		
		
		
		//localhost
		//public static const GOOGLE_MAPS_KEY:String = 'ABQIAAAAdqhTWe-Va6NKmCnqtKJJfRT2yXp_ZAY8_ufC3CFXhHIE1NvwkxTsyTEjaFv08kHXF9z4-Hx0L1t9SQ';
		//field validators parameters
		public static const USERNAME_MIN_LENGTH:int = 3;
		public static const USERNAME_MAX_LENGTH:int = 25;
		public static const USERNAME_SHORT_ERROR:String = "username must be at least "+ USERNAME_MIN_LENGTH.toString() +" characters";
		public static const USERNAME_LONG_ERROR:String = "username cannot be longer than " + USERNAME_MAX_LENGTH.toString() +" characters";
		
		public static const FIRST_NAME_MIN_LENGTH:int = 3;
		public static const FIRST_NAME_MAX_LENGTH:int = 25;
		public static const FIRST_NAME_SHORT_ERROR:String = "first name must be at least "+ FIRST_NAME_MIN_LENGTH.toString() +" characters";
		public static const FIRST_NAME_LONG_ERROR:String = "first name cannot be longer than " + FIRST_NAME_MAX_LENGTH.toString() +" characters";
		
		public static const LAST_NAME_MIN_LENGTH:int = 3;
		public static const LAST_NAME_MAX_LENGTH:int = 25;
		public static const LAST_NAME_SHORT_ERROR:String = "last name must be at least "+ LAST_NAME_MIN_LENGTH.toString() +" characters";
		public static const LAST_NAME_LONG_ERROR:String = "last name cannot be longer than " + LAST_NAME_MAX_LENGTH.toString() +" characters";
		
		public static const PASSWORD_MIN_LENGTH:int = 6;
		public static const PASSWORD_MAX_LENGTH:int = 25;
		public static const PASSWORD_SHORT_ERROR:String = "password must be at least "+ PASSWORD_MIN_LENGTH.toString() +" characters";
		public static const PASSWORD_LONG_ERROR:String = "password cannot be longer than "+ PASSWORD_MAX_LENGTH.toString() +" characters";
		
		
		public static const ALPHANUMERIC_UNDERSCORE_REGEX:String = "A-Za-z0-9_";
		public static const ALPHA_REGEX:String = "A-Za-z";
		
		//text for labels
		public static const LINK_SEPARATOR:String = "|";
		
		//messages for passing in events
		public static const REGISTER_LINK:String = "register";
		public static const FORGOT_PASSWORD_LINK:String = "forgot password";
		public static const LOGOUT_LINK:String = "logout";
		public static const CANCEL_LINK:String = "cancel";
		public static const REGISTRATION_COMPLETE:String = "complete";
		public static const PASSWORD_SENT:String = "sent";
		public static const PASSWORD_NOT_SENT:String = "notSent";
		
		//alerts and warnings
		public static const PASSWORDS_DONT_MATCH:String = "the passwords do not match";
		public static const REGISTRATION_SUCCESS:String = "check your email for instruction on how to complete the registration process";
		public static const REGISTRATION_ERROR:String = "there was an error whiles processing your registration";
		public static const UPDATE_SUCCESS:String = "Your profile has been updated";
		public static const UPDATE_ERROR:String = "An error occurred while updating your profile";
		public static const GENERAL_ERROR:String = "An error occurred while processing your request";
		public static const LOGIN_ERROR:String = "The supplied username password combination does not match an active account";
		public static const ADD_INSTR_ERROR:String = "We were unable to add the instrument. Please try again";
		public static const UPDATE_INSTR_ERROR:String = "We were unable to update the instrument. Please try again";
		public static const REPORT_UPDATE_ERR:String = "We were unable to update your alert. Please try again";
		
		//special users
		public static const ANONYMOUS_USER:String = "anonymous";
		public static const SUSPENDED_USER:String = "suspended";
		public static const INACTIVE_USER:String = "inactive";
		
		//user status
		public static const INACTIVE:String = "inactive";
		public static const ACTIVE:String = "active"
		public static const SUSPENDED:String = "suspended";
		public static const PENDING_DELETION:String = "pending";
		public static const STATUS_ARRAY:Array = [INACTIVE, ACTIVE, SUSPENDED, PENDING_DELETION];
		
		//user roles
		public static const ADMIN_ROLE:String = "admin";
		public static const USER_ROLE:String = "user";
		public static const CONTRIBUTOR_ROLE:String = "contributor";
		public static const ROLES_ARRAY:Array = [ADMIN_ROLE, CONTRIBUTOR_ROLE, USER_ROLE];
		
		//admin button bar links
		public static const ADMINBB_FILTER:String = "filter results";
		public static const ADMINBB_STATUS:String = "update status";
		public static const ADMINBB_ROLE:String = "update role";
		public static const ADMINBB_DELETE:String = "delete user";
		public static const ADMINBB_SEND_EMAIL:String = "send an email";
		public static const ADMINBB_ACTIVATION:String = "resend activation";
		public static const ADMINBB_BACKUP:String = "backup database"
		public static const ADMINBB_RESTORE:String = "restore from backup";
		public static const ADMINBB_ARRAY:Array  = [ADMINBB_FILTER, ADMINBB_BACKUP, ADMINBB_RESTORE];
		
		//instrument button bar link
		public static const INSTBB_VIEW:String = "instruments";
		public static const INSTBB_ADD:String = "add instrument";
		public static const INSTBB_CRETEALERT:String = "create alert";
		public static const INSTBB_VIEWALERT:String = "view alerts";
		public static const INSTBB_ARRAY:Array  = [INSTBB_VIEW, INSTBB_ADD, INSTBB_VIEWALERT];
		
		//instrument DG button bar link
		public static const INSTDGBB_VIEW:String = "view";
		public static const INSTDGBB_EDIT:String = "edit";
		public static const INSTDGBB_DELETE:String = "delete";
		public static const INSTDGBB_CREATEALERT:String = "create alert";
		public static const INSTDGBB_EDITALERT:String = "edit alert";
		public static const INSTDGBB_ARRAY:Array  = [INSTDGBB_VIEW, INSTDGBB_EDIT,  INSTDGBB_DELETE, INSTDGBB_CREATEALERT];
		
		//report statuses
		public static const REPORT_ACTIVE:String = "active";
		public static const REPORT_FALSE:String =  "false_alarm";
		public static const REPORT_RECOVERED:String = "recovered";
		public static const REPORT_CANCEL:String = "cancelled";
		public static const REPORT_STATUS_ARRY:Array = [REPORT_ACTIVE, REPORT_RECOVERED, REPORT_CANCEL];
		
		//home component group
		public static const ADMIN_GROUP:String = "admin";
		public static const ARTIST_GROUP:String = "artist";
		public static const DEFAULT_GROUP:String = "home";
		public static const DETAILS_GROUP:String = "details";
		public static const EDIT_GROUP:String = "editProfile";
		
		//file upload
		public static const IMG_EXT:FileFilter = new FileFilter("Images (*.jpg, *.jpeg, *.gif, *.png)", "*.jpg; *.jpeg; *.gif; *.png");
		public static const allTypes:Array = new Array(IMG_EXT);

	}
}