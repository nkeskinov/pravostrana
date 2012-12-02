/**
 * This is a generated class and is not intended for modification.  To customize behavior
 * of this value object you may modify the generated sub-class of this class - EntrySetsMenu.as.
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
public class _Super_EntrySetsMenu extends flash.events.EventDispatcher implements com.adobe.fiber.valueobjects.IValueObject
{
    model_internal static function initRemoteClassAliasSingle(cz:Class) : void
    {
        flash.net.registerClassAlias("EntrySetsMenu", cz);
    }

    model_internal static function initRemoteClassAliasAllRelated() : void
    {
    }

    model_internal var _dminternal_model : _EntrySetsMenuEntityMetadata;
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
    private var _internal_default_y_sq : String;
    private var _internal_default_y_en : String;
    private var _internal_default_x_en : String;
    private var _internal_default_z : String;
    private var _internal_default_z_en : String;
    private var _internal_default_z_sq : String;
    private var _internal_default_x_sq : String;
    private var _internal_default_z_id : int;
    private var _internal_default_x : Object;
    private var _internal_default_x_id : Object;
    private var _internal_default_y : Object;
    private var _internal_default_y_id : Object;
    private var _internal_x_axis : Object;
    private var _internal_y_axis : Object;
    private var _internal_default_tab : Object;
    private var _internal_menu : Object;

    private static var emptyArray:Array = new Array();


    /**
     * derived property cache initialization
     */
    model_internal var _cacheInitialized_isValid:Boolean = false;

    model_internal var _changeWatcherArray:Array = new Array();

    public function _Super_EntrySetsMenu()
    {
        _model = new _EntrySetsMenuEntityMetadata(this);

        // Bind to own data or source properties for cache invalidation triggering
        model_internal::_changeWatcherArray.push(mx.binding.utils.ChangeWatcher.watch(this, "default_y_sq", model_internal::setterListenerDefault_y_sq));
        model_internal::_changeWatcherArray.push(mx.binding.utils.ChangeWatcher.watch(this, "default_y_en", model_internal::setterListenerDefault_y_en));
        model_internal::_changeWatcherArray.push(mx.binding.utils.ChangeWatcher.watch(this, "default_x_en", model_internal::setterListenerDefault_x_en));
        model_internal::_changeWatcherArray.push(mx.binding.utils.ChangeWatcher.watch(this, "default_z", model_internal::setterListenerDefault_z));
        model_internal::_changeWatcherArray.push(mx.binding.utils.ChangeWatcher.watch(this, "default_z_en", model_internal::setterListenerDefault_z_en));
        model_internal::_changeWatcherArray.push(mx.binding.utils.ChangeWatcher.watch(this, "default_z_sq", model_internal::setterListenerDefault_z_sq));
        model_internal::_changeWatcherArray.push(mx.binding.utils.ChangeWatcher.watch(this, "default_x_sq", model_internal::setterListenerDefault_x_sq));

    }

    /**
     * data/source property getters
     */

    [Bindable(event="propertyChange")]
    public function get default_y_sq() : String
    {
        return _internal_default_y_sq;
    }

    [Bindable(event="propertyChange")]
    public function get default_y_en() : String
    {
        return _internal_default_y_en;
    }

    [Bindable(event="propertyChange")]
    public function get default_x_en() : String
    {
        return _internal_default_x_en;
    }

    [Bindable(event="propertyChange")]
    public function get default_z() : String
    {
        return _internal_default_z;
    }

    [Bindable(event="propertyChange")]
    public function get default_z_en() : String
    {
        return _internal_default_z_en;
    }

    [Bindable(event="propertyChange")]
    public function get default_z_sq() : String
    {
        return _internal_default_z_sq;
    }

    [Bindable(event="propertyChange")]
    public function get default_x_sq() : String
    {
        return _internal_default_x_sq;
    }

    [Bindable(event="propertyChange")]
    public function get default_z_id() : int
    {
        return _internal_default_z_id;
    }

    [Bindable(event="propertyChange")]
    public function get default_x() : Object
    {
        return _internal_default_x;
    }

    [Bindable(event="propertyChange")]
    public function get default_x_id() : Object
    {
        return _internal_default_x_id;
    }

    [Bindable(event="propertyChange")]
    public function get default_y() : Object
    {
        return _internal_default_y;
    }

    [Bindable(event="propertyChange")]
    public function get default_y_id() : Object
    {
        return _internal_default_y_id;
    }

    [Bindable(event="propertyChange")]
    public function get x_axis() : Object
    {
        return _internal_x_axis;
    }

    [Bindable(event="propertyChange")]
    public function get y_axis() : Object
    {
        return _internal_y_axis;
    }

    [Bindable(event="propertyChange")]
    public function get default_tab() : Object
    {
        return _internal_default_tab;
    }

    [Bindable(event="propertyChange")]
    public function get menu() : Object
    {
        return _internal_menu;
    }

    public function clearAssociations() : void
    {
    }

    /**
     * data/source property setters
     */

    public function set default_y_sq(value:String) : void
    {
        var oldValue:String = _internal_default_y_sq;
        if (oldValue !== value)
        {
            _internal_default_y_sq = value;
            this.dispatchEvent(mx.events.PropertyChangeEvent.createUpdateEvent(this, "default_y_sq", oldValue, _internal_default_y_sq));
        }
    }

    public function set default_y_en(value:String) : void
    {
        var oldValue:String = _internal_default_y_en;
        if (oldValue !== value)
        {
            _internal_default_y_en = value;
            this.dispatchEvent(mx.events.PropertyChangeEvent.createUpdateEvent(this, "default_y_en", oldValue, _internal_default_y_en));
        }
    }

    public function set default_x_en(value:String) : void
    {
        var oldValue:String = _internal_default_x_en;
        if (oldValue !== value)
        {
            _internal_default_x_en = value;
            this.dispatchEvent(mx.events.PropertyChangeEvent.createUpdateEvent(this, "default_x_en", oldValue, _internal_default_x_en));
        }
    }

    public function set default_z(value:String) : void
    {
        var oldValue:String = _internal_default_z;
        if (oldValue !== value)
        {
            _internal_default_z = value;
            this.dispatchEvent(mx.events.PropertyChangeEvent.createUpdateEvent(this, "default_z", oldValue, _internal_default_z));
        }
    }

    public function set default_z_en(value:String) : void
    {
        var oldValue:String = _internal_default_z_en;
        if (oldValue !== value)
        {
            _internal_default_z_en = value;
            this.dispatchEvent(mx.events.PropertyChangeEvent.createUpdateEvent(this, "default_z_en", oldValue, _internal_default_z_en));
        }
    }

    public function set default_z_sq(value:String) : void
    {
        var oldValue:String = _internal_default_z_sq;
        if (oldValue !== value)
        {
            _internal_default_z_sq = value;
            this.dispatchEvent(mx.events.PropertyChangeEvent.createUpdateEvent(this, "default_z_sq", oldValue, _internal_default_z_sq));
        }
    }

    public function set default_x_sq(value:String) : void
    {
        var oldValue:String = _internal_default_x_sq;
        if (oldValue !== value)
        {
            _internal_default_x_sq = value;
            this.dispatchEvent(mx.events.PropertyChangeEvent.createUpdateEvent(this, "default_x_sq", oldValue, _internal_default_x_sq));
        }
    }

    public function set default_z_id(value:int) : void
    {
        var oldValue:int = _internal_default_z_id;
        if (oldValue !== value)
        {
            _internal_default_z_id = value;
            this.dispatchEvent(mx.events.PropertyChangeEvent.createUpdateEvent(this, "default_z_id", oldValue, _internal_default_z_id));
        }
    }

    public function set default_x(value:Object) : void
    {
        var oldValue:Object = _internal_default_x;
        if (oldValue !== value)
        {
            _internal_default_x = value;
            this.dispatchEvent(mx.events.PropertyChangeEvent.createUpdateEvent(this, "default_x", oldValue, _internal_default_x));
        }
    }

    public function set default_x_id(value:Object) : void
    {
        var oldValue:Object = _internal_default_x_id;
        if (oldValue !== value)
        {
            _internal_default_x_id = value;
            this.dispatchEvent(mx.events.PropertyChangeEvent.createUpdateEvent(this, "default_x_id", oldValue, _internal_default_x_id));
        }
    }

    public function set default_y(value:Object) : void
    {
        var oldValue:Object = _internal_default_y;
        if (oldValue !== value)
        {
            _internal_default_y = value;
            this.dispatchEvent(mx.events.PropertyChangeEvent.createUpdateEvent(this, "default_y", oldValue, _internal_default_y));
        }
    }

    public function set default_y_id(value:Object) : void
    {
        var oldValue:Object = _internal_default_y_id;
        if (oldValue !== value)
        {
            _internal_default_y_id = value;
            this.dispatchEvent(mx.events.PropertyChangeEvent.createUpdateEvent(this, "default_y_id", oldValue, _internal_default_y_id));
        }
    }

    public function set x_axis(value:Object) : void
    {
        var oldValue:Object = _internal_x_axis;
        if (oldValue !== value)
        {
            _internal_x_axis = value;
            this.dispatchEvent(mx.events.PropertyChangeEvent.createUpdateEvent(this, "x_axis", oldValue, _internal_x_axis));
        }
    }

    public function set y_axis(value:Object) : void
    {
        var oldValue:Object = _internal_y_axis;
        if (oldValue !== value)
        {
            _internal_y_axis = value;
            this.dispatchEvent(mx.events.PropertyChangeEvent.createUpdateEvent(this, "y_axis", oldValue, _internal_y_axis));
        }
    }

    public function set default_tab(value:Object) : void
    {
        var oldValue:Object = _internal_default_tab;
        if (oldValue !== value)
        {
            _internal_default_tab = value;
            this.dispatchEvent(mx.events.PropertyChangeEvent.createUpdateEvent(this, "default_tab", oldValue, _internal_default_tab));
        }
    }

    public function set menu(value:Object) : void
    {
        var oldValue:Object = _internal_menu;
        if (oldValue !== value)
        {
            _internal_menu = value;
            this.dispatchEvent(mx.events.PropertyChangeEvent.createUpdateEvent(this, "menu", oldValue, _internal_menu));
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

    model_internal function setterListenerDefault_y_sq(value:flash.events.Event):void
    {
        _model.invalidateDependentOnDefault_y_sq();
    }

    model_internal function setterListenerDefault_y_en(value:flash.events.Event):void
    {
        _model.invalidateDependentOnDefault_y_en();
    }

    model_internal function setterListenerDefault_x_en(value:flash.events.Event):void
    {
        _model.invalidateDependentOnDefault_x_en();
    }

    model_internal function setterListenerDefault_z(value:flash.events.Event):void
    {
        _model.invalidateDependentOnDefault_z();
    }

    model_internal function setterListenerDefault_z_en(value:flash.events.Event):void
    {
        _model.invalidateDependentOnDefault_z_en();
    }

    model_internal function setterListenerDefault_z_sq(value:flash.events.Event):void
    {
        _model.invalidateDependentOnDefault_z_sq();
    }

    model_internal function setterListenerDefault_x_sq(value:flash.events.Event):void
    {
        _model.invalidateDependentOnDefault_x_sq();
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
        if (!_model.default_y_sqIsValid)
        {
            propertyValidity = false;
            com.adobe.fiber.util.FiberUtils.arrayAdd(validationFailureMessages, _model.model_internal::_default_y_sqValidationFailureMessages);
        }
        if (!_model.default_y_enIsValid)
        {
            propertyValidity = false;
            com.adobe.fiber.util.FiberUtils.arrayAdd(validationFailureMessages, _model.model_internal::_default_y_enValidationFailureMessages);
        }
        if (!_model.default_x_enIsValid)
        {
            propertyValidity = false;
            com.adobe.fiber.util.FiberUtils.arrayAdd(validationFailureMessages, _model.model_internal::_default_x_enValidationFailureMessages);
        }
        if (!_model.default_zIsValid)
        {
            propertyValidity = false;
            com.adobe.fiber.util.FiberUtils.arrayAdd(validationFailureMessages, _model.model_internal::_default_zValidationFailureMessages);
        }
        if (!_model.default_z_enIsValid)
        {
            propertyValidity = false;
            com.adobe.fiber.util.FiberUtils.arrayAdd(validationFailureMessages, _model.model_internal::_default_z_enValidationFailureMessages);
        }
        if (!_model.default_z_sqIsValid)
        {
            propertyValidity = false;
            com.adobe.fiber.util.FiberUtils.arrayAdd(validationFailureMessages, _model.model_internal::_default_z_sqValidationFailureMessages);
        }
        if (!_model.default_x_sqIsValid)
        {
            propertyValidity = false;
            com.adobe.fiber.util.FiberUtils.arrayAdd(validationFailureMessages, _model.model_internal::_default_x_sqValidationFailureMessages);
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
    public function get _model() : _EntrySetsMenuEntityMetadata
    {
        return model_internal::_dminternal_model;
    }

    public function set _model(value : _EntrySetsMenuEntityMetadata) : void
    {
        var oldValue : _EntrySetsMenuEntityMetadata = model_internal::_dminternal_model;
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

    model_internal var _doValidationCacheOfDefault_y_sq : Array = null;
    model_internal var _doValidationLastValOfDefault_y_sq : String;

    model_internal function _doValidationForDefault_y_sq(valueIn:Object):Array
    {
        var value : String = valueIn as String;

        if (model_internal::_doValidationCacheOfDefault_y_sq != null && model_internal::_doValidationLastValOfDefault_y_sq == value)
           return model_internal::_doValidationCacheOfDefault_y_sq ;

        _model.model_internal::_default_y_sqIsValidCacheInitialized = true;
        var validationFailures:Array = new Array();
        var errorMessage:String;
        var failure:Boolean;

        var valRes:ValidationResult;
        if (_model.isDefault_y_sqAvailable && _internal_default_y_sq == null)
        {
            validationFailures.push(new ValidationResult(true, "", "", "default_y_sq is required"));
        }

        model_internal::_doValidationCacheOfDefault_y_sq = validationFailures;
        model_internal::_doValidationLastValOfDefault_y_sq = value;

        return validationFailures;
    }
    
    model_internal var _doValidationCacheOfDefault_y_en : Array = null;
    model_internal var _doValidationLastValOfDefault_y_en : String;

    model_internal function _doValidationForDefault_y_en(valueIn:Object):Array
    {
        var value : String = valueIn as String;

        if (model_internal::_doValidationCacheOfDefault_y_en != null && model_internal::_doValidationLastValOfDefault_y_en == value)
           return model_internal::_doValidationCacheOfDefault_y_en ;

        _model.model_internal::_default_y_enIsValidCacheInitialized = true;
        var validationFailures:Array = new Array();
        var errorMessage:String;
        var failure:Boolean;

        var valRes:ValidationResult;
        if (_model.isDefault_y_enAvailable && _internal_default_y_en == null)
        {
            validationFailures.push(new ValidationResult(true, "", "", "default_y_en is required"));
        }

        model_internal::_doValidationCacheOfDefault_y_en = validationFailures;
        model_internal::_doValidationLastValOfDefault_y_en = value;

        return validationFailures;
    }
    
    model_internal var _doValidationCacheOfDefault_x_en : Array = null;
    model_internal var _doValidationLastValOfDefault_x_en : String;

    model_internal function _doValidationForDefault_x_en(valueIn:Object):Array
    {
        var value : String = valueIn as String;

        if (model_internal::_doValidationCacheOfDefault_x_en != null && model_internal::_doValidationLastValOfDefault_x_en == value)
           return model_internal::_doValidationCacheOfDefault_x_en ;

        _model.model_internal::_default_x_enIsValidCacheInitialized = true;
        var validationFailures:Array = new Array();
        var errorMessage:String;
        var failure:Boolean;

        var valRes:ValidationResult;
        if (_model.isDefault_x_enAvailable && _internal_default_x_en == null)
        {
            validationFailures.push(new ValidationResult(true, "", "", "default_x_en is required"));
        }

        model_internal::_doValidationCacheOfDefault_x_en = validationFailures;
        model_internal::_doValidationLastValOfDefault_x_en = value;

        return validationFailures;
    }
    
    model_internal var _doValidationCacheOfDefault_z : Array = null;
    model_internal var _doValidationLastValOfDefault_z : String;

    model_internal function _doValidationForDefault_z(valueIn:Object):Array
    {
        var value : String = valueIn as String;

        if (model_internal::_doValidationCacheOfDefault_z != null && model_internal::_doValidationLastValOfDefault_z == value)
           return model_internal::_doValidationCacheOfDefault_z ;

        _model.model_internal::_default_zIsValidCacheInitialized = true;
        var validationFailures:Array = new Array();
        var errorMessage:String;
        var failure:Boolean;

        var valRes:ValidationResult;
        if (_model.isDefault_zAvailable && _internal_default_z == null)
        {
            validationFailures.push(new ValidationResult(true, "", "", "default_z is required"));
        }

        model_internal::_doValidationCacheOfDefault_z = validationFailures;
        model_internal::_doValidationLastValOfDefault_z = value;

        return validationFailures;
    }
    
    model_internal var _doValidationCacheOfDefault_z_en : Array = null;
    model_internal var _doValidationLastValOfDefault_z_en : String;

    model_internal function _doValidationForDefault_z_en(valueIn:Object):Array
    {
        var value : String = valueIn as String;

        if (model_internal::_doValidationCacheOfDefault_z_en != null && model_internal::_doValidationLastValOfDefault_z_en == value)
           return model_internal::_doValidationCacheOfDefault_z_en ;

        _model.model_internal::_default_z_enIsValidCacheInitialized = true;
        var validationFailures:Array = new Array();
        var errorMessage:String;
        var failure:Boolean;

        var valRes:ValidationResult;
        if (_model.isDefault_z_enAvailable && _internal_default_z_en == null)
        {
            validationFailures.push(new ValidationResult(true, "", "", "default_z_en is required"));
        }

        model_internal::_doValidationCacheOfDefault_z_en = validationFailures;
        model_internal::_doValidationLastValOfDefault_z_en = value;

        return validationFailures;
    }
    
    model_internal var _doValidationCacheOfDefault_z_sq : Array = null;
    model_internal var _doValidationLastValOfDefault_z_sq : String;

    model_internal function _doValidationForDefault_z_sq(valueIn:Object):Array
    {
        var value : String = valueIn as String;

        if (model_internal::_doValidationCacheOfDefault_z_sq != null && model_internal::_doValidationLastValOfDefault_z_sq == value)
           return model_internal::_doValidationCacheOfDefault_z_sq ;

        _model.model_internal::_default_z_sqIsValidCacheInitialized = true;
        var validationFailures:Array = new Array();
        var errorMessage:String;
        var failure:Boolean;

        var valRes:ValidationResult;
        if (_model.isDefault_z_sqAvailable && _internal_default_z_sq == null)
        {
            validationFailures.push(new ValidationResult(true, "", "", "default_z_sq is required"));
        }

        model_internal::_doValidationCacheOfDefault_z_sq = validationFailures;
        model_internal::_doValidationLastValOfDefault_z_sq = value;

        return validationFailures;
    }
    
    model_internal var _doValidationCacheOfDefault_x_sq : Array = null;
    model_internal var _doValidationLastValOfDefault_x_sq : String;

    model_internal function _doValidationForDefault_x_sq(valueIn:Object):Array
    {
        var value : String = valueIn as String;

        if (model_internal::_doValidationCacheOfDefault_x_sq != null && model_internal::_doValidationLastValOfDefault_x_sq == value)
           return model_internal::_doValidationCacheOfDefault_x_sq ;

        _model.model_internal::_default_x_sqIsValidCacheInitialized = true;
        var validationFailures:Array = new Array();
        var errorMessage:String;
        var failure:Boolean;

        var valRes:ValidationResult;
        if (_model.isDefault_x_sqAvailable && _internal_default_x_sq == null)
        {
            validationFailures.push(new ValidationResult(true, "", "", "default_x_sq is required"));
        }

        model_internal::_doValidationCacheOfDefault_x_sq = validationFailures;
        model_internal::_doValidationLastValOfDefault_x_sq = value;

        return validationFailures;
    }
    

}

}
