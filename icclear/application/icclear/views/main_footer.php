<div class="row">
    <div class="space-top15">
    <div class="col-sm-7 footer-text">
        <p>IT Ninjas &copy; Copyright 2014-2015</p>
    </div>
    
    <div class="col-sm-5 footer-text space-bottom15">
        <p class="pull-right">
            <?php echo anchor('faq', 'F.A.Q.', 'class=""'); ?>
            |
            <?php echo anchor('contact', 'CONTACT', 'class=""'); ?>
            |
            <a href="https://www.facebook.com/pages/IC-Clear/129517440453849" target="_blank" ><i title="Twitter" data-placement="top" class="fa fa-twitter"></i></a> 
            <a href="https://twitter.com/icclear" target="_blank"><i title="Facebook" data-placement="top" class="fa fa-facebook"></i></a>
        </p>
    </div>
    
    <div class="italic col-sm-12 space-top15">        
        <p><span class="bold">PHP Project - IT Ninjas - Groep 23:</span> Frederik Van Hooghten, Rob Oosthoek, Leslie Milants & Abderrahmane Ikrou</p>
        <p><span class="bold">Opdrachtgever:</span> Karine Nickolay</p>
    </div>
    </div>
</div>


<div class="row hidden">    
    
    <div class="col-sm-4">
        <h4 class="red">Help</h4>
        <p><?php echo anchor('faq', 'F.A.Q.'); ?></p>
        <p>User Guide</p>
    </div>
    
    <div class="col-sm-4">     
        <h4 class="red">Social Media</h4>
        <div class="footer-icon">
            <span class="fa fa-twitter"></span>Twitter
        </div>
        <div class="footer-icon">
            <span class="fa fa-facebook-square"></span>Facebook
        </div>
    </div>
    
    <div class="col-sm-4">
        <h4 class="red">Contact</h4>
        <div class="footer-icon">
        <span class="glyphicon glyphicon-home"></span> 
            Thomas More Kempen<br/>
            Kleinhoefstraat 4<br/>
            2440 Geel, Belgium
        </div>
        <div class="footer-icon">
            <span class="glyphicon glyphicon-envelope"></span> 
            E-mail: <a href="mailto:support@icclear.test">support@ICClear.be</a>
        </div>
        <div class="footer-icon">            
            <span class="glyphicon glyphicon-phone-alt"></span>
            tel: 017 55 94 781
        </div>
    </div>
</div>

<br/><br/>

<div class="row hidden">
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