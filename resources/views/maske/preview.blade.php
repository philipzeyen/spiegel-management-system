<div class="row">
    <div class="col-md-12">
        <canvas id='canvas_{{ $maske->name_maske }}' width='870' height='600' class="masken_canvas edit" data-punkte-json='{{ $maske->punkte }}' data-maske-url='{{ $maske->bilddatei }}'></canvas>
        <input type="hidden" id="maske_json" name="maske_json" value="{{ $maske->punkte }}" />
    </div>
</div>