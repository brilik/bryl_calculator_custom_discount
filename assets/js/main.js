
$(document).ready(function(){

    let pluginURL = window.location.origin+'/wp-content/plugins/bryl-calculator-firstvoip-custom/assets/data/';
    // console.log("URL Plagin",pluginURL+"get-data.php");





    $("#calc-select").on('change',function(){

        let allSelect = $(this).val();
        let allDiscount = $(this).find('option:selected').data('discount');
        let price = $('#calc-form').find('#calc-price').text();
        let dataString = "select=" + allSelect +"&discount=" + allDiscount;

        // console.log("allSelect", allSelect);
        // console.log("allDiscount", allDiscount);

        $.ajax({
            type: "POST",
            url: pluginURL+"get-data.php",
            data: dataString,
            success: function(select){
                console.log("Choosed count phones: ",select);
                $("#calc-form #discount").text(allDiscount);
                price = parseFloat(price);
                let res = price+(price-(allDiscount*price));
                $("#calc-form #calc-res").text(res);
                $("#calc-form input[name='res']").val(res);
                $("#calc-form input[name='price']").val(price);
                $("#calc-form input[name='discount']").val(allDiscount);
            }
        });

    });


    $("#calc-form").submit(function(e) {

        let msg = $('#calc-form').find('.message');

        e.preventDefault();
        let form_data = $(this).serialize();
        $.ajax({
            type: 'POST',
            url: pluginURL+'send.php',
            dataType: "html",
            data: form_data ,
            success: function(form_data){
                msg.text(form_data).show('slow');
                setTimeout(function() {
                    msg.hide('fast');
                }, 3000);
            }
        });
    });
});
