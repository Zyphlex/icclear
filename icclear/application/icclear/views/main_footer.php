<div class="row">    
    <div class="col-sm-4">        
    </div>
    
    <div class="col-sm-4">
        <h4 class="red">HELP</h4>
        <p><?php echo anchor('faq', 'F.A.Q.'); ?></p>
        <p>User Guide</p>
    </div>
    
    <div class="col-sm-4">
        <h4 class="red">CONTACT</h4>
        <div class="footer-icon">
            Thomas More Kempen<br/>
            Kleinhoefstraat 4<br/>
            Geel, 2440 Belgium
        </div>
        <span class="glyphicon glyphicon-envelope"></span> 
        <div class="footer-icon">
            E-mail: <a href="mailto:support@icclear.test">support@ICClear.be</a></div>
        <p><span class="glyphicon glyphicon-phone-alt"></span> tel: 017 55 94 781</p>
    </div>
</div>

<br/><br/>

<div class="row">
    <div class="col-sm-10 col-md-offset-2">       
        <p>PHP Project - IT Ninjas - Groep 23: Frederik Van Hooghten, Rob Oosthoek, Leslie Milants & Abderrahmane Ikrou - Opdrachtgever: Karine Nickolay</p>        
    </div>
</div>

<script type="text/javascript">
    //TOOLTIPS
    $(function () {
        $('[data-toggle="popover"]').popover();
        $('body').tooltip({
            selector: '*',
            html: true
        });

    });
    
    //EQUALIZER
    $( document ).ready(function() {
        var heights = $(".equalizer").map(function() {
            return $(this).height();
        }).get(),
        maxHeight = Math.max.apply(null, heights);
        $(".equalizer").height(maxHeight);
                
    });
</script>