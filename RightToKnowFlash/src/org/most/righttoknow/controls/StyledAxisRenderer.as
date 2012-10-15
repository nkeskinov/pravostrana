package org.most.righttoknow.controls
{
	import mx.charts.AxisRenderer;
	import mx.graphics.Stroke;
	
	[Style(name="axisStrokeColor", type="uint", format="Color", inherit="yes")]
	[Style(name="axisStrokeWeight", type="Number", format="Length", inherit="yes")]
	
	[Style(name="minorTickStrokeColor", type="uint", format="Color", inherit="yes")]
	[Style(name="minorTickStrokeWeight", type="Number", format="Length", inherit="yes")]
	
	[Style(name="tickStrokeColor", type="uint", format="Color", inherit="yes")]
	[Style(name="tickStrokeWeight", type="Number", format="Length", inherit="yes")]
	
	public class StyledAxisRenderer extends AxisRenderer
	{
		
		override public function styleChanged(styleProp:String):void
		{
			super.styleChanged(styleProp);
			
			var stylesUpdated:Boolean = false;
			
			if ((styleProp != "axisStroke") && (styleProp != "minorTickStroke") && (styleProp != "tickStroke"))
			{
				if ((getStyle("axisStrokeColor") != null) && (getStyle("axisStrokeWeight") != null))
				{
					var axisStroke:Stroke = new Stroke(getStyle("axisStrokeColor"), getStyle("axisStrokeWeight"));
					setStyle("axisStroke", axisStroke);
					
					stylesUpdated = true;
				}
				
				if ((getStyle("minorTickStrokeColor") != null) && (getStyle("minorTickStrokeWeight") != null))
				{
					var minorTickStroke:Stroke = new Stroke(getStyle("minorTickStrokeColor"), getStyle("minorTickStrokeWeight"));
					setStyle("minorTickStroke", minorTickStroke);
					
					stylesUpdated = true;
				}
				
				if ((getStyle("tickStrokeColor") != null) && (getStyle("tickStrokeWeight") != null))
				{
					var tickStroke:Stroke = new Stroke(getStyle("tickStrokeColor"), getStyle("tickStrokeWeight"));
					setStyle("tickStroke", tickStroke);
					
					stylesUpdated = true;
				}
				
				if (stylesUpdated)
				{
					invalidateDisplayList();
				}
			}
		}
	}
}