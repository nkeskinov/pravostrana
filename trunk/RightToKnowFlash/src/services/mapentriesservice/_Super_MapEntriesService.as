/**
 * This is a generated class and is not intended for modification.  To customize behavior
 * of this service wrapper you may modify the generated sub-class of this class - MapEntriesService.as.
 */
package services.mapentriesservice
{
import com.adobe.fiber.core.model_internal;
import com.adobe.fiber.services.wrapper.RemoteObjectServiceWrapper;
import com.adobe.serializers.utility.TypeUtility;
import mx.rpc.AbstractOperation;
import mx.rpc.AsyncToken;
import mx.rpc.remoting.Operation;
import mx.rpc.remoting.RemoteObject;
import valueObjects.MapEntryResult;

import mx.collections.ItemResponder;
import com.adobe.fiber.valueobjects.AvailablePropertyIterator;

[ExcludeClass]
internal class _Super_MapEntriesService extends com.adobe.fiber.services.wrapper.RemoteObjectServiceWrapper
{

    // Constructor
    public function _Super_MapEntriesService()
    {
        // initialize service control
        _serviceControl = new mx.rpc.remoting.RemoteObject();

        // initialize RemoteClass alias for all entities returned by functions of this service

        var operations:Object = new Object();
        var operation:mx.rpc.remoting.Operation;

        operation = new mx.rpc.remoting.Operation(null, "getMapEntriesByIds");
         operation.resultType = valueObjects.MapEntryResult;
        operations["getMapEntriesByIds"] = operation;

        _serviceControl.operations = operations;
        _serviceControl.convertResultHandler = com.adobe.serializers.utility.TypeUtility.convertResultHandler;
        _serviceControl.source = "MapEntriesService";
        _serviceControl.endpoint = "gateway.php";


         preInitializeService();
         model_internal::initialize();
    }
    
    //init initialization routine here, child class to override
    protected function preInitializeService():void
    {
        destination = "MapEntriesService";
      
    }
    

    /**
      * This method is a generated wrapper used to call the 'getMapEntriesByIds' operation. It returns an mx.rpc.AsyncToken whose 
      * result property will be populated with the result of the operation when the server response is received. 
      * To use this result from MXML code, define a CallResponder component and assign its token property to this method's return value. 
      * You can then bind to CallResponder.lastResult or listen for the CallResponder.result or fault events.
      *
      * @see mx.rpc.AsyncToken
      * @see mx.rpc.CallResponder 
      *
      * @return an mx.rpc.AsyncToken whose result property will be populated with the result of the operation when the server response is received.
      */
    public function getMapEntriesByIds(value1:int, value2:int) : mx.rpc.AsyncToken
    {
        var _internal_operation:mx.rpc.AbstractOperation = _serviceControl.getOperation("getMapEntriesByIds");
		var _internal_token:mx.rpc.AsyncToken = _internal_operation.send(value1,value2) ;
        return _internal_token;
    }
     
}

}
