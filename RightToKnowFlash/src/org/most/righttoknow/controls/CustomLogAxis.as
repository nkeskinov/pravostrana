/*******************************CustomLogAxis****************************/
		package org.most.righttoknow.controls
		{
			
			import flash.events.Event;
			import mx.charts.chartClasses.AxisLabelSet;
			import mx.charts.chartClasses.NumericAxis;
			import mx.core.mx_internal;
			import mx.charts.AxisLabel ;
			import mx.charts.chartClasses.AxisLabelSet;
			//import mx.controls.Alert;
			import mx.formatters.NumberBaseRoundType;
			
			use namespace mx_internal;
			
			/**
			 *  The CustomLogAxis class maps numeric values logarithmically
			 *  between a minimum and maximum value along a chart axis.
			 *  By default, it determines <code>minimum</code>, <code>maximum</
			 code>,
			 *  and <code>interval</code> values from the charting data
			 *  to fit all of the chart elements on the screen.
			 *  You can also explicitly set specific values for these properties.
			 *  A LogAxis object cannot correctly render negative values,
			 *  as Log10() of a negative number is <code>undefined</code>.
			 *
			 *  @see mx.charts.chartClasses.IAxis
			 *  "CustomLogAxis" is developed to show intyermediate labels
			 *
			 */
			public class CustomLogAxis extends NumericAxis
			{
				//include "../core/Version.as";
				//include "Version.as";
				
				//--------------------------------------------------------------------------
				//
				//  Constructor
				//
				//--------------------------------------------------------------------------
				
				/**
				 *  Constructor.
				 */
				
				public function CustomLogAxis()
				{
					super();
					computedInterval  = super.computedInterval;
				}
				
				//----------------------------------
				//  interval
				//----------------------------------
				
				/**
				 *  @private
				 */
				private var _userInterval:Number;
				/**
				 *  @private
				 */
				private var _userMinorInterval:Number;
				
				/**
				 *  @private
				 *  Storage for the minorInterval property.
				 */
				private var _minorInterval:Number = 10;
				
				private var _buildLabelCacheFlag :Boolean = true;
				
				private var _previousMin : Number = 0;
				private var _previousMax : Number = 0;
				private var _previousComputedMinimum : Number = 0;
				private var _previousComputedMaximum : Number = 0;
				
				private var _callReduceLabelOnce : Boolean = false;
				
				[Inspectable(category="General")]
				
				/**
				 *  Specifies the multiplier label values along the axis.
				 *  A value of 10 generates labels at 1, 10, 100, 1000, etc.,
				 *  while a value of 100 generates labels at 1, 100, 10000, etc.
				 *  Flex calculates the interval if this property
				 *  is set to <code>NaN</code>.
				 *  Intervals must be even powers of 10, and must be greater than
				 or equal to 10.
				 *  The LogAxis rounds the interval down to an even power of 10,
				 if necessary.
				 *
				 *  @default 10
				 */
				
				public function get interval():Number
				{
					return Math.pow(10, computedInterval);
				}
				
				/**
				 *  @private
				 */
				public function set interval(value:Number):void
				{
					if (!isNaN(value))
						value = Math.max(1, Math.floor(Math.log(value) /
							Math.LN10));
					
					if (isNaN(value))
						value = 1;
					
					computedInterval = value;
					invalidateCache();
					
					dispatchEvent(new Event("axisChange"));
				}
				
				//----------------------------------
				//  maximum
				//----------------------------------
				
				[Inspectable(category="General")]
				
				/**
				 *  Specifies the maximum value for an axis label.
				 *  If <code>NaN</code>, Flex determines the maximum value
				 *  from the data in the chart.
				 *  The maximum value must be an even power of 10.
				 *  The LogAxis rounds an explicit maximum value
				 *  up to an even power of 10, if necessary.
				 *
				 *  @default NaN
				 */
				public function get maximum():Number
				{
					//return Math.pow(10, computedMaximum);
					return computedMaximum;
				}
				
				/**
				 *  @private
				 */
				public function set maximum(value:Number):void
				{
					/*
					computedMaximum = Math.ceil(Math.log(value) / Math.LN10);
					*/
					assignedMaximum = computedMaximum;
					
					invalidateCache();
					
					dispatchEvent(new Event("mappingChange"));
					dispatchEvent(new Event("axisChange"));
					
				}
				
				//----------------------------------
				//  maximumLabelPrecision
				//----------------------------------
				
				/**
				 *  @private
				 */
				private var _labelPrecision:Number;
				
				/**
				 * @private
				 */
				public function get maximumLabelPrecision():Number
				{
					return _labelPrecision;
				}
				
				/**
				 *  Specifies the maximum number of decimal places for
				 representing fractional
				 *  values on the labels generated by this axis. By default, the
				 *  Axis autogenerates this value from the labels themselves.  A
				 value of 0
				 *  round to the nearest integer value, while a value of 2 rounds
				 to the nearest
				 *  1/100th of a value.
				 */
				public function set maximumLabelPrecision(value:Number):void
				{
					_labelPrecision = value;
					
					invalidateCache();
				}
				
				//----------------------------------
				//  minimum
				//----------------------------------
				
				[Inspectable(category="General")]
				
				/**
				 *  Specifies the minimum value for an axis label.
				 *  If <code>NaN</code>, Flex determines the minimum value
				 *  from the data in the chart.
				 *  The minimum value must be an even power of 10.
				 *  The LogAxis will round an explicit minimum value
				 *  downward to an even power of 10 if necessary.
				 *
				 *  @default NaN
				 */
				public function get minimum():Number
				{
					//return Math.pow(10, computedMinimum);
					return computedMinimum;
				}
				
				/**
				 *  @private
				 */
				public function set minimum(value:Number):void
				{
					/*
					if(value == 0)
					assignedMinimum = NaN;
					else
					{
					assignedMinimum = Math.floor(Math.log(value) / Math.LN10);
					}*/
					computedMinimum = assignedMinimum;
					
					invalidateCache();
					
					dispatchEvent(new Event("mappingChange"));
					dispatchEvent(new Event("axisChange"));
					
				}
				
				//--------------------------------------------------------------------------
				//
				//  Overridden methods: NumericAxis
				//
				//--------------------------------------------------------------------------
				
				/**
				 *  @private
				 */
				/*override protected function adjustMinMax(minValue:Number,
				maxValue:Number):void
				{
				esg: We always floor to the nearest power of 10
				if (autoAdjust && isNaN(assignedMinimum))
				computedMinimum = Math.floor(computedMinimum);
				
				esg: We always ceil o the nearest power of 10
				if (autoAdjust && isNaN(assignedMaximum))
				computedMaximum = Math.ceil(computedMaximum);
				
				Alert.show("computedMinimum- adjustMinMax:
				"+computedMinimum);
				Alert.show("computedMaximum- adjustMinMax:
				"+computedMaximum);
				
				}*/
				
				/**
				 *  @private
				 */
				override public function mapCache(cache:Array, field:String,
												  convertedField:String,
												  indexValues:Boolean =
												  false):void
				{
					const ln10:Number = Math.LN10;
					
					var n:int = cache.length;
					var i:int;
					var v:Object;
					var vf:Number;
					var parseFunction:Function = this.parseFunction ;
					
					if (parseFunction != null)
					{
						for (i = 0; i < n; i++)
						{
							v = cache[i];
							v[convertedField] =
								Math.log(Number(parseFunction(v[field]))) / ln10;
						}
					}
					else
					{
						for (i = 0; i < n && cache[i][field] == null; i++)
						{
						}
						
						if (i == n)
							return;
						
						if (cache[i][field] is String)
						{
							for (i = 0; i < n; i++)
							{
								v = cache[i];
								v[convertedField] = Math.log(Number(v[field])) /
									ln10;
							}
						}
						else if (cache[i][field] is XML ||
							cache[i][field] is XMLList)
						{
							for (i = 0; i < n; i++)
							{
								v = cache[i];
								v[convertedField] =
									Math.log(Number(v[field].toString())) / ln10;
							}
						}
						else if (cache[i][field] is Number ||
							cache[i][field] is int ||
							cache[i][field] is uint)
						{
							for (i = 0; i < n; i++)
							{
								v = cache[i];
								
								v[convertedField] = v[field] == null ?
									NaN :
									Math.log(v[field]) / ln10;
							}
						}
						else
						{
							for (i = 0; i < n; i++)
							{
								v = cache[i];
								
								v[convertedField] =
									Math.log(parseFloat(v[field])) / ln10;
							}
						}
					}
				}
				
				/**
				 *  @private
				 */
				/**
				 *  @private
				 */
				override protected function buildLabelCache():Boolean
				{
					
					if (labelCache)
						return false;
					
					labelCache = [];
					
					computedMaximum = Math.log(computedMaximum) *
						Math.LOG10E;
					computedMinimum = Math.log(computedMinimum) *
						Math.LOG10E;
					var r:Number = computedMaximum -
						computedMinimum;
					
					var labelBase:Number = labelMinimum -
						Math.floor ((labelMinimum - computedMinimum) /
							computedInterval) *
						computedInterval;
					
					var labelTop:Number = computedMaximum + 0.000001;
					
					var labelFunction:Function = this.labelFunction;
					
					var i:Number;
					var v:Number;
					var roundedValue:Number;
					
					var roundBase:Number;
					if(isNaN(computedMinimum)){
						labelMinimum = 0;
					}else{
						labelMinimum = computedMinimum;
					}
					trace("computedMinimum : "+computedMinimum);
					trace("computedMaximum : "+computedMaximum);
					trace("labelMinimum : "+labelMinimum);
					
					
					if (!isNaN(_labelPrecision))
						roundBase = Math.pow(10, _labelPrecision);
					
					if (labelFunction != null)
					{
						var previousValue:Number = NaN;
						for (i = labelBase; i <= labelTop; i +=
							computedInterval)
						{
							v = Math.pow(10, i);
							
							roundedValue = isNaN(_labelPrecision) ?
								v :
								Math.round(v * roundBase) /
								roundBase;
							
							labelCache.push(new AxisLabel((i -
								computedMinimum) / r, v,
								labelFunction(roundedValue, previousValue,
									this)));
							
							previousValue = v;
						}
					}
					else
					{
						var lowerLimit : Number;
						if(isNaN(computedMinimum)){
							lowerLimit = 0;
						}else{
							lowerLimit =
								Math.pow(10,computedMinimum);
						}
						var upperLimit : Number =
							Math.pow(10,computedMaximum);
						var logValue : Number;
						var totalspan : Number = upperLimit-lowerLimit;
						var lablePoints : Number = (totalspan/
							computedInterval);
						var scallingRatio : Number = 1/(computedMaximum-
							computedMinimum);
						var scaleDownValue : Number =
							Math.round(Math.log(lowerLimit)*Math.LOG10E*100000)*(1/100000);
						
						var scallingFactor :
						Number;
						var scaleIndex : Number = 0;
						
						
						var firstLabel : Number =
							Math.pow(10,labelMinimum);
						
						logValue =
							Math.round(Math.log(lowerLimit)*Math.LOG10E*100000)*(1/100000);
						//First Label is skipped
						/*if(lowerLimit < (Math.floor (lowerLimit)
						+ 0.5)){
						//To designate the label 1 as 0
						if(lowerLimit==1){
						labelCache.push(new AxisLabel(0,
						lowerLimit,"0"));
						}else{
						labelCache.push(new AxisLabel(0,
						lowerLimit,String(Math.floor(lowerLimit))));
						}
						
						}else{
						if(lowerLimit==1){
						labelCache.push(new AxisLabel(0,
						lowerLimit,"0"));
						}else{
						labelCache.push(new AxisLabel(0,
						lowerLimit,String(Math.ceil(lowerLimit))));
						}
						
						}*/
						
						//more than 10 labels would smudge out the y axis
						//so reduce numer of labels by increasing computed interval
						if(lablePoints >= 9){
							computedInterval = 2*computedInterval;
						}
						
						
						if(lowerLimit==1)lowerLimit=0;
						//Build intermediate labels
						for(var lblIndex : Number = lowerLimit
							+computedInterval;lblIndex<upperLimit;lblIndex+=computedInterval){
							logValue = Math.round(Math.log(lblIndex)*Math.LOG10E*100000)*(1/100000);
							scallingFactor = (logValue - computedMinimum)*scallingRatio;
							if(scallingFactor < 0.96){
								labelCache.push(new AxisLabel(scallingFactor, lblIndex,lblIndex+""));
							}
							
						}
						
						/*if(labelCache.length > 1){
						labelCache =
						labelCache.slice(0,labelCache.length-1);
						}*/
						
						//if more than labels
						//re asign the original vaue of computedInterval
						if(lablePoints >= 9){
							computedInterval = computedInterval/2;
						}
						//Final lable is also skipped
						//Below might be used for creating final label
						/*if((labelCache.length) < 2 &&
						(upperLimit != lowerLimit)){
						logValue =
						Math.round(Math.log(upperLimit)*Math.LOG10E*100000)*(1/100000);
						scallingFactor = (logValue -
						computedMinimum)*scallingRatio;
						labelCache.push(new
						AxisLabel(scallingFactor, upperLimit,
						
						String(Math.ceil(upperLimit))));
						
						}*/
						//reverting the change
						
						if(lowerLimit==0)lowerLimit=1;
						
						
					}
					
					return true;
				}
				
				/**
				 *  @private
				 */
				override protected function buildMinorTickCache():Array
				{
					var cache:Array = [];
					var n:int = labelCache.length;
					for (var i:int = 0; i < labelCache.length; i++)
					{
						cache.push(labelCache[i].position);
					}
					return cache;
				}
				
				/**
				 *  @private
				 */
				override public function reduceLabels(intervalStart:AxisLabel,
													  
													  intervalEnd:AxisLabel):AxisLabelSet
				{
					if(!_callReduceLabelOnce){
						
						
						var intervalMultiplier:Number =
							Math.round((Math.log(Number(intervalEnd.value)) /
								Math.LN10) -
								Math.log(Number(intervalStart.value)) / Math.LN10);
						intervalMultiplier =
							Math.floor(intervalMultiplier / computedInterval) + 1;
						
						var labels:Array = [];
						var newMinorTicks:Array = [];
						var newTicks:Array = [];
						
						var r:Number = computedMaximum - computedMinimum;
						
						var labelBase:Number = labelMinimum -
							Math.floor((labelMinimum - computedMinimum) /
								computedInterval) *
							computedInterval;
						
						var labelTop:Number = computedMaximum + 0.000001
						
						for (var i:int = 0; i < labelCache.length; i +=
							intervalMultiplier)
						{
							var ci:AxisLabel = labelCache[i];
							labels.push(ci);
							newTicks.push(ci.position);
							newMinorTicks.push(ci.position);
						}
						
						
						var labelSet:AxisLabelSet = new AxisLabelSet();
						labelSet.labels = labels;
						labelSet.minorTicks = newMinorTicks;
						labelSet.ticks = newTicks;
						labelSet.accurate = true;
						
						_callReduceLabelOnce = true;
					}
					
					return labelSet;
				}
				
				/**
				 *  @private
				 */
				override public function invertTransform(value:Number):Object
				{
					update();
					
					return Math.pow(10,
						value * (computedMaximum - computedMinimum) +
						computedMinimum);
				}
				
				/**
				 *  @private
				 */
				override protected function guardMinMax(min:Number,
														max:Number):Array
				{
					if (isNaN(min) || !isFinite(min))
						min = 0;
					if (isNaN(max) || !isFinite(max))
						max = min + 2;
					if (max == min)
						max = min + 2;
					
					return [min,max];
				}
				
				/**
				 *  @This function over rides the parent to mimic the lower and
				 upper bound values
				 *  as that of linear axis
				 */
				override protected function adjustMinMax(minValue:Number,
														 maxValue:Number):void
				{
					
					minValue = Math.pow(10,minValue);
					maxValue = Math.pow(10,maxValue);
					trace("minValue : "+minValue);
					trace("maxValue : "+maxValue);
					
					var interval:Number = _userInterval;
					
					if (autoAdjust == false &&
						!isNaN(_userInterval) &&
						!isNaN(_userMinorInterval))
					{
						return;
					}
					
					// New calculations to accomodate negative values.
					// Find the nearest power of ten for y_userInterval
					// for line-grid and labelling positions.
					if (maxValue == 0 && minValue == 0)
						maxValue = 100;
					var maxPowerOfTen:Number =
						Math.floor(Math.log(Math.abs(maxValue)) / Math.LN10);
					var minPowerOfTen:Number =
						Math.floor(Math.log(Math.abs(minValue)) / Math.LN10);
					var powerOfTen:Number =
						Math.floor(Math.log(Math.abs(maxValue - minValue)) /
							Math.LN10)
					
					trace("maxPowerOfTen : "+maxPowerOfTen);
					trace("minPowerOfTen : "+minPowerOfTen);
					trace("powerOfTen : "+powerOfTen);
					
					var y_userInterval:Number;
					
					if (isNaN(_userInterval))
					{
						y_userInterval = Math.pow(10, powerOfTen);
						trace("y_userInterval : "+y_userInterval);
						if (Math.abs(maxValue - minValue) / y_userInterval < 4)
						{
							powerOfTen--;
							y_userInterval = y_userInterval * 2 / 10;
						}
					}
					else
					{
						y_userInterval = _userInterval;
					}
					
					// Bug 148745:
					// Using % to decide if y_userInterval divides maxValue evenly
					// is running into floating point errors.
					// For example, 3 % .2 == .2.
					// Multiplication and division don't seem to have the same problems,
					// so instead we divide, round and multiply.
					// If we get back to the same value, it means that either it fit evenly,
					// or the difference was trivial enough to get rounded out
					// by imprecision.
					
					var y_topBound:Number =
						Math.round(maxValue / y_userInterval) * y_userInterval ==
						maxValue ?
						maxValue :
						(Math.floor(maxValue / y_userInterval) + 1) *
						y_userInterval;
					
					var y_lowerBound:Number;
					
					if (isFinite(minValue))
						y_lowerBound = 0;
					
					if (minValue < 0 || baseAtZero == false)
					{
						y_lowerBound =
							Math.floor(minValue / y_userInterval) *
							y_userInterval;
						
						if (maxValue < 0)
							y_topBound = 0;
					}
					else
					{
						y_lowerBound = 0;
					}
					
					// OK, we've figured out our interval.
					// If the caller wants us to lower it based on layout rules,
					// we have more to do. Otherwise, return here.
					// If the user didn't provide us with an interval,
					// we'll use the one we just generated
					
					if (isNaN(_userInterval))
						computedInterval = y_userInterval;
					
					//if(computedInterval < 1) computedInterval = 1;
					
					if (isNaN(_userMinorInterval))
						_minorInterval = computedInterval / 2;
					
					// If the user wanted to us to autoadjust the min/max
					// to nice clean values, record the ones we just caluclated.
					// If the user has provided us with specific min/max values,
					// we won't blow that away here.
					if (autoAdjust)
					{
						if (isNaN(assignedMinimum))
							computedMinimum = y_lowerBound;
						
						if (isNaN(assignedMaximum))
							computedMaximum = y_topBound;
					}
					if(computedMinimum == 0) computedMinimum =1;
				}//
				
				
			}
			
		}