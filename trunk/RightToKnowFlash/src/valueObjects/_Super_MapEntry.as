/**
 * This is a generated class and is not intended for modification.  To customize behavior
 * of this value object you may modify the generated sub-class of this class - MapEntry.as.
 */

package valueObjects
{
import com.adobe.fiber.services.IFiberManagingService;
import com.adobe.fiber.util.FiberUtils;
import com.adobe.fiber.valueobjects.IValueObject;
import flash.events.Event;
import flash.events.EventDispatcher;
import mx.binding.utils.ChangeWatcher;
import mx.collections.ArrayCollection;
import mx.events.PropertyChangeEvent;
import mx.validators.ValidationResult;

import flash.net.registerClassAlias;
import flash.net.getClassByAlias;
import com.adobe.fiber.core.model_internal;
import com.adobe.fiber.valueobjects.IPropertyIterator;
import com.adobe.fiber.valueobjects.AvailablePropertyIterator;

use namespace model_internal;

[ExcludeClass]
public class _Super_MapEntry extends flash.events.EventDispatcher implements com.adobe.fiber.valueobjects.IValueObject
{
    model_internal static function initRemoteClassAliasSingle(cz:Class) : void
    {
    }

    model_internal static function initRemoteClassAliasAllRelated() : void
    {
    }

    model_internal var _dminternal_model : _MapEntryEntityMetadata;
    model_internal var _changedObjects:mx.collections.ArrayCollection = new ArrayCollection();

    public function getChangedObjects() : Array
    {
        _changedObjects.addItemAt(this,0);
        return _changedObjects.source;
    }

    public function clearChangedObjects() : void
    {
        _changedObjects.removeAll();
    }

    /**
     * properties
     */
    private var _internal_title : String;
    private var _internal_instanceName : String;
    private var _internal_value : String;
    private var _internal_year : int;

    private static var emptyArray:Array = new Array();


    /**
     * derived property cache initialization
     */
    model_internal var _cacheInitialized_isValid:Boolean = false;

    model_internal var _changeWatcherArray:Array = new Array();

    public function _Super_MapEntry()
    {
        _model = new _MapEntryEntityMetadata(this);

        // Bind to own data or source properties for cache invalidation triggering
        model_internal::_changeWatcherArray.push(mx.binding.utils.ChangeWatcher.watch(this, "title", model_internal::setterListenerTitle));
        model_internal::_changeWatcherArray.push(mx.binding.utils.ChangeWatcher.watch(this, "instanceName", model_internal::setterListenerInstanceName));
        model_internal::_changeWatcherArray.push(mx.binding.utils.ChangeWatcher.watch(this, "value", model_internal::setterListenerValue));

    }

    /**
     * data/source property getters
     */

    [Bindable(event="propertyChange")]
    public function get title() : String
    {
        return _internal_title;
    }

    [Bindable(event="propertyChange")]
    public function get instanceName() : String
    {
        return _internal_instanceName;
    }

    [Bindable(event="propertyChange")]
    public function get value() : String
    {
        return _internal_value;
    }

    [Bindable(event="propertyChange")]
    public function get year() : int
    {
        return _internal_year;
    }

    public function clearAssociations() : void
    {
    }

    /**
     * data/source property setters
     */

    public function set title(value:String) : void
    {
        var oldValue:String = _internal_title;
        if (oldValue !== value)
        {
            _internal_title = value;
            this.dispatchEvent(mx.events.PropertyChangeEvent.createUpdateEvent(this, "title", oldValue, _internal_title));
        }
    }

    public function set instanceName(value:String) : void
    {
        var oldValue:String = _internal_instanceName;
        if (oldValue !== value)
        {
            _internal_instanceName = value;
            this.dispatchEvent(mx.events.PropertyChangeEvent.createUpdateEvent(this, "instanceName", oldValue, _internal_instanceName));
        }
    }

    public function set value(value:String) : void
    {
        var oldValue:String = _internal_value;
        if (oldValue !== value)
        {
            _internal_value = value;
            this.dispatchEvent(mx.events.PropertyChangeEvent.createUpdateEvent(this, "value", oldValue, _internal_value));
        }
    }

    public function set year(value:int) : void
    {
        var oldValue:int = _internal_year;
        if (oldValue !== value)
        {
            _internal_year = value;
            this.dispatchEvent(mx.events.PropertyChangeEvent.createUpdateEvent(this, "year", oldValue, _internal_year));
        }
    }

    /**
     * Data/source property setter listeners
     *
     * Each data property whose value affects other properties or the validity of the entity
     * needs to invalidate all previously calculated artifacts. These include:
     *  - any derived properties or constraints that reference the given data property.
     *  - any availability guards (variant expressions) that reference the given data property.
     *  - any style validations, message tokens or guards that reference the given data property.
     *  - the validity of the property (and the containing entity) if the given data property has a length restriction.
     *  - the validity of the property (and the containing entity) if the given data property is required.
     */

    model_internal function setterListenerTitle(value:flash.events.Event):void
    {
        _model.invalidateDependentOnTitle();
    }

    model_internal function setterListenerInstanceName(value:flash.events.Event):void
    {
        _model.invalidateDependentOnInstanceName();
    }

    model_internal function setterListenerValue(value:flash.events.Event):void
    {
        _model.invalidateDependentOnValue();
    }


    /**
     * valid related derived properties
     */
    model_internal var _isValid : Boolean;
    model_internal var _invalidConstraints:Array = new Array();
    model_internal var _validationFailureMessages:Array = new Array();

    /**
     * derived property calculators
     */
    

    /**
     * isValid calculator
     */
    model_internal function calculateIsValid():Boolean
    {
        var violatedConsts:Array = new Array();
        var validationFailureMessages:Array = new Array();

        var propertyValidity:Boolean = true;
        if (!_model.titleIsValid)
        {
            propertyValidity = false;
            com.adobe.fiber.util.FiberUtils.arrayAdd(validationFailureMessages, _model.model_internal::_titleValidationFailureMessages);
        }
        if (!_model.instanceNameIsValid)
        {
            propertyValidity = false;
            com.adobe.fiber.util.FiberUtils.arrayAdd(validationFailureMessages, _model.model_internal::_instanceNameValidationFailureMessages);
        }
        if (!_model.valueIsValid)
        {
            propertyValidity = false;
            com.adobe.fiber.util.FiberUtils.arrayAdd(validationFailureMessages, _model.model_internal::_valueValidationFailureMessages);
        }

        model_internal::_cacheInitialized_isValid = true;
        model_internal::invalidConstraints_der = violatedConsts;
        model_internal::validationFailureMessages_der = validationFailureMessages;
        return violatedConsts.length == 0 && propertyValidity;
    }

    /**
     * derived property setters
     */

    model_internal function set isValid_der(value:Boolean) : void
    {
        var oldValue:Boolean = model_internal::_isValid;
        if (oldValue !== value)
        {
            model_internal::_isValid = value;
            _model.model_internal::fireChangeEvent("isValid", oldValue, model_internal::_isValid);
        }
    }

    /**
     * derived property getters
     */

    [Transient]
    [Bindable(event="propertyChange")]
    public function get _model() : _MapEntryEntityMetadata
    {
        return model_internal::_dminternal_model;
    }

    public function set _model(value : _MapEntryEntityMetadata) : void
    {
        var oldValue : _MapEntryEntityMetadata = model_internal::_dminternal_model;
        if (oldValue !== value)
        {
            model_internal::_dminternal_model = value;
            this.dispatchEvent(mx.events.PropertyChangeEvent.createUpdateEvent(this, "_model", oldValue, model_internal::_dminternal_model));
        }
    }

    /**
     * methods
     */


    /**
     *  services
     */
    private var _managingService:com.adobe.fiber.services.IFiberManagingService;

    public function set managingService(managingService:com.adobe.fiber.services.IFiberManagingService):void
    {
        _managingService = managingService;
    }

    model_internal function set invalidConstraints_der(value:Array) : void
    {
        var oldValue:Array = model_internal::_invalidConstraints;
        // avoid firing the event when old and new value are different empty arrays
        if (oldValue !== value && (oldValue.length > 0 || value.length > 0))
        {
            model_internal::_invalidConstraints = value;
            _model.model_internal::fireChangeEvent("invalidConstraints", oldValue, model_internal::_invalidConstraints);
        }
    }

    model_internal function set validationFailureMessages_der(value:Array) : void
    {
        var oldValue:Array = model_internal::_validationFailureMessages;
        // avoid firing the event when old and new value are different empty arrays
        if (oldValue !== value && (oldValue.length > 0 || value.length > 0))
        {
            model_internal::_validationFailureMessages = value;
            _model.model_internal::fireChangeEvent("validationFailureMessages", oldValue, model_internal::_validationFailureMessages);
        }
    }

    model_internal var _doValidationCacheOfTitle : Array = null;
    model_internal var _doValidationLastValOfTitle : String;

    model_internal function _doValidationForTitle(valueIn:Object):Array
    {
        var value : String = valueIn as String;

        if (model_internal::_doValidationCacheOfTitle != null && model_internal::_doValidationLastValOfTitle == value)
           return model_internal::_doValidationCacheOfTitle ;

        _model.model_internal::_titleIsValidCacheInitialized = true;
        var validationFailures:Array = new Array();
        var errorMessage:String;
        var failure:Boolean;

        var valRes:ValidationResult;
        if (_model.isTitleAvailable && _internal_title == null)
        {
            validationFailures.push(new ValidationResult(true, "", "", "title is required"));
        }

        model_internal::_doValidationCacheOfTitle = validationFailures;
        model_internal::_doValidationLastValOfTitle = value;

        return validationFailures;
    }
    
    model_internal var _doValidationCacheOfInstanceName : Array = null;
    model_internal var _doValidationLastValOfInstanceName : String;

    model_internal function _doValidationForInstanceName(valueIn:Object):Array
    {
        var value : String = valueIn as String;

        if (model_internal::_doValidationCacheOfInstanceName != null && model_internal::_doValidationLastValOfInstanceName == value)
           return model_internal::_doValidationCacheOfInstanceName ;

        _model.model_internal::_instanceNameIsValidCacheInitialized = true;
        var validationFailures:Array = new Array();
        var errorMessage:String;
        var failure:Boolean;

        var valRes:ValidationResult;
        if (_model.isInstanceNameAvailable && _internal_instanceName == null)
        {
            validationFailures.push(new ValidationResult(true, "", "", "instanceName is required"));
        }

        model_internal::_doValidationCacheOfInstanceName = validationFailures;
        model_internal::_doValidationLastValOfInstanceName = value;

        return validationFailures;
    }
    
    model_internal var _doValidationCacheOfValue : Array = null;
    model_internal var _doValidationLastValOfValue : String;

    model_internal function _doValidationForValue(valueIn:Object):Array
    {
        var value : String = valueIn as String;

        if (model_internal::_doValidationCacheOfValue != null && model_internal::_doValidationLastValOfValue == value)
           return model_internal::_doValidationCacheOfValue ;

        _model.model_internal::_valueIsValidCacheInitialized = true;
        var validationFailures:Array = new Array();
        var errorMessage:String;
        var failure:Boolean;

        var valRes:ValidationResult;
        if (_model.isValueAvailable && _internal_value == null)
        {
            validationFailures.push(new ValidationResult(true, "", "", "value is required"));
        }

        model_internal::_doValidationCacheOfValue = validationFailures;
        model_internal::_doValidationLastValOfValue = value;

        return validationFailures;
    }
    

}

}
