</section>

<footer class="footer">

    <div class="footer-inner">

        <div class="copyright pull-left">

         <a href="http://www.soyep.net/" title="然亦部落">SOYEP</a> 版权所有，保留一切权利 · <a href="http://www.soyep.net/sitemap.html" title="站点地图">站点地图</a>   ·   基于WordPress构建   © 2014-2015  ·  <a rel="nofollow" target="_blank" href="http://www.soyep.net/about">赞助我们</a>

        </div>

        <div class="trackcode pull-right">

            <?php if( dopt('d_track_b') ) echo dopt('d_track'); ?>

        </div>

    </div>

</footer>



<?php 

wp_footer(); 

global $dHasShare; 

if($dHasShare == true){ 

	echo'<script>with(document)0[(getElementsByTagName("head")[0]||body).appendChild(createElement("script")).src="http://bdimg.share.baidu.com/static/api/js/share.js?v=89860593.js?cdnversion="+~(-new Date()/36e5)];</script>';

}  

if( dopt('d_footcode_b') ) echo dopt('d_footcode'); 

?>

</body>

</html>