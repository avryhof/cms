	<!-- Quantcast Tag -->
	<script type="text/javascript">
    var _qevents = _qevents || [];
    
    (function() {
    var elem = document.createElement('script');
    elem.src = (document.location.protocol == "https:" ? "https://secure" : "http://edge") + ".quantserve.com/quant.js";
    elem.async = true;
    elem.type = "text/javascript";
    var scpt = document.getElementsByTagName('script')[0];
    scpt.parentNode.insertBefore(elem, scpt);
    })();
    
    _qevents.push({
    qacct:"p-pppL4QA9sRAQ_"
    });
    </script>
    
    <noscript>
    <div style="display:none;">
    <img src="//pixel.quantserve.com/pixel/p-pppL4QA9sRAQ_.gif" border="0" height="1" width="1" alt="Quantcast"/>
    </div>
    </noscript>
    <!-- End Quantcast tag -->

	<? if ($metadata['google']['ua'] !== 'UA-XXXXX-X') { ?>
    <!-- Google Analytics: change UA-XXXXX-X to be your site's ID. -->
    <script>
	  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
	  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
	  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
	  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
	
	  ga('create', '<?= $metadata['google']['ua']; ?>', 'auto');
	  ga('send', 'pageview');
	
	</script>
    <? } ?>