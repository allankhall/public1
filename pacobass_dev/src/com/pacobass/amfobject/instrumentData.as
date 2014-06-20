package com.pacobass.amfobject
{
	[RemoteClass(alias = "instrumentData")]
	public class instrumentData
	{
		private var _instrumentid:int;
		private var _userid:int;
		private var _nickname:String;
		private var _serial:String;
		private var _description:String;
		private var _stolen:Boolean;
		public function instrumentData()
		{
		}
	
		[Bindable]
		public function set instrumentid(instrumentid:int):void{
			_instrumentid = instrumentid;
		}
		public function get instrumentid():int{
			return _instrumentid;
			
		}

		
		[Bindable]
		public function set userid(userid:int):void{
			_userid = userid;
		}
		public function get userid():int{
			return _userid;
		}
		
		[Bindable]
		public function set nickname(nickname:String):void{
			_nickname = nickname;
		}
		public function get nickname():String{
			return _nickname;
		}
		
		[Bindable]
		public function set serial(serial:String):void{
			_serial = serial;
		}
		public function get serial():String{
			return _serial;
		}
		
		[Bindable]
		public function set description(description:String):void{
			_description= description;
		}
		public function get description():String{
			return _description;
		}
		
		[Bindable]
		public function set stolen(stolen:Boolean):void{
			_stolen = stolen;
		}
		public function get stolen():Boolean{
			return _stolen;
		}
		

	}
}