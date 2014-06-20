package com.pacobass.instrument
{
	import com.pacobass.amfobject.instrumentData;

	public class InstrumentDGRow extends instrumentData
	{
		private var _select:Boolean;
		
		public function InstrumentDGRow()
		{
			super();
		}
		
		[Bindable]
		public function set select(select:Boolean):void{
			_select = select;
		}
		public function get select():Boolean{
			return _select;
			
		}
		
	}
}