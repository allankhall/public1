package com.pacobass.util
{
	public class DateUtil
	{
		public function DateUtil()
		{
		}
		public static function asDateToMySQL(date:Date):String{
			return date.getFullYear()+"-"+(date.getMonth()+1)+"-"+date.getDate();
		}
		public static function MySQLToasDate(date:String):Date{
			var a:Array = date.split( '-' );
			return new Date( a[0], a[1] - 1, a[2] );

		}

	}
}