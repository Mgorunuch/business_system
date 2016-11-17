(function(){
  this.mg_paralax = function() {
    var defaults = {
      mode: '3d', // 3d = Rotation, 2d = Translate, All = Rotation + Translate
      objectID: null, // REQUIRED
      object: {
        id: null, // REQUIRED
        width: null,
        height: null,
        offset: null,
        css: {
          rotateX: "",
          rotateY: "",
          translateX: "",
          translateY: "",
          perspective: ""
        }
      },
      containerID: null, // REQUIRED
      // 3D Rotation Parametrs
      maxRotationX: [20,20], // Max Rotation on X axis in DEGS (left, right)
      maxRotationY: [20,20], // Max Rotation on Y axis in DEGS (top, bottom)
      // 2D Translate Parametrs
      maxTranslateX: [0,0], // Max Translate on X axis (left, right)
      maxTranslateY: [0,0], // Max Translate on Y axis (top, bottom)

      perspective: 1,
      reverse: {
        RotationX: false,
        RotationY: false,
        TranslateX: false,
        TranslateY: false
      },
      additionTransform: ""
    }

    if (arguments[0] && typeof arguments[0] === "object") {
      this.options = extendDefaults(defaults, arguments[0]);
    }

    this.options.object.id = this.options.objectID;
    this.options.object.css.perspective = this.options.perspective;

    this.options.object.width = setObjectWidth(document.getElementById(this.options.object.id));
    this.options.object.height = setObjectHeight(document.getElementById(this.options.object.id));
    this.options.object.offset = setObjectOffset(this.options.object);

    var parent = this;
    document.getElementById(this.options.containerID).addEventListener("mousemove",function(event){
        setCssProp(parent.options,event.clientY,event.clientX);
    });
  }
  function extendDefaults(source, properties) {
    var property;
    for (property in properties) {
      if (properties.hasOwnProperty(property)) {
        source[property] = properties[property];
      }
    }
    return source;
  }
  function setObjectWidth(objectID) {
    return objectID.offsetWidth;
  }
  function setObjectHeight(objectID) {
    return objectID.offsetWidth;
  }
  function setObjectOffset(object) {
    var elemDOM = document.getElementById(object.id);

    object.offset = {},
    object.offset.top = elemDOM.offsetTop + elemDOM.offsetHeight/2,
    object.offset.left = elemDOM.offsetLeft + elemDOM.offsetWidth/2,
    object.offset.bottom = elemDOM.parentElement.offsetHeight - object.offset.top,
    object.offset.right = elemDOM.parentElement.offsetWidth - object.offset.left;

    return object.offset;
  }
  function setRotationXCss(options, mouseX) {
    var stepX = null;
    if(options.object.offset.left > mouseX) {
      stepX = options.maxRotationX[0] / options.object.offset.right;
      mouseX -= options.object.offset.left;
    } else {
      stepX = options.maxRotationX[1] / options.object.offset.left;
      mouseX -= options.object.offset.right;
    }

    var angle = mouseX*stepX;
    if(options.reverse.RotationX) angle *= -1;
    return angle*-1+"deg";
  }
  function setRotationYCss(options, mouseY) {
    var stepY = null;
    if(options.object.offset.top > mouseY) {
      stepY = options.maxRotationY[0] / options.object.offset.top;
      mouseY -= options.object.offset.top;
    } else {
      stepY = options.maxRotationY[1] / options.object.offset.bottom;
      mouseY -= options.object.offset.bottom;
    }

    var angle = mouseY*stepY;
    if(options.reverse.RotationY) angle *= -1;
    return angle+"deg";
  }
  function setTranslateXCss(options, mouseX) {
    var stepX = null;
    if(options.object.offset.left > mouseX) {
      stepX = options.maxTranslateX[0] / options.object.offset.right;
      mouseX -= options.object.offset.left;
    } else {
      stepX = options.maxTranslateX[1] / options.object.offset.left;
      mouseX -= options.object.offset.right;
    }

    var value = mouseX*stepX;
    if(options.reverse.TranslateX) value *= -1;
    return value+"px";
  }
  function setTranslateYCss(options, mouseY) {
    var stepY = null;
    if(options.object.offset.top > mouseY) {
      stepY = options.maxTranslateY[0] / options.object.offset.top;
      mouseY -= options.object.offset.top;
    } else {
      stepY = options.maxTranslateY[1] / options.object.offset.bottom;
      mouseY -= options.object.offset.bottom;
    }

    var value = mouseY*stepY;
    if(options.reverse.TranslateY) value *= -1;
    return value+"px";
  }
  function setCssToElem(options) {
    var css = options.object.css;
    if(css.perspective != "") css.perspective = "perspective("+options.perspective+")";
    if(css.rotateX != "") css.rotateX = "rotateX("+css.rotateX+")";
    if(css.rotateY != "") css.rotateY = "rotateY("+css.rotateY+")";
    if(css.translateX != "") css.translateX = "translateX("+css.translateX+")";
    if(css.translateY != "") css.translateY = "translateY("+css.translateY+")";
    css = ""+css.perspective+" "+css.rotateX+" "+css.rotateY+" "+css.translateX+" "+css.translateY+"";

    document.getElementById(options.object.id).style.transform = css+" "+options.additionTransform;
    document.getElementById(options.object.id).style.transition = "0s";
  }
  function setCssProp(options,mouseX,mouseY) {
    if(options.mode == "3d") {
      options.object.css.rotateY = setRotationXCss(options, mouseY);
      options.object.css.rotateX = setRotationYCss(options, mouseX);
    } else if(options.mode == "2d") {
      options.object.css.translateX = setTranslateXCss(options, mouseY);
      options.object.css.TranslateY = setTranslateYCss(options, mouseX);
    } else if(options.mode == "All") {
      options.object.css.rotateX = setRotationXCss(options, mouseY);
      options.object.css.rotateY = setRotationYCss(options, mouseX);
      options.object.css.translateX = setTranslateXCss(options, mouseY);
      options.object.css.TranslateY = setTranslateYCss(options, mouseX);
    }
    setCssToElem(options);
  }
}());
