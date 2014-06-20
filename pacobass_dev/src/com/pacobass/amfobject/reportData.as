package com.pacobass.amfobject
{
	[RemoteClass(alias = "reportData")]
	public class reportData
	{
		
		private var _userid:int;
		private var _reportid:int;
		private var _instrumentid:int;
		private var _dateStolen:String;
		private var _dateRecovered:String;
		private var _status:String;
		private var _description:String;
		private var _addressLine1:String;
		private var _addressLine2:String;
		private var _city:String;
		private var _state:String;
		private var _country:String;
		private var _zip:String;
		private var _reward:int;
		private var _rewardBool:Boolean;
		private var _lng:Number;
		private var _lat:Number;
		
		public function reportData()
		{
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
		public function get lng():Number
		{
			return _lng;
		}

		public function set lng(value:Number):void
		{
			_lng = value;
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
		public function set userid(userid:int):void
		{
			_userid = userid;
		}
		public function get userid():int{
			return _userid;
		}
		
		[Bindable]
		public function set reportid(reportid:int):void
		{
			_reportid = reportid;
		}
		public function get reportid():int{
			return _reportid;
		}	
		
		[Bindable]
		public function set instrumentid(instrumentid:int):void
		{
			_instrumentid = instrumentid;
		}
		public function get instrumentid():int{
			return _instrumentid;
		}
		
		[Bindable]
		public function set dateStolen(dateStolen:String):void
		{
			_dateStolen = dateStolen;
		}
		public function get dateStolen():String{
			return _dateStolen;
		}
		
		[Bindable]
		public function set dateRecovered(dateRecovered:String):void
		{
			_dateRecovered = dateRecovered;
		}
		public function get dateRecovered():String{
			return _dateRecovered;
		}
		
		[Bindable]
		public function set status(status:String):void
		{
			_status = status;
		}
		public function get status():String{
			return _status;
		}
		
		[Bindable]
		public function set description(description:String):void
		{
			_description = description;
		}
		public function get description():String{
			return _description;
		}
		
		[Bindable]
		public function set city(city:String):void
		{
			_city = city;
		}
		public function get city():String{
			return _city;
		}

		[Bindable]
		public function set state(state:String):void
		{
			_state = state;
		}
		public function get state():String{
			return _state;
		}
		
		[Bindable]
		public function set country(country:String):void
		{
			_country = country;
		}
		public function get country():String{
			return _country;
		}
		
		[Bindable]
		public function set zip(zip:String):void
		{
			_zip = zip;
		}
		public function get zip():String{
			return _zip;
		}
		
		[Bindable]
		public function set reward(reward:int):void
		{
			_reward = reward;
		}
		public function get reward():int{
			return _reward;
		}
		
		[Bindable]
		public function set rewardBool(rewardBool:Boolean):void
		{
			_rewardBool = rewardBool;
		}
		public function get rewardBool():Boolean{
			return _rewardBool;
		}
				
					

	}
}