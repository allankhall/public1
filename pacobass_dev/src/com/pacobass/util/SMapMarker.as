package com.pacobass.util{

	import com.google.maps.InfoWindowOptions;
	import com.google.maps.LatLng;
	import com.google.maps.MapMouseEvent;
	import com.google.maps.overlays.Marker;
	import com.google.maps.overlays.MarkerOptions;
	import com.google.maps.styles.FillStyle;
	import com.pacobass.amfobject.pMarkerData;
	import com.pacobass.amfobject.sightingData;
	import com.pacobass.amfobject.reportData;
	import com.pacobass.component.account.LoginBox;
	import com.pacobass.event.PMarkerClickEvent;
	
	import flash.events.Event;
	
	import mx.controls.Alert;
	
	[Event(name="clicked", type="com.pacobass.event.PMarkerClickEvent")]
	[Event(name="rollover", type="com.pacobass.event.PMarkerClickEvent")]
	[Event(name="rollout", type="com.pacobass.event.PMarkerClickEvent")]
	
/**
 * Subclass for google maps map marker
 * basic data is com.pacobass.amfobject.sightingData
 */ 
	public class SMapMarker extends Marker {
		private var popup:InfoWindowOptions;
		private var _reportD:reportData;
		private var _pMarkerD:sightingData

		private var dispatcher:EventDispatcher;
		
		public function SMapMarker(reportIn:sightingData, arg0:LatLng, arg1:MarkerOptions=null){
			_pMarkerD = new sightingData();
			_pMarkerD = reportIn;
			super(arg0, arg1);
			addEventListener(MapMouseEvent.ROLL_OVER, pMapRollOver);
			addEventListener(MapMouseEvent.ROLL_OUT, pMapRollOut);
			addEventListener(MapMouseEvent.CLICK, pMapClick);
			popup = new InfoWindowOptions();
			popup.hasShadow = true;		

		}

		public function get pMarkerD():sightingData
		{
			return _pMarkerD;
		}

		public function set pMarkerD(value:sightingData):void
		{
			_pMarkerD = value;
		}

		[Bindable]
		public function get reportD():reportData
		{
			return _reportD;
		}

		public function set reportD(value:reportData):void
		{
			_reportD = value;
		}

		private function pMapRollOver(event:Event):void{
	//		popup.content = pMarkerD.getDisplayString();
	//		openInfoWindow(popup);
	//		dispatchEvent(new PMarkerClickEvent("rollover",pMarkerD, true));

		}
		
		private function pMapRollOut(event:Event):void{
	//		closeInfoWindow();
	//		dispatchEvent(new PMarkerClickEvent("rollout",pMarkerD, true));

		}
		private function pMapClick(event:Event):void{
	//		dispatchEvent(new PMarkerClickEvent("clicked",pMarkerD, true));
		}
		
	
	}
}