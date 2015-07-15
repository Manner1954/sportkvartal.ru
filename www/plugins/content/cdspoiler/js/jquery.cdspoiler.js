/**
 * Core Design Spoiler plugin for Joomla! 2.5
 * @author		Daniel Rataj, <info@greatjoomla.com>
 * @package		Joomla
 * @subpackage	Content
 * @category   	Plugin
 * @version		2.5.x.2.0.2
 * @copyright	Copyright (C) 2007 - 2012 Great Joomla!, http://www.greatjoomla.com
 * @license		http://www.gnu.org/copyleft/gpl.html GNU/GPL 3
 * 
 * This file is part of Great Joomla! extension.   
 * This extension is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This extension is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program. If not, see <http://www.gnu.org/licenses/>.
 */

if (typeof jQuery == 'function') {
	
	(function($) {
		
		$.fn.cdspoiler = function(options) {

			// set defaults
			var defaults = {
					action : 'click'
			},
			opts = $.extend(defaults, options),
			toggleEl = {};
			
			return this.each(function() {
				var $this = $(this);
				
				// prevent click
				$this.click(function(e) { e.preventDefault(); });
				
				var event = 'click';
				if (opts.action === 'hover') event = 'mouseover';
				
				$this.bind(event, function() {
					toggleEl = $('.cdspoiler_source', $(this).closest('.cdspoiler'));
					toggleElement();
				});
				
				if (opts.action === 'hover') {
					$this.bind('mouseout', function() {
						toggleEl = $('.cdspoiler_source', $(this).closest('.cdspoiler'));
						toggleElement();
					});
				}
			});
			
			/**
			 * Toggle element
			 */
			function toggleElement() {
				toggleEl.toggle();
			};
		};
		
	})(jQuery);
}