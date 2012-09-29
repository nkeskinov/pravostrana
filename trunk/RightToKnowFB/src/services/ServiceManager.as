package services
{

import flash.utils.Dictionary;

import mx.controls.Alert;
import mx.rpc.events.FaultEvent;
import services.mapentriesservice.MapEntriesService;

public class ServiceManager
{
	private static var instance:ServiceManager;
	
	private var servicesMap:Dictionary = new Dictionary();
	
	public function ServiceManager()
	{
		if (instance != null)
			throw new Error("Singleton - Can't Instanstiate");
		
		instance = this;
	}
	
	public static function getInstance():ServiceManager
	{
		if (instance == null)
			instance = new ServiceManager();
		
		return instance;
	}
	
	private function faultHandler(event:FaultEvent):void
	{
		Alert.show(event.fault.faultString + "\n" + event.fault.faultDetail);
	}

	public function get mapEntriesService():MapEntriesService
	{
		
		var service:MapEntriesService = servicesMap["mapEntriesService"];
		if (service == null)
		{
			service = new MapEntriesService();
			service.showBusyCursor = true;
			service.addEventListener(FaultEvent.FAULT, faultHandler);
			servicesMap["mapEntriesService"] = service;
		}
		
		return service;
	}

}

}
