/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, { enumerable: true, get: getter });
/******/ 		}
/******/ 	};
/******/
/******/ 	// define __esModule on exports
/******/ 	__webpack_require__.r = function(exports) {
/******/ 		if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 			Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 		}
/******/ 		Object.defineProperty(exports, '__esModule', { value: true });
/******/ 	};
/******/
/******/ 	// create a fake namespace object
/******/ 	// mode & 1: value is a module id, require it
/******/ 	// mode & 2: merge all properties of value into the ns
/******/ 	// mode & 4: return value when already ns object
/******/ 	// mode & 8|1: behave like require
/******/ 	__webpack_require__.t = function(value, mode) {
/******/ 		if(mode & 1) value = __webpack_require__(value);
/******/ 		if(mode & 8) return value;
/******/ 		if((mode & 4) && typeof value === 'object' && value && value.__esModule) return value;
/******/ 		var ns = Object.create(null);
/******/ 		__webpack_require__.r(ns);
/******/ 		Object.defineProperty(ns, 'default', { enumerable: true, value: value });
/******/ 		if(mode & 2 && typeof value != 'string') for(var key in value) __webpack_require__.d(ns, key, function(key) { return value[key]; }.bind(null, key));
/******/ 		return ns;
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "/";
/******/
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 0);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./node_modules/vanilla-lazyload/dist/lazyload.min.js":
/*!************************************************************!*\
  !*** ./node_modules/vanilla-lazyload/dist/lazyload.min.js ***!
  \************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

!function(n,t){ true?module.exports=t():undefined}(this,(function(){"use strict";function n(){return n=Object.assign||function(n){for(var t=1;t<arguments.length;t++){var e=arguments[t];for(var i in e)Object.prototype.hasOwnProperty.call(e,i)&&(n[i]=e[i])}return n},n.apply(this,arguments)}var t="undefined"!=typeof window,e=t&&!("onscroll"in window)||"undefined"!=typeof navigator&&/(gle|ing|ro)bot|crawl|spider/i.test(navigator.userAgent),i=t&&"IntersectionObserver"in window,o=t&&"classList"in document.createElement("p"),a=t&&window.devicePixelRatio>1,r={elements_selector:".lazy",container:e||t?document:null,threshold:300,thresholds:null,data_src:"src",data_srcset:"srcset",data_sizes:"sizes",data_bg:"bg",data_bg_hidpi:"bg-hidpi",data_bg_multi:"bg-multi",data_bg_multi_hidpi:"bg-multi-hidpi",data_poster:"poster",class_applied:"applied",class_loading:"loading",class_loaded:"loaded",class_error:"error",class_entered:"entered",class_exited:"exited",unobserve_completed:!0,unobserve_entered:!1,cancel_on_exit:!0,callback_enter:null,callback_exit:null,callback_applied:null,callback_loading:null,callback_loaded:null,callback_error:null,callback_finish:null,callback_cancel:null,use_native:!1},c=function(t){return n({},r,t)},u=function(n,t){var e,i="LazyLoad::Initialized",o=new n(t);try{e=new CustomEvent(i,{detail:{instance:o}})}catch(n){(e=document.createEvent("CustomEvent")).initCustomEvent(i,!1,!1,{instance:o})}window.dispatchEvent(e)},l="src",s="srcset",f="sizes",d="poster",_="llOriginalAttrs",g="data",v="loading",b="loaded",p="applied",h="error",m="native",E="data-",I="ll-status",y=function(n,t){return n.getAttribute(E+t)},A=function(n){return y(n,I)},k=function(n,t){return function(n,t,e){var i="data-ll-status";null!==e?n.setAttribute(i,e):n.removeAttribute(i)}(n,0,t)},L=function(n){return k(n,null)},w=function(n){return null===A(n)},O=function(n){return A(n)===m},x=[v,b,p,h],C=function(n,t,e,i){n&&(void 0===i?void 0===e?n(t):n(t,e):n(t,e,i))},N=function(n,t){o?n.classList.add(t):n.className+=(n.className?" ":"")+t},M=function(n,t){o?n.classList.remove(t):n.className=n.className.replace(new RegExp("(^|\\s+)"+t+"(\\s+|$)")," ").replace(/^\s+/,"").replace(/\s+$/,"")},z=function(n){return n.llTempImage},T=function(n,t){if(t){var e=t._observer;e&&e.unobserve(n)}},R=function(n,t){n&&(n.loadingCount+=t)},G=function(n,t){n&&(n.toLoadCount=t)},D=function(n){for(var t,e=[],i=0;t=n.children[i];i+=1)"SOURCE"===t.tagName&&e.push(t);return e},V=function(n,t){var e=n.parentNode;e&&"PICTURE"===e.tagName&&D(e).forEach(t)},F=function(n,t){D(n).forEach(t)},j=[l],B=[l,d],J=[l,s,f],P=[g],S=function(n){return!!n[_]},U=function(n){return n[_]},$=function(n){return delete n[_]},q=function(n,t){if(!S(n)){var e={};t.forEach((function(t){e[t]=n.getAttribute(t)})),n[_]=e}},H=function(n,t){if(S(n)){var e=U(n);t.forEach((function(t){!function(n,t,e){e?n.setAttribute(t,e):n.removeAttribute(t)}(n,t,e[t])}))}},K=function(n,t,e){N(n,t.class_loading),k(n,v),e&&(R(e,1),C(t.callback_loading,n,e))},Q=function(n,t,e){e&&n.setAttribute(t,e)},W=function(n,t){Q(n,f,y(n,t.data_sizes)),Q(n,s,y(n,t.data_srcset)),Q(n,l,y(n,t.data_src))},X={IMG:function(n,t){V(n,(function(n){q(n,J),W(n,t)})),q(n,J),W(n,t)},IFRAME:function(n,t){q(n,j),Q(n,l,y(n,t.data_src))},VIDEO:function(n,t){F(n,(function(n){q(n,j),Q(n,l,y(n,t.data_src))})),q(n,B),Q(n,d,y(n,t.data_poster)),Q(n,l,y(n,t.data_src)),n.load()},OBJECT:function(n,t){q(n,P),Q(n,g,y(n,t.data_src))}},Y=["IMG","IFRAME","VIDEO","OBJECT"],Z=function(n,t){!t||function(n){return n.loadingCount>0}(t)||function(n){return n.toLoadCount>0}(t)||C(n.callback_finish,t)},nn=function(n,t,e){n.addEventListener(t,e),n.llEvLisnrs[t]=e},tn=function(n,t,e){n.removeEventListener(t,e)},en=function(n){return!!n.llEvLisnrs},on=function(n){if(en(n)){var t=n.llEvLisnrs;for(var e in t){var i=t[e];tn(n,e,i)}delete n.llEvLisnrs}},an=function(n,t,e){!function(n){delete n.llTempImage}(n),R(e,-1),function(n){n&&(n.toLoadCount-=1)}(e),M(n,t.class_loading),t.unobserve_completed&&T(n,e)},rn=function(n,t,e){var i=z(n)||n;en(i)||function(n,t,e){en(n)||(n.llEvLisnrs={});var i="VIDEO"===n.tagName?"loadeddata":"load";nn(n,i,t),nn(n,"error",e)}(i,(function(o){!function(n,t,e,i){var o=O(t);an(t,e,i),N(t,e.class_loaded),k(t,b),C(e.callback_loaded,t,i),o||Z(e,i)}(0,n,t,e),on(i)}),(function(o){!function(n,t,e,i){var o=O(t);an(t,e,i),N(t,e.class_error),k(t,h),C(e.callback_error,t,i),o||Z(e,i)}(0,n,t,e),on(i)}))},cn=function(n,t,e){!function(n){n.llTempImage=document.createElement("IMG")}(n),rn(n,t,e),function(n){S(n)||(n[_]={backgroundImage:n.style.backgroundImage})}(n),function(n,t,e){var i=y(n,t.data_bg),o=y(n,t.data_bg_hidpi),r=a&&o?o:i;r&&(n.style.backgroundImage='url("'.concat(r,'")'),z(n).setAttribute(l,r),K(n,t,e))}(n,t,e),function(n,t,e){var i=y(n,t.data_bg_multi),o=y(n,t.data_bg_multi_hidpi),r=a&&o?o:i;r&&(n.style.backgroundImage=r,function(n,t,e){N(n,t.class_applied),k(n,p),e&&(t.unobserve_completed&&T(n,t),C(t.callback_applied,n,e))}(n,t,e))}(n,t,e)},un=function(n,t,e){!function(n){return Y.indexOf(n.tagName)>-1}(n)?cn(n,t,e):function(n,t,e){rn(n,t,e),function(n,t,e){var i=X[n.tagName];i&&(i(n,t),K(n,t,e))}(n,t,e)}(n,t,e)},ln=function(n){n.removeAttribute(l),n.removeAttribute(s),n.removeAttribute(f)},sn=function(n){V(n,(function(n){H(n,J)})),H(n,J)},fn={IMG:sn,IFRAME:function(n){H(n,j)},VIDEO:function(n){F(n,(function(n){H(n,j)})),H(n,B),n.load()},OBJECT:function(n){H(n,P)}},dn=function(n,t){(function(n){var t=fn[n.tagName];t?t(n):function(n){if(S(n)){var t=U(n);n.style.backgroundImage=t.backgroundImage}}(n)})(n),function(n,t){w(n)||O(n)||(M(n,t.class_entered),M(n,t.class_exited),M(n,t.class_applied),M(n,t.class_loading),M(n,t.class_loaded),M(n,t.class_error))}(n,t),L(n),$(n)},_n=["IMG","IFRAME","VIDEO"],gn=function(n){return n.use_native&&"loading"in HTMLImageElement.prototype},vn=function(n,t,e){n.forEach((function(n){return function(n){return n.isIntersecting||n.intersectionRatio>0}(n)?function(n,t,e,i){var o=function(n){return x.indexOf(A(n))>=0}(n);k(n,"entered"),N(n,e.class_entered),M(n,e.class_exited),function(n,t,e){t.unobserve_entered&&T(n,e)}(n,e,i),C(e.callback_enter,n,t,i),o||un(n,e,i)}(n.target,n,t,e):function(n,t,e,i){w(n)||(N(n,e.class_exited),function(n,t,e,i){e.cancel_on_exit&&function(n){return A(n)===v}(n)&&"IMG"===n.tagName&&(on(n),function(n){V(n,(function(n){ln(n)})),ln(n)}(n),sn(n),M(n,e.class_loading),R(i,-1),L(n),C(e.callback_cancel,n,t,i))}(n,t,e,i),C(e.callback_exit,n,t,i))}(n.target,n,t,e)}))},bn=function(n){return Array.prototype.slice.call(n)},pn=function(n){return n.container.querySelectorAll(n.elements_selector)},hn=function(n){return function(n){return A(n)===h}(n)},mn=function(n,t){return function(n){return bn(n).filter(w)}(n||pn(t))},En=function(n,e){var o=c(n);this._settings=o,this.loadingCount=0,function(n,t){i&&!gn(n)&&(t._observer=new IntersectionObserver((function(e){vn(e,n,t)}),function(n){return{root:n.container===document?null:n.container,rootMargin:n.thresholds||n.threshold+"px"}}(n)))}(o,this),function(n,e){t&&window.addEventListener("online",(function(){!function(n,t){var e;(e=pn(n),bn(e).filter(hn)).forEach((function(t){M(t,n.class_error),L(t)})),t.update()}(n,e)}))}(o,this),this.update(e)};return En.prototype={update:function(n){var t,o,a=this._settings,r=mn(n,a);G(this,r.length),!e&&i?gn(a)?function(n,t,e){n.forEach((function(n){-1!==_n.indexOf(n.tagName)&&function(n,t,e){n.setAttribute("loading","lazy"),rn(n,t,e),function(n,t){var e=X[n.tagName];e&&e(n,t)}(n,t),k(n,m)}(n,t,e)})),G(e,0)}(r,a,this):(o=r,function(n){n.disconnect()}(t=this._observer),function(n,t){t.forEach((function(t){n.observe(t)}))}(t,o)):this.loadAll(r)},destroy:function(){this._observer&&this._observer.disconnect(),pn(this._settings).forEach((function(n){$(n)})),delete this._observer,delete this._settings,delete this.loadingCount,delete this.toLoadCount},loadAll:function(n){var t=this,e=this._settings;mn(n,e).forEach((function(n){T(n,t),un(n,e,t)}))},restoreAll:function(){var n=this._settings;pn(n).forEach((function(t){dn(t,n)}))}},En.load=function(n,t){var e=c(t);un(n,e)},En.resetStatus=function(n){L(n)},t&&function(n,t){if(t)if(t.length)for(var e,i=0;e=t[i];i+=1)u(n,e);else u(n,t)}(En,window.lazyLoadOptions),En}));


/***/ }),

/***/ "./resources/js/app.js":
/*!*****************************!*\
  !*** ./resources/js/app.js ***!
  \*****************************/
/*! no exports provided */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _libs_PageScroll2id__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./libs/PageScroll2id */ "./resources/js/libs/PageScroll2id.js");
/* harmony import */ var _libs_PageScroll2id__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_libs_PageScroll2id__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var vanilla_lazyload__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! vanilla-lazyload */ "./node_modules/vanilla-lazyload/dist/lazyload.min.js");
/* harmony import */ var vanilla_lazyload__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(vanilla_lazyload__WEBPACK_IMPORTED_MODULE_1__);


$(window).on("load", function () {
  /* Page Scroll to id fn call */
  $("#navigation-menu a,a[href='#top'],a[rel='m_PageScroll2id']").mPageScroll2id({
    highlightSelector: "#navigation-menu a"
  });
});

window.onload = function () {
  $('.view-load').fadeOut(1000);
  animateCSS('.project-catalog li a.active', 'bounceIn');
  scrollToTop();
  lazyLoadInstance();
};

function lazyLoadInstance() {
  new vanilla_lazyload__WEBPACK_IMPORTED_MODULE_1___default.a({// Your custom settings go here
  });
}

function scrollToTop() {
  $(window).scroll(function () {
    if ($(this).scrollTop() > 50) {
      $('#back-to-top').fadeIn();
    } else {
      $('#back-to-top').fadeOut();
    }
  }); // scroll body to 0px on click

  $('#back-to-top').click(function () {
    $('body,html').animate({
      scrollTop: 0
    }, 400);
    return false;
  });
}

window.animateCSS = function (element, animation) {
  var prefix = arguments.length > 2 && arguments[2] !== undefined ? arguments[2] : 'animate__';
  return (// We create a Promise and return it
    new Promise(function (resolve, reject) {
      var animationName = "".concat(prefix).concat(animation);
      var node = document.querySelector(element);
      node.classList.add("".concat(prefix, "animated"), animationName); // When the animation ends, we clean the classes and resolve the Promise

      function handleAnimationEnd(event) {
        event.stopPropagation();
        node.classList.remove("".concat(prefix, "animated"), animationName);
        resolve('Animation ended');
      }

      node.addEventListener('animationend', handleAnimationEnd, {
        once: true
      });
    })
  );
};

/***/ }),

/***/ "./resources/js/libs/PageScroll2id.js":
/*!********************************************!*\
  !*** ./resources/js/libs/PageScroll2id.js ***!
  \********************************************/
/*! no static exports found */
/***/ (function(module, exports) {

function _typeof(obj) { "@babel/helpers - typeof"; return _typeof = "function" == typeof Symbol && "symbol" == typeof Symbol.iterator ? function (obj) { return typeof obj; } : function (obj) { return obj && "function" == typeof Symbol && obj.constructor === Symbol && obj !== Symbol.prototype ? "symbol" : typeof obj; }, _typeof(obj); }

/* == Page scroll to id == Version: 1.6.8, License: MIT License (MIT) */
!function (e, t, a) {
  var n,
      l,
      s,
      i,
      o,
      r,
      c,
      u,
      h,
      f,
      g,
      d,
      p = "mPageScroll2id",
      _ = "mPS2id",
      C = ".m_PageScroll2id,a[rel~='m_PageScroll2id'],.page-scroll-to-id,a[rel~='page-scroll-to-id'],._ps2id",
      v = {
    scrollSpeed: 1e3,
    autoScrollSpeed: !0,
    scrollEasing: "easeInOutQuint",
    scrollingEasing: "easeOutQuint",
    pageEndSmoothScroll: !0,
    layout: "vertical",
    offset: 0,
    highlightSelector: !1,
    clickedClass: _ + "-clicked",
    targetClass: _ + "-target",
    highlightClass: _ + "-highlight",
    forceSingleHighlight: !1,
    keepHighlightUntilNext: !1,
    highlightByNextTarget: !1,
    disablePluginBelow: !1,
    clickEvents: !0,
    appendHash: !1,
    onStart: function onStart() {},
    onComplete: function onComplete() {},
    defaultSelector: !1,
    live: !0,
    liveSelector: !1,
    excludeSelectors: !1,
    encodeLinks: !1,
    inIframe: !1
  },
      m = 0,
      I = /[ `!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?~]/,
      S = {
    init: function init(r) {
      var r = e.extend(!0, {}, v, r);

      if (e(a).data(_, r), l = e(a).data(_), !this.selector) {
        var c = "__" + _;
        this.each(function () {
          var t = e(this);
          t.hasClass(c) || t.addClass(c);
        }), this.selector = "." + c;
      }

      l.liveSelector && (this.selector += "," + l.liveSelector), n = n ? n + "," + this.selector : this.selector, l.defaultSelector && ("object" == _typeof(e(n)) && 0 !== e(n).length || (n = C)), l.clickEvents && e(a).off("." + _).on("click." + _, n, function (t) {
        if (O._isDisabled.call(null)) return void O._removeClasses.call(null);
        var a = e(this),
            n = a.attr("href"),
            s = a.prop("href").baseVal || a.prop("href");
        l.excludeSelectors && a.is(l.excludeSelectors) || n && -1 !== n.indexOf("#/") || (O._reset.call(null), f = a.data("ps2id-offset") || 0, O._isValid.call(null, n, s) && O._findTarget.call(null, n) && (t.preventDefault(), i = "selector", o = a, O._setClasses.call(null, !0), O._scrollTo.call(null)));
      }), e(t).off("." + _).on("scroll." + _ + " resize." + _, function () {
        if (O._isDisabled.call(null)) return void O._removeClasses.call(null);
        var t = e("._" + _ + "-t");
        t.each(function (a) {
          var n = e(this),
              l = n.attr("id"),
              s = O._findHighlight.call(null, l);

          O._setClasses.call(null, !1, n, s), a == t.length - 1 && O._extendClasses.call(null);
        });
      }), s = !0, O._setup.call(null), O._live.call(null);
    },
    scrollTo: function scrollTo(t, a) {
      if (O._isDisabled.call(null)) return void O._removeClasses.call(null);

      if (t && "undefined" != typeof t) {
        O._isInit.call(null);

        var n = {
          layout: l.layout,
          offset: l.offset,
          clicked: !1
        },
            a = e.extend(!0, {}, n, a);
        O._reset.call(null), u = a.layout, h = a.offset, t = -1 !== t.indexOf("#") ? t : "#" + t, O._isValid.call(null, t) && O._findTarget.call(null, t) && (i = "scrollTo", o = a.clicked, o && O._setClasses.call(null, !0), O._scrollTo.call(null));
      }
    },
    destroy: function destroy() {
      e(t).off("." + _), e(a).off("." + _).removeData(_), e("._" + _ + "-t").removeData(_), O._removeClasses.call(null, !0);
    }
  },
      O = {
    _isDisabled: function _isDisabled() {
      var e = t,
          n = "inner",
          s = l.disablePluginBelow instanceof Array ? [l.disablePluginBelow[0] || 0, l.disablePluginBelow[1] || 0] : [l.disablePluginBelow || 0, 0];
      return "innerWidth" in t || (n = "client", e = a.documentElement || a.body), e[n + "Width"] <= s[0] || e[n + "Height"] <= s[1];
    },
    _isValid: function _isValid(e, a) {
      if (e) {
        a = a ? a : e;
        var n = -1 !== a.indexOf("#/") ? a.split("#/")[0] : a.split("#")[0],
            s = l.inIframe || t.location === t.parent.location ? t.location : t.parent.location,
            i = s.toString().split("#")[0];
        return "#" !== e && -1 !== e.indexOf("#") && ("" === n || decodeURIComponent(n) === decodeURIComponent(i));
      }
    },
    _setup: function _setup() {
      var t = O._highlightSelector(),
          n = 1,
          s = 0;

      return e(t).each(function () {
        var i = e(this),
            o = i.attr("href"),
            r = i.prop("href").baseVal || i.prop("href");

        if (O._isValid.call(null, o, r)) {
          if (l.excludeSelectors && i.is(l.excludeSelectors)) return;
          var c = -1 !== o.indexOf("#/") ? o.split("#/")[1] : o.substring(o.indexOf("#") + 1),
              u = e(I.test(c) ? a.getElementById(c) : "#" + c);

          if (u.length > 0) {
            l.highlightByNextTarget && u !== s && (s ? s.data(_, {
              tn: u
            }) : u.data(_, {
              tn: "0"
            }), s = u), u.hasClass("_" + _ + "-t") || u.addClass("_" + _ + "-t"), u.data(_, {
              i: n
            }), i.hasClass("_" + _ + "-h") || i.addClass("_" + _ + "-h");

            var h = O._findHighlight.call(null, c);

            O._setClasses.call(null, !1, u, h), m = n, n++, n == e(t).length && O._extendClasses.call(null);
          }
        }
      });
    },
    _highlightSelector: function _highlightSelector() {
      return l.highlightSelector && "" !== l.highlightSelector ? l.highlightSelector : n;
    },
    _findTarget: function _findTarget(t) {
      var n = -1 !== t.indexOf("#/") ? t.split("#/")[1] : t.substring(t.indexOf("#") + 1),
          s = e(I.test(n) ? a.getElementById(n) : "#" + n);

      if (s.length < 1 || "fixed" === s.css("position")) {
        if ("top" !== n) return;
        s = e("body");
      }

      return r = s, u || (u = l.layout), h = O._setOffset.call(null), c = [(s.offset().top - h[0]).toString(), (s.offset().left - h[1]).toString()], c[0] = c[0] < 0 ? 0 : c[0], c[1] = c[1] < 0 ? 0 : c[1], c;
    },
    _setOffset: function _setOffset() {
      h || (h = l.offset ? l.offset : 0), f && (h = f);
      var t, a, n, s;

      switch (_typeof(h)) {
        case "object":
        case "string":
          t = [h.y ? h.y : h, h.x ? h.x : h], a = [t[0] instanceof jQuery ? t[0] : e(t[0]), t[1] instanceof jQuery ? t[1] : e(t[1])], a[0].length > 0 ? (n = a[0].height(), "fixed" === a[0].css("position") && (n += a[0][0].offsetTop)) : n = !isNaN(parseFloat(t[0])) && isFinite(t[0]) ? parseInt(t[0]) : 0, a[1].length > 0 ? (s = a[1].width(), "fixed" === a[1].css("position") && (s += a[1][0].offsetLeft)) : s = !isNaN(parseFloat(t[1])) && isFinite(t[1]) ? parseInt(t[1]) : 0;
          break;

        case "function":
          t = h.call(null), t instanceof Array ? (n = t[0], s = t[1]) : n = s = t;
          break;

        default:
          n = s = parseInt(h);
      }

      return [n, s];
    },
    _findHighlight: function _findHighlight(a) {
      var n = l.inIframe || t.location === t.parent.location ? t.location : t.parent.location,
          s = n.toString().split("#")[0],
          i = n.pathname;

      if (-1 !== s.indexOf("'") && (s = s.replace("'", "\\'")), -1 !== i.indexOf("'") && (i = i.replace("'", "\\'")), s = decodeURIComponent(s), i = decodeURIComponent(i), l.encodeLinks) {
        var o = encodeURI(s).toLowerCase(),
            r = encodeURI(i).toLowerCase();
        return e("._" + _ + "-h[href='#" + a + "'],._" + _ + "-h[href='" + s + "#" + a + "'],._" + _ + "-h[href='" + i + "#" + a + "'],._" + _ + "-h[href='#/" + a + "'],._" + _ + "-h[href='" + s + "#/" + a + "'],._" + _ + "-h[href='" + i + "#/" + a + "'],._" + _ + "-h[href='" + o + "#/" + a + "'],._" + _ + "-h[href='" + o + "#" + a + "'],._" + _ + "-h[href='" + r + "#/" + a + "'],._" + _ + "-h[href='" + r + "#" + a + "']");
      }

      return e("._" + _ + "-h[href='#" + a + "'],._" + _ + "-h[href='" + s + "#" + a + "'],._" + _ + "-h[href='" + i + "#" + a + "'],._" + _ + "-h[href='#/" + a + "'],._" + _ + "-h[href='" + s + "#/" + a + "'],._" + _ + "-h[href='" + i + "#/" + a + "']");
    },
    _setClasses: function _setClasses(t, a, n) {
      var s = l.clickedClass,
          i = l.targetClass,
          r = l.highlightClass;
      t && s && "" !== s ? (e("." + s).removeClass(s), o.addClass(s)) : a && i && "" !== i && n && r && "" !== r && (O._currentTarget.call(null, a) ? (a.addClass(i), n.addClass(r)) : (!l.keepHighlightUntilNext || e("." + r).length > 1) && (a.removeClass(i), n.removeClass(r)));
    },
    _extendClasses: function _extendClasses() {
      var t = l.targetClass,
          a = l.highlightClass,
          n = e("." + t),
          s = e("." + a),
          i = t + "-first",
          o = t + "-last",
          r = a + "-first",
          c = a + "-last";
      e("._" + _ + "-t").removeClass(i + " " + o), e("._" + _ + "-h").removeClass(r + " " + c), l.forceSingleHighlight ? l.keepHighlightUntilNext && n.length > 1 ? (n.slice(0, 1).removeClass(t), s.slice(0, 1).removeClass(a)) : (n.slice(1).removeClass(t), s.slice(1).removeClass(a)) : (n.slice(0, 1).addClass(i).end().slice(-1).addClass(o), s.slice(0, 1).addClass(r).end().slice(-1).addClass(c));
    },
    _removeClasses: function _removeClasses(t) {
      e("." + l.clickedClass).removeClass(l.clickedClass), e("." + l.targetClass).removeClass(l.targetClass + " " + l.targetClass + "-first " + l.targetClass + "-last"), e("." + l.highlightClass).removeClass(l.highlightClass + " " + l.highlightClass + "-first " + l.highlightClass + "-last"), t && (e("._" + _ + "-t").removeClass("_" + _ + "-t"), e("._" + _ + "-h").removeClass("_" + _ + "-h"));
    },
    _currentTarget: function _currentTarget(a) {
      if (a.data(_)) {
        var n = l["target_" + a.data(_).i],
            s = a.data("ps2id-target"),
            i = s && e(s)[0] ? e(s)[0].getBoundingClientRect() : a[0].getBoundingClientRect();

        if ("undefined" != typeof n) {
          var o = a.offset().top,
              r = a.offset().left,
              c = n.from ? n.from + o : o,
              u = n.to ? n.to + o : o,
              h = n.fromX ? n.fromX + r : r,
              f = n.toX ? n.toX + r : r;
          return i.top >= u && i.top <= c && i.left >= f && i.left <= h;
        }

        var g = e(t).height(),
            d = e(t).width(),
            p = s ? e(s).height() : a.height(),
            C = s ? e(s).width() : a.width(),
            v = 1 + p / g,
            m = v,
            I = g > p ? v * (g / p) : v,
            S = 1 + C / d,
            O = S,
            M = d > C ? S * (d / C) : S,
            b = [i.top <= g / m, i.bottom >= g / I, i.left <= d / O, i.right >= d / M];

        if (l.highlightByNextTarget) {
          var y = a.data(_).tn;

          if (y) {
            var w = y[0].getBoundingClientRect();
            "vertical" === l.layout ? b = [i.top <= g / 2, w.top > g / 2, 1, 1] : "horizontal" === l.layout && (b = [1, 1, i.left <= d / 2, w.left > d / 2]);
          }
        }

        return b[0] && b[1] && b[2] && b[3];
      }
    },
    _scrollTo: function _scrollTo() {
      d = O._scrollSpeed.call(null), c = l.pageEndSmoothScroll ? O._pageEndSmoothScroll.call(null) : c;
      var a = e("html,body"),
          n = l.autoScrollSpeed ? O._autoScrollSpeed.call(null) : d,
          s = a.is(":animated") ? l.scrollingEasing : l.scrollEasing,
          i = e(t).scrollTop(),
          o = e(t).scrollLeft();

      switch (u) {
        case "horizontal":
          o != c[1] && (O._callbacks.call(null, "onStart"), a.stop().animate({
            scrollLeft: c[1]
          }, n, s).promise().then(function () {
            O._callbacks.call(null, "onComplete");
          }));
          break;

        case "auto":
          if (i != c[0] || o != c[1]) if (O._callbacks.call(null, "onStart"), navigator.userAgent.match(/(iPod|iPhone|iPad|Android)/)) {
            var r;
            a.stop().animate({
              pageYOffset: c[0],
              pageXOffset: c[1]
            }, {
              duration: n,
              easing: s,
              step: function step(e, a) {
                "pageXOffset" == a.prop ? r = e : "pageYOffset" == a.prop && t.scrollTo(r, e);
              }
            }).promise().then(function () {
              O._callbacks.call(null, "onComplete");
            });
          } else a.stop().animate({
            scrollTop: c[0],
            scrollLeft: c[1]
          }, n, s).promise().then(function () {
            O._callbacks.call(null, "onComplete");
          });
          break;

        default:
          i != c[0] && (O._callbacks.call(null, "onStart"), a.stop().animate({
            scrollTop: c[0]
          }, n, s).promise().then(function () {
            O._callbacks.call(null, "onComplete");
          }));
      }
    },
    _pageEndSmoothScroll: function _pageEndSmoothScroll() {
      var n = e(a).height(),
          l = e(a).width(),
          s = e(t).height(),
          i = e(t).width();
      return [n - c[0] < s ? n - s : c[0], l - c[1] < i ? l - i : c[1]];
    },
    _scrollSpeed: function _scrollSpeed() {
      var t = l.scrollSpeed;
      return o && o.length && o.add(o.parent()).each(function () {
        var a = e(this);

        if (a.attr("class")) {
          var n = a.attr("class").split(" ");

          for (var l in n) {
            if (String(n[l]).match(/^ps2id-speed-\d+$/)) {
              t = n[l].split("ps2id-speed-")[1];
              break;
            }
          }
        }
      }), parseInt(t);
    },
    _autoScrollSpeed: function _autoScrollSpeed() {
      var n = e(t).scrollTop(),
          l = e(t).scrollLeft(),
          s = e(a).height(),
          i = e(a).width(),
          o = [d + d * Math.floor(Math.abs(c[0] - n) / s * 100) / 100, d + d * Math.floor(Math.abs(c[1] - l) / i * 100) / 100];
      return Math.max.apply(Math, o);
    },
    _callbacks: function _callbacks(e) {
      if (l) switch (this[_] = {
        trigger: i,
        clicked: o,
        target: r,
        scrollTo: {
          y: c[0],
          x: c[1]
        }
      }, e) {
        case "onStart":
          if (l.appendHash && t.history && t.history.pushState && o && o.length) {
            var a = o.attr("href"),
                n = "#" + a.substring(a.indexOf("#") + 1);
            n !== t.location.hash && history.pushState("", "", n);
          }

          l.onStart.call(null, this[_]);
          break;

        case "onComplete":
          l.onComplete.call(null, this[_]);
      }
    },
    _reset: function _reset() {
      u = h = f = !1;
    },
    _isInit: function _isInit() {
      s || S.init.apply(this);
    },
    _live: function _live() {
      g = setTimeout(function () {
        l.live ? e(O._highlightSelector()).length !== m && O._setup.call(null) : g && clearTimeout(g), O._live.call(null);
      }, 1e3);
    },
    _easing: function _easing() {
      function t(e) {
        var t = 7.5625,
            a = 2.75;
        return 1 / a > e ? t * e * e : 2 / a > e ? t * (e -= 1.5 / a) * e + .75 : 2.5 / a > e ? t * (e -= 2.25 / a) * e + .9375 : t * (e -= 2.625 / a) * e + .984375;
      }

      e.easing.easeInQuad = e.easing.easeInQuad || function (e) {
        return e * e;
      }, e.easing.easeOutQuad = e.easing.easeOutQuad || function (e) {
        return 1 - (1 - e) * (1 - e);
      }, e.easing.easeInOutQuad = e.easing.easeInOutQuad || function (e) {
        return .5 > e ? 2 * e * e : 1 - Math.pow(-2 * e + 2, 2) / 2;
      }, e.easing.easeInCubic = e.easing.easeInCubic || function (e) {
        return e * e * e;
      }, e.easing.easeOutCubic = e.easing.easeOutCubic || function (e) {
        return 1 - Math.pow(1 - e, 3);
      }, e.easing.easeInOutCubic = e.easing.easeInOutCubic || function (e) {
        return .5 > e ? 4 * e * e * e : 1 - Math.pow(-2 * e + 2, 3) / 2;
      }, e.easing.easeInQuart = e.easing.easeInQuart || function (e) {
        return e * e * e * e;
      }, e.easing.easeOutQuart = e.easing.easeOutQuart || function (e) {
        return 1 - Math.pow(1 - e, 4);
      }, e.easing.easeInOutQuart = e.easing.easeInOutQuart || function (e) {
        return .5 > e ? 8 * e * e * e * e : 1 - Math.pow(-2 * e + 2, 4) / 2;
      }, e.easing.easeInQuint = e.easing.easeInQuint || function (e) {
        return e * e * e * e * e;
      }, e.easing.easeOutQuint = e.easing.easeOutQuint || function (e) {
        return 1 - Math.pow(1 - e, 5);
      }, e.easing.easeInOutQuint = e.easing.easeInOutQuint || function (e) {
        return .5 > e ? 16 * e * e * e * e * e : 1 - Math.pow(-2 * e + 2, 5) / 2;
      }, e.easing.easeInExpo = e.easing.easeInExpo || function (e) {
        return 0 === e ? 0 : Math.pow(2, 10 * e - 10);
      }, e.easing.easeOutExpo = e.easing.easeOutExpo || function (e) {
        return 1 === e ? 1 : 1 - Math.pow(2, -10 * e);
      }, e.easing.easeInOutExpo = e.easing.easeInOutExpo || function (e) {
        return 0 === e ? 0 : 1 === e ? 1 : .5 > e ? Math.pow(2, 20 * e - 10) / 2 : (2 - Math.pow(2, -20 * e + 10)) / 2;
      }, e.easing.easeInSine = e.easing.easeInSine || function (e) {
        return 1 - Math.cos(e * Math.PI / 2);
      }, e.easing.easeOutSine = e.easing.easeOutSine || function (e) {
        return Math.sin(e * Math.PI / 2);
      }, e.easing.easeInOutSine = e.easing.easeInOutSine || function (e) {
        return -(Math.cos(Math.PI * e) - 1) / 2;
      }, e.easing.easeInCirc = e.easing.easeInCirc || function (e) {
        return 1 - Math.sqrt(1 - Math.pow(e, 2));
      }, e.easing.easeOutCirc = e.easing.easeOutCirc || function (e) {
        return Math.sqrt(1 - Math.pow(e - 1, 2));
      }, e.easing.easeInOutCirc = e.easing.easeInOutCirc || function (e) {
        return .5 > e ? (1 - Math.sqrt(1 - Math.pow(2 * e, 2))) / 2 : (Math.sqrt(1 - Math.pow(-2 * e + 2, 2)) + 1) / 2;
      }, e.easing.easeInElastic = e.easing.easeInElastic || function (e) {
        return 0 === e ? 0 : 1 === e ? 1 : -Math.pow(2, 10 * e - 10) * Math.sin((10 * e - 10.75) * (2 * Math.PI / 3));
      }, e.easing.easeOutElastic = e.easing.easeOutElastic || function (e) {
        return 0 === e ? 0 : 1 === e ? 1 : Math.pow(2, -10 * e) * Math.sin((10 * e - .75) * (2 * Math.PI / 3)) + 1;
      }, e.easing.easeInOutElastic = e.easing.easeInOutElastic || function (e) {
        return 0 === e ? 0 : 1 === e ? 1 : .5 > e ? -(Math.pow(2, 20 * e - 10) * Math.sin((20 * e - 11.125) * (2 * Math.PI / 4.5))) / 2 : Math.pow(2, -20 * e + 10) * Math.sin((20 * e - 11.125) * (2 * Math.PI / 4.5)) / 2 + 1;
      }, e.easing.easeInBack = e.easing.easeInBack || function (e) {
        return 2.70158 * e * e * e - 1.70158 * e * e;
      }, e.easing.easeOutBack = e.easing.easeOutBack || function (e) {
        return 1 + 2.70158 * Math.pow(e - 1, 3) + 1.70158 * Math.pow(e - 1, 2);
      }, e.easing.easeInOutBack = e.easing.easeInOutBack || function (e) {
        return .5 > e ? Math.pow(2 * e, 2) * (7.189819 * e - 2.5949095) / 2 : (Math.pow(2 * e - 2, 2) * (3.5949095 * (2 * e - 2) + 2.5949095) + 2) / 2;
      }, e.easing.easeInBounce = e.easing.easeInBounce || function (e) {
        return 1 - t(1 - e);
      }, e.easing.easeOutBounce = e.easing.easeOutBounce || t, e.easing.easeInOutBounce = e.easing.easeInOutBounce || function (e) {
        return .5 > e ? (1 - t(1 - 2 * e)) / 2 : (1 + t(2 * e - 1)) / 2;
      };
    }
  };
  O._easing.call(), e.fn[p] = function (t) {
    return S[t] ? S[t].apply(this, Array.prototype.slice.call(arguments, 1)) : "object" != _typeof(t) && t ? void e.error("Method " + t + " does not exist") : S.init.apply(this, arguments);
  }, e[p] = function (t) {
    return S[t] ? S[t].apply(this, Array.prototype.slice.call(arguments, 1)) : "object" != _typeof(t) && t ? void e.error("Method " + t + " does not exist") : S.init.apply(this, arguments);
  }, e[p].defaults = v;
}(jQuery, window, document);

/***/ }),

/***/ "./resources/sass/admin.scss":
/*!***********************************!*\
  !*** ./resources/sass/admin.scss ***!
  \***********************************/
/*! no static exports found */
/***/ (function(module, exports) {

// removed by extract-text-webpack-plugin

/***/ }),

/***/ "./resources/sass/site.scss":
/*!**********************************!*\
  !*** ./resources/sass/site.scss ***!
  \**********************************/
/*! no static exports found */
/***/ (function(module, exports) {

// removed by extract-text-webpack-plugin

/***/ }),

/***/ "./resources/sass/user.scss":
/*!**********************************!*\
  !*** ./resources/sass/user.scss ***!
  \**********************************/
/*! no static exports found */
/***/ (function(module, exports) {

// removed by extract-text-webpack-plugin

/***/ }),

/***/ 0:
/*!*********************************************************************************************************************!*\
  !*** multi ./resources/js/app.js ./resources/sass/user.scss ./resources/sass/site.scss ./resources/sass/admin.scss ***!
  \*********************************************************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

__webpack_require__(/*! /Users/vodaiphuc/Documents/03.Git/buy/resources/js/app.js */"./resources/js/app.js");
__webpack_require__(/*! /Users/vodaiphuc/Documents/03.Git/buy/resources/sass/user.scss */"./resources/sass/user.scss");
__webpack_require__(/*! /Users/vodaiphuc/Documents/03.Git/buy/resources/sass/site.scss */"./resources/sass/site.scss");
module.exports = __webpack_require__(/*! /Users/vodaiphuc/Documents/03.Git/buy/resources/sass/admin.scss */"./resources/sass/admin.scss");


/***/ })

/******/ });