<html lang="en" ng-app="kitchensink">


<title>Kitchensink | Fabric.js Demos</title>
<link rel="stylesheet" type="text/css" href="bootstrap.css">
<link rel="stylesheet" type="text/css" href="kitchensink.css">
<link rel="stylesheet" type="text/css" href="master.css">
<link rel="stylesheet" type="text/css" href="prism.css">

<script src="jquery.js"></script>
<script src="bootstrap.js"></script>
<script src="angular.min.js"></script>
<script src="fabric.js"></script>
<script src="utils.js"></script>
<script src="master.js"></script>
<script src="paster.js"></script>
<script src="prism.js"></script>
<body>


<div id="bd-wrapper" ng-controller="CanvasControls">
    <h2><span>Fabric.js demos</span> &middot; Icon-Editor</h2>


    <div style="position:relative;width:704px;float:left;" id="canvas-wrapper">

        <div id="canvas-controls">
            <div id="complexity">
                Canvas complexity (number of paths):
                <strong>{[ canvas.complexity() ]}</strong>
            </div>

            <div id="canvas-background">
                <label for="canvas-background-picker">Canvas background:</label>
                <input type="color" bind-value-to="canvasBgColor">
            </div>
        </div>

        <canvas id="canvas" width="700" height="600"></canvas>

        <div id="text-wrapper" style="margin-top: 10px" ng-show="getText()">

            <textarea bind-value-to="text"></textarea>

            <div id="text-controls">
                <label for="font-family" style="display:inline-block">Font family:</label>
                <select id="font-family" class="btn-object-action" bind-value-to="fontFamily">
                    <option value="arial">Arial</option>
                    <option value="helvetica" selected>Helvetica</option>
                    <option value="myriad pro">Myriad Pro</option>
                    <option value="delicious">Delicious</option>
                    <option value="verdana">Verdana</option>
                    <option value="georgia">Georgia</option>
                    <option value="courier">Courier</option>
                    <option value="comic sans ms">Comic Sans MS</option>
                    <option value="impact">Impact</option>
                    <option value="monaco">Monaco</option>
                    <option value="optima">Optima</option>
                    <option value="hoefler text">Hoefler Text</option>
                    <option value="plaster">Plaster</option>
                    <option value="engagement">Engagement</option>
                </select>
                <br>
                <label for="text-align" style="display:inline-block">Text align:</label>
                <select id="text-align" class="btn-object-action" bind-value-to="textAlign">
                    <option>Left</option>
                    <option>Center</option>
                    <option>Right</option>
                    <option>Justify</option>
                </select>

                <div>
                    <label for="text-bg-color">Background color:</label>
                    <input type="color" value="" id="text-bg-color" size="10" class="btn-object-action"
                           bind-value-to="bgColor">
                </div>
                <div>
                    <label for="text-lines-bg-color">Background text color:</label>
                    <input type="color" value="" id="text-lines-bg-color" size="10" class="btn-object-action"
                           bind-value-to="textBgColor">
                </div>
                <div>
                    <label for="text-stroke-color">Stroke color:</label>
                    <input type="color" value="" id="text-stroke-color" class="btn-object-action"
                           bind-value-to="strokeColor">
                </div>
                <div>
                    <label for="text-stroke-width">Stroke width:</label>
                    <input type="range" value="1" min="1" max="5" id="text-stroke-width" class="btn-object-action"
                           bind-value-to="strokeWidth">
                </div>
                <div>
                    <label for="text-font-size">Font size:</label>
                    <input type="range" value="" min="1" max="120" step="1" id="text-font-size"
                           class="btn-object-action"
                           bind-value-to="fontSize">
                </div>
                <div>
                    <label for="text-line-height">Line height:</label>
                    <input type="range" value="" min="0" max="10" step="0.1" id="text-line-height"
                           class="btn-object-action"
                           bind-value-to="lineHeight">
                </div>
            </div>
            <div id="text-controls-additional">
                <button type="button" class="btn btn-object-action"
                        ng-click="toggleBold()"
                        ng-class="{'btn-inverse': isBold()}">
                    Bold
                </button>
                <button type="button" class="btn btn-object-action" id="text-cmd-italic"
                        ng-click="toggleItalic()"
                        ng-class="{'btn-inverse': isItalic()}">
                    Italic
                </button>
                <button type="button" class="btn btn-object-action" id="text-cmd-underline"
                        ng-click="toggleUnderline()"
                        ng-class="{'btn-inverse': isUnderline()}">
                    Underline
                </button>
                <button type="button" class="btn btn-object-action" id="text-cmd-linethrough"
                        ng-click="toggleLinethrough()"
                        ng-class="{'btn-inverse': isLinethrough()}">
                    Linethrough
                </button>
                <button type="button" class="btn btn-object-action" id="text-cmd-overline"
                        ng-click="toggleOverline()"
                        ng-class="{'btn-inverse': isOverline()}">
                    Overline
                </button>
            </div>
        </div>
    </div>

    <div id="commands" ng-click="maybeLoadShape($event)">

        <ul class="nav nav-tabs">
            <li><a href="#simple-shapes" data-toggle="tab">Simple</a></li>
            <li class="active"><a href="#object-controls-pane" data-toggle="tab">Controls</a></li>
        </ul>

        <div class="tab-content">

            <div class="tab-pane" id="simple-shapes">
                <p>Add <strong>simple shapes</strong> to canvas:</p>

                <p>
                    <button type="button" class="btn rect" ng-click="addRect()">Rectangle</button>
                    <button type="button" class="btn circle" ng-click="addCircle()">Circle</button>
                    <button type="button" class="btn triangle" ng-click="addTriangle()">Triangle</button>
                </p>
            </div>

            <div class="tab-pane active" id="object-controls-pane">
                <div id="global-controls">
                    <p>
                        <button class="btn btn-danger clear" ng-click="confirmClear()">Clear canvas</button>
                    </p>
                </div>

                <div class="object-controls" object-buttons-enabled="getSelected()">

                    <div style="margin-top:10px;">
                        <p>
                            <button class="btn btn-object-action" id="remove-selected"
                                    ng-click="removeSelected()">
                                Remove selected object/group
                            </button>
                        </p>

                        <button class="btn btn-lock btn-object-action"
                                ng-click="setHorizontalLock(!getHorizontalLock())"
                                ng-class="{'btn-inverse': getHorizontalLock()}">
                            {[ getHorizontalLock() ? 'Unlock horizontal movement' : 'Lock horizontal movement' ]}
                        </button>
                        <br>
                        <button class="btn btn-lock btn-object-action"
                                ng-click="setVerticalLock(!getVerticalLock())"
                                ng-class="{'btn-inverse': getVerticalLock()}">
                            {[ getVerticalLock() ? 'Unlock vertical movement' : 'Lock vertical movement' ]}
                        </button>
                        <br>
                        <button class="btn btn-lock btn-object-action"
                                ng-click="setScaleLockX(!getScaleLockX())"
                                ng-class="{'btn-inverse': getScaleLockX()}">
                            {[ getScaleLockX() ? 'Unlock horizontal scaling' : 'Lock horizontal scaling' ]}
                        </button>
                        <br>
                        <button class="btn btn-lock btn-object-action"
                                ng-click="setScaleLockY(!getScaleLockY())"
                                ng-class="{'btn-inverse': getScaleLockY()}">
                            {[ getScaleLockY() ? 'Unlock vertical scaling' : 'Lock vertical scaling' ]}
                        </button>
                        <br>
                        <button class="btn btn-lock btn-object-action"
                                ng-click="setRotationLock(!getRotationLock())"
                                ng-class="{'btn-inverse': getRotationLock()}">
                            {[ getRotationLock() ? 'Unlock rotation' : 'Lock rotation' ]}
                        </button>
                    </div>

                    <div style="margin-top:10px">
                        <p>
                            <span style="margin-right: 10px">Origin X: </span>
                            <label>
                                Right
                                <input type="radio" name="origin-x" class="origin-x btn-object-action" value="right"
                                       bind-value-to="originX">
                            </label>
                            <label>
                                Center
                                <input type="radio" name="origin-x" class="origin-x btn-object-action" value="center"
                                       bind-value-to="originX">
                            </label>
                            <label>
                                Left
                                <input type="radio" name="origin-x" class="origin-x btn-object-action" value="left"
                                       bind-value-to="originX">
                            </label>
                        </p>

                        <p>
                            <span style="margin-right: 10px">Origin Y: </span>
                            <label>
                                Top
                                <input type="radio" name="origin-y" class="origin-y btn-object-action" value="bottom"
                                       bind-value-to="originY">
                            </label>
                            <label>
                                Center
                                <input type="radio" name="origin-y" class="origin-y btn-object-action" value="center"
                                       bind-value-to="originY">
                            </label>
                            <label>
                                Bottom
                                <input type="radio" name="origin-y" class="origin-y btn-object-action" value="top"
                                       bind-value-to="originY">
                            </label>
                        </p>
                    </div>

                    <div style="margin-top:10px;">
                        <button id="send-backwards" class="btn btn-object-action"
                                ng-click="sendBackwards()">Send backwards
                        </button>
                        <button id="send-to-back" class="btn btn-object-action"
                                ng-click="sendToBack()">Send to back
                        </button>
                    </div>

                    <div style="margin-top:4px;">
                        <button id="bring-forward" class="btn btn-object-action"
                                ng-click="bringForward()">Bring forwards
                        </button>
                        <button id="bring-to-front" class="btn btn-object-action"
                                ng-click="bringToFront()">Bring to front
                        </button>
                    </div>

                    <div style="margin-top:10px;">
                        <button id="gradientify" class="btn btn-object-action" ng-click="gradientify()">
                            Gradientify
                        </button>
                        <button id="shadowify" class="btn btn-object-action" ng-click="shadowify()">
                            Shadowify
                        </button>
                        <button id="patternify" class="btn btn-object-action" ng-click="patternify()">
                            Patternify
                        </button>
                        <button id="clip" class="btn btn-object-action" ng-click="clip()">
                            Clip
                        </button>
                    </div>
                </div>
                <div style="margin-top:10px;" id="drawing-mode-wrapper">

                    <button id="drawing-mode" class="btn btn-info"
                            ng-click="setFreeDrawingMode(!getFreeDrawingMode())"
                            ng-class="{'btn-inverse': getFreeDrawingMode()}">
                        {[ getFreeDrawingMode() ? 'Exit free drawing mode' : 'Enter free drawing mode' ]}
                    </button>

                    <div id="drawing-mode-options" ng-show="getFreeDrawingMode()">
                        <label for="drawing-mode-selector">Mode:</label>
                        <select id="drawing-mode-selector" bind-value-to="drawingMode">
                            <option>Pencil</option>
                            <option>Circle</option>
                            <option>Spray</option>
                            <option>Pattern</option>

                            <option>hline</option>
                            <option>vline</option>
                            <option>square</option>
                            <option>diamond</option>
                            <option>texture</option>
                        </select>
                        <br>
                        <label for="drawing-line-width">Line width:</label>
                        <input type="range" value="30" min="0" max="150" bind-value-to="drawingLineWidth">
                        <br>
                        <label for="drawing-color">Line color:</label>
                        <input type="color" value="#005E7A" bind-value-to="drawingLineColor">
                        <br>
                        <label for="drawing-shadow-width">Line shadow width:</label>
                        <input type="range" value="0" min="0" max="50" bind-value-to="drawingLineShadowWidth">
                    </div>
                </div>
            </div>
        </div>

        <div id="color-opacity-controls" ng-show="canvas.getActiveObject()">

            <label for="opacity">Opacity: </label>
            <input value="100" type="range" bind-value-to="opacity">

            <label for="color" style="margin-left:10px">Color: </label>
            <input type="color" style="width:40px" bind-value-to="fill">
        </div>

    </div>

    <script src="http://fabricjs.com/lib/font_definitions.js"></script>
    <script>
        var kitchensink = {};
        var canvas = new fabric.Canvas('canvas');
    </script>


    <script src="app_config.js"></script>
    <script src="controller.js"></script>
</div>

<script type="text/javascript">


    (function () {

        if (document.location.hash !== '#zoom') return;

        function renderVieportBorders() {
            var ctx = canvas.getContext();

            ctx.save();

            ctx.fillStyle = 'rgba(0,0,0,0.1)';

            ctx.fillRect(
                canvas.viewportTransform[4],
                canvas.viewportTransform[5],
                canvas.getWidth() * canvas.getZoom(),
                canvas.getHeight() * canvas.getZoom());

            ctx.setLineDash([5, 5]);

            ctx.strokeRect(
                canvas.viewportTransform[4],
                canvas.viewportTransform[5],
                canvas.getWidth() * canvas.getZoom(),
                canvas.getHeight() * canvas.getZoom());

            // var viewport = canvas.getViewportCenter();
            //console.log(canvas.getZoom(), viewport.x, viewport.y);

            ctx.restore();
        }

        $(canvas.getElement().parentNode).on('wheel mousewheel', function (e) {

            // canvas.setZoom(canvas.getZoom() + e.originalEvent.wheelDelta / 300);

            var newZoom = canvas.getZoom() + e.originalEvent.wheelDelta / 300;
            canvas.zoomToPoint({x: e.offsetX, y: e.offsetY}, newZoom);

            renderVieportBorders();

            return false;
        });

        var viewportLeft = 0,
            viewportTop = 0,
            mouseLeft,
            mouseTop,
            _drawSelection = canvas._drawSelection,
            isDown = false;

        canvas.on('mouse:down', function (options) {
            isDown = true;

            viewportLeft = canvas.viewportTransform[4];
            viewportTop = canvas.viewportTransform[5];

            mouseLeft = options.e.x;
            mouseTop = options.e.y;

            if (options.e.altKey) {
                _drawSelection = canvas._drawSelection;
                canvas._drawSelection = function () {
                };
            }

            renderVieportBorders();
        });

        canvas.on('mouse:move', function (options) {
            if (options.e.altKey && isDown) {
                var currentMouseLeft = options.e.x;
                var currentMouseTop = options.e.y;

                var deltaLeft = currentMouseLeft - mouseLeft,
                    deltaTop = currentMouseTop - mouseTop;

                canvas.viewportTransform[4] = viewportLeft + deltaLeft;
                canvas.viewportTransform[5] = viewportTop + deltaTop;

                console.log(deltaLeft, deltaTop);

                canvas.renderAll();
                renderVieportBorders();
            }
        });

        canvas.on('mouse:up', function () {
            canvas._drawSelection = _drawSelection;
            isDown = false;
        });
    })();
    (function () {
        var mainScriptEl = document.getElementById('main');
        if (!mainScriptEl) return;
        var preEl = document.createElement('pre');
        var codeEl = document.createElement('code');
        codeEl.innerHTML = mainScriptEl.innerHTML;
        codeEl.className = 'language-javascript';
        preEl.appendChild(codeEl);
        document.getElementById('bd-wrapper').appendChild(preEl);
    })();

    (function () {
        fabric.util.addListener(fabric.window, 'load', function () {
            var canvas = this.__canvas || this.canvas,
                canvases = this.__canvases || this.canvases;

            canvas && canvas.calcOffset && canvas.calcOffset();

            if (canvases && canvases.length) {
                for (var i = 0, len = canvases.length; i < len; i++) {
                    canvases[i].calcOffset();
                }
            }
        });
    })();

</script>

</body>
