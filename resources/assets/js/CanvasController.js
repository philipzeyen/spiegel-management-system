export function CanvasController(canvas, pointsRawData, maskenTextur, maskenTexturUrl, editable, pointColor) {
    console.log("CanvasController was called with editable: " + editable);
    
    editable = editable ? editable : false;
    pointColor = pointColor ? pointColor : '#00FF00';
    pointsRawData = pointsRawData != null ? pointsRawData : JSON.parse('{"uv":[0.10191553967007,0.42812687457542,0.1162513335287,0.46707067463465,0.14073494280588,0.53483436585967,0.17965193757793,0.59218433770266,0.21642122051227,0.65135408681014,0.25216985447787,0.71587501685821,0.3188779004622,0.77330669826101,0.42070052056825,0.80942396385169,0.53554616921888,0.82556100549369,0.65750335792765,0.80924985887115,0.75377175396351,0.77750256367985,0.82101629300692,0.71323247800426,0.83590111748015,0.65016060039915,0.86457680568633,0.59008642984408,0.90279763684599,0.5311109645987,0.91713553065197,0.48112862050346,0.91918378699486,0.43094739514085,0.27262913209996,0.3678263128738,0.32002822428651,0.3530144670914,0.36742731647305,0.35005209793491,0.41482638380815,0.3604203899826,0.46636207406606,0.37739783731,0.57402505781441,0.37880258070638,0.62940397480023,0.358752078584,0.68287330652293,0.35206859444376,0.73061373334754,0.35779728448503,0.78408301536734,0.36734515092216,0.52419000184497,0.41357993874057,0.52632956240775,0.45316079006673,0.53060868353331,0.49381139547474,0.53916692578443,0.54301998383573,0.45640141490228,0.55661051026706,0.49482761842808,0.56717743507373,0.53517513710047,0.56717743507373,0.57744392121654,0.56429553293509,0.60626359871234,0.55564987622085,0.30270554732034,0.43068752991368,0.34461594870502,0.41463582605404,0.41364715774983,0.42293406803406,0.42967323526886,0.44522581765644,0.38419744634473,0.45038723758769,0.33659524327381,0.44461560529601,0.62575782005484,0.44478081367606,0.63985942629339,0.42067117545298,0.69816315989541,0.41173399354223,0.7373342607231,0.4258352295732,0.709131048246,0.44008040166574,0.66839311332578,0.44977968426707,0.33222121446839,0.69838792851726,0.3903494719962,0.69965099727846,0.44694782468317,0.70417872080609,0.53476136049153,0.70291599995664,0.61224330442348,0.69730080369872,0.68084150183861,0.69589911695558,0.73312169177524,0.69299474965816,0.67720513856372,0.72447892416234,0.60893965233421,0.73358074288383,0.53308910655665,0.73585623484046,0.45875559256985,0.73206379794776,0.39307560128575,0.72333762451399,0.36751675683435,0.70325615824577,0.44275439135026,0.71579276057994,0.53452035114897,0.71606467846419,0.6148940592713,0.71606467846419,0.69996513838877,0.70156749400973,0.6148940592713,0.71688038241527,0.53452035114897,0.71606467846419,0.44221059196547,0.71633659634844,0.097029546184726,0.36786776407385,0.17148980255624,0.3019593868136,0.26608649138907,0.26412933924729,0.38705971186635,0.2431690354706,0.64712728195936,0.2392563205154,0.76251344960365,0.25848166294232,0.83538361092732,0.28333045210584,0.89169381107492,0.33975480473527]}').uv

    canvas.width = 870;
    canvas.height = 600;
    var points = [];
    var imageWidth, imageHeight;

    var ctx = canvas.getContext('2d');

    function createAllPoints() {
        for (var i = 0; i < pointsRawData.length; i += 2) {
            createPoint(
                pointsRawData[i] * imageWidth,
                pointsRawData[i + 1] * imageHeight,
                4,
                pointColor
            );
        }
    }

    function createPoint(x, y, radius, pointColor) {
        points.push({
            x: x,
            y: y,
            radius: radius,
            color: pointColor
        });
    }

    function drawAllPoints() {
        for (var i = 0; i < points.length; i++) {
            drawPoint(points[i]);
        }
    }

    function drawPoint(point) {
        ctx.beginPath();
        ctx.arc(point.x, point.y, point.radius, 0, 2 * Math.PI);
        ctx.fillStyle = point.color;
        ctx.fill();
    }

    function drawMaske() {
        ctx.drawImage(maskenTextur, 0, 0);
    }

    function redraw() {
        clearCanvas();
        drawMaske();
        drawAllPoints();
    }

    function clearCanvas() {
        // var p1 = ctx.transformedPoint(0,0);
        // var p2 = ctx.transformedPoint(canvas.width,canvas.height);
        // ctx.clearRect(p1.x,p1.y,p2.x-p1.x,p2.y-p1.y);
        ctx.save();
        ctx.setTransform(1, 0, 0, 1, 0, 0);
        ctx.clearRect(0, 0, canvas.width, canvas.height);
        ctx.restore();
    }

    function fitImageToCanvas() {
        var pt = ctx.transformedPoint(0, 0);
        ctx.translate(pt.x, pt.y);
        var scaleX = canvas.width / imageWidth;
        var scaleY = canvas.height / imageHeight;
        var factor = scaleX < scaleY ? scaleX : scaleY;
        ctx.scale(factor, factor);
        ctx.translate(-pt.x, -pt.y);
        redraw();
    }

    var lastX = canvas.width / 2, lastY = canvas.height / 2;
    var dragStart;

    canvas.addEventListener('mousedown', function (event) {
        document.body.style.mozUserSelect = document.body.style.webkitUserSelect = document.body.style.userSelect = 'none';
        lastX = event.offsetX || (event.pageX - canvas.offsetLeft);
        lastY = event.offsetY || (event.pageY - canvas.offsetTop);
        dragStart = ctx.transformedPoint(lastX, lastY);
        
        if (event.shiftKey) {
            canvas.onmousemove = moveCompleteCanvas;
        } else if(editable) {
            console.log("editable canvasController");
            var hittedPointIndex;
            if ((hittedPointIndex = checkIfAPointWasHit(dragStart.x, dragStart.y)) !== null) {
                canvas.onmousemove = function (event) {
                    lastX = event.offsetX || (event.pageX - canvas.offsetLeft);
                    lastY = event.offsetY || (event.pageY - canvas.offsetTop);

                    if (dragStart) {
                        var pt = ctx.transformedPoint(lastX, lastY);
                        points[hittedPointIndex].x += pt.x - points[hittedPointIndex].x;
                        points[hittedPointIndex].y += pt.y - points[hittedPointIndex].y;
                        redraw();
                    }
                };
            }
        }
    }, false);

    function checkIfAPointWasHit(hittedX, hittedY) {
        for (var i = 0; i < points.length; i++) {
            if (hittedX > points[i].x - points[i].radius && hittedX < points[i].x + points[i].radius
                && hittedY > points[i].y - points[i].radius && hittedY < points[i].y + points[i].radius) {
                return i;
            }
        }

        return null;
    }

    function moveCompleteCanvas(event) {
        lastX = event.offsetX || (event.pageX - canvas.offsetLeft);
        lastY = event.offsetY || (event.pageY - canvas.offsetTop);

        if (dragStart) {
            var pt = ctx.transformedPoint(lastX, lastY);
            ctx.translate(pt.x - dragStart.x, pt.y - dragStart.y);
            redraw();
        }
    }

    canvas.addEventListener('mouseup', function (evt) {
        dragStart = null;
        canvas.onmousemove = null;
    }, false);

    var scaleFactor = 1.1;
    var zoom = function (clicks) {
        var pt = ctx.transformedPoint(lastX, lastY);
        ctx.translate(pt.x, pt.y);
        var factor = Math.pow(scaleFactor, clicks);
        ctx.scale(factor, factor);
        ctx.translate(-pt.x, -pt.y);
        redraw();
    };

    var handleScroll = function (evt) {
        var delta = evt.wheelDelta ? evt.wheelDelta / 40 : evt.detail ? -evt.detail : 0;
        if (delta) zoom(delta);
        return evt.preventDefault() && false;
    };
    canvas.addEventListener('DOMMouseScroll', handleScroll, false);
    canvas.addEventListener('mousewheel', handleScroll, false);

    if(editable) {
        var buttonDiv = document.createElement('div');

        var saveButton = document.createElement('button');
        saveButton.id = "reset";
        saveButton.type = "button";
        saveButton.className = "btn btn-success";
        saveButton.innerHTML = "Save Points";
        saveButton.onclick = function() {
            var output = {"uv": []};
            for (var i = 0; i < points.length; i++) {
                output.uv.push(points[i].x / imageWidth);
                output.uv.push(points[i].y / imageHeight);
            }

            console.log(output);
            $("#maske_json").attr("value", JSON.stringify(output))
        };

        var resetButton = document.createElement('button');
        resetButton.id = "reset";
        resetButton.type = "button";
        resetButton.className = "btn btn-danger";
        resetButton.innerHTML = "Reset Points";
        resetButton.onclick = function () {
            points = null;
            points = [];
            createAllPoints();
            redraw();
            
            var output = {"uv": []};
            for (var i = 0; i < points.length; i++) {
                output.uv.push(points[i].x / imageWidth);
                output.uv.push(points[i].y / imageHeight);
            }
            $("#maske_json").attr("value", JSON.stringify(output))
        };

        buttonDiv.appendChild(saveButton);
        buttonDiv.appendChild(resetButton);
        canvas.parentNode.appendChild(buttonDiv);
    }
        
    maskenTextur.onload = function () {
        console.log("maskentextur onload");
        imageWidth = maskenTextur.width;
        imageHeight = maskenTextur.height;
        
        
        trackTransforms(ctx);
        createAllPoints();
        redraw();
        fitImageToCanvas();
    };

        
    // Adds ctx.getTransform() - returns an SVGMatrix
    // Adds ctx.transformedPoint(x,y) - returns an SVGPoint
    function trackTransforms(ctx) {
        var svg = document.createElementNS("http://www.w3.org/2000/svg", 'svg');
        var xform = svg.createSVGMatrix();
        ctx.getTransform = function () {
            return xform;
        };

        var savedTransforms = [];
        var save = ctx.save;
        ctx.save = function () {
            savedTransforms.push(xform.translate(0, 0));
            return save.call(ctx);
        };
        var restore = ctx.restore;
        ctx.restore = function () {
            xform = savedTransforms.pop();
            return restore.call(ctx);
        };

        var scale = ctx.scale;
        ctx.scale = function (sx, sy) {
            xform = xform.scaleNonUniform(sx, sy);
            return scale.call(ctx, sx, sy);
        };
        var rotate = ctx.rotate;
        ctx.rotate = function (radians) {
            xform = xform.rotate(radians * 180 / Math.PI);
            return rotate.call(ctx, radians);
        };
        var translate = ctx.translate;
        ctx.translate = function (dx, dy) {
            // updateAllPoints();
            xform = xform.translate(dx, dy);
            return translate.call(ctx, dx, dy);
        };
        var transform = ctx.transform;
        ctx.transform = function (a, b, c, d, e, f) {
            var m2 = svg.createSVGMatrix();
            m2.a = a;
            m2.b = b;
            m2.c = c;
            m2.d = d;
            m2.e = e;
            m2.f = f;
            xform = xform.multiply(m2);
            return transform.call(ctx, a, b, c, d, e, f);
        };
        var setTransform = ctx.setTransform;
        ctx.setTransform = function (a, b, c, d, e, f) {
            xform.a = a;
            xform.b = b;
            xform.c = c;
            xform.d = d;
            xform.e = e;
            xform.f = f;
            return setTransform.call(ctx, a, b, c, d, e, f);
        };
        var pt = svg.createSVGPoint();
        ctx.transformedPoint = function (x, y) {
            pt.x = x;
            pt.y = y;
            return pt.matrixTransform(xform.inverse());
        }
    }
    
    maskenTextur.src = maskenTexturUrl;
    console.log(maskenTexturUrl, maskenTextur);
};
