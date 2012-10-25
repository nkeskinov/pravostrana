
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
internal class _CustomDatatypeEntityMetadata extends com.adobe.fiber.valueobjects.AbstractEntityMetadata
{
    private static var emptyArray:Array = new Array();

    model_internal static var allProperties:Array = new Array("name_sq", "map_id", "id_municipality", "name_en", "name");
    model_internal static var allAssociationProperties:Array = new Array();
    model_internal static var allRequiredProperties:Array = new Array("name_sq", "map_id", "id_municipality", "name_en", "name");
    model_internal static var allAlwaysAvailableProperties:Array = new Array("name_sq", "map_id", "id_municipality", "name_en", "name");
    model_internal static var guardedProperties:Array = new Array();
    model_internal static var dataProperties:Array = new Array("name_sq", "map_id", "id_municipality", "name_en", "name");
    model_internal static var sourceProperties:Array = emptyArray
    model_internal static var nonDerivedProperties:Array = new Array("name_sq", "map_id", "id_municipality", "name_en", "name");
    model_internal static var derivedProperties:Array = new Array();
    model_internal static var collectionProperties:Array = new Array();
    model_internal static var collectionBaseMap:Object;
    model_internal static var entityName:String = "CustomDatatype";
    model_internal static var dependentsOnMap:Object;
    model_internal static var dependedOnServices:Array = new Array();
    model_internal static var propertyTypeMap:Object;

    
    model_internal var _name_sqIsValid:Boolean;
    model_internal var _name_sqValidator:com.adobe.fiber.styles.StyleValidator;
    model_internal var _name_sqIsValidCacheInitialized:Boolean = false;
    model_internal var _name_sqValidationFailureMessages:Array;
    
    model_internal var _map_idIsValid:Boolean;
    model_internal var _map_idValidator:com.adobe.fiber.styles.StyleValidator;
    model_internal var _map_idIsValidCacheInitialized:Boolean = false;
    model_internal var _map_idValidationFailureMessages:Array;
    
    model_internal var _name_enIsValid:Boolean;
    model_internal var _name_enValidator:com.adobe.fiber.styles.StyleValidator;
    model_internal var _name_enIsValidCacheInitialized:Boolean = false;
    model_internal var _name_enValidationFailureMessages:Array;
    
    model_internal var _nameIsValid:Boolean;
    model_internal var _nameValidator:com.adobe.fiber.styles.StyleValidator;
    model_internal var _nameIsValidCacheInitialized:Boolean = false;
    model_internal var _nameValidationFailureMessages:Array;

    model_internal var _instance:_Super_CustomDatatype;
    model_internal static var _nullStyle:com.adobe.fiber.styles.Style = new com.adobe.fiber.styles.Style();

    public function _CustomDatatypeEntityMetadata(value : _Super_CustomDatatype)
    {
        // initialize property maps
        if (model_internal::dependentsOnMap == null)
        {
            // dependents map
            model_internal::dependentsOnMap = new Object();
            model_internal::dependentsOnMap["name_sq"] = new Array();
            model_internal::dependentsOnMap["map_id"] = new Array();
            model_internal::dependentsOnMap["id_municipality"] = new Array();
            model_internal::dependentsOnMap["name_en"] = new Array();
            model_internal::dependentsOnMap["name"] = new Array();

            // collection base map
            model_internal::collectionBaseMap = new Object();
        }

        // Property type Map
        model_internal::propertyTypeMap = new Object();
        model_internal::propertyTypeMap["name_sq"] = "String";
        model_internal::propertyTypeMap["map_id"] = "String";
        model_internal::propertyTypeMap["id_municipality"] = "int";
        model_internal::propertyTypeMap["name_en"] = "String";
        model_internal::propertyTypeMap["name"] = "String";

        model_internal::_instance = value;
        model_internal::_name_sqValidator = new StyleValidator(model_internal::_instance.model_internal::_doValidationForName_sq);
        model_internal::_name_sqValidator.required = true;
        model_internal::_name_sqValidator.requiredFieldError = "name_sq is required";
        //model_internal::_name_sqValidator.source = model_internal::_instance;
        //model_internal::_name_sqValidator.property = "name_sq";
        model_internal::_map_idValidator = new StyleValidator(model_internal::_instance.model_internal::_doValidationForMap_id);
        model_internal::_map_idValidator.required = true;
        model_internal::_map_idValidator.requiredFieldError = "map_id is required";
        //model_internal::_map_idValidator.source = model_internal::_instance;
        //model_internal::_map_idValidator.property = "map_id";
        model_internal::_name_enValidator = new StyleValidator(model_internal::_instance.model_internal::_doValidationForName_en);
        model_internal::_name_enValidator.required = true;
        model_internal::_name_enValidator.requiredFieldError = "name_en is required";
        //model_internal::_name_enValidator.source = model_internal::_instance;
        //model_internal::_name_enValidator.property = "name_en";
        model_internal::_nameValidator = new StyleValidator(model_internal::_instance.model_internal::_doValidationForName);
        model_internal::_nameValidator.required = true;
        model_internal::_nameValidator.requiredFieldError = "name is required";
        //model_internal::_nameValidator.source = model_internal::_instance;
        //model_internal::_nameValidator.property = "name";
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
            throw new Error(propertyName + " is not a data property of entity CustomDatatype");
            
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
            throw new Error(propertyName + " is not a collection property of entity CustomDatatype");

        return model_internal::collectionBaseMap[propertyName];
    }
    
    override public function getPropertyType(propertyName:String):String
    {
        if (model_internal::allProperties.indexOf(propertyName) == -1)
            throw new Error(propertyName + " is not a property of CustomDatatype");

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
            throw new Error(propertyName + " does not exist for entity CustomDatatype");
        }

        return model_internal::_instance[propertyName];
    }

    override public function setValue(propertyName:String, value:*):void
    {
        if (model_internal::nonDerivedProperties.indexOf(propertyName) == -1)
        {
            throw new Error(propertyName + " is not a modifiable property of entity CustomDatatype");
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
            throw new Error(propertyName + " does not exist for entity CustomDatatype");
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
    public function get isName_sqAvailable():Boolean
    {
        return true;
    }

    [Bindable(event="propertyChange")]
    public function get isMap_idAvailable():Boolean
    {
        return true;
    }

    [Bindable(event="propertyChange")]
    public function get isId_municipalityAvailable():Boolean
    {
        return true;
    }

    [Bindable(event="propertyChange")]
    public function get isName_enAvailable():Boolean
    {
        return true;
    }

    [Bindable(event="propertyChange")]
    public function get isNameAvailable():Boolean
    {
        return true;
    }


    /**
     * derived property recalculation
     */
    public function invalidateDependentOnName_sq():void
    {
        if (model_internal::_name_sqIsValidCacheInitialized )
        {
            model_internal::_instance.model_internal::_doValidationCacheOfName_sq = null;
            model_internal::calculateName_sqIsValid();
        }
    }
    public function invalidateDependentOnMap_id():void
    {
        if (model_internal::_map_idIsValidCacheInitialized )
        {
            model_internal::_instance.model_internal::_doValidationCacheOfMap_id = null;
            model_internal::calculateMap_idIsValid();
        }
    }
    public function invalidateDependentOnName_en():void
    {
        if (model_internal::_name_enIsValidCacheInitialized )
        {
            model_internal::_instance.model_internal::_doValidationCacheOfName_en = null;
            model_internal::calculateName_enIsValid();
        }
    }
    public function invalidateDependentOnName():void
    {
        if (model_internal::_nameIsValidCacheInitialized )
        {
            model_internal::_instance.model_internal::_doValidationCacheOfName = null;
            model_internal::calculateNameIsValid();
        }
    }

    model_internal function fireChangeEvent(propertyName:String, oldValue:Object, newValue:Object):void
    {
        this.dispatchEvent(mx.events.PropertyChangeEvent.createUpdateEvent(this, propertyName, oldValue, newValue));
    }

    [Bindable(event="propertyChange")]   
    public function get name_sqStyle():com.adobe.fiber.styles.Style
    {
        return model_internal::_nullStyle;
    }

    public function get name_sqValidator() : StyleValidator
    {
        return model_internal::_name_sqValidator;
    }

    model_internal function set _name_sqIsValid_der(value:Boolean):void 
    {
        var oldValue:Boolean = model_internal::_name_sqIsValid;         
        if (oldValue !== value)
        {
            model_internal::_name_sqIsValid = value;
            this.dispatchEvent(mx.events.PropertyChangeEvent.createUpdateEvent(this, "name_sqIsValid", oldValue, value));
        }                             
    }

    [Bindable(event="propertyChange")]
    public function get name_sqIsValid():Boolean
    {
        if (!model_internal::_name_sqIsValidCacheInitialized)
        {
            model_internal::calculateName_sqIsValid();
        }

        return model_internal::_name_sqIsValid;
    }

    model_internal function calculateName_sqIsValid():void
    {
        var valRes:ValidationResultEvent = model_internal::_name_sqValidator.validate(model_internal::_instance.name_sq)
        model_internal::_name_sqIsValid_der = (valRes.results == null);
        model_internal::_name_sqIsValidCacheInitialized = true;
        if (valRes.results == null)
             model_internal::name_sqValidationFailureMessages_der = emptyArray;
        else
        {
            var _valFailures:Array = new Array();
            for (var a:int = 0 ; a<valRes.results.length ; a++)
            {
                _valFailures.push(valRes.results[a].errorMessage);
            }
            model_internal::name_sqValidationFailureMessages_der = _valFailures;
        }
    }

    [Bindable(event="propertyChange")]
    public function get name_sqValidationFailureMessages():Array
    {
        if (model_internal::_name_sqValidationFailureMessages == null)
            model_internal::calculateName_sqIsValid();

        return _name_sqValidationFailureMessages;
    }

    model_internal function set name_sqValidationFailureMessages_der(value:Array) : void
    {
        var oldValue:Array = model_internal::_name_sqValidationFailureMessages;

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
            model_internal::_name_sqValidationFailureMessages = value;   
            this.dispatchEvent(mx.events.PropertyChangeEvent.createUpdateEvent(this, "name_sqValidationFailureMessages", oldValue, value));
            // Only execute calculateIsValid if it has been called before, to update the validationFailureMessages for
            // the entire entity.
            if (model_internal::_instance.model_internal::_cacheInitialized_isValid)
            {
                model_internal::_instance.model_internal::isValid_der = model_internal::_instance.model_internal::calculateIsValid();
            }
        }
    }

    [Bindable(event="propertyChange")]   
    public function get map_idStyle():com.adobe.fiber.styles.Style
    {
        return model_internal::_nullStyle;
    }

    public function get map_idValidator() : StyleValidator
    {
        return model_internal::_map_idValidator;
    }

    model_internal function set _map_idIsValid_der(value:Boolean):void 
    {
        var oldValue:Boolean = model_internal::_map_idIsValid;         
        if (oldValue !== value)
        {
            model_internal::_map_idIsValid = value;
            this.dispatchEvent(mx.events.PropertyChangeEvent.createUpdateEvent(this, "map_idIsValid", oldValue, value));
        }                             
    }

    [Bindable(event="propertyChange")]
    public function get map_idIsValid():Boolean
    {
        if (!model_internal::_map_idIsValidCacheInitialized)
        {
            model_internal::calculateMap_idIsValid();
        }

        return model_internal::_map_idIsValid;
    }

    model_internal function calculateMap_idIsValid():void
    {
        var valRes:ValidationResultEvent = model_internal::_map_idValidator.validate(model_internal::_instance.map_id)
        model_internal::_map_idIsValid_der = (valRes.results == null);
        model_internal::_map_idIsValidCacheInitialized = true;
        if (valRes.results == null)
             model_internal::map_idValidationFailureMessages_der = emptyArray;
        else
        {
            var _valFailures:Array = new Array();
            for (var a:int = 0 ; a<valRes.results.length ; a++)
            {
                _valFailures.push(valRes.results[a].errorMessage);
            }
            model_internal::map_idValidationFailureMessages_der = _valFailures;
        }
    }

    [Bindable(event="propertyChange")]
    public function get map_idValidationFailureMessages():Array
    {
        if (model_internal::_map_idValidationFailureMessages == null)
            model_internal::calculateMap_idIsValid();

        return _map_idValidationFailureMessages;
    }

    model_internal function set map_idValidationFailureMessages_der(value:Array) : void
    {
        var oldValue:Array = model_internal::_map_idValidationFailureMessages;

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
            model_internal::_map_idValidationFailureMessages = value;   
            this.dispatchEvent(mx.events.PropertyChangeEvent.createUpdateEvent(this, "map_idValidationFailureMessages", oldValue, value));
            // Only execute calculateIsValid if it has been called before, to update the validationFailureMessages for
            // the entire entity.
            if (model_internal::_instance.model_internal::_cacheInitialized_isValid)
            {
                model_internal::_instance.model_internal::isValid_der = model_internal::_instance.model_internal::calculateIsValid();
            }
        }
    }

    [Bindable(event="propertyChange")]   
    public function get id_municipalityStyle():com.adobe.fiber.styles.Style
    {
        return model_internal::_nullStyle;
    }

    [Bindable(event="propertyChange")]   
    public function get name_enStyle():com.adobe.fiber.styles.Style
    {
        return model_internal::_nullStyle;
    }

    public function get name_enValidator() : StyleValidator
    {
        return model_internal::_name_enValidator;
    }

    model_internal function set _name_enIsValid_der(value:Boolean):void 
    {
        var oldValue:Boolean = model_internal::_name_enIsValid;         
        if (oldValue !== value)
        {
            model_internal::_name_enIsValid = value;
            this.dispatchEvent(mx.events.PropertyChangeEvent.createUpdateEvent(this, "name_enIsValid", oldValue, value));
        }                             
    }

    [Bindable(event="propertyChange")]
    public function get name_enIsValid():Boolean
    {
        if (!model_internal::_name_enIsValidCacheInitialized)
        {
            model_internal::calculateName_enIsValid();
        }

        return model_internal::_name_enIsValid;
    }

    model_internal function calculateName_enIsValid():void
    {
        var valRes:ValidationResultEvent = model_internal::_name_enValidator.validate(model_internal::_instance.name_en)
        model_internal::_name_enIsValid_der = (valRes.results == null);
        model_internal::_name_enIsValidCacheInitialized = true;
        if (valRes.results == null)
             model_internal::name_enValidationFailureMessages_der = emptyArray;
        else
        {
            var _valFailures:Array = new Array();
            for (var a:int = 0 ; a<valRes.results.length ; a++)
            {
                _valFailures.push(valRes.results[a].errorMessage);
            }
            model_internal::name_enValidationFailureMessages_der = _valFailures;
        }
    }

    [Bindable(event="propertyChange")]
    public function get name_enValidationFailureMessages():Array
    {
        if (model_internal::_name_enValidationFailureMessages == null)
            model_internal::calculateName_enIsValid();

        return _name_enValidationFailureMessages;
    }

    model_internal function set name_enValidationFailureMessages_der(value:Array) : void
    {
        var oldValue:Array = model_internal::_name_enValidationFailureMessages;

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
            model_internal::_name_enValidationFailureMessages = value;   
            this.dispatchEvent(mx.events.PropertyChangeEvent.createUpdateEvent(this, "name_enValidationFailureMessages", oldValue, value));
            // Only execute calculateIsValid if it has been called before, to update the validationFailureMessages for
            // the entire entity.
            if (model_internal::_instance.model_internal::_cacheInitialized_isValid)
            {
                model_internal::_instance.model_internal::isValid_der = model_internal::_instance.model_internal::calculateIsValid();
            }
        }
    }

    [Bindable(event="propertyChange")]   
    public function get nameStyle():com.adobe.fiber.styles.Style
    {
        return model_internal::_nullStyle;
    }

    public function get nameValidator() : StyleValidator
    {
        return model_internal::_nameValidator;
    }

    model_internal function set _nameIsValid_der(value:Boolean):void 
    {
        var oldValue:Boolean = model_internal::_nameIsValid;         
        if (oldValue !== value)
        {
            model_internal::_nameIsValid = value;
            this.dispatchEvent(mx.events.PropertyChangeEvent.createUpdateEvent(this, "nameIsValid", oldValue, value));
        }                             
    }

    [Bindable(event="propertyChange")]
    public function get nameIsValid():Boolean
    {
        if (!model_internal::_nameIsValidCacheInitialized)
        {
            model_internal::calculateNameIsValid();
        }

        return model_internal::_nameIsValid;
    }

    model_internal function calculateNameIsValid():void
    {
        var valRes:ValidationResultEvent = model_internal::_nameValidator.validate(model_internal::_instance.name)
        model_internal::_nameIsValid_der = (valRes.results == null);
        model_internal::_nameIsValidCacheInitialized = true;
        if (valRes.results == null)
             model_internal::nameValidationFailureMessages_der = emptyArray;
        else
        {
            var _valFailures:Array = new Array();
            for (var a:int = 0 ; a<valRes.results.length ; a++)
            {
                _valFailures.push(valRes.results[a].errorMessage);
            }
            model_internal::nameValidationFailureMessages_der = _valFailures;
        }
    }

    [Bindable(event="propertyChange")]
    public function get nameValidationFailureMessages():Array
    {
        if (model_internal::_nameValidationFailureMessages == null)
            model_internal::calculateNameIsValid();

        return _nameValidationFailureMessages;
    }

    model_internal function set nameValidationFailureMessages_der(value:Array) : void
    {
        var oldValue:Array = model_internal::_nameValidationFailureMessages;

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
            model_internal::_nameValidationFailureMessages = value;   
            this.dispatchEvent(mx.events.PropertyChangeEvent.createUpdateEvent(this, "nameValidationFailureMessages", oldValue, value));
            // Only execute calculateIsValid if it has been called before, to update the validationFailureMessages for
            // the entire entity.
            if (model_internal::_instance.model_internal::_cacheInitialized_isValid)
            {
                model_internal::_instance.model_internal::isValid_der = model_internal::_instance.model_internal::calculateIsValid();
            }
        }
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
            case("name_sq"):
            {
                return name_sqValidationFailureMessages;
            }
            case("map_id"):
            {
                return map_idValidationFailureMessages;
            }
            case("name_en"):
            {
                return name_enValidationFailureMessages;
            }
            case("name"):
            {
                return nameValidationFailureMessages;
            }
            default:
            {
                return emptyArray;
            }
         }
     }

}

}
