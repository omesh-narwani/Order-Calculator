
jQuery(window).load(function(){
    jQuery('#numberofpages01').on('change', function() {
		var base_url = window.location.href;
        var pages = jQuery(this).val();
        var service1 = jQuery('#product-services1').val();
        var pid = jQuery('#product-services1').find(':selected').attr('data-proid');
        //var serviceid = jQuery(this).find(':selected').attr('data-proid');
        var totalprice = service1 * pages;
        jQuery( "#price1" ).html(totalprice );
        var url = base_url+"/demo/procontentclub/checkout/?add-to-cart="+pid+"&quantity="+pages;
        var a = document.getElementById('carturl'); //or grab it by tagname etc
        a.href = url;
       
    });
});
