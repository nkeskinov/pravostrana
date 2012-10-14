/**
 * This is a generated class and is not intended for modification.  To customize behavior
 * of this value object you may modify the generated sub-class of this class - EntrySetsMenu.as.
 */

package valueObjects
{
import com.adobe.fiber.services.IFiberManagingService;
import com.adobe.fiber.valueobjects.IValueObject;
import flash.events.EventDispatcher;
import mx.collections.ArrayCollection;
import mx.events.PropertyChangeEvent;

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
        try
        {
            if (flash.net.getClassByAlias("EntrySetsMenu") == null)
            {
                flash.net.registerClassAlias("EntrySetsMenu", cz);
            }
        }
        catch (e:Error)
        {
            flash.net.registerClassAlias("EntrySetsMenu", cz);
        }
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
    private var _internal_default_x : Object;
    private var _internal_default_x_id : Object;
    private var _internal_default_y : Object;
    private var _internal_default_y_id : Object;
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

    }

    /**
     * data/source property getters
     */

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


}

}
