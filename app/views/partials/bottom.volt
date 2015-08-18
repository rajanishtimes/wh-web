		<script type="text/javascript" src="https://code.jquery.com/jquery-1.11.0.min.js"></script>

        <?php if($this->config->application->environment == 'local'){?>
            {{ assets.outputJs('js') }}
            {{ assets.outputJs('appsjs') }}
        <?php } ?>
        		
        <script type="text/javascript" src="{{baseUrl}}/js/main.js"></script>
        <script type="text/javascript" src="{{baseUrl}}{{elements.auto_version('/js/app.js')}}"></script>
        <script src="http://tags.crwdcntrl.net/c/6939/cc_af.js"></script>
        
        <!-- Place this tag in your head or just before your close body tag. -->
        <script src="https://apis.google.com/js/platform.js" async defer></script>
		
        <?php if($isappclose == 0){ ?>
        <script>
            
                //setheader();
            

            
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
        <script type="text/javascript">
            var wizrocket = {event:[], profile:[], account:[], enum:function(e){return '$E_' + e}};
            wizrocket.account.push({"id": "4W7-84R-6K4Z"});
            (function () {
                var wzrk = document.createElement('script');
                wzrk.type = 'text/javascript';
                wzrk.async = true;
                wzrk.src = ('https:' == document.location.protocol ? 'https://d2r1yp2w7bby2u.cloudfront.net' : 'http://static.wizrocket.com') + '/js/a.js';
                var s = document.getElementsByTagName('script')[0];
                s.parentNode.insertBefore(wzrk, s);
            })();
        </script>


    </body>
</html>