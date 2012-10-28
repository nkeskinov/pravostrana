
/**
 * This is a generated class and is not intended for modification.  
 */
package valueObjects
{
import com.adobe.fiber.styles.IStyle;
import com.adobe.fiber.styles.Style;
import com.adobe.fiber.styles.StyleValidator;
import com.adobe.fiber.valueobjects.AbstractEntityMetadata;
import com.adobe.fiber.valueobjects.AvailablePropertyIterator;
import com.adobe.fiber.valueobjects.IPropertyIterator;
import mx.events.ValidationResultEvent;
import com.adobe.fiber.core.model_internal;
import com.adobe.fiber.valueobjects.IModelType;
import mx.events.PropertyChangeEvent;

use namespace model_internal;

[ExcludeClass]
internal class _EntrySetsMenuEntityMetadata extends com.adobe.fiber.valueobjects.AbstractEntityMetadata
{
    private static var emptyArray:Array = new Array();

    model_internal static var allProperties:Array = new Array("default_y_sq", "default_y_en", "default_x_en", "default_z", "default_z_en", "default_z_sq", "default_x_sq", "default_z_id", "default_x", "default_x_id", "default_y", "default_y_id", "x_axis", "y_axis", "default_tab", "menu");
    model_internal static var allAssociationProperties:Array = new Array();
    model_internal static var allRequiredProperties:Array = new Array("default_y_sq", "default_y_en", "default_x_en", "default_z", "default_z_en", "default_z_sq", "default_x_sq", "default_z_id");
    model_internal static var allAlwaysAvailableProperties:Array = new Array("default_y_sq", "default_y_en", "default_x_en", "default_z", "default_z_en", "default_z_sq", "default_x_sq", "default_z_id", "default_x", "default_x_id", "default_y", "default_y_id", "x_axis", "y_axis", "default_tab", "menu");
    model_internal static var guardedProperties:Array = new Array();
    model_internal static var dataProperties:Array = new Array("default_y_sq", "default_y_en", "default_x_en", "default_z", "default_z_en", "default_z_sq", "default_x_sq", "default_z_id", "default_x", "default_x_id", "default_y", "default_y_id", "x_axis", "y_axis", "default_tab", "menu");
    model_internal static var sourceProperties:Array = emptyArray
    model_internal static var nonDerivedProperties:Array = new Array("default_y_sq", "default_y_en", "default_x_en", "default_z", "default_z_en", "default_z_sq", "default_x_sq", "default_z_id", "default_x", "default_x_id", "default_y", "default_y_id", "x_axis", "y_axis", "default_tab", "menu");
    model_internal static var derivedProperties:Array = new Array();
    model_internal static var collectionProperties:Array = new Array();
    model_internal static var collectionBaseMap:Object;
    model_internal static var entityName:String = "EntrySetsMenu";
    model_internal static var dependentsOnMap:Object;
    model_internal static var dependedOnServices:Array = new Array();
    model_internal static var propertyTypeMap:Object;

    
    model_internal var _default_y_sqIsValid:Boolean;
    model_internal var _default_y_sqValidator:com.adobe.fiber.styles.StyleValidator;
    model_internal var _default_y_sqIsValidCacheInitialized:Boolean = false;
    model_internal var _default_y_sqValidationFailureMessages:Array;
    
    model_internal var _default_y_enIsValid:Boolean;
    model_internal var _default_y_enValidator:com.adobe.fiber.styles.StyleValidator;
    model_internal var _default_y_enIsValidCacheInitialized:Boolean = false;
    model_internal var _default_y_enValidationFailureMessages:Array;
    
    model_internal var _default_x_enIsValid:Boolean;
    model_internal var _default_x_enValidator:com.adobe.fiber.styles.StyleValidator;
    model_internal var _default_x_enIsValidCacheInitialized:Boolean = false;
    model_internal var _default_x_enValidationFailureMessages:Array;
    
    model_internal var _default_zIsValid:Boolean;
    model_internal var _default_zValidator:com.adobe.fiber.styles.StyleValidator;
    model_internal var _default_zIsValidCacheInitialized:Boolean = false;
    model_internal var _default_zValidationFailureMessages:Array;
    
    model_internal var _default_z_enIsValid:Boolean;
    model_internal var _default_z_enValidator:com.adobe.fiber.styles.StyleValidator;
    model_internal var _default_z_enIsValidCacheInitialized:Boolean = false;
    model_internal var _default_z_enValidationFailureMessages:Array;
    
    model_internal var _default_z_sqIsValid:Boolean;
    model_internal var _default_z_sqValidator:com.adobe.fiber.styles.StyleValidator;
    model_internal var _default_z_sqIsValidCacheInitialized:Boolean = false;
    model_internal var _default_z_sqValidationFailureMessages:Array;
    
    model_internal var _default_x_sqIsValid:Boolean;
    model_internal var _default_x_sqValidator:com.adobe.fiber.styles.StyleValidator;
    model_internal var _default_x_sqIsValidCacheInitialized:Boolean = false;
    model_internal var _default_x_sqValidationFailureMessages:Array;

    model_internal var _instance:_Super_EntrySetsMenu;
    model_internal static var _nullStyle:com.adobe.fiber.styles.Style = new com.adobe.fiber.styles.Style();

    public function _EntrySetsMenuEntityMetadata(value : _Super_EntrySetsMenu)
    {
        // initialize property maps
        if (model_internal::dependentsOnMap == null)
        {
            // dependents map
            model_internal::dependentsOnMap = new Object();
            model_internal::dependentsOnMap["default_y_sq"] = new Array();
            model_internal::dependentsOnMap["default_y_en"] = new Array();
            model_internal::dependentsOnMap["default_x_en"] = new Array();
            model_internal::dependentsOnMap["default_z"] = new Array();
            model_internal::dependentsOnMap["default_z_en"] = new Array();
            model_internal::dependentsOnMap["default_z_sq"] = new Array();
            model_internal::dependentsOnMap["default_x_sq"] = new Array();
            model_internal::dependentsOnMap["default_z_id"] = new Array();
            model_internal::dependentsOnMap["default_x"] = new Array();
            model_internal::dependentsOnMap["default_x_id"] = new Array();
            model_internal::dependentsOnMap["default_y"] = new Array();
            model_internal::dependentsOnMap["default_y_id"] = new Array();
            model_internal::dependentsOnMap["x_axis"] = new Array();
            model_internal::dependentsOnMap["y_axis"] = new Array();
            model_internal::dependentsOnMap["default_tab"] = new Array();
            model_internal::dependentsOnMap["menu"] = new Array();

            // collection base map
            model_internal::collectionBaseMap = new Object();
        }

        // Property type Map
        model_internal::propertyTypeMap = new Object();
        model_internal::propertyTypeMap["default_y_sq"] = "String";
        model_internal::propertyTypeMap["default_y_en"] = "String";
        model_internal::propertyTypeMap["default_x_en"] = "String";
        model_internal::propertyTypeMap["default_z"] = "String";
        model_internal::propertyTypeMap["default_z_en"] = "String";
        model_internal::propertyTypeMap["default_z_sq"] = "String";
        model_internal::propertyTypeMap["default_x_sq"] = "String";
        model_internal::propertyTypeMap["default_z_id"] = "int";
        model_internal::propertyTypeMap["default_x"] = "Object";
        model_internal::propertyTypeMap["default_x_id"] = "Object";
        model_internal::propertyTypeMap["default_y"] = "Object";
        model_internal::propertyTypeMap["default_y_id"] = "Object";
        model_internal::propertyTypeMap["x_axis"] = "Object";
        model_internal::propertyTypeMap["y_axis"] = "Object";
        model_internal::propertyTypeMap["default_tab"] = "Object";
        model_internal::propertyTypeMap["menu"] = "Object";

        model_internal::_instance = value;
        model_internal::_default_y_sqValidator = new StyleValidator(model_internal::_instance.model_internal::_doValidationForDefault_y_sq);
        model_internal::_default_y_sqValidator.required = true;
        model_internal::_default_y_sqValidator.requiredFieldError = "default_y_sq is required";
        //model_internal::_default_y_sqValidator.source = model_internal::_instance;
        //model_internal::_default_y_sqValidator.property = "default_y_sq";
        model_internal::_default_y_enValidator = new StyleValidator(model_internal::_instance.model_internal::_doValidationForDefault_y_en);
        model_internal::_default_y_enValidator.required = true;
        model_internal::_default_y_enValidator.requiredFieldError = "default_y_en is required";
        //model_internal::_default_y_enValidator.source = model_internal::_instance;
        //model_internal::_default_y_enValidator.property = "default_y_en";
        model_internal::_default_x_enValidator = new StyleValidator(model_internal::_instance.model_internal::_doValidationForDefault_x_en);
        model_internal::_default_x_enValidator.required = true;
        model_internal::_default_x_enValidator.requiredFieldError = "default_x_en is required";
        //model_internal::_default_x_enValidator.source = model_internal::_instance;
        //model_internal::_default_x_enValidator.property = "default_x_en";
        model_internal::_default_zValidator = new StyleValidator(model_internal::_instance.model_internal::_doValidationForDefault_z);
        model_internal::_default_zValidator.required = true;
        model_internal::_default_zValidator.requiredFieldError = "default_z is required";
        //model_internal::_default_zValidator.source = model_internal::_instance;
        //model_internal::_default_zValidator.property = "default_z";
        model_internal::_default_z_enValidator = new StyleValidator(model_internal::_instance.model_internal::_doValidationForDefault_z_en);
        model_internal::_default_z_enValidator.required = true;
        model_internal::_default_z_enValidator.requiredFieldError = "default_z_en is required";
        //model_internal::_default_z_enValidator.source = model_internal::_instance;
        //model_internal::_default_z_enValidator.property = "default_z_en";
        model_internal::_default_z_sqValidator = new StyleValidator(model_internal::_instance.model_internal::_doValidationForDefault_z_sq);
        model_internal::_default_z_sqValidator.required = true;
        model_internal::_default_z_sqValidator.requiredFieldError = "default_z_sq is required";
        //model_internal::_default_z_sqValidator.source = model_internal::_instance;
        //model_internal::_default_z_sqValidator.property = "default_z_sq";
        model_internal::_default_x_sqValidator = new StyleValidator(model_internal::_instance.model_internal::_doValidationForDefault_x_sq);
        model_internal::_default_x_sqValidator.required = true;
        model_internal::_default_x_sqValidator.requiredFieldError = "default_x_sq is required";
        //model_internal::_default_x_sqValidator.source = model_internal::_instance;
        //model_internal::_default_x_sqValidator.property = "default_x_sq";
    }

    override public function getEntityName():String
    {
        return model_internal::entityName;
    }

    override public function getProperties():Array
    {
        return model_internal::allProperties;
    }

    override public function getAssociationProperties():Array
    {
        return model_internal::allAssociationProperties;
    }

    override public function getRequiredProperties():Array
    {
         return model_internal::allRequiredProperties;   
    }

    override public function getDataProperties():Array
    {
        return model_internal::dataProperties;
    }

    public function getSourceProperties():Array
    {
        return model_internal::sourceProperties;
    }

    public function getNonDerivedProperties():Array
    {
        return model_internal::nonDerivedProperties;
    }

    override public function getGuardedProperties():Array
    {
        return model_internal::guardedProperties;
    }

    override public function getUnguardedProperties():Array
    {
        return model_internal::allAlwaysAvailableProperties;
    }

    override public function getDependants(propertyName:String):Array
    {
       if (model_internal::nonDerivedProperties.indexOf(propertyName) == -1)
            throw new Error(propertyName + " is not a data property of entity EntrySetsMenu");
            
       return model_internal::dependentsOnMap[propertyName] as Array;  
    }

    override public function getDependedOnServices():Array
    {
        return model_internal::dependedOnServices;
    }

    override public function getCollectionProperties():Array
    {
        return model_internal::collectionProperties;
    }

    override public function getCollectionBase(propertyName:String):String
    {
        if (model_internal::collectionProperties.indexOf(propertyName) == -1)
            throw new Error(propertyName + " is not a collection property of entity EntrySetsMenu");

        return model_internal::collectionBaseMap[propertyName];
    }
    
    override public function getPropertyType(propertyName:String):String
    {
        if (model_internal::allProperties.indexOf(propertyName) == -1)
            throw new Error(propertyName + " is not a property of EntrySetsMenu");

        return model_internal::propertyTypeMap[propertyName];
    }

    override public function getAvailableProperties():com.adobe.fiber.valueobjects.IPropertyIterator
    {
        return new com.adobe.fiber.valueobjects.AvailablePropertyIterator(this);
    }

    override public function getValue(propertyName:String):*
    {
        if (model_internal::allProperties.indexOf(propertyName) == -1)
        {
            throw new Error(propertyName + " does not exist for entity EntrySetsMenu");
        }

        return model_internal::_instance[propertyName];
    }

    override public function setValue(propertyName:String, value:*):void
    {
        if (model_internal::nonDerivedProperties.indexOf(propertyName) == -1)
        {
            throw new Error(propertyName + " is not a modifiable property of entity EntrySetsMenu");
        }

        model_internal::_instance[propertyName] = value;
    }

    override public function getMappedByProperty(associationProperty:String):String
    {
        switch(associationProperty)
        {
            default:
            {
                return null;
            }
        }
    }

    override public function getPropertyLength(propertyName:String):int
    {
        switch(propertyName)
        {
            default:
            {
                return 0;
            }
        }
    }

    override public function isAvailable(propertyName:String):Boolean
    {
        if (model_internal::allProperties.indexOf(propertyName) == -1)
        {
            throw new Error(propertyName + " does not exist for entity EntrySetsMenu");
        }

        if (model_internal::allAlwaysAvailableProperties.indexOf(propertyName) != -1)
        {
            return true;
        }

        switch(propertyName)
        {
            default:
            {
                return true;
            }
        }
    }

    override public function getIdentityMap():Object
    {
        var returnMap:Object = new Object();

        return returnMap;
    }

    [Bindable(event="propertyChange")]
    override public function get invalidConstraints():Array
    {
        if (model_internal::_instance.model_internal::_cacheInitialized_isValid)
        {
            return model_internal::_instance.model_internal::_invalidConstraints;
        }
        else
        {
            // recalculate isValid
            model_internal::_instance.model_internal::_isValid = model_internal::_instance.model_internal::calculateIsValid();
            return model_internal::_instance.model_internal::_invalidConstraints;        
        }
    }

    [Bindable(event="propertyChange")]
    override public function get validationFailureMessages():Array
    {
        if (model_internal::_instance.model_internal::_cacheInitialized_isValid)
        {
            return model_internal::_instance.model_internal::_validationFailureMessages;
        }
        else
        {
            // recalculate isValid
            model_internal::_instance.model_internal::_isValid = model_internal::_instance.model_internal::calculateIsValid();
            return model_internal::_instance.model_internal::_validationFailureMessages;
        }
    }

    override public function getDependantInvalidConstraints(propertyName:String):Array
    {
        var dependants:Array = getDependants(propertyName);
        if (dependants.length == 0)
        {
            return emptyArray;
        }

        var currentlyInvalid:Array = invalidConstraints;
        if (currentlyInvalid.length == 0)
        {
            return emptyArray;
        }

        var filterFunc:Function = function(element:*, index:int, arr:Array):Boolean
        {
            return dependants.indexOf(element) > -1;
        }

        return currentlyInvalid.filter(filterFunc);
    }

    /**
     * isValid
     */
    [Bindable(event="propertyChange")] 
    public function get isValid() : Boolean
    {
        if (model_internal::_instance.model_internal::_cacheInitialized_isValid)
        {
            return model_internal::_instance.model_internal::_isValid;
        }
        else
        {
            // recalculate isValid
            model_internal::_instance.model_internal::_isValid = model_internal::_instance.model_internal::calculateIsValid();
            return model_internal::_instance.model_internal::_isValid;
        }
    }

    [Bindable(event="propertyChange")]
    public function get isDefault_y_sqAvailable():Boolean
    {
        return true;
    }

    [Bindable(event="propertyChange")]
    public function get isDefault_y_enAvailable():Boolean
    {
        return true;
    }

    [Bindable(event="propertyChange")]
    public function get isDefault_x_enAvailable():Boolean
    {
        return true;
    }

    [Bindable(event="propertyChange")]
    public function get isDefault_zAvailable():Boolean
    {
        return true;
    }

    [Bindable(event="propertyChange")]
    public function get isDefault_z_enAvailable():Boolean
    {
        return true;
    }

    [Bindable(event="propertyChange")]
    public function get isDefault_z_sqAvailable():Boolean
    {
        return true;
    }

    [Bindable(event="propertyChange")]
    public function get isDefault_x_sqAvailable():Boolean
    {
        return true;
    }

    [Bindable(event="propertyChange")]
    public function get isDefault_z_idAvailable():Boolean
    {
        return true;
    }

    [Bindable(event="propertyChange")]
    public function get isDefault_xAvailable():Boolean
    {
        return true;
    }

    [Bindable(event="propertyChange")]
    public function get isDefault_x_idAvailable():Boolean
    {
        return true;
    }

    [Bindable(event="propertyChange")]
    public function get isDefault_yAvailable():Boolean
    {
        return true;
    }

    [Bindable(event="propertyChange")]
    public function get isDefault_y_idAvailable():Boolean
    {
        return true;
    }

    [Bindable(event="propertyChange")]
    public function get isX_axisAvailable():Boolean
    {
        return true;
    }

    [Bindable(event="propertyChange")]
    public function get isY_axisAvailable():Boolean
    {
        return true;
    }

    [Bindable(event="propertyChange")]
    public function get isDefault_tabAvailable():Boolean
    {
        return true;
    }

    [Bindable(event="propertyChange")]
    public function get isMenuAvailable():Boolean
    {
        return true;
    }


    /**
     * derived property recalculation
     */
    public function invalidateDependentOnDefault_y_sq():void
    {
        if (model_internal::_default_y_sqIsValidCacheInitialized )
        {
            model_internal::_instance.model_internal::_doValidationCacheOfDefault_y_sq = null;
            model_internal::calculateDefault_y_sqIsValid();
        }
    }
    public function invalidateDependentOnDefault_y_en():void
    {
        if (model_internal::_default_y_enIsValidCacheInitialized )
        {
            model_internal::_instance.model_internal::_doValidationCacheOfDefault_y_en = null;
            model_internal::calculateDefault_y_enIsValid();
        }
    }
    public function invalidateDependentOnDefault_x_en():void
    {
        if (model_internal::_default_x_enIsValidCacheInitialized )
        {
            model_internal::_instance.model_internal::_doValidationCacheOfDefault_x_en = null;
            model_internal::calculateDefault_x_enIsValid();
        }
    }
    public function invalidateDependentOnDefault_z():void
    {
        if (model_internal::_default_zIsValidCacheInitialized )
        {
            model_internal::_instance.model_internal::_doValidationCacheOfDefault_z = null;
            model_internal::calculateDefault_zIsValid();
        }
    }
    public function invalidateDependentOnDefault_z_en():void
    {
        if (model_internal::_default_z_enIsValidCacheInitialized )
        {
            model_internal::_instance.model_internal::_doValidationCacheOfDefault_z_en = null;
            model_internal::calculateDefault_z_enIsValid();
        }
    }
    public function invalidateDependentOnDefault_z_sq():void
    {
        if (model_internal::_default_z_sqIsValidCacheInitialized )
        {
            model_internal::_instance.model_internal::_doValidationCacheOfDefault_z_sq = null;
            model_internal::calculateDefault_z_sqIsValid();
        }
    }
    public function invalidateDependentOnDefault_x_sq():void
    {
        if (model_internal::_default_x_sqIsValidCacheInitialized )
        {
            model_internal::_instance.model_internal::_doValidationCacheOfDefault_x_sq = null;
            model_internal::calculateDefault_x_sqIsValid();
        }
    }

    model_internal function fireChangeEvent(propertyName:String, oldValue:Object, newValue:Object):void
    {
        this.dispatchEvent(mx.events.PropertyChangeEvent.createUpdateEvent(this, propertyName, oldValue, newValue));
    }

    [Bindable(event="propertyChange")]   
    public function get default_y_sqStyle():com.adobe.fiber.styles.Style
    {
        return model_internal::_nullStyle;
    }

    public function get default_y_sqValidator() : StyleValidator
    {
        return model_internal::_default_y_sqValidator;
    }

    model_internal function set _default_y_sqIsValid_der(value:Boolean):void 
    {
        var oldValue:Boolean = model_internal::_default_y_sqIsValid;         
        if (oldValue !== value)
        {
            model_internal::_default_y_sqIsValid = value;
            this.dispatchEvent(mx.events.PropertyChangeEvent.createUpdateEvent(this, "default_y_sqIsValid", oldValue, value));
        }                             
    }

    [Bindable(event="propertyChange")]
    public function get default_y_sqIsValid():Boolean
    {
        if (!model_internal::_default_y_sqIsValidCacheInitialized)
        {
            model_internal::calculateDefault_y_sqIsValid();
        }

        return model_internal::_default_y_sqIsValid;
    }

    model_internal function calculateDefault_y_sqIsValid():void
    {
        var valRes:ValidationResultEvent = model_internal::_default_y_sqValidator.validate(model_internal::_instance.default_y_sq)
        model_internal::_default_y_sqIsValid_der = (valRes.results == null);
        model_internal::_default_y_sqIsValidCacheInitialized = true;
        if (valRes.results == null)
             model_internal::default_y_sqValidationFailureMessages_der = emptyArray;
        else
        {
            var _valFailures:Array = new Array();
            for (var a:int = 0 ; a<valRes.results.length ; a++)
            {
                _valFailures.push(valRes.results[a].errorMessage);
            }
            model_internal::default_y_sqValidationFailureMessages_der = _valFailures;
        }
    }

    [Bindable(event="propertyChange")]
    public function get default_y_sqValidationFailureMessages():Array
    {
        if (model_internal::_default_y_sqValidationFailureMessages == null)
            model_internal::calculateDefault_y_sqIsValid();

        return _default_y_sqValidationFailureMessages;
    }

    model_internal function set default_y_sqValidationFailureMessages_der(value:Array) : void
    {
        var oldValue:Array = model_internal::_default_y_sqValidationFailureMessages;

        var needUpdate : Boolean = false;
        if (oldValue == null)
            needUpdate = true;
    
        // avoid firing the event when old and new value are different empty arrays
        if (!needUpdate && (oldValue !== value && (oldValue.length > 0 || value.length > 0)))
        {
            if (oldValue.length == value.length)
            {
                for (var a:int=0; a < oldValue.length; a++)
                {
                    if (oldValue[a] !== value[a])
                    {
                        needUpdate = true;
                        break;
                    }
                }
            }
            else
            {
                needUpdate = true;
            }
        }

        if (needUpdate)
        {
            model_internal::_default_y_sqValidationFailureMessages = value;   
            this.dispatchEvent(mx.events.PropertyChangeEvent.createUpdateEvent(this, "default_y_sqValidationFailureMessages", oldValue, value));
            // Only execute calculateIsValid if it has been called before, to update the validationFailureMessages for
            // the entire entity.
            if (model_internal::_instance.model_internal::_cacheInitialized_isValid)
            {
                model_internal::_instance.model_internal::isValid_der = model_internal::_instance.model_internal::calculateIsValid();
            }
        }
    }

    [Bindable(event="propertyChange")]   
    public function get default_y_enStyle():com.adobe.fiber.styles.Style
    {
        return model_internal::_nullStyle;
    }

    public function get default_y_enValidator() : StyleValidator
    {
        return model_internal::_default_y_enValidator;
    }

    model_internal function set _default_y_enIsValid_der(value:Boolean):void 
    {
        var oldValue:Boolean = model_internal::_default_y_enIsValid;         
        if (oldValue !== value)
        {
            model_internal::_default_y_enIsValid = value;
            this.dispatchEvent(mx.events.PropertyChangeEvent.createUpdateEvent(this, "default_y_enIsValid", oldValue, value));
        }                             
    }

    [Bindable(event="propertyChange")]
    public function get default_y_enIsValid():Boolean
    {
        if (!model_internal::_default_y_enIsValidCacheInitialized)
        {
            model_internal::calculateDefault_y_enIsValid();
        }

        return model_internal::_default_y_enIsValid;
    }

    model_internal function calculateDefault_y_enIsValid():void
    {
        var valRes:ValidationResultEvent = model_internal::_default_y_enValidator.validate(model_internal::_instance.default_y_en)
        model_internal::_default_y_enIsValid_der = (valRes.results == null);
        model_internal::_default_y_enIsValidCacheInitialized = true;
        if (valRes.results == null)
             model_internal::default_y_enValidationFailureMessages_der = emptyArray;
        else
        {
            var _valFailures:Array = new Array();
            for (var a:int = 0 ; a<valRes.results.length ; a++)
            {
                _valFailures.push(valRes.results[a].errorMessage);
            }
            model_internal::default_y_enValidationFailureMessages_der = _valFailures;
        }
    }

    [Bindable(event="propertyChange")]
    public function get default_y_enValidationFailureMessages():Array
    {
        if (model_internal::_default_y_enValidationFailureMessages == null)
            model_internal::calculateDefault_y_enIsValid();

        return _default_y_enValidationFailureMessages;
    }

    model_internal function set default_y_enValidationFailureMessages_der(value:Array) : void
    {
        var oldValue:Array = model_internal::_default_y_enValidationFailureMessages;

        var needUpdate : Boolean = false;
        if (oldValue == null)
            needUpdate = true;
    
        // avoid firing the event when old and new value are different empty arrays
        if (!needUpdate && (oldValue !== value && (oldValue.length > 0 || value.length > 0)))
        {
            if (oldValue.length == value.length)
            {
                for (var a:int=0; a < oldValue.length; a++)
                {
                    if (oldValue[a] !== value[a])
                    {
                        needUpdate = true;
                        break;
                    }
                }
            }
            else
            {
                needUpdate = true;
            }
        }

        if (needUpdate)
        {
            model_internal::_default_y_enValidationFailureMessages = value;   
            this.dispatchEvent(mx.events.PropertyChangeEvent.createUpdateEvent(this, "default_y_enValidationFailureMessages", oldValue, value));
            // Only execute calculateIsValid if it has been called before, to update the validationFailureMessages for
            // the entire entity.
            if (model_internal::_instance.model_internal::_cacheInitialized_isValid)
            {
                model_internal::_instance.model_internal::isValid_der = model_internal::_instance.model_internal::calculateIsValid();
            }
        }
    }

    [Bindable(event="propertyChange")]   
    public function get default_x_enStyle():com.adobe.fiber.styles.Style
    {
        return model_internal::_nullStyle;
    }

    public function get default_x_enValidator() : StyleValidator
    {
        return model_internal::_default_x_enValidator;
    }

    model_internal function set _default_x_enIsValid_der(value:Boolean):void 
    {
        var oldValue:Boolean = model_internal::_default_x_enIsValid;         
        if (oldValue !== value)
        {
            model_internal::_default_x_enIsValid = value;
            this.dispatchEvent(mx.events.PropertyChangeEvent.createUpdateEvent(this, "default_x_enIsValid", oldValue, value));
        }                             
    }

    [Bindable(event="propertyChange")]
    public function get default_x_enIsValid():Boolean
    {
        if (!model_internal::_default_x_enIsValidCacheInitialized)
        {
            model_internal::calculateDefault_x_enIsValid();
        }

        return model_internal::_default_x_enIsValid;
    }

    model_internal function calculateDefault_x_enIsValid():void
    {
        var valRes:ValidationResultEvent = model_internal::_default_x_enValidator.validate(model_internal::_instance.default_x_en)
        model_internal::_default_x_enIsValid_der = (valRes.results == null);
        model_internal::_default_x_enIsValidCacheInitialized = true;
        if (valRes.results == null)
             model_internal::default_x_enValidationFailureMessages_der = emptyArray;
        else
        {
            var _valFailures:Array = new Array();
            for (var a:int = 0 ; a<valRes.results.length ; a++)
            {
                _valFailures.push(valRes.results[a].errorMessage);
            }
            model_internal::default_x_enValidationFailureMessages_der = _valFailures;
        }
    }

    [Bindable(event="propertyChange")]
    public function get default_x_enValidationFailureMessages():Array
    {
        if (model_internal::_default_x_enValidationFailureMessages == null)
            model_internal::calculateDefault_x_enIsValid();

        return _default_x_enValidationFailureMessages;
    }

    model_internal function set default_x_enValidationFailureMessages_der(value:Array) : void
    {
        var oldValue:Array = model_internal::_default_x_enValidationFailureMessages;

        var needUpdate : Boolean = false;
        if (oldValue == null)
            needUpdate = true;
    
        // avoid firing the event when old and new value are different empty arrays
        if (!needUpdate && (oldValue !== value && (oldValue.length > 0 || value.length > 0)))
        {
            if (oldValue.length == value.length)
            {
                for (var a:int=0; a < oldValue.length; a++)
                {
                    if (oldValue[a] !== value[a])
                    {
                        needUpdate = true;
                        break;
                    }
                }
            }
            else
            {
                needUpdate = true;
            }
        }

        if (needUpdate)
        {
            model_internal::_default_x_enValidationFailureMessages = value;   
            this.dispatchEvent(mx.events.PropertyChangeEvent.createUpdateEvent(this, "default_x_enValidationFailureMessages", oldValue, value));
            // Only execute calculateIsValid if it has been called before, to update the validationFailureMessages for
            // the entire entity.
            if (model_internal::_instance.model_internal::_cacheInitialized_isValid)
            {
                model_internal::_instance.model_internal::isValid_der = model_internal::_instance.model_internal::calculateIsValid();
            }
        }
    }

    [Bindable(event="propertyChange")]   
    public function get default_zStyle():com.adobe.fiber.styles.Style
    {
        return model_internal::_nullStyle;
    }

    public function get default_zValidator() : StyleValidator
    {
        return model_internal::_default_zValidator;
    }

    model_internal function set _default_zIsValid_der(value:Boolean):void 
    {
        var oldValue:Boolean = model_internal::_default_zIsValid;         
        if (oldValue !== value)
        {
            model_internal::_default_zIsValid = value;
            this.dispatchEvent(mx.events.PropertyChangeEvent.createUpdateEvent(this, "default_zIsValid", oldValue, value));
        }                             
    }

    [Bindable(event="propertyChange")]
    public function get default_zIsValid():Boolean
    {
        if (!model_internal::_default_zIsValidCacheInitialized)
        {
            model_internal::calculateDefault_zIsValid();
        }

        return model_internal::_default_zIsValid;
    }

    model_internal function calculateDefault_zIsValid():void
    {
        var valRes:ValidationResultEvent = model_internal::_default_zValidator.validate(model_internal::_instance.default_z)
        model_internal::_default_zIsValid_der = (valRes.results == null);
        model_internal::_default_zIsValidCacheInitialized = true;
        if (valRes.results == null)
             model_internal::default_zValidationFailureMessages_der = emptyArray;
        else
        {
            var _valFailures:Array = new Array();
            for (var a:int = 0 ; a<valRes.results.length ; a++)
            {
                _valFailures.push(valRes.results[a].errorMessage);
            }
            model_internal::default_zValidationFailureMessages_der = _valFailures;
        }
    }

    [Bindable(event="propertyChange")]
    public function get default_zValidationFailureMessages():Array
    {
        if (model_internal::_default_zValidationFailureMessages == null)
            model_internal::calculateDefault_zIsValid();

        return _default_zValidationFailureMessages;
    }

    model_internal function set default_zValidationFailureMessages_der(value:Array) : void
    {
        var oldValue:Array = model_internal::_default_zValidationFailureMessages;

        var needUpdate : Boolean = false;
        if (oldValue == null)
            needUpdate = true;
    
        // avoid firing the event when old and new value are different empty arrays
        if (!needUpdate && (oldValue !== value && (oldValue.length > 0 || value.length > 0)))
        {
            if (oldValue.length == value.length)
            {
                for (var a:int=0; a < oldValue.length; a++)
                {
                    if (oldValue[a] !== value[a])
                    {
                        needUpdate = true;
                        break;
                    }
                }
            }
            else
            {
                needUpdate = true;
            }
        }

        if (needUpdate)
        {
            model_internal::_default_zValidationFailureMessages = value;   
            this.dispatchEvent(mx.events.PropertyChangeEvent.createUpdateEvent(this, "default_zValidationFailureMessages", oldValue, value));
            // Only execute calculateIsValid if it has been called before, to update the validationFailureMessages for
            // the entire entity.
            if (model_internal::_instance.model_internal::_cacheInitialized_isValid)
            {
                model_internal::_instance.model_internal::isValid_der = model_internal::_instance.model_internal::calculateIsValid();
            }
        }
    }

    [Bindable(event="propertyChange")]   
    public function get default_z_enStyle():com.adobe.fiber.styles.Style
    {
        return model_internal::_nullStyle;
    }

    public function get default_z_enValidator() : StyleValidator
    {
        return model_internal::_default_z_enValidator;
    }

    model_internal function set _default_z_enIsValid_der(value:Boolean):void 
    {
        var oldValue:Boolean = model_internal::_default_z_enIsValid;         
        if (oldValue !== value)
        {
            model_internal::_default_z_enIsValid = value;
            this.dispatchEvent(mx.events.PropertyChangeEvent.createUpdateEvent(this, "default_z_enIsValid", oldValue, value));
        }                             
    }

    [Bindable(event="propertyChange")]
    public function get default_z_enIsValid():Boolean
    {
        if (!model_internal::_default_z_enIsValidCacheInitialized)
        {
            model_internal::calculateDefault_z_enIsValid();
        }

        return model_internal::_default_z_enIsValid;
    }

    model_internal function calculateDefault_z_enIsValid():void
    {
        var valRes:ValidationResultEvent = model_internal::_default_z_enValidator.validate(model_internal::_instance.default_z_en)
        model_internal::_default_z_enIsValid_der = (valRes.results == null);
        model_internal::_default_z_enIsValidCacheInitialized = true;
        if (valRes.results == null)
             model_internal::default_z_enValidationFailureMessages_der = emptyArray;
        else
        {
            var _valFailures:Array = new Array();
            for (var a:int = 0 ; a<valRes.results.length ; a++)
            {
                _valFailures.push(valRes.results[a].errorMessage);
            }
            model_internal::default_z_enValidationFailureMessages_der = _valFailures;
        }
    }

    [Bindable(event="propertyChange")]
    public function get default_z_enValidationFailureMessages():Array
    {
        if (model_internal::_default_z_enValidationFailureMessages == null)
            model_internal::calculateDefault_z_enIsValid();

        return _default_z_enValidationFailureMessages;
    }

    model_internal function set default_z_enValidationFailureMessages_der(value:Array) : void
    {
        var oldValue:Array = model_internal::_default_z_enValidationFailureMessages;

        var needUpdate : Boolean = false;
        if (oldValue == null)
            needUpdate = true;
    
        // avoid firing the event when old and new value are different empty arrays
        if (!needUpdate && (oldValue !== value && (oldValue.length > 0 || value.length > 0)))
        {
            if (oldValue.length == value.length)
            {
                for (var a:int=0; a < oldValue.length; a++)
                {
                    if (oldValue[a] !== value[a])
                    {
                        needUpdate = true;
                        break;
                    }
                }
            }
            else
            {
                needUpdate = true;
            }
        }

        if (needUpdate)
        {
            model_internal::_default_z_enValidationFailureMessages = value;   
            this.dispatchEvent(mx.events.PropertyChangeEvent.createUpdateEvent(this, "default_z_enValidationFailureMessages", oldValue, value));
            // Only execute calculateIsValid if it has been called before, to update the validationFailureMessages for
            // the entire entity.
            if (model_internal::_instance.model_internal::_cacheInitialized_isValid)
            {
                model_internal::_instance.model_internal::isValid_der = model_internal::_instance.model_internal::calculateIsValid();
            }
        }
    }

    [Bindable(event="propertyChange")]   
    public function get default_z_sqStyle():com.adobe.fiber.styles.Style
    {
        return model_internal::_nullStyle;
    }

    public function get default_z_sqValidator() : StyleValidator
    {
        return model_internal::_default_z_sqValidator;
    }

    model_internal function set _default_z_sqIsValid_der(value:Boolean):void 
    {
        var oldValue:Boolean = model_internal::_default_z_sqIsValid;         
        if (oldValue !== value)
        {
            model_internal::_default_z_sqIsValid = value;
            this.dispatchEvent(mx.events.PropertyChangeEvent.createUpdateEvent(this, "default_z_sqIsValid", oldValue, value));
        }                             
    }

    [Bindable(event="propertyChange")]
    public function get default_z_sqIsValid():Boolean
    {
        if (!model_internal::_default_z_sqIsValidCacheInitialized)
        {
            model_internal::calculateDefault_z_sqIsValid();
        }

        return model_internal::_default_z_sqIsValid;
    }

    model_internal function calculateDefault_z_sqIsValid():void
    {
        var valRes:ValidationResultEvent = model_internal::_default_z_sqValidator.validate(model_internal::_instance.default_z_sq)
        model_internal::_default_z_sqIsValid_der = (valRes.results == null);
        model_internal::_default_z_sqIsValidCacheInitialized = true;
        if (valRes.results == null)
             model_internal::default_z_sqValidationFailureMessages_der = emptyArray;
        else
        {
            var _valFailures:Array = new Array();
            for (var a:int = 0 ; a<valRes.results.length ; a++)
            {
                _valFailures.push(valRes.results[a].errorMessage);
            }
            model_internal::default_z_sqValidationFailureMessages_der = _valFailures;
        }
    }

    [Bindable(event="propertyChange")]
    public function get default_z_sqValidationFailureMessages():Array
    {
        if (model_internal::_default_z_sqValidationFailureMessages == null)
            model_internal::calculateDefault_z_sqIsValid();

        return _default_z_sqValidationFailureMessages;
    }

    model_internal function set default_z_sqValidationFailureMessages_der(value:Array) : void
    {
        var oldValue:Array = model_internal::_default_z_sqValidationFailureMessages;

        var needUpdate : Boolean = false;
        if (oldValue == null)
            needUpdate = true;
    
        // avoid firing the event when old and new value are different empty arrays
        if (!needUpdate && (oldValue !== value && (oldValue.length > 0 || value.length > 0)))
        {
            if (oldValue.length == value.length)
            {
                for (var a:int=0; a < oldValue.length; a++)
                {
                    if (oldValue[a] !== value[a])
                    {
                        needUpdate = true;
                        break;
                    }
                }
            }
            else
            {
                needUpdate = true;
            }
        }

        if (needUpdate)
        {
            model_internal::_default_z_sqValidationFailureMessages = value;   
            this.dispatchEvent(mx.events.PropertyChangeEvent.createUpdateEvent(this, "default_z_sqValidationFailureMessages", oldValue, value));
            // Only execute calculateIsValid if it has been called before, to update the validationFailureMessages for
            // the entire entity.
            if (model_internal::_instance.model_internal::_cacheInitialized_isValid)
            {
                model_internal::_instance.model_internal::isValid_der = model_internal::_instance.model_internal::calculateIsValid();
            }
        }
    }

    [Bindable(event="propertyChange")]   
    public function get default_x_sqStyle():com.adobe.fiber.styles.Style
    {
        return model_internal::_nullStyle;
    }

    public function get default_x_sqValidator() : StyleValidator
    {
        return model_internal::_default_x_sqValidator;
    }

    model_internal function set _default_x_sqIsValid_der(value:Boolean):void 
    {
        var oldValue:Boolean = model_internal::_default_x_sqIsValid;         
        if (oldValue !== value)
        {
            model_internal::_default_x_sqIsValid = value;
            this.dispatchEvent(mx.events.PropertyChangeEvent.createUpdateEvent(this, "default_x_sqIsValid", oldValue, value));
        }                             
    }

    [Bindable(event="propertyChange")]
    public function get default_x_sqIsValid():Boolean
    {
        if (!model_internal::_default_x_sqIsValidCacheInitialized)
        {
            model_internal::calculateDefault_x_sqIsValid();
        }

        return model_internal::_default_x_sqIsValid;
    }

    model_internal function calculateDefault_x_sqIsValid():void
    {
        var valRes:ValidationResultEvent = model_internal::_default_x_sqValidator.validate(model_internal::_instance.default_x_sq)
        model_internal::_default_x_sqIsValid_der = (valRes.results == null);
        model_internal::_default_x_sqIsValidCacheInitialized = true;
        if (valRes.results == null)
             model_internal::default_x_sqValidationFailureMessages_der = emptyArray;
        else
        {
            var _valFailures:Array = new Array();
            for (var a:int = 0 ; a<valRes.results.length ; a++)
            {
                _valFailures.push(valRes.results[a].errorMessage);
            }
            model_internal::default_x_sqValidationFailureMessages_der = _valFailures;
        }
    }

    [Bindable(event="propertyChange")]
    public function get default_x_sqValidationFailureMessages():Array
    {
        if (model_internal::_default_x_sqValidationFailureMessages == null)
            model_internal::calculateDefault_x_sqIsValid();

        return _default_x_sqValidationFailureMessages;
    }

    model_internal function set default_x_sqValidationFailureMessages_der(value:Array) : void
    {
        var oldValue:Array = model_internal::_default_x_sqValidationFailureMessages;

        var needUpdate : Boolean = false;
        if (oldValue == null)
            needUpdate = true;
    
        // avoid firing the event when old and new value are different empty arrays
        if (!needUpdate && (oldValue !== value && (oldValue.length > 0 || value.length > 0)))
        {
            if (oldValue.length == value.length)
            {
                for (var a:int=0; a < oldValue.length; a++)
                {
                    if (oldValue[a] !== value[a])
                    {
                        needUpdate = true;
                        break;
                    }
                }
            }
            else
            {
                needUpdate = true;
            }
        }

        if (needUpdate)
        {
            model_internal::_default_x_sqValidationFailureMessages = value;   
            this.dispatchEvent(mx.events.PropertyChangeEvent.createUpdateEvent(this, "default_x_sqValidationFailureMessages", oldValue, value));
            // Only execute calculateIsValid if it has been called before, to update the validationFailureMessages for
            // the entire entity.
            if (model_internal::_instance.model_internal::_cacheInitialized_isValid)
            {
                model_internal::_instance.model_internal::isValid_der = model_internal::_instance.model_internal::calculateIsValid();
            }
        }
    }

    [Bindable(event="propertyChange")]   
    public function get default_z_idStyle():com.adobe.fiber.styles.Style
    {
        return model_internal::_nullStyle;
    }

    [Bindable(event="propertyChange")]   
    public function get default_xStyle():com.adobe.fiber.styles.Style
    {
        return model_internal::_nullStyle;
    }

    [Bindable(event="propertyChange")]   
    public function get default_x_idStyle():com.adobe.fiber.styles.Style
    {
        return model_internal::_nullStyle;
    }

    [Bindable(event="propertyChange")]   
    public function get default_yStyle():com.adobe.fiber.styles.Style
    {
        return model_internal::_nullStyle;
    }

    [Bindable(event="propertyChange")]   
    public function get default_y_idStyle():com.adobe.fiber.styles.Style
    {
        return model_internal::_nullStyle;
    }

    [Bindable(event="propertyChange")]   
    public function get x_axisStyle():com.adobe.fiber.styles.Style
    {
        return model_internal::_nullStyle;
    }

    [Bindable(event="propertyChange")]   
    public function get y_axisStyle():com.adobe.fiber.styles.Style
    {
        return model_internal::_nullStyle;
    }

    [Bindable(event="propertyChange")]   
    public function get default_tabStyle():com.adobe.fiber.styles.Style
    {
        return model_internal::_nullStyle;
    }

    [Bindable(event="propertyChange")]   
    public function get menuStyle():com.adobe.fiber.styles.Style
    {
        return model_internal::_nullStyle;
    }


     /**
     * 
     * @inheritDoc 
     */ 
     override public function getStyle(propertyName:String):com.adobe.fiber.styles.IStyle
     {
         switch(propertyName)
         {
            default:
            {
                return null;
            }
         }
     }
     
     /**
     * 
     * @inheritDoc 
     *  
     */  
     override public function getPropertyValidationFailureMessages(propertyName:String):Array
     {
         switch(propertyName)
         {
            case("default_y_sq"):
            {
                return default_y_sqValidationFailureMessages;
            }
            case("default_y_en"):
            {
                return default_y_enValidationFailureMessages;
            }
            case("default_x_en"):
            {
                return default_x_enValidationFailureMessages;
            }
            case("default_z"):
            {
                return default_zValidationFailureMessages;
            }
            case("default_z_en"):
            {
                return default_z_enValidationFailureMessages;
            }
            case("default_z_sq"):
            {
                return default_z_sqValidationFailureMessages;
            }
            case("default_x_sq"):
            {
                return default_x_sqValidationFailureMessages;
            }
            default:
            {
                return emptyArray;
            }
         }
     }

}

}
