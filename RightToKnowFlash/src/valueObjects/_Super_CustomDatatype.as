/**
 * This is a generated class and is not intended for modification.  To customize behavior
 * of this value object you may modify the generated sub-class of this class - CustomDatatype.as.
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
public class _Super_CustomDatatype extends flash.events.EventDispatcher implements com.adobe.fiber.valueobjects.IValueObject
{
    model_internal static function initRemoteClassAliasSingle(cz:Class) : void
    {
    }

    model_internal static function initRemoteClassAliasAllRelated() : void
    {
    }

    model_internal var _dminternal_model : _CustomDatatypeEntityMetadata;
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
    private var _internal_name_sq : String;
    private var _internal_map_id : String;
    private var _internal_id_municipality : int;
    private var _internal_name_en : String;
    private var _internal_name : String;

    private static var emptyArray:Array = new Array();


    /**
     * derived property cache initialization
     */
    model_internal var _cacheInitialized_isValid:Boolean = false;

    model_internal var _changeWatcherArray:Array = new Array();

    public function _Super_CustomDatatype()
    {
        _model = new _CustomDatatypeEntityMetadata(this);

        // Bind to own data or source properties for cache invalidation triggering
        model_internal::_changeWatcherArray.push(mx.binding.utils.ChangeWatcher.watch(this, "name_sq", model_internal::setterListenerName_sq));
        model_internal::_changeWatcherArray.push(mx.binding.utils.ChangeWatcher.watch(this, "map_id", model_internal::setterListenerMap_id));
        model_internal::_changeWatcherArray.push(mx.binding.utils.ChangeWatcher.watch(this, "name_en", model_internal::setterListenerName_en));
        model_internal::_changeWatcherArray.push(mx.binding.utils.ChangeWatcher.watch(this, "name", model_internal::setterListenerName));

    }

    /**
     * data/source property getters
     */

    [Bindable(event="propertyChange")]
    public function get name_sq() : String
    {
        return _internal_name_sq;
    }

    [Bindable(event="propertyChange")]
    public function get map_id() : String
    {
        return _internal_map_id;
    }

    [Bindable(event="propertyChange")]
    public function get id_municipality() : int
    {
        return _internal_id_municipality;
    }

    [Bindable(event="propertyChange")]
    public function get name_en() : String
    {
        return _internal_name_en;
    }

    [Bindable(event="propertyChange")]
    public function get name() : String
    {
        return _internal_name;
    }

    public function clearAssociations() : void
    {
    }

    /**
     * data/source property setters
     */

    public function set name_sq(value:String) : void
    {
        var oldValue:String = _internal_name_sq;
        if (oldValue !== value)
        {
            _internal_name_sq = value;
            this.dispatchEvent(mx.events.PropertyChangeEvent.createUpdateEvent(this, "name_sq", oldValue, _internal_name_sq));
        }
    }

    public function set map_id(value:String) : void
    {
        var oldValue:String = _internal_map_id;
        if (oldValue !== value)
        {
            _internal_map_id = value;
            this.dispatchEvent(mx.events.PropertyChangeEvent.createUpdateEvent(this, "map_id", oldValue, _internal_map_id));
        }
    }

    public function set id_municipality(value:int) : void
    {
        var oldValue:int = _internal_id_municipality;
        if (oldValue !== value)
        {
            _internal_id_municipality = value;
            this.dispatchEvent(mx.events.PropertyChangeEvent.createUpdateEvent(this, "id_municipality", oldValue, _internal_id_municipality));
        }
    }

    public function set name_en(value:String) : void
    {
        var oldValue:String = _internal_name_en;
        if (oldValue !== value)
        {
            _internal_name_en = value;
            this.dispatchEvent(mx.events.PropertyChangeEvent.createUpdateEvent(this, "name_en", oldValue, _internal_name_en));
        }
    }

    public function set name(value:String) : void
    {
        var oldValue:String = _internal_name;
        if (oldValue !== value)
        {
            _internal_name = value;
            this.dispatchEvent(mx.events.PropertyChangeEvent.createUpdateEvent(this, "name", oldValue, _internal_name));
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

    model_internal function setterListenerName_sq(value:flash.events.Event):void
    {
        _model.invalidateDependentOnName_sq();
    }

    model_internal function setterListenerMap_id(value:flash.events.Event):void
    {
        _model.invalidateDependentOnMap_id();
    }

    model_internal function setterListenerName_en(value:flash.events.Event):void
    {
        _model.invalidateDependentOnName_en();
    }

    model_internal function setterListenerName(value:flash.events.Event):void
    {
        _model.invalidateDependentOnName();
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
        if (!_model.name_sqIsValid)
        {
            propertyValidity = false;
            com.adobe.fiber.util.FiberUtils.arrayAdd(validationFailureMessages, _model.model_internal::_name_sqValidationFailureMessages);
        }
        if (!_model.map_idIsValid)
        {
            propertyValidity = false;
            com.adobe.fiber.util.FiberUtils.arrayAdd(validationFailureMessages, _model.model_internal::_map_idValidationFailureMessages);
        }
        if (!_model.name_enIsValid)
        {
            propertyValidity = false;
            com.adobe.fiber.util.FiberUtils.arrayAdd(validationFailureMessages, _model.model_internal::_name_enValidationFailureMessages);
        }
        if (!_model.nameIsValid)
        {
            propertyValidity = false;
            com.adobe.fiber.util.FiberUtils.arrayAdd(validationFailureMessages, _model.model_internal::_nameValidationFailureMessages);
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
    public function get _model() : _CustomDatatypeEntityMetadata
    {
        return model_internal::_dminternal_model;
    }

    public function set _model(value : _CustomDatatypeEntityMetadata) : void
    {
        var oldValue : _CustomDatatypeEntityMetadata = model_internal::_dminternal_model;
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

    model_internal var _doValidationCacheOfName_sq : Array = null;
    model_internal var _doValidationLastValOfName_sq : String;

    model_internal function _doValidationForName_sq(valueIn:Object):Array
    {
        var value : String = valueIn as String;

        if (model_internal::_doValidationCacheOfName_sq != null && model_internal::_doValidationLastValOfName_sq == value)
           return model_internal::_doValidationCacheOfName_sq ;

        _model.model_internal::_name_sqIsValidCacheInitialized = true;
        var validationFailures:Array = new Array();
        var errorMessage:String;
        var failure:Boolean;

        var valRes:ValidationResult;
        if (_model.isName_sqAvailable && _internal_name_sq == null)
        {
            validationFailures.push(new ValidationResult(true, "", "", "name_sq is required"));
        }

        model_internal::_doValidationCacheOfName_sq = validationFailures;
        model_internal::_doValidationLastValOfName_sq = value;

        return validationFailures;
    }
    
    model_internal var _doValidationCacheOfMap_id : Array = null;
    model_internal var _doValidationLastValOfMap_id : String;

    model_internal function _doValidationForMap_id(valueIn:Object):Array
    {
        var value : String = valueIn as String;

        if (model_internal::_doValidationCacheOfMap_id != null && model_internal::_doValidationLastValOfMap_id == value)
           return model_internal::_doValidationCacheOfMap_id ;

        _model.model_internal::_map_idIsValidCacheInitialized = true;
        var validationFailures:Array = new Array();
        var errorMessage:String;
        var failure:Boolean;

        var valRes:ValidationResult;
        if (_model.isMap_idAvailable && _internal_map_id == null)
        {
            validationFailures.push(new ValidationResult(true, "", "", "map_id is required"));
        }

        model_internal::_doValidationCacheOfMap_id = validationFailures;
        model_internal::_doValidationLastValOfMap_id = value;

        return validationFailures;
    }
    
    model_internal var _doValidationCacheOfName_en : Array = null;
    model_internal var _doValidationLastValOfName_en : String;

    model_internal function _doValidationForName_en(valueIn:Object):Array
    {
        var value : String = valueIn as String;

        if (model_internal::_doValidationCacheOfName_en != null && model_internal::_doValidationLastValOfName_en == value)
           return model_internal::_doValidationCacheOfName_en ;

        _model.model_internal::_name_enIsValidCacheInitialized = true;
        var validationFailures:Array = new Array();
        var errorMessage:String;
        var failure:Boolean;

        var valRes:ValidationResult;
        if (_model.isName_enAvailable && _internal_name_en == null)
        {
            validationFailures.push(new ValidationResult(true, "", "", "name_en is required"));
        }

        model_internal::_doValidationCacheOfName_en = validationFailures;
        model_internal::_doValidationLastValOfName_en = value;

        return validationFailures;
    }
    
    model_internal var _doValidationCacheOfName : Array = null;
    model_internal var _doValidationLastValOfName : String;

    model_internal function _doValidationForName(valueIn:Object):Array
    {
        var value : String = valueIn as String;

        if (model_internal::_doValidationCacheOfName != null && model_internal::_doValidationLastValOfName == value)
           return model_internal::_doValidationCacheOfName ;

        _model.model_internal::_nameIsValidCacheInitialized = true;
        var validationFailures:Array = new Array();
        var errorMessage:String;
        var failure:Boolean;

        var valRes:ValidationResult;
        if (_model.isNameAvailable && _internal_name == null)
        {
            validationFailures.push(new ValidationResult(true, "", "", "name is required"));
        }

        model_internal::_doValidationCacheOfName = validationFailures;
        model_internal::_doValidationLastValOfName = value;

        return validationFailures;
    }
    

}

}
