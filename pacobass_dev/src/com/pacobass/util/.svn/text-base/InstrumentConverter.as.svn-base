package com.pacobass.util
{
	import com.pacobass.amfobject.instrumentData;
	import com.pacobass.instrument.InstrumentDGRow;
	public class InstrumentConverter
	{
		public function InstrumentConverter()
		{
		}
		
		public static function Data2DG(data:instrumentData):InstrumentDGRow{
			var dg:InstrumentDGRow = new InstrumentDGRow();
			dg.instrumentid = data.instrumentid;
			dg.userid = data.userid;
			dg.nickname = data.nickname;
			dg.serial = data.serial;
			dg.description = data.description;
			dg.stolen = data.stolen;
			dg.select = false;
			return dg;			
		}
		
		public static function DG2Data(dg:InstrumentDGRow):instrumentData{
			var data:instrumentData = new instrumentData();
			data.instrumentid = dg.instrumentid;
			data.userid = dg.userid;
			data.nickname = dg.nickname;
			data.serial = dg.serial;
			data.description = dg.description;
			data.stolen = dg.stolen;
			return data;			
		}
		

	}
}