(window.webpackJsonp=window.webpackJsonp||[]).push([[38],{"3Vma":function(t,e,n){"use strict";n.r(e);n("FNk8"),n("+2oP");var a=n("G7vj"),i=n("oVt+"),r=n("sove"),c=n("IF94"),s=n("WeRW"),o=n("Hrou"),l=n("C9gC"),b=n("okd0"),u=n("Ki4g"),d=n("CAmi"),p=n("bPaI"),f={components:{BContainer:a.a,BRow:i.a,BCol:r.a,BCard:c.a,BToast:s.a,BTableSimple:o.a,BThead:l.a,BTbody:b.a,BTr:u.a,BTd:d.a,BTh:p.a},data:function(){return{form_id:"",disabled:!1,visible:!1,variant:"",title:"",message:"",siswa_masuk:[],siswa_lambat:[],pulang_cepat:[]}},created:function(){this.loadPostsData()},mounted:function(){var t=this,e=this;window.Echo.channel("scan").listen("ScanEvent",(function(n){console.log("scan"),console.log(n);var a=n.message;a.absen&&(a.absen.absen_masuk&&(a.absen.absen_masuk.terlambat?(t.siswa_lambat.push(a.absen),t.siswa_lambat.unshift(t.siswa_lambat.pop()),11===t.siswa_lambat.length&&(t.siswa_lambat=t.siswa_lambat.slice(0,-1))):(t.siswa_masuk.push(a.absen),t.siswa_masuk.unshift(t.siswa_masuk.pop()),11===t.siswa_masuk.length&&(t.siswa_masuk=t.siswa_masuk.slice(0,-1)))),a.absen.absen_pulang&&(t.pulang_cepat.push(a.absen),t.pulang_cepat.unshift(t.pulang_cepat.pop()),11===t.pulang_cepat.length&&(t.pulang_cepat=t.pulang_cepat.slice(0,-1)))),e.variant=a.type,e.title=a.title,e.message=a.message,e.visible=!0,e.sound(a.mp3)}))},methods:{sound:function(t){new Audio("/mp3/".concat(t)).play()},loadPostsData:function(){var t=this;this.$http.get("/display").then((function(e){var n=e.data;t.siswa_masuk=n.siswa_masuk,t.siswa_lambat=n.siswa_lambat,t.pulang_cepat=n.pulang_cepat}))},setVarian:function(t){return t?"":"success"}}},m=(n("LbEq"),n("KHd+")),_=Object(m.a)(f,(function(){var t=this,e=t.$createElement,n=t._self._c||e;return n("b-container",{staticClass:"mt-3",attrs:{fluid:""}},[n("b-row",{staticClass:"match-height"},[n("b-col",{attrs:{cols:"12",md:"6"}},[n("b-card",[n("h3",{staticClass:"card-title text-center mb-0"},[t._v("SCAN MASUK")]),t._v(" "),n("b-table-simple",{attrs:{bordered:""}},[n("b-thead",[n("b-tr",[n("b-th",{staticClass:"text-center"},[t._v("NO")]),t._v(" "),n("b-th",{staticClass:"text-center"},[t._v("NAMA")]),t._v(" "),n("b-th",{staticClass:"text-center"},[t._v("Kelas/Unit")]),t._v(" "),n("b-th",{staticClass:"text-center"},[t._v("Waktu Scan Masuk")])],1)],1),t._v(" "),n("b-tbody",[t.siswa_masuk.length?t._l(t.siswa_masuk,(function(e,a){return n("b-tr",{key:e.peserta_didik_id,attrs:{variant:t.setVarian(a)}},[n("b-td",{staticClass:"text-center"},[t._v(t._s(a+1))]),t._v(" "),n("b-td",[t._v(t._s(e.peserta_didik.nama))]),t._v(" "),n("b-td",{staticClass:"text-center"},[t._v(t._s(e.peserta_didik.kelas?e.peserta_didik.kelas.nama:"-"))]),t._v(" "),n("b-td",{staticClass:"text-center"},[t._v(t._s(e.jam_masuk))])],1)})):[n("b-tr",[n("b-td",{staticClass:"text-center",attrs:{colspan:"4"}},[t._v("Tidak ada data untuk ditampilkan")])],1)]],2)],1)],1)],1),t._v(" "),n("b-col",{attrs:{cols:"12",md:"6"}},[n("b-card",[n("h3",{staticClass:"card-title text-center mb-0"},[t._v("TERLAMBAT SCAN MASUK")]),t._v(" "),n("b-table-simple",{attrs:{bordered:""}},[n("b-thead",[n("b-tr",[n("b-th",{staticClass:"text-center"},[t._v("NO")]),t._v(" "),n("b-th",{staticClass:"text-center"},[t._v("NAMA")]),t._v(" "),n("b-th",{staticClass:"text-center"},[t._v("Kelas/Unit")]),t._v(" "),n("b-th",{staticClass:"text-center"},[t._v("Waktu Scan Masuk")]),t._v(" "),n("b-th",{staticClass:"text-center"},[t._v("WAKTU TERLAMBAT (MENIT)")])],1)],1),t._v(" "),n("b-tbody",[t.siswa_lambat.length?t._l(t.siswa_lambat,(function(e,a){return n("b-tr",{key:e.peserta_didik_id,attrs:{variant:t.setVarian(a)}},[n("b-td",{staticClass:"text-center"},[t._v(t._s(a+1))]),t._v(" "),n("b-td",[t._v(t._s(e.peserta_didik.nama))]),t._v(" "),n("b-td",{staticClass:"text-center"},[t._v(t._s(e.peserta_didik.kelas?e.peserta_didik.kelas.nama:"-"))]),t._v(" "),n("b-td",{staticClass:"text-center"},[t._v(t._s(e.jam_masuk))]),t._v(" "),n("b-td",{staticClass:"text-center"},[t._v(t._s(e.absen_masuk.terlambat))])],1)})):[n("b-tr",[n("b-td",{staticClass:"text-center",attrs:{colspan:"5"}},[t._v("Tidak ada data untuk ditampilkan")])],1)]],2)],1)],1)],1)],1),t._v(" "),n("b-row",{staticClass:"match-height"},[n("b-col",{attrs:{cols:"12",md:"6"}},[n("b-card",[n("h3",{staticClass:"card-title text-center mb-0"},[t._v("TIDAK SCAN MASUK")])])],1),t._v(" "),n("b-col",{attrs:{cols:"12",md:"6"}},[n("b-card",[n("h3",{staticClass:"card-title text-center mb-0"},[t._v("SCAN PULANG CEPAT")]),t._v(" "),n("b-table-simple",{attrs:{bordered:""}},[n("b-thead",[n("b-tr",[n("b-th",{staticClass:"text-center"},[t._v("NO")]),t._v(" "),n("b-th",{staticClass:"text-center"},[t._v("NAMA")]),t._v(" "),n("b-th",{staticClass:"text-center"},[t._v("Kelas/Unit")]),t._v(" "),n("b-th",{staticClass:"text-center"},[t._v("Keterangan")])],1)],1),t._v(" "),n("b-tbody",[t.pulang_cepat.length?t._l(t.pulang_cepat,(function(e,a){return n("b-tr",{key:e.peserta_didik_id,attrs:{variant:t.setVarian(a)}},[n("b-td",{staticClass:"text-center"},[t._v(t._s(a+1))]),t._v(" "),n("b-td",[t._v(t._s(e.peserta_didik.nama))]),t._v(" "),n("b-td",{staticClass:"text-center"},[t._v(t._s(e.peserta_didik.kelas?e.peserta_didik.kelas.nama:"-"))]),t._v(" "),n("b-td",{staticClass:"text-center"},[t._v(t._s(e.absen_pulang.keterangan))])],1)})):[n("b-tr",[n("b-td",{staticClass:"text-center",attrs:{colspan:"4"}},[t._v("Tidak ada data untuk ditampilkan")])],1)]],2)],1)],1)],1)],1),t._v(" "),n("b-toast",{attrs:{variant:t.variant,title:t.title},model:{value:t.visible,callback:function(e){t.visible=e},expression:"visible"}},[t._v("\n    "+t._s(t.message)+"\n  ")])],1)}),[],!1,null,null,null);e.default=_.exports},Av9n:function(t,e,n){(e=n("JPst")(!1)).push([t.i,'* {\n  box-sizing: border-box;\n  font-family: consolas;\n}[dir] * {\n  margin: 0;\n  padding: 0;\n}\nbody {\n  justify-content: center;\n  min-height: 100vh;\n}\n[dir] body {\n  background: #111;\n}\n.scan {\n  align-items: center;\n  display: flex;\n}\n.scan {\n  flex-direction: column;\n  position: relative;\n}\n.scan .qrcode {\n  height: 400px;\n  position: relative;\n  width: 400px;\n}\n[dir] .scan .qrcode {\n  background: url(/img/scan/QR_Code01.png?dca1d8a3939dc88eb3cd6117ac0beeea);\n  background-size: 400px;\n}\n.scan .qrcode:before {\n  content: "";\n  height: 100%;\n  overflow: hidden;\n  position: absolute;\n  top: 0;\n  width: 100%;\n}\n[dir] .scan .qrcode:before {\n  background: url(/img/scan/QR_Code02.png?e6d7e7e17ef605c594045b125d891f0d);\n  background-size: 400px;\n}\n[dir=ltr] .scan .qrcode:before {\n  -webkit-animation: animate 4s ease-in-out infinite;\n  animation: animate 4s ease-in-out infinite;\n  left: 0;\n}\n[dir=rtl] .scan .qrcode:before {\n  -webkit-animation: animate 4s ease-in-out infinite;\n  animation: animate 4s ease-in-out infinite;\n  right: 0;\n}\n@-webkit-keyframes animate {\n0%, to {\n    height: 20px;\n}\n50% {\n    height: calc(100% - 20px);\n}\n}\n@keyframes animate {\n0%, to {\n    height: 20px;\n}\n50% {\n    height: calc(100% - 20px);\n}\n}\n.scan .qrcode:after {\n  content: "";\n  filter: drop-shadow(0 0 20px #35fd5c) drop-shadow(0 0 60px #35fd5c);\n  height: 2px;\n  inset: 20px;\n  position: absolute;\n  width: calc(100% - 40px);\n}\n[dir] .scan .qrcode:after {\n  background: #35fd5c;\n}\n[dir=ltr] .scan .qrcode:after {\n  -webkit-animation: animate_line 4s ease-in-out infinite;\n  animation: animate_line 4s ease-in-out infinite;\n}\n[dir=rtl] .scan .qrcode:after {\n  -webkit-animation: animate_line 4s ease-in-out infinite;\n  animation: animate_line 4s ease-in-out infinite;\n}\n@-webkit-keyframes animate_line {\n0%, to {\n    top: 20px;\n}\n50% {\n    top: calc(100% - 20px);\n}\n}\n@keyframes animate_line {\n0%, to {\n    top: 20px;\n}\n50% {\n    top: calc(100% - 20px);\n}\n}\n.border {\n  inset: 0;\n  position: absolute;\n}\n[dir] .border {\n  background: url(/img/scan/border.png?4cc6dfdd18c8c16bfba4dd88038aa533);\n  background-repeat: no-repeat;\n  background-size: 400px;\n}\n[dir=ltr] .border {\n  -webkit-animation: animate_text 0.5s linear infinite;\n  animation: animate_text 0.5s linear infinite;\n}\n[dir=rtl] .border {\n  -webkit-animation: animate_text 0.5s linear infinite;\n  animation: animate_text 0.5s linear infinite;\n}\n@-webkit-keyframes animate_text {\n0%, to {\n    opacity: 0;\n}\n50% {\n    opacity: 1;\n}\n}\n@keyframes animate_text {\n0%, to {\n    opacity: 0;\n}\n50% {\n    opacity: 1;\n}\n}\n.scan h3 {\n  color: #fff;\n  filter: drop-shadow(0 0 20px #fff) drop-shadow(0 0 60px #fff);\n  font-size: 2em;\n  letter-spacing: 2px;\n  text-transform: uppercase;\n}\n[dir] .scan h3 {\n  margin-top: 20px;\n}\n[dir=ltr] .scan h3 {\n  -webkit-animation: animate_text 0.5s steps(1) infinite;\n  animation: animate_text 0.5s steps(1) infinite;\n}\n[dir=rtl] .scan h3 {\n  -webkit-animation: animate_text 0.5s steps(1) infinite;\n  animation: animate_text 0.5s steps(1) infinite;\n}\n.toast-body {\n  font-size: 2rem;\n}',""]),t.exports=e},G7vj:function(t,e,n){"use strict";n.d(e,"a",(function(){return l}));var a=n("L3ns"),i=n("tC49"),r=n("xjcK"),c=n("pyNs"),s=n("z3V6");var o=Object(s.d)({fluid:Object(s.c)(c.j,!1),tag:Object(s.c)(c.u,"div")},r.v),l=Object(a.c)({name:r.v,functional:!0,props:o,render:function(t,e){var n,a,r,c=e.props,s=e.data,o=e.children,l=c.fluid;return t(c.tag,Object(i.a)(s,{class:(n={container:!(l||""===l),"container-fluid":!0===l||""===l},a="container-".concat(l),r=l&&!0!==l,a in n?Object.defineProperty(n,a,{value:r,enumerable:!0,configurable:!0,writable:!0}):n[a]=r,n)}),o)}})},Hrou:function(t,e,n){"use strict";n.d(e,"a",(function(){return O}));var a=n("L3ns"),i=n("xjcK"),r=n("2C+6"),c=n("z3V6"),s=n("STsD"),o=n("Md8H"),l=n("kO/s"),b=n("jBgq"),u=n("SPl0"),d=n("cSte");function p(t,e){var n=Object.keys(t);if(Object.getOwnPropertySymbols){var a=Object.getOwnPropertySymbols(t);e&&(a=a.filter((function(e){return Object.getOwnPropertyDescriptor(t,e).enumerable}))),n.push.apply(n,a)}return n}function f(t){for(var e=1;e<arguments.length;e++){var n=null!=arguments[e]?arguments[e]:{};e%2?p(Object(n),!0).forEach((function(e){m(t,e,n[e])})):Object.getOwnPropertyDescriptors?Object.defineProperties(t,Object.getOwnPropertyDescriptors(n)):p(Object(n)).forEach((function(e){Object.defineProperty(t,e,Object.getOwnPropertyDescriptor(n,e))}))}return t}function m(t,e,n){return e in t?Object.defineProperty(t,e,{value:n,enumerable:!0,configurable:!0,writable:!0}):t[e]=n,t}var _=Object(c.d)(Object(r.m)(f(f(f({},l.b),u.a),d.a)),i.xb),O=Object(a.c)({name:i.xb,mixins:[s.a,o.a,l.a,b.a,d.b,u.b],props:_,computed:{isTableSimple:function(){return!0}}})},LbEq:function(t,e,n){"use strict";n("Utj8")},SRip:function(t,e,n){"use strict";n.d(e,"b",(function(){return m})),n.d(e,"a",(function(){return _}));var a=n("L3ns"),i=n("tC49"),r=n("xjcK"),c=n("pyNs"),s=n("Iyau"),o=n("bAY6"),l=n("ex6f"),b=n("OljW"),u=n("z3V6"),d=n("+nMp");function p(t,e,n){return e in t?Object.defineProperty(t,e,{value:n,enumerable:!0,configurable:!0,writable:!0}):t[e]=n,t}var f='<svg width="%{w}" height="%{h}" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 %{w} %{h}" preserveAspectRatio="none"><rect width="100%" height="100%" style="fill:%{f};"></rect></svg>',m=Object(u.d)({alt:Object(u.c)(c.u),blank:Object(u.c)(c.g,!1),blankColor:Object(u.c)(c.u,"transparent"),block:Object(u.c)(c.g,!1),center:Object(u.c)(c.g,!1),fluid:Object(u.c)(c.g,!1),fluidGrow:Object(u.c)(c.g,!1),height:Object(u.c)(c.p),left:Object(u.c)(c.g,!1),right:Object(u.c)(c.g,!1),rounded:Object(u.c)(c.j,!1),sizes:Object(u.c)(c.f),src:Object(u.c)(c.u),srcset:Object(u.c)(c.f),thumbnail:Object(u.c)(c.g,!1),width:Object(u.c)(c.p)},r.X),_=Object(a.c)({name:r.X,functional:!0,props:m,render:function(t,e){var n,a=e.props,r=e.data,c=a.alt,u=a.src,m=a.block,_=a.fluidGrow,O=a.rounded,j=Object(b.b)(a.width)||null,v=Object(b.b)(a.height)||null,g=null,h=Object(s.b)(a.srcset).filter(o.a).join(","),w=Object(s.b)(a.sizes).filter(o.a).join(",");return a.blank&&(!v&&j?v=j:!j&&v&&(j=v),j||v||(j=1,v=1),u=function(t,e,n){var a=encodeURIComponent(f.replace("%{w}",Object(d.g)(t)).replace("%{h}",Object(d.g)(e)).replace("%{f}",n));return"data:image/svg+xml;charset=UTF-8,".concat(a)}(j,v,a.blankColor||"transparent"),h=null,w=null),a.left?g="float-left":a.right?g="float-right":a.center&&(g="mx-auto",m=!0),t("img",Object(i.a)(r,{attrs:{src:u,alt:c,width:j?Object(d.g)(j):null,height:v?Object(d.g)(v):null,srcset:h||null,sizes:w||null},class:(n={"img-thumbnail":a.thumbnail,"img-fluid":a.fluid||_,"w-100":_,rounded:""===O||!0===O},p(n,"rounded-".concat(O),Object(l.n)(O)&&""!==O),p(n,g,g),p(n,"d-block",m),n)}))}})},Utj8:function(t,e,n){var a=n("Av9n");"string"==typeof a&&(a=[[t.i,a,""]]);var i={hmr:!0,transform:void 0,insertInto:void 0};n("aET+")(a,i);a.locals&&(t.exports=a.locals)},"oVt+":function(t,e,n){"use strict";n.d(e,"a",(function(){return g}));var a=n("tC49"),i=n("xjcK"),r=n("pyNs"),c=n("Iyau"),s=n("Io6r"),o=n("bAY6"),l=n("tQiw"),b=n("2C+6"),u=n("z3V6"),d=n("+nMp");function p(t,e){var n=Object.keys(t);if(Object.getOwnPropertySymbols){var a=Object.getOwnPropertySymbols(t);e&&(a=a.filter((function(e){return Object.getOwnPropertyDescriptor(t,e).enumerable}))),n.push.apply(n,a)}return n}function f(t){for(var e=1;e<arguments.length;e++){var n=null!=arguments[e]?arguments[e]:{};e%2?p(Object(n),!0).forEach((function(e){m(t,e,n[e])})):Object.getOwnPropertyDescriptors?Object.defineProperties(t,Object.getOwnPropertyDescriptors(n)):p(Object(n)).forEach((function(e){Object.defineProperty(t,e,Object.getOwnPropertyDescriptor(n,e))}))}return t}function m(t,e,n){return e in t?Object.defineProperty(t,e,{value:n,enumerable:!0,configurable:!0,writable:!0}):t[e]=n,t}var _=["start","end","center"],O=Object(l.a)((function(t,e){return(e=Object(d.h)(Object(d.g)(e)))?Object(d.c)(["row-cols",t,e].filter(o.a).join("-")):null})),j=Object(l.a)((function(t){return Object(d.c)(t.replace("cols",""))})),v=[],g={name:i.rb,functional:!0,get props(){var t;return delete this.props,this.props=(t=Object(s.b)().reduce((function(t,e){return t[Object(u.g)(e,"cols")]=Object(u.c)(r.p),t}),Object(b.c)(null)),v=Object(b.h)(t),Object(u.d)(Object(b.m)(f(f({},t),{},{alignContent:Object(u.c)(r.u,null,(function(t){return Object(c.a)(Object(c.b)(_,"between","around","stretch"),t)})),alignH:Object(u.c)(r.u,null,(function(t){return Object(c.a)(Object(c.b)(_,"between","around"),t)})),alignV:Object(u.c)(r.u,null,(function(t){return Object(c.a)(Object(c.b)(_,"baseline","stretch"),t)})),noGutters:Object(u.c)(r.g,!1),tag:Object(u.c)(r.u,"div")})),i.rb)),this.props},render:function(t,e){var n,i=e.props,r=e.data,c=e.children,s=i.alignV,o=i.alignH,l=i.alignContent,b=[];return v.forEach((function(t){var e=O(j(t),i[t]);e&&b.push(e)})),b.push((m(n={"no-gutters":i.noGutters},"align-items-".concat(s),s),m(n,"justify-content-".concat(o),o),m(n,"align-content-".concat(l),l),n)),t(i.tag,Object(a.a)(r,{staticClass:"row",class:b}),c)}}},sove:function(t,e,n){"use strict";n.d(e,"a",(function(){return h}));var a=n("tC49"),i=n("xjcK"),r=n("pyNs"),c=n("mS7b"),s=n("Iyau"),o=n("Io6r"),l=n("bAY6"),b=n("ex6f"),u=n("tQiw"),d=n("2C+6"),p=n("z3V6"),f=n("+nMp");function m(t,e){var n=Object.keys(t);if(Object.getOwnPropertySymbols){var a=Object.getOwnPropertySymbols(t);e&&(a=a.filter((function(e){return Object.getOwnPropertyDescriptor(t,e).enumerable}))),n.push.apply(n,a)}return n}function _(t){for(var e=1;e<arguments.length;e++){var n=null!=arguments[e]?arguments[e]:{};e%2?m(Object(n),!0).forEach((function(e){O(t,e,n[e])})):Object.getOwnPropertyDescriptors?Object.defineProperties(t,Object.getOwnPropertyDescriptors(n)):m(Object(n)).forEach((function(e){Object.defineProperty(t,e,Object.getOwnPropertyDescriptor(n,e))}))}return t}function O(t,e,n){return e in t?Object.defineProperty(t,e,{value:n,enumerable:!0,configurable:!0,writable:!0}):t[e]=n,t}var j=["auto","start","end","center","baseline","stretch"],v=Object(u.a)((function(t,e,n){var a=t;if(!Object(b.p)(n)&&!1!==n)return e&&(a+="-".concat(e)),"col"!==t||""!==n&&!0!==n?(a+="-".concat(n),Object(f.c)(a)):Object(f.c)(a)})),g=Object(d.c)(null),h={name:i.s,functional:!0,get props(){return delete this.props,this.props=(t=Object(o.b)().filter(l.a),e=t.reduce((function(t,e){return t[e]=Object(p.c)(r.i),t}),Object(d.c)(null)),n=t.reduce((function(t,e){return t[Object(p.g)(e,"offset")]=Object(p.c)(r.p),t}),Object(d.c)(null)),a=t.reduce((function(t,e){return t[Object(p.g)(e,"order")]=Object(p.c)(r.p),t}),Object(d.c)(null)),g=Object(d.a)(Object(d.c)(null),{col:Object(d.h)(e),offset:Object(d.h)(n),order:Object(d.h)(a)}),Object(p.d)(Object(d.m)(_(_(_(_({},e),n),a),{},{alignSelf:Object(p.c)(r.u,null,(function(t){return Object(s.a)(j,t)})),col:Object(p.c)(r.g,!1),cols:Object(p.c)(r.p),offset:Object(p.c)(r.p),order:Object(p.c)(r.p),tag:Object(p.c)(r.u,"div")})),i.s));var t,e,n,a},render:function(t,e){var n,i=e.props,r=e.data,s=e.children,o=i.cols,l=i.offset,b=i.order,u=i.alignSelf,d=[];for(var p in g)for(var f=g[p],m=0;m<f.length;m++){var _=v(p,f[m].replace(p,""),i[f[m]]);_&&d.push(_)}var j=d.some((function(t){return c.c.test(t)}));return d.push((O(n={col:i.col||!j&&!o},"col-".concat(o),o),O(n,"offset-".concat(l),l),O(n,"order-".concat(b),b),O(n,"align-self-".concat(u),u),n)),t(i.tag,Object(a.a)(r,{class:d}),s)}}}}]);