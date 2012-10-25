/**
 * This is a generated class and is not intended for modification.  To customize behavior
 * of this value object you may modify the generated sub-class of this class - BubbleServiceResult.as.
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
public class _Super_BubbleServiceResult extends flash.events.EventDispatcher implements com.adobe.fiber.valueobjects.IValueObject
{
    model_internal static function initRemoteClassAliasSingle(cz:Class) : void
    {
        try
        {
            if (flash.net.getClassByAlias("BubbleServiceResult") == null)
            {
                flash.net.registerClassAlias("BubbleServiceResult", cz);
            }
        }
        catch (e:Error)
        {
            flash.net.registerClassAlias("BubbleServiceResult", cz);
        }
    }

    model_internal static function initRemoteClassAliasAllRelated() : void
    {
    }

    model_internal var _dminternal_model : _BubbleServiceResultEntityMetadata;
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
    private var _internal_minYear : Object;
    private var _internal_maxYear : Object;
    private var _internal_minXValue : Object;
    private var _internal_maxXValue : Object;
    private var _internal_minYValue : Object;
    private var _internal_maxYValue : Object;
    private var _internal_rows : Object;

    private static var emptyArray:Array = new Array();


    /**
     * derived property cache initialization
     */
    model_internal var _cacheInitialized_isValid:Boolean = false;

    model_internal var _changeWatcherArray:Array = new Array();

    public function _Super_BubbleServiceResult()
    {
        _model = new _BubbleServiceResultEntityMetadata(this);

        // Bind to own data or source properties for cache invalidation triggering

    }

    /**
     * data/source property getters
     */

    [Bindable(event="propertyChange")]
    public function get minYear() : Object
    {
        return _internal_minYear;
    }

    [Bindable(event="propertyChange")]
    public function get maxYear() : Object
    {
        return _internal_maxYear;
    }

    [Bindable(event="propertyChange")]
    public function get minXValue() : Object
    {
        return _internal_minXValue;
    }

    [Bindable(event="propertyChange")]
    public function get maxXValue() : Object
    {
        return _internal_maxXValue;
    }

    [Bindable(event="propertyChange")]
    public function get minYValue() : Object
    {
        return _internal_minYValue;
    }

    [Bindable(event="propertyChange")]
    public function get maxYValue() : Object
    {
        return _internal_maxYValue;
    }

    [Bindable(event="propertyChange")]
    public function get rows() : Object
    {
        return _internal_rows;
    }

    public function clearAssociations() : void
    {
    }

    /**
     * data/source property setters
     */

    public function set minYear(value:Object) : void
    {
        var oldValue:Object = _internal_minYear;
        if (oldValue !== value)
        {
            _internal_minYear = value;
            this.dispatchEvent(mx.events.PropertyChangeEvent.createUpdateEvent(this, "minYear", oldValue, _internal_minYear));
        }
    }

    public function set maxYear(value:Object) : void
    {
        var oldValue:Object = _internal_maxYear;
        if (oldValue !== value)
        {
            _internal_maxYear = value;
            this.dispatchEvent(mx.events.PropertyChangeEvent.createUpdateEvent(this, "maxYear", oldValue, _internal_maxYear));
        }
    }

    public function set minXValue(value:Object) : void
    {
        var oldValue:Object = _internal_minXValue;
        if (oldValue !== value)
        {
            _internal_minXValue = value;
            this.dispatchEvent(mx.events.PropertyChangeEvent.createUpdateEvent(this, "minXValue", oldValue, _internal_minXValue));
        }
    }

    public function set maxXValue(value:Object) : void
    {
        var oldValue:Object = _internal_maxXValue;
        if (oldValue !== value)
        {
            _internal_maxXValue = value;
            this.dispatchEvent(mx.events.PropertyChangeEvent.createUpdateEvent(this, "maxXValue", oldValue, _internal_maxXValue));
        }
    }

    public function set minYValue(value:Object) : void
    {
        var oldValue:Object = _internal_minYValue;
        if (oldValue !== value)
        {
            _internal_minYValue = value;
            this.dispatchEvent(mx.events.PropertyChangeEvent.createUpdateEvent(this, "minYValue", oldValue, _internal_minYValue));
        }
    }

    public function set maxYValue(value:Object) : void
    {
        var oldValue:Object = _internal_maxYValue;
        if (oldValue !== value)
        {
            _internal_maxYValue = value;
            this.dispatchEvent(mx.events.PropertyChangeEvent.createUpdateEvent(this, "maxYValue", oldValue, _internal_maxYValue));
        }
    }

    public function set rows(value:Object) : void
    {
        var oldValue:Object = _internal_rows;
        if (oldValue !== value)
        {
            _internal_rows = value;
            this.dispatchEvent(mx.events.PropertyChangeEvent.createUpdateEvent(this, "rows", oldValue, _internal_rows));
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
    public function get _model() : _BubbleServiceResultEntityMetadata
    {
        return model_internal::_dminternal_model;
    }

    public function set _model(value : _BubbleServiceResultEntityMetadata) : void
    {
        var oldValue : _BubbleServiceResultEntityMetadata = model_internal::_dminternal_model;
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
