		<script type="text/javascript" src="https://code.jquery.com/jquery-1.11.0.min.js"></script>
		<script type="text/javascript" src="{{baseUrl}}/js/bootstrap.min.js"></script>
		<script type="text/javascript" src="{{baseUrl}}/js/typeahead.min.js"></script>
		<script type="text/javascript" src="{{baseUrl}}/plugins/owl-carousel/owl.carousel.min.js"></script>
		<script type="text/javascript" src="{{baseUrl}}/plugins/swipebox/src/js/jquery.swipebox.min.js"></script>
		<script type="text/javascript" src="{{baseUrl}}/js/jquery.lazyload.js"></script>
        <script type="text/javascript" src="{{baseUrl}}/js/cookies.js?v=1.0"></script>
		<script type="text/javascript" src="{{baseUrl}}/js/apps.js{{time}}"></script>
		
        <?php if($isappclose == 0){ ?>
        <script>
            alert('asdf');
            {% if(isdeep_link == true) %}
                alert('inside');
                setheader();
            {% endif %}

            
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

		<script type="text/javascript" defer>
                      
       /*      (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
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
        */     
			
			
        </script>

        


    </body>
</html>