package com.pacobass.amfobject
{
	[RemoteClass(alias = "sightingData")]

	public class sightingData
	{
		private var _sightingid:int;
		private var _instrumentid:int;
		private var _userid:int;
		private var _reportid:int;
		private var _clientip:String;
		private var _addressLine1:String;
		private var _addressLine2:String;
		private var _city:String;
		private var _state:String;
		private var _country:String;
		private var _zip:String;
		private var _lat:Number;
		private var _lng:Number;
		private var _reportDate:String;
		private var _statusid:int;
		private var _status:String;
		private var _description:String;
	
		public function sightingData()
		{

			
		}
		[Bindable]
		public function get sightingid():int
		{
			return _sightingid;
		}

		public function set sightingid(value:int):void
		{
			_sightingid = value;
		}

		[Bindable]
		public function get description():String
		{
			return _description;
		}

		public function set description(value:String):void
		{
			_description = value;
		}

		[Bindable]
		public function get status():String
		{
			return _status;
		}

		public function set status(value:String):void
		{
			_status = value;
		}

		[Bindable]
		public function get reportid():int
		{
			return _reportid;
		}

		public function set reportid(value:int):void
		{
			_reportid = value;
		}

		[Bindable]
		public function get statusid():int
		{
			return _statusid;
		}

		public function set statusid(value:int):void
		{
			_statusid = value;
		}

		[Bindable]
		public function get reportDate():String
		{
			return _reportDate;
		}

		public function set reportDate(value:String):void
		{
			_reportDate = value;
		}

		[Bindable]
		public function get lng():Number
		{
			return _lng;
		}

		public function set lng(value:Number):void
		{
			_lng = value;
		}

		[Bindable]
		public function get lat():Number
		{
			return _lat;
		}

		public function set lat(value:Number):void
		{
			_lat = value;
		}

		[Bindable]
		public function get zip():String
		{
			return _zip;
		}

		public function set zip(value:String):void
		{
			_zip = value;
		}

		[Bindable]
		public function get country():String
		{
			return _country;
		}

		public function set country(value:String):void
		{
			_country = value;
		}

		[Bindable]
		public function get state():String
		{
			return _state;
		}

		public function set state(value:String):void
		{
			_state = value;
		}

		[Bindable]
		public function get city():String
		{
			return _city;
		}

		public function set city(value:String):void
		{
			_city = value;
		}

		[Bindable]
		public function get addressLine2():String
		{
			return _addressLine2;
		}

		public function set addressLine2(value:String):void
		{
			_addressLine2 = value;
		}

		[Bindable]
		public function get addressLine1():String
		{
			return _addressLine1;
		}

		public function set addressLine1(value:String):void
		{
			_addressLine1 = value;
		}

		[Bindable]
		public function get clientip():String
		{
			return _clientip;
		}

		public function set clientip(value:String):void
		{
			_clientip = value;
		}

		[Bindable]
		public function get userid():int
		{
			return _userid;
		}

		public function set userid(value:int):void
		{
			_userid = value;
		}

		[Bindable]
		public function get instrumentid():int
		{
			return _instrumentid;
		}

		public function set instrumentid(value:int):void
		{
			_instrumentid = value;
		}

	}
}