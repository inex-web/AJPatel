webpackJsonp([1],{88:function(e,t,n){"use strict";Object.defineProperty(t,"__esModule",{value:!0}),n.d(t,"Component",function(){return r});var o=n(96),r=o.a},92:function(e,t){e.exports="object"==typeof self?self.FormData:window.FormData},93:function(e,t,n){"use strict";function o(e){return fetch(s+"login",{headers:p,method:l,body:e})}function r(e){return fetch(s+"admin_view",{headers:p,method:l,body:e})}function i(e){return fetch(s+"admin_edit",{headers:p,method:l,body:e})}function c(e){return fetch(s+"party_list",{headers:p,method:l,body:e})}function a(e){return fetch(s+"party_view",{headers:p,method:l,body:e})}function u(e){return fetch(s+"party_edit",{headers:p,method:l,body:e})}t.c=o,t.b=r,t.a=i,t.e=c,t.f=a,t.d=u;var f=n(34),l=(n.n(f),"POST"),s="http://localhost/ajpatel/ajpatel-rest/api/",p={"Access-Control-Allow-Origin":"*"}},96:function(e,t,n){"use strict";function o(e,t){if(!(e instanceof t))throw new TypeError("Cannot call a class as a function")}function r(e,t){if(!e)throw new ReferenceError("this hasn't been initialised - super() hasn't been called");return!t||"object"!==typeof t&&"function"!==typeof t?e:t}function i(e,t){if("function"!==typeof t&&null!==t)throw new TypeError("Super expression must either be null or a function, not "+typeof t);e.prototype=Object.create(t&&t.prototype,{constructor:{value:e,enumerable:!1,writable:!0,configurable:!0}}),t&&(Object.setPrototypeOf?Object.setPrototypeOf(e,t):e.__proto__=t)}var c=n(0),a=n.n(c),u=n(93),f=function(){function e(e,t){for(var n=0;n<t.length;n++){var o=t[n];o.enumerable=o.enumerable||!1,o.configurable=!0,"value"in o&&(o.writable=!0),Object.defineProperty(e,o.key,o)}}return function(t,n,o){return n&&e(t.prototype,n),o&&e(t,o),t}}(),l=function(e){function t(e){o(this,t);var n=r(this,(t.__proto__||Object.getPrototypeOf(t)).call(this,e));return n.state={},n}return i(t,e),f(t,[{key:"componentDidMount",value:function(){var e=n(92),t=new e;t.append("login_email_mob","9898989898"),t.append("login_password","Test1234"),Object(u.c)(t).then(function(e){return console.log(e),e.text()}).then(function(e){console.log(e)}).catch(function(e){console.log("parsing failed",e)})}},{key:"render",value:function(){return a.a.createElement("div",null,"Sales")}}]),t}(c.Component);t.a=l}});
//# sourceMappingURL=1.84cd89fc.chunk.js.map