
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
import { CanvasController } from './CanvasController';

/**
 * Next, we will add our custom javascript
 */
var canvasControllers = [];
$(document).ready(function() {
    $('#masks').multiselect({
        enableFiltering: true,
        includeSelectAllOption: true
    });
    
    $('.stele_select').multiselect({
        enableFiltering: true,
        includeSelectAllOption: false
    });

    $('.masken_canvas.non-edit').each(function (index, element) {
        let canvas = element;
        let pointsRawData = JSON.parse($(element).attr('data-punkte-json')).uv;
        let maskenTextur = new Image();
        let maskenTexturUrl = $(element).attr('data-maske-url');

        canvasControllers.push(new CanvasController(canvas, pointsRawData, maskenTextur, maskenTexturUrl, false, 'green'));
    });

    $('.masken_canvas.edit').each(function (index, element) {
        let canvas = element;
        let pointsRawData = JSON.parse($(element).attr('data-punkte-json')).uv;
        let maskenTextur = new Image();
        let maskenTexturUrl = $(element).attr('data-maske-url');

        canvasControllers.push(new CanvasController(canvas, pointsRawData, maskenTextur, maskenTexturUrl, true, 'green'));
    });
}); 
