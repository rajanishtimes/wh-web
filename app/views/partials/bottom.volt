		<script type="text/javascript" src="https://code.jquery.com/jquery-1.11.0.min.js"></script>
		<script type="text/javascript" src="{{baseUrl}}/js/bootstrap.min.js"></script>
		<script type="text/javascript" src="{{baseUrl}}/js/typeahead.min.js"></script>
		<script type="text/javascript" src="{{baseUrl}}/plugins/owl-carousel/owl.carousel.min.js"></script>
		<script type="text/javascript" src="{{baseUrl}}/plugins/swipebox/src/js/jquery.swipebox.js"></script>
		<script type="text/javascript" src="{{baseUrl}}/js/utils.js"></script>
		<script type="text/javascript" src="{{baseUrl}}/js/apps.js{{time}}"></script>
		
		<script type="text/javascript">
                      
            /* (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
            (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
            m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
            })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

            ga('create', 'UA-62145553-1', {'cookieDomain': 'none'});
            ga('send', 'pageview');
            
            
            
            window.ga_debug = {trace: true};
            
            
            $(document).ready(function(){
                
                $('a').on('click', function(){
                    var action = $(this).attr('data-ga-action') || $(this).attr('href');
                    var label = $(this).attr('data-ga-label') || $(this).text();
                    var category = $(this).attr('data-ga-cat') || 'linkClicks';
                    ga('send', 'event', category, action, label, 1);
                });
            }); */
            
			$('#citieslist li').click(function(){
				SetCookie('city', '{{city}}', 15);
				//document.cookie = "city={{city}};expires=" + myDate + ";domain={{host}};path=/";
				var href = $(this).find('a').attr('href');
				window.location.href = href;
				return false;
			});
			
			function SetCookie(cookieName,cookieValue,nDays) {
				var today = new Date();
				var expire = new Date();
				if (nDays==null || nDays==0) nDays=1;
				expire.setTime(today.getTime() + 3600000*24*nDays);
				document.cookie = cookieName+"="+escape(cookieValue)+ ";expires="+expire.toGMTString();
			}
        </script>
    </body>
</html>