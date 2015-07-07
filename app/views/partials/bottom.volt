		<script type="text/javascript" src="https://code.jquery.com/jquery-1.11.0.min.js"></script>
		<script type="text/javascript" src="{{baseUrl}}/js/bootstrap.min.js"></script>
		<script type="text/javascript" src="{{baseUrl}}/js/typeahead.min.js"></script>
		<script type="text/javascript" src="{{baseUrl}}/plugins/owl-carousel/owl.carousel.min.js"></script>
		<script type="text/javascript" src="{{baseUrl}}/plugins/swipebox/src/js/jquery.swipebox.min.js"></script>
		<!--<script type="text/javascript" src="{{baseUrl}}/js/jquery.lazyload.js"></script>-->
        <script type="text/javascript" src="{{baseUrl}}/js/jquery.unveil.js"></script>
        <script type="text/javascript" src="{{baseUrl}}/js/cookies.js?v=1.0"></script>
        <script type="text/javascript" src="{{baseUrl}}/js/jQuery_mousewheel_plugin.js"></script>
		<script type="text/javascript" src="{{baseUrl}}{{elements.auto_version('/js/apps.js')}}"></script>
        <!-- Place this tag in your head or just before your close body tag. -->
        <script src="https://apis.google.com/js/platform.js" async defer></script>
		
        <?php if($isappclose == 0){ ?>
        <script>
            
                setheader();
            

            
                /*if( /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ) {
                    
                    {% if(isdeep_link == true) %}
                        document.getElementById('loader').src = '{{deep_link}}';
                        //window.location = '{{deep_link}}';
                    {% endif %}

                    fallbackLink = isAndroid ? 'https://play.google.com/store/apps/details?id=com.phdmobi.timescity' :
                                             'https://itunes.apple.com/in/app/timescity-food-restaurant/id636515332?mt=8' ;
                    window.setTimeout(function (){
                            //window.location.replace(fallbackLink);
                            setheader();
                    }, 1);
                }*/
        </script>
        <?php } ?>


        <script pagespeed_orig_type="text/javascript" type="text/psajs" orig_index="16">var tca=function(e,t,n){function r(e){var t="";if(e){t+="&x="+e.x;t+="&y="+e.y;t+="&w="+e.w;t+="&h="+e.h;t+="&l="+e.l;t+="&d="+e.d;t+="&t="+e.t;t+="&p="+e.p;t+="&lag="+e.lag;t+="&r="+encodeURI(e.r);t+="&text="+e.text;t+="&rand="+Math.random()*1e12}return t}function u(e){var t=document.evaluate(e,document,null,XPathResult.ANY_TYPE,null);var n=[];var r;while(r=t.iterateNext()){n.push(r)}var i="";switch($(n).prop("tagName")){case"INPUT":i=$(n).attr("value");break;default:i=$(n).text()}return i}function a(e){var t=document.evaluate(e,document,null,XPathResult.ANY_TYPE,null);var n=[];var r;while(r=t.iterateNext()){n.push(r)}return n.length}var i=function(r,i){if(d(r)){return false}c=r.timeStamp;var s=l();x=0;var o=i.text();o=o.replace(/\s{2,}/g," ");if(o.length>50){o=o.substring(0,50)}var a=getElementTreeXPath(r.srcElement);var f=getUniqueXPath(a);console.log("Final Xpath = "+f);var h={x:r.pageX||0,y:r.pageY||0,w:n(e).width(),h:n(e).height(),l:n(t).height(),d:e.location.href,t:s,p:encodeURIComponent(f),lag:s-p,r:"",text:encodeURIComponent(u(f))};v(h);m(h)};var s=0;var o=function(e){var t=e;var n=0;if(t.previousSibling){n=1;var r=t.previousSibling;do{if(r.nodeType==1&&r.nodeName==t.nodeName){n++}r=r.previousSibling}while(r);if(n==1){n=null}}else if(t.nextSibling){var r=t.nextSibling;do{if(r.nodeType==1&&r.nodeName==t.nodeName){n=1;r=null}else{var n=null;r=r.previousSibling}}while(r)}if(n){return"("+n+")"}else{return""}};createXpath=function(e){var t="";var n="";t+=e.tagName;if(e.id!=""||e.name!=""||e.clazz!=""){t+="[";var r=false;if(e.id!=""){t+="@id='"+e.id+"'";r=true}if(e.name!=""){if(r){t+=" and "}t+="@name='"+e.name+"'";r=true}if(e.clazz!=""){if(r){t+=" and "}t+="@class='"+e.clazz+"'";r=true}t+="]"}var i=t;var s=a("//"+t);s=a("(//"+i+")");if(r&&s>1){for(var o=1;o<=s;o++){var u=document.evaluate("(//"+i+")["+o+"]",document,null,XPathResult.FIRST_ORDERED_NODE_TYPE,null).singleNodeValue;if(u==e.self&&a("(//"+i+")["+o+"]")==1){t="(//"+i+")["+o+"]";break}}}return t};getUniqueXPath=function(e){var t="";var n=false;for(var r=0;r<e.length;r++){var i=e[r];var s=createXpath(i);if(t==""){t=s}else{t=s+"/"+t}var o=(t&&t.indexOf("(")==0?"":"//")+t;if(a(o)==1){return o}else{if(r<e.length){var u=e[r+1];var f=document.evaluate("//"+u.tagName+"//"+t,document,null,0,null);var l;var c=0;while(l=f.iterateNext()){if(l.parentNode==u.self){if(l.tagName.toUpperCase()==i.self.tagName.toUpperCase()){c++}if(l==i.self){break}}}t=t+"["+c+"]"}}n=true}};getElementTreeXPath=function(e){var t=[];var n=[];for(;e&&e.nodeType==1;e=e.parentNode){var r=0;for(var i=e.previousSibling;i;i=i.previousSibling){if(i.nodeType==Node.DOCUMENT_TYPE_NODE)continue;if(i.nodeName==e.nodeName)++r}var s={tagName:e.nodeName.toLowerCase(),pathIndex:r?r+1:"",clazz:e.getAttribute("class")?e.getAttribute("class"):"",name:e.getAttribute("name")?e.getAttribute("name"):"",id:e.getAttribute("id")?e.getAttribute("id"):"",self:e};t.push(s)}return t};var f=function(e){s++;if(s>1e3){return""}if(e&&typeof e.className!=="undefined"){var t=e.className;var n=t.replace(/ /g,"|");var r=e.parentNode;var i=e.id;n=n+o(e);if(typeof i!=="undefined"&&i&&i.length){n+="["+i+"]"}var u=e.tagName;n=u+":"+n;if(r){if(n.length){return f(r)+">"+n.trim()}else{return f(r)}}return n.trim()}return""};var l=function(){var e=new Date;return e.getTime()/1e3};var c=0;var h=new Date;var p=h.getTime()/1e3;var d=function(e){if(c===e.timeStamp){return true}return false};var v=function(e){if(console){}};var m=function(e){var t=new Image;t.src="http://local.whatshot.in/t/b.gif?_=1.0"+r(e);console.log("url => "+t.src)};var g=n("div, a, span, button, img, li, textarea, input");g.on("click",function(e){try{i(e,n(this))}catch(e){}});var y={x:0,y:0,w:n(e).width(),h:n(e).height(),l:n(t).height(),d:e.location.href,t:l(),p:"",lag:0,r:t.referrer||"",text:t.title};m(y);return this}(window,document,$);</script>

        <script pagespeed_no_defer="true" type="text/javascript">var tcp=function(){setTimeout(function(){window.performance=window.performance||window.mozPerformance||window.msPerformance||window.webkitPerformance||{};var e=performance.timing||{},t=Math.random()*1e16,n="i="+t,r=new Image;if(e){n+="&pd="+(e.domainLookupEnd-e.domainLookupStart);n+="&pc="+(e.connectEnd-e.connectStart);n+="&pt="+(e.responseStart-e.connectEnd);n+="&pb="+(e.responseEnd-e.responseStart);n+="&pf="+(e.loadEventStart-e.responseEnd)}if(document.referrer!==""){n+="&r="+document.referrer}n+="&u="+window.location.href;n+="&m=0";r.src="http://local.whatshot.in/t/b.gif?"+n},0)};if(window.addEventListener){window.addEventListener("load",tcp,false)}else if(window.attachEvent){window.attachEvent("onload",tcp)}else{document.addEventListener("load",tcp,false)}</script>


        {% if(baseUrl == 'http://www.whatshot.in') %}
    		<script type="text/javascript" defer>
                (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
                (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
                m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
                })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

                ga('create', 'UA-116455-36', {'cookieDomain': 'none'});
                ga('send', 'pageview');
                
                window.ga_debug = {trace: true};
                
                $(document).ready(function(){
                    $('a').on('click', function(){
                        var action = $(this).attr('data-ga-action') || $(this).attr('href');
                        var label = $(this).attr('data-ga-label') || $(this).text();
                        var category = $(this).attr('data-ga-cat') || 'linkClicks';
                        ga('send', 'event', category, action, label, 1);
                    });
                });
            </script>
        {% endif %}
        


    </body>
</html>