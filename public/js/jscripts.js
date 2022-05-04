

var site_urls = $('#url').val();
var page_name = $('#page_name').val();
var token = $('#txt_token').val();
var token1 = $('#txt_token1').val();
//var lastPage = $('#url_cookies').val();
var interval;
var isValidated = true;

var routeName = $('#routeName').val();
var closeTimes = '<i class="fa fa-times"></i>';
//alert(page_name)


if(page_name == "deposit"){
  var userWallAdd = retrieve_cookie('userWallAdd');
  $('.userWallAdd').val(userWallAdd);
}


var planType = retrieve_cookie('planType');
var percentage = retrieve_cookie('percentage');
var invest = "investment-plans";

$('.chosenPlan').val('starter');
$('.chosenPlan').html(`Starter (200%) <a href='${invest}' class='change_plan'>Change Plan</a>`);
if(planType != ""){
  $('.chosenPlan').html(`${planType} (${percentage}%) <a href="${invest}" class="change_plan">Change Plan</a>`);
  $('.chosenPlan').val(planType);
}

$(document).ready(function(){
  $('.live_rates').html("<p style='font-size:15px;color:#ccc;margin:0;padding-top:14px'>Loading live trades... Loading live trades... Loading live trades...</p>");
  
  if(page_name == "dashboard" || page_name == "wallet" || page_name == "kyc" || page_name == "investment_plans" || page_name == "deposit" || page_name == "transactions"){
    //var interval2 = setInterval(function() {
      var dataString='from_Currency=USD'
      +'&_token='+token1;
      $.ajax({
        type : "POST",
        url : "/live_rates",
        data : dataString,
        cache : false,
        success : function(data){
          //alert(data);
          $('.live_rates').html(data);
        },error : function(data){
          $('.live_rates').html("<p style='font-size:15px;color:#ccc;margin:0;padding-top:14px'>Poor network connection to view live trades. Please check your network.</p>");
        }
      });
    //}, 3000);
  }

  var datastring1='coinTypeFrom=USD'
  +'&coinTypeTo=BTC'
  +'&amts=1'
  +'&_token='+token;

  var datastring2='coinTypeFrom=USD'
  +'&coinTypeTo=LTC'
  +'&amts=1'
  +'&_token='+token;

  var datastring3='coinTypeFrom=USD'
  +'&coinTypeTo=ETH'
  +'&amts=1'
  +'&_token='+token;

  var datastring4='coinTypeFrom=USD'
  +'&coinTypeTo=USDT'
  +'&amts=1'
  +'&_token='+token;

  //alert(routeName)

  //if(routeName != "signup" && routeName != "signin" && routeName != "dashboard"){
  if(routeName == "index" || routeName == "indexs"){
    $(".btc_usd, .ngn_usd, .eth_usd, .usdt_usd").html("<span style='font-weight:400;font-size:14px;color:#999!important'>Loading...</span>");

    $.ajax({
      type: "POST",
      url:"btc_usd",
      data: datastring1,
      success:function(data){
        $(".btc_usd").html(data);
      }
    });

    $.ajax({
      type: "POST",
      url:"ngn_usd",
      data: datastring2,
      success:function(data){
        //data = parseInt(data).toLocaleString();
        $(".ngn_usd").html(data);
      }
    });

    $.ajax({
      type: "POST",
      url:"eth_usd",
      data: datastring3,
      success:function(data){
        $(".eth_usd").html(data);
      }
    });

    $.ajax({
      type: "POST",
      url:"usdt_usd",
      data: datastring4,
      success:function(data){
        $(".usdt_usd").html(data);
      }
    });
  }

  //alert(routeName)

  if(routeName == "dashboard" || routeName == "wallet"){
    var datastring11='coinTypeFrom=USD'
    +'&coinTypeTo=BTC'
    +'&amts='+$(".txtusd_btc").val()
    +'&_token='+token1;

    var datastring22='coinTypeFrom=USD'
    +'&coinTypeTo=ETH'
    +'&amts='+$(".txtusd_eth").val()
    +'&_token='+token1;

    var datastring33='coinTypeFrom=USD'
    +'&coinTypeTo=USDT'
    +'&amts='+$(".txtusd_usdt").val()
    +'&_token='+token1;
    
    $(".btc_usd, .usdt_usd, .eth_usd").html("<span style='font-weight:400;font-size:14px;color:#ddd'>Loading...</span>");

    $(".btc_usd1, .eth_usd1, .usdt_usd1").val(0);

    //alert(datastring11)

    $.ajax({
      type: "POST",
      url: "/btc_usd",
      data: datastring11,
      success:function(data){
        $(".btc_usd").html(data);
        if(parseFloat(data) <= 0) data = 0;

        if(data > 0) data = data.replace(/,/g, "");
        $(".btc_usd1").val(data);
      }
    });

    $.ajax({
      type: "POST",
      url:"/eth_usd",
      data: datastring22,
      success:function(data){
        $(".eth_usd").html(data);
        if(parseFloat(data) <= 0) data = 0;

        if(data > 0) data = data.replace(/,/g, "");
        $(".eth_usd1").val(data);
      }
    });

    $.ajax({
      type: "POST",
      url:"/usdt_usd",
      data: datastring33,
      success:function(data){
        $(".usdt_usd").html(data);
        if(parseFloat(data) <= 0) data = 0;

        if(data > 0) data = data.replace(/,/g, "");
        $(".usdt_usd1").val(data);
        
      }
    });
  }



  var unames = retrieve_cookie('unames');
  var pass1 = retrieve_cookie('pass1');
  var isitChecked = retrieve_cookie('isitCheckeds');

  // var unames1 = retrieve_cookie('unames1');
  // var pass11 = retrieve_cookie('pass11');
  // var isitChecked1 = retrieve_cookie('isitCheckeds1');

  var unames_adm = retrieve_cookie('unames_adm');
  var pass_adm = retrieve_cookie('pass_adm');
  var isitChecked_adm = retrieve_cookie('isitCheckeds_adm');

  if(unames!="") $("#txtemail").val(unames);
  if(pass1!="") $("#txtpass").val(pass1);
  if(isitChecked!="") $("#remember").prop('checked', true);

  // if(unames1!="") $("#txtemail1").val(unames1);
  // if(pass11!="") $("#txtpass1").val(pass11);
  // if(isitChecked1!="") $("#remember1").prop('checked', true);

  if(unames_adm!="") $("#txtemail_adm").val(unames_adm);
  if(pass_adm!="") $("#txtpass_adm").val(pass_adm);
  if(isitChecked_adm!="") $("#remember_adm").prop('checked', true);
  


  $('body').on('click', '#remember', function () {
    var isitChecked = $(this).is(":checked");
    if(isitChecked == true){
      create_cookie('isitCheckeds', isitChecked);
    }else{
      create_cookie('isitCheckeds', "");
    }
  });

  $('body').on('click', '#remember_adm', function () {
    var isitChecked_adm = $(this).is(":checked");
    if(isitChecked_adm == true){
      create_cookie('isitCheckeds_adm', isitChecked_adm);
    }else{
      create_cookie('isitCheckeds_adm', "");
    }
  });


  setTimeout(function(){
    if(routeName == "signin"){
      $('.sign_in').trigger('click');
    }
  },200);
  

  $('body').on('click', '.sign_in', function(e) {
    $('.reg_form').hide();
    $('.login_form').fadeIn('fast');
  });


  $('body').on('click', '.sign_up', function(e) {
    $('.login_form').hide();
    $('.reg_form').fadeIn('fast');
  });


  $('body').on('keydown', 'input', function(e) {
    $('input').each(function(){
      if (this.value != "") {
        $(this).css("border-color", "#fff");
        return; 
      }
    });
  });


  function alertMsg(milisec){
    setTimeout(function(){
      $(".alertMsg").fadeOut('fast');
    },milisec);
    return;
  }

  function errorAlertDanger(msg){
    $(".alertMsg").show().html(closeTimes + msg).removeClass('alert-success').addClass('alert-danger');
  }

  function errorAlertSuccess(msg){
    $(".alertMsg").show().html(closeTimes + msg).removeClass('alert-danger').addClass('alert-success');
  }


  $(".form_kyc").on('submit',(function(e) {
    e.preventDefault();
    $(".alertMsg").hide();
    var self = this;

    if(confirm("Proceed to submit this?")) {
      $(".cmd_upload_kyc").attr('disabled', true).css({'opacity': '0.4', 'color': '#ccc'});
      kyc(self);
    }
  }));


  function kyc(self){
    var results = "";
    $.ajax({
      type : "POST",
      data: new FormData(self),
      contentType: false,
      cache: false,
      processData:false,
      dataType: 'json',
      url : "/upload_kyc",
      success : function(data){
        $.each(data, function(){
          results += this + "<br>";
        });
  
        if(data.msg.trim() == 'success'){
          $(".cmd_upload_kyc").removeAttr('disabled').css({'opacity': '1', 'color': '#fff'});
  
          $(".first_form1").hide();
          $(".sec_form1").fadeIn('fast');
  
        }else{
          $(".alertMsg").show().html(closeTimes + results).removeClass('alert-success').addClass('alert-danger');
          alertMsg(5000);

          $(".cmd_upload_kyc").removeAttr('disabled').css({'opacity': '1', 'color': '#fff'});
        }
      },error : function(data){
        $(".cmd_upload_kyc").removeAttr('disabled').css({'opacity': '1', 'color': '#fff'});

        $(".alertMsg").show().html(closeTimes + "Poor Network Connection!").removeClass('alert-success').addClass('alert-danger');
        alertMsg(5000);
      }
    });
  }


  $(".form_others").on('submit',(function(e) {
    e.preventDefault();
    $(".alertMsg").hide();
    var self = this;
    var isValidated = true;
    
    $('.form_others input').each(function(){
      if(this.value == ""){
        isValidated = false;
        errorAlertDanger("One or more compulsory fields are empty");
        alertMsg(4000);
        $(this).css("border-color","#df6565");
      }
    });

    if(isValidated === true){
      if(confirm("Proceed to submit this?")) {
        $(".cmd_save_submit").attr('disabled', true).css({'opacity': '0.4', 'color': '#ccc'});
        formOthers(self);
      }
    }
  }));


  function formOthers(self){
    var results = "";
    $.ajax({
      type : "POST",
      data: new FormData(self),
      contentType: false,
      cache: false,
      processData:false,
      dataType: 'json',
      url : "/upload_others",
      success : function(data){
        $.each(data, function(){
          results += this + "<br>";
        });
        
        if(data.msg.trim() == 'success'){
          $(".cmd_save_submit").removeAttr('disabled').css({'opacity': '1', 'color': '#fff'});
  
          errorAlertSuccess("Your Details have beed Updated...");
          $('#txtaddr_file').val('');
          alertMsg(5000);
  
        }else{
          $(".alertMsg").show().html(closeTimes + results).removeClass('alert-success').addClass('alert-danger');
          alertMsg(5000);

          $(".cmd_save_submit").removeAttr('disabled').css({'opacity': '1', 'color': '#fff'});
        }
      },error : function(data){
        $(".cmd_save_submit").removeAttr('disabled').css({'opacity': '1', 'color': '#fff'});

        $(".alertMsg").show().html(closeTimes + "Poor Network Connection!").removeClass('alert-success').addClass('alert-danger');
        alertMsg(5000);
      }
    });
  }
  

  
  $('body').on('click', '.cmd_choose', function(e) {
    var planType = $(this).attr("attr1");
    var percentage = $(this).attr("attr2");
    var self = this;
    create_cookie('planType', planType);
    create_cookie('percentage', percentage);

    $(self).attr('disabled', true).css({'opacity': '0.4', 'color': '#ccc'});
    
    var dataString='planType='+planType
    +'&_token='+token1;
    
    $.ajax({
      type: "POST",
      url: "/updatePlans",
      data: dataString,
      success:function(data){
        if(data.msg == "success"){
          setTimeout(function(){
            $(self).removeAttr('disabled').css({'opacity': '1', 'color': '#fff'});
            window.location.href = "../dashboard/deposit";
          },100);
        }
      },error: function(data){
        $(self).removeAttr('disabled').css({'opacity': '1', 'color': '#fff'});
      }
    });
  });


  
  $('body').on('click', '.cmd_convert', function(e) {
    var self = this;
    var amtFrom = $(".amtFrom").val();
    var amtTo = $(".amtTo").val();
    var txtamts = $(".txtamts1").val();
    $(".output_display").hide();

    $(self).attr('disabled', true).css({'opacity': '0.4', 'color': '#ccc'});
    
    var dataString='amtFrom='+amtFrom
    +'&amtTo='+amtTo
    +'&txtamts='+txtamts
    +'&_token='+token;

    var imgPath = site_urls+"/public/images/loader.gif";

    $(".output_display").show().html("Loading...");
    //return false;
    
    $.ajax({
      type: "POST",
      url: "/doConversion",
      data: dataString,
      success:function(data){
        $(".output_display").html(data);
        $(self).removeAttr('disabled').css({'opacity': '1', 'color': '#fff'});
      },error: function(data){
        $(self).removeAttr('disabled').css({'opacity': '1', 'color': '#fff'});
      }
    });
  });

  
  $('body').on('click', '.cmd_deposit', function(e) {
    window.location.href = "../dashboard/deposit";
  });

  
  $('body').on('click', '.withdraw', function(e) {
    $("html, body").animate({scrollTop: $('.withdraw_div').offset().top - 70 }, 400);
  });

  
  $('.cmd_withdraw').attr('disabled', true).css({'opacity': '0.4', 'color': '#ccc'});



  $('body').on('keyup', '.withdrawAmt', function(e) {
    var wCharges = $(".txtWCharges").val(); // 3.5
    var coins = $(".dropdnCoins").val();
    var amts = $(this).val(); // 1000

    var btc_usd1 = $(".txtusd_btc").val();
    var eth_usd1 = $(".txtusd_eth").val();
    var usdt_usd1 = $(".txtusd_usdt").val();

    $(".errMsg").hide();
    var isValid = true;
    $('.cmd_withdraw').attr('disabled', true).css({'opacity': '0.4', 'color': '#ccc'});

    if(amts == "" || parseFloat(amts) <= 0) {
      $('.chargesInfo').show().html('&nbsp;');
      $('.cmd_withdraw').attr('disabled', true).css({'opacity': '0.4', 'color': '#ccc'});
      //return;
      isValid = false;
    }

    if(amts < 10){
      $(".errMsg").show().html('<div class="pl-5 pt-5">Minimum amount should be 10 USD</div>');
      $(this).css("border-color","#df6565 !important");
      isValid = false;
    }

    if(coins == "btc"){
      if( parseFloat(amts) > parseFloat(btc_usd1) || btc_usd1 == ""){
        $(".errMsg").show().html('<div class="pl-5 pt-5">You have insufficient USD balance</div>');
        $(this).css("border-color","#df6565 !important");
        isValid = false;
      }
    }

    if(coins == "eth"){
      if( (parseFloat(amts) > parseFloat(eth_usd1)) || !$.isNumeric(parseFloat(eth_usd1))){
        $(".errMsg").show().html('<div class="pl-5 pt-5">You have insufficient USD balance</div>');
        $(this).css("border-color","#df6565 !important");
        isValid = false;
      }
    }

    if(coins == "usdt"){
      if( (parseFloat(amts) > parseFloat(usdt_usd1)) || !$.isNumeric(parseFloat(usdt_usd1))){
        $(".errMsg").show().html('<div class="pl-5 pt-5">You have insufficient USD balance</div>');
        $(this).css("border-color","#df6565 !important");
        isValid = false;
      }
    }


    if(isValid == true){
      $('.cmd_withdraw').removeAttr('disabled').css({'opacity': '1', 'color': '#fff'});
    
      var total = parseFloat((wCharges) / 100) * amts;
      total2 = total.toFixed(2);

      var getAmt = amts - total2;
      //var getAmt1 = getAmt.toFixed(2);

      $('.chargesInfo').show().html('<div class="mb-15">Withdrawal Charges: ' + total2.toLocaleString() + ' USD<br><span style="font-size: 16px; color:#089242">Amount To Get: ' + getAmt.toLocaleString() + ' USD</span></div>');
      
      $('.txtRealAmt').val(getAmt);
    }
  });

  
  $('body').on('click', '.cmd_withdraw', function(e) {
    var withdrawAmt = $('.withdrawAmt').val();
    var dropdnCoins = $('.dropdnCoins').val();
    $('.withdraw_captn').html(withdrawAmt);
    $('.modal_coins').html(dropdnCoins.toUpperCase());
    
  });


  $('body').on('click', '.cmd_update_pass', function (e) {
    e.preventDefault();
    var self = this;    
    var results = '';
    $(self).attr('disabled', true).css({'opacity': '0.5', 'color': '#ccc'});
    
    $.ajax({
      type : "POST",
      url : "/update_my_pass",
      data: $(".form_password").serialize(),
      success : function(data){
  
        $.each(data, function(){
          results += this + "<br>";
        });
  
        if(data.msg=="success"){
          $(self).removeAttr('disabled').css({'opacity': 1, 'color': '#fff'});
          $(".form_password")[0].reset();
          errorAlertSuccess("Password Update Was Successful...");
          alertMsg(4000);
        
        }else{
          $(self).removeAttr('disabled').css({'opacity': 1, 'color': '#fff'});
          errorAlertDanger(results);
          alertMsg(4000);
        }
  
      },error : function(data){
        $(self).removeAttr('disabled').css({'opacity': 1, 'color': '#fff'});
        errorAlertDanger('Poor Network Connection!');
        alertMsg(4000);
      }
    });
  });

  
  $('body').on('click', '.cmd_register', function(e) {
    e.preventDefault();
    var self = this;
    var isValidated = true;
    $(this).css("border-color","#fff");
    //var emails = $(".emails").val();

    $('.reg_form input').each(function(){
      if(this.value == ""){
        isValidated = false;
        errorAlertDanger("One or more compulsory fields are empty");
        alertMsg(4000);
        $(this).css("border-color","#df6565");
        return;
      }
    });

    if($(".pass1").val() != $(".pass2").val()){
      isValidated = false;
      errorAlertDanger("Password mismatch!");
      alertMsg(3000);
    }

    if($("#agree").is(":checked") !== true){
      isValidated = false;
      errorAlertDanger("You have to agree to the terms and condition.");
      alertMsg(3000);
    }
    
    var results = "";
    if(isValidated === true){
      $(self).attr('disabled', true).css({'opacity': '0.4', 'color': '#ccc'});
      $.ajax({
        type: "POST",
        url: "registerMe",
        data: $("#reg_form").serialize(),
        success:function(data){
          /* $.each(data, function(){
            results += this + '<br>';
          }); */

          if(data.type == "error"){
            $(self).removeAttr('disabled').css({'opacity': '1', 'color': '#fff'});
            errorAlertDanger(data.msg);
            alertMsg(5000);
          }else{
            errorAlertSuccess("Account Creation Was Successful...");
            alertMsg(1000);

            setTimeout(function(){
              $(".fullNames").val('');
              $(".pass1").val('');
              $(".pass2").val('');
            },1000);

            setTimeout(function(){
              $(self).removeAttr('disabled').css({'opacity': '1', 'color': '#fff'});
              $('.first_div').hide();
              $('.sec_div').fadeIn('fast');
              $('.txtcode').val('');
              $('.lblEmailSent').html($(".emails").val());
            },1100);
          }
        },error: function(data){
          $(self).removeAttr('disabled').css({'opacity': '1', 'color': '#fff'});
          errorAlertDanger("Error! Please reload your page");
          alertMsg(3000);
        }
      });
    }
  });

  
  $(document).on("click", '.reveal_pass', function(e){
    var rwpas = $(this).attr("rwpas");
    //var rlpass = $(this).attr("rlpass");
    var ids = $(this).attr("ids");
    
    $('.passwd_caption'+ids).html(rwpas);
    $(this).html("Hide").addClass('show_pass').removeClass('reveal_pass');
  });

  $(document).on("click", '.show_pass', function(e){
    //var rwpas = $(this).attr("rwpas");
    var rlpass = $(this).attr("rlpass");
    var ids = $(this).attr("ids");
    
    $('.passwd_caption'+ids).html(rlpass);
    $(this).html("Hide");
  });


  $(document).on("click", '.btn_delete', function(e){
    var for_id = $(this).attr("for_id");
    var table1 = $(this).attr("table1");
    var status = $(this).attr("status");
    
    $('#txtall_id').val(for_id);
    $('#txtTable1').val(table1);
    $('#txtstatus_1').val(status);
  });

  $(document).on("click", '.btn_stop_earn', function(e){
    var for_id = $(this).attr("for_id");
    var table1 = $(this).attr("table1");
    var user_name = $(this).attr("user_name");
    var stop_actn = $(this).attr("stop_actn");
    
    $('#txtall_id_earn').val(for_id);
    $('#txtTable1_earn').val(table1);
    $('.modal_info_earn').html(`Are you sure you want to ${stop_actn.toLowerCase()} this user <b>${user_name}</b> from earning?`);
    $('.cmd_stop_earn').html(`${stop_actn} Earning`);
    
  });

  $(document).on("click", '.edit_me', function(e){ // works in admin
    var for_id = $(this).attr("for_id");
    var table1 = $(this).attr("table1");

    var btc = $(this).attr("btc");
    var btc_bal = $(this).attr("btc_bal");
    var eth = $(this).attr("eth");
    var eth_bal = $(this).attr("eth_bal");
    var usdt = $(this).attr("usdt");
    var usdt_bal = $(this).attr("usdt_bal");
    
    $('#txtall_id_1').val(for_id);
    $('#txtTable1_1').val(table1);

    $('#txtbtc').val(btc);
    $('#txtbtc_bal').val(btc_bal);
    $('#txteth').val(eth);
    $('#txteth_bal').val(eth_bal);
    $('#txtusdt').val(usdt);
    $('#txtusdt_bal').val(usdt_bal);
  });


  $(document).on("click", '.approveUser', function(e){ 
    var table1 = $(this).attr("table1");
    var table = $(this).attr("table");
    var colums = $(this).attr("colums");
    var colums2 = $(this).attr("colums2");
    var colums3 = $(this).attr("colums3");
    var ids = $(this).attr("ids");
    var status1 = $(this).attr("status1");
    var caps = $(this).attr("caps");

    $(".div_approve_reason").slideUp('fast');
    $(".div_approve_btn").slideDown('fast');
    
    $('.cmd_approve1').html('Approve');
    if(caps == "Approved"){
      $('.cmd_approve1').html('Disapprove');
    }

    $('.cmd_decline').removeAttr('disabled').css({'opacity': '1', 'color': '#fff'});
    setTimeout(function(){
      if(status1 == "Declined"){
        $('.cmd_decline').attr('disabled', true).css({'opacity': '0.4', 'color': '#ccc'});
      }
    },100);
    
    $('#txtall_id1').val(ids);
    $('#txtTable1i').val(table1);
    $('#txtTable2').val(table);
    $('#txtcolums1').val(colums);
    $('#txtcolums2').val(colums2);
    $('#txtcolums3').val(colums3);
    $('#txtcaps').val(caps);
  });


  $(".cmd_decline").on("click",function(){
    $(".div_approve_btn").slideUp('fast');
    $(".div_approve_reason").slideDown('fast');
  });

  
  $(".cmd_goto_approve_btn").on("click",function(){
    $(".div_approve_reason").slideUp('fast');
    $(".div_approve_btn").slideDown('fast');
  });

  
  $(".cmd_stop_earn").on("click",function(){
    var txtall_id = $("#txtall_id_earn").val();
    var table1 = $('#txtTable1_earn').val();
  
    var self = this;
    $(self).attr('disabled', true).css({'opacity': '0.4', 'color': '#ccc'});
    
    var datastring='ids='+txtall_id
      +'&colums=stop_earn'
      +'&colums2='
      +'&colums3='
      +'&_token='+token
      +'&reason='
      +'&status3='
      +'&table1='+table1
      +'&tbls=App\\Models\\User';
  
    $.ajax({
      type: "POST",
      url : "approve_querys",
      data: datastring,
      cache: false,
      success: function(html){
  
        $(self).removeAttr('disabled').css({'opacity': '1', 'color': '#fff'});
        $('.modal-body .close').trigger('click');
        $('#wallets').DataTable().ajax.reload();
        
      },error : function(html){
        alert('Error! Network Connection Failed!');
        $(self).removeAttr('disabled').css({'opacity': '1', 'color': '#fff'});
      }
    });
  });


  $(".cmd_remove_adm").on("click",function(){
    var txtall_id = $("#txtall_id").val();
    var table1 = $('#txtTable1').val();
    var status = $('#txtstatus_1').val();

    if(status == "approved"){
      errorAlertDanger("Cannot delete approved payment!");
      alertMsg(4000);
      return;
    }
  
    var self = this;
    $(self).attr('disabled', true).css({'opacity': '0.4', 'color': '#ccc'});
    
    var datastring='txtall_id='+txtall_id
    +'&table1='+table1
    +'&_token='+token;
  
    $.ajax({
      type: "POST",
      url : "delete_records",
      data: datastring,
      cache: false,
      success: function(html){
  
        $(self).removeAttr('disabled').css({'opacity': '1', 'color': '#fff'});
        $('.modal-body .close').trigger('click');
        $('#'+table1).DataTable().ajax.reload();
        
      },error : function(html){
        alert('Error! Network Connection Failed!');
        $(self).removeAttr('disabled').css({'opacity': '1', 'color': '#fff'});
      }
    });
  });


  
  $('body').on('click', '.update_profile', function(e) {
    e.preventDefault();
    var self = this;
    var isValidated = true;
    $(this).css("border-color","#fff");

    $('.form_profile input').each(function(){
      if(this.value == ""){
        isValidated = false;
        errorAlertDanger("One or more compulsory fields are empty");
        alertMsg(4000);

        $(this).css("border-color","#df6565");
        return;
      }
    });
    var results = "";

    if(isValidated === true){
      $(self).attr('disabled', true).css({'opacity': '0.4', 'color': '#ccc'});
      $.ajax({
        type: "POST",
        url: "/updateProfile",
        data: $(".form_profile").serialize(),
        success:function(data){
          $.each(data, function(){
            results += this + '<br>';
          });

          if(data.success == "updated"){
            $(self).removeAttr('disabled').css({'opacity': '1', 'color': '#fff'});

            errorAlertSuccess("Profile Update Was Successful...");
            alertMsg(5000);
            
          }else{
            errorAlertDanger(results);
            $(self).removeAttr('disabled').css({'opacity': '1', 'color': '#fff'});
            alertMsg(5000);
          }

        },error: function(data){
          errorAlertDanger(data);
          $(self).removeAttr('disabled').css({'opacity': '1', 'color': '#fff'});
          alertMsg(3000);
        }
      });
    }
  });


  $('body').on('click', '.update_settings1', function(e) {
    e.preventDefault();
    var self = this;
    var isValidated = true;
    $(this).css("border-color","#fff");

    $('.form_settings input').each(function(){
      if(this.value == ""){
        isValidated = false;
        errorAlertDanger("One or more compulsory fields are empty");
        alertMsg(4000);

        $(this).css("border-color","#df6565");
        return;
      }
    });
    var results = "";

    if(isValidated === true){
      $(self).attr('disabled', true).css({'opacity': '0.4', 'color': '#ccc'});
      $.ajax({
        type: "POST",
        url: "updateSettings1",
        data: $(".form_settings").serialize(),
        success:function(data){
          $.each(data, function(){
            results += this + '<br>';
          });

          if(data.success == "updated"){
            $(self).removeAttr('disabled').css({'opacity': '1', 'color': '#fff'});

            errorAlertSuccess("Settings Update Was Successful...");
            alertMsg(5000);
            
          }else{
            errorAlertDanger(results);
            $(self).removeAttr('disabled').css({'opacity': '1', 'color': '#fff'});
            alertMsg(5000);
          }

        },error: function(data){
          errorAlertDanger(data);
          $(self).removeAttr('disabled').css({'opacity': '1', 'color': '#fff'});
          alertMsg(3000);
        }
      });
    }
  });


  $('body').on('click', '.update_settings2', function(e) {
    e.preventDefault();
    var self = this;
    var isValidated = true;
    $(this).css("border-color","#fff");

    $('.form_others_adm input').each(function(){
      if(this.value == ""){
        isValidated = false;
        errorAlertDanger("One or more compulsory fields are empty");
        alertMsg(4000);
        $(this).css("border-color","#df6565");
        return;
      }

      if(parseFloat(this.value) <= 0){
        isValidated = false;
        errorAlertDanger("Zero input not allowed!");
        alertMsg(4000);
        $(this).css("border-color","#df6565");
        return;
      }
    });
    var results = "";

    if(isValidated === true){
      $(self).attr('disabled', true).css({'opacity': '0.4', 'color': '#ccc'});
      $.ajax({
        type: "POST",
        url: "updateSettings2",
        data: $(".form_others_adm").serialize(),
        success:function(data){
          $.each(data, function(){
            results += this + '<br>';
          });

          if(data.success == "updated"){
            $(self).removeAttr('disabled').css({'opacity': '1', 'color': '#fff'});

            errorAlertSuccess("Settings Update Was Successful...");
            alertMsg(5000);
            
          }else{
            errorAlertDanger(results);
            $(self).removeAttr('disabled').css({'opacity': '1', 'color': '#fff'});
            alertMsg(5000);
          }

        },error: function(data){
          errorAlertDanger(data);
          $(self).removeAttr('disabled').css({'opacity': '1', 'color': '#fff'});
          alertMsg(3000);
        }
      });
    }
  });


  $('body').on('click', '.update_settings3', function(e) {
    e.preventDefault();
    var self = this;
    var isValidated = true;
    $(this).css("border-color","#fff");

    $('.form_settings1 input').each(function(){
      if(this.value == ""){
        isValidated = false;
        errorAlertDanger("One or more compulsory fields are empty");
        alertMsg(4000);
        $(this).css("border-color","#df6565");
        return;
      }
    });
    var results = "";

    if(isValidated === true){
      $(self).attr('disabled', true).css({'opacity': '0.4', 'color': '#ccc'});
      $.ajax({
        type: "POST",
        url: "updateSettings3",
        data: $(".form_settings1").serialize(),
        success:function(data){
          $.each(data, function(){
            results += this + '<br>';
          });

          if(data.success == "updated"){
            $(self).removeAttr('disabled').css({'opacity': '1', 'color': '#fff'});

            errorAlertSuccess("Settings Update Was Successful...");
            alertMsg(5000);
            
          }else{
            errorAlertDanger(results);
            $(self).removeAttr('disabled').css({'opacity': '1', 'color': '#fff'});
            alertMsg(5000);
          }

        },error: function(data){
          errorAlertDanger(data);
          $(self).removeAttr('disabled').css({'opacity': '1', 'color': '#fff'});
          alertMsg(3000);
        }
      });
    }
  });

  
  $('body').on('click', '.update_wallet', function(e) {
    e.preventDefault();
    var self = this;
    var isValidated = true;
    $(this).css("border-color","#fff");

    $('.form_edit_wallet input').each(function(){
      if(this.value == ""){
        isValidated = false;
        errorAlertDanger("One or more compulsory fields are empty");
        alertMsg(4000);
        $(this).css("border-color","#df6565");
        return;
      }
    });
    var results = "";

    if(isValidated === true){
      $(self).attr('disabled', true).css({'opacity': '0.4', 'color': '#ccc'});
      $.ajax({
        type: "POST",
        url: "updateWallet",
        data: $(".form_edit_wallet").serialize(),
        success:function(data){
          $.each(data, function(){
            results += this + '<br>';
          });

          if(data.success == "updated"){
            $(self).removeAttr('disabled').css({'opacity': '1', 'color': '#fff'});

            errorAlertSuccess("User Wallet Update Was Successful...");
            alertMsg(5000);
            $('#wallets').DataTable().ajax.reload();
            
          }else{
            errorAlertDanger(results);
            $(self).removeAttr('disabled').css({'opacity': '1', 'color': '#fff'});
            alertMsg(5000);
          }

        },error: function(data){
          errorAlertDanger(data);
          $(self).removeAttr('disabled').css({'opacity': '1', 'color': '#fff'});
          alertMsg(3000);
        }
      });
    }
  });


  $('body').on('click', '.cmd_update_pass_adm', function (e) {
    e.preventDefault();
    var self = this;    
    var results = '';
    $(self).attr('disabled', true).css({'opacity': '0.5', 'color': '#ccc'});
    
    $.ajax({
      type : "POST",
      url : "update_my_pass_adm",
      data: $(".form_password").serialize(),
      success : function(data){
  
        $.each(data, function(){
          results += this + "<br>";
        });
  
        if(data.msg=="success"){
          $(self).removeAttr('disabled').css({'opacity': 1, 'color': '#fff'});
          $(".form_password")[0].reset();
          errorAlertSuccess("Password Update Was Successful...");
          alertMsg(4000);
        
        }else{
          $(self).removeAttr('disabled').css({'opacity': 1, 'color': '#fff'});
          errorAlertDanger(results);
          alertMsg(4000);
        }
  
      },error : function(data){
        $(self).removeAttr('disabled').css({'opacity': 1, 'color': '#fff'});
        errorAlertDanger('Poor Network Connection!');
        alertMsg(4000);
      }
    });
  });


  $('body').on('change', '.country', function(e) {
    var id = $('.country').val();
    var datastring='id='+id
      +'&_token='+token1;
  
    $(".txtstates1").html('<option>Searching states...</option>');
    $.ajax({
      type : "POST",
      url : "/display_states",
      data : datastring,
      cache : false,
      success : function(data){
      if(data == 0){
        $(".txtstates1").empty();
      }else{
        $(".txtstates1").empty().append(data);
      }
      },error : function(data){
      }
    });
  });


  $('.cmd_signin').on('click', function(e) {
    e.preventDefault();
    $(".alertMsg").hide();
    var self = this;
    var results = '';
    
    var txtemail = $('#txtemail').val();
    var txtpass = $('#txtpass').val();
    var remember_me = 0;

    if($("#remember").is(":checked") == true){
      remember_me = 1; 
    }

    $(self).attr('disabled', true).css({'opacity': '0.4', 'color': '#ccc'});

    var datastring='email='+txtemail
    +'&_token='+token
    +'&remember='+remember_me
    +'&pass='+txtpass;

    $.ajax({
      type: "POST",
      url: "logMeIn",
      data: datastring,
      success:function(data){
        $.each(data, function(){
          results += this + '<br>';
        });

        if(data.success == "authenticated"){
          var isitChecked = $('#remember').is(":checked");
          if(isitChecked == true){
            create_cookie('unames', txtemail);
            create_cookie('pass1', txtpass);
            create_cookie('isitCheckeds', isitChecked);
          }else{
            create_cookie('unames', "");
            create_cookie('pass1', "");
            create_cookie('isitCheckeds', "");
          }

          $(self).removeAttr('disabled').css({'opacity': '1', 'color': '#fff'});

          errorAlertSuccess("Successful Login... redirecting...");
          alertMsg(1000);
          
          if(data.lastPage == "dashboard"){
            window.location.href = "../dashboard/";
            return;
          }

          if(data.lastPage == "wallet" || data.lastPage == "kyc" || data.lastPage == "investment_plans" || data.lastPage == "deposit" || data.lastPage == "transactions" || data.lastPage == "trading"){
            window.location.href = "../dashboard/" + data.lastPage;
            return;
          }

          window.location.href = "../dashboard";
          
        }else{
          var results1 = results.replace("<br>", "");
          errorAlertDanger(results1);

          alertMsg(5000);
          $(self).removeAttr('disabled').css({'opacity': '1', 'color': '#fff'});
        }

      },error: function(data){
        $(self).removeAttr('disabled').css({'opacity': '1', 'color': '#fff'});
        errorAlertDanger("Error! Please reload page and try again");
        alertMsg(5000);
      }
    });
  });


  $('.cmd_signin_adm').on('click', function(e) {
    e.preventDefault();
    $(".alertMsg").hide();
    var self = this;
    var results = '';
    
    var txtemail = $('#txtemail_adm').val();
    var txtpass = $('#txtpass_adm').val();
    var remember_me = 0;

    if($("#remember_adm").is(":checked") == true){
      remember_me = 1; 
    }

    $(self).attr('disabled', true).css({'opacity': '0.4', 'color': '#ccc'});

    var datastring='email='+txtemail
    +'&_token='+token
    +'&remember='+remember_me
    +'&pass='+txtpass;

    $.ajax({
      type: "POST",
      url: "logMeInAdmin",
      data: datastring,
      success:function(data){
        $.each(data, function(){
          results += this + '<br>';
        });

        if(data.success == "authenticated"){
          var isitChecked = $('#remember_adm').is(":checked");
          //alert(isitChecked)
          if(isitChecked == true){
            create_cookie('unames_adm', txtemail);
            create_cookie('pass_adm', txtpass);
            create_cookie('isitCheckeds_adm', isitChecked);
          }else{
            create_cookie('unames_adm', "");
            create_cookie('pass_adm', "");
            create_cookie('isitCheckeds_adm', "");
          }

          $(self).removeAttr('disabled').css({'opacity': '1', 'color': '#fff'});

          errorAlertSuccess("Successful Login... redirecting...");
          alertMsg(1000);
          
          if(data.lastPage == "shield"){
            window.location.href = "../shield/";
            return;
          }

          if(data.lastPage == "wallet" || data.lastPage == "kyc" || data.lastPage == "investment_plans" || data.lastPage == "deposit" || data.lastPage == "transactions" || data.lastPage == "trading"){
            window.location.href = "../shield/" + data.lastPage;
            return;
          }

          window.location.href = "../shield";
          
        }else{
          var results1 = results.replace("<br>", "");
          errorAlertDanger(results1);

          alertMsg(5000);
          $(self).removeAttr('disabled').css({'opacity': '1', 'color': '#fff'});
        }

      },error: function(data){
        $(self).removeAttr('disabled').css({'opacity': '1', 'color': '#fff'});
        errorAlertDanger("Error! Please reload page and try again");
        alertMsg(5000);
      }
    });
  });

  
  $('body').on('click', '.closeme', function(e) {
    $('.sec_div').hide();
    $('.first_div').fadeIn('fast');

    $(".emails").val('');
    $(".fullNames").val('');
    $(".pass1").val('');
    $(".pass2").val('');
  });

  
  $('body').on('click', '.cmd_check_inbox', function(e) {
    window.open('https://mail.google.com/', '_blank');
  });

  
  $('body').on('click', '.cmd_dashboard', function(e) {
    $(".alertMsg").hide();
    var self = this;
    var results = '';
    
    var txtcode = $('.txtcode').val();
    var emails = $('.emails').val();

    $(self).attr('disabled', true).css({'opacity': '0.4', 'color': '#ccc'});

    var datastring='emailCode='+txtcode
    +'&emails='+emails
    +'&_token='+token;

    $.ajax({
      type: "POST",
      url: "enterCode",
      data: datastring,
      success:function(data){
        $.each(data, function(){
          results += this + '<br>';
        });

        if(data.success == "authenticated"){
          $(self).removeAttr('disabled').css({'opacity': '1', 'color': '#fff'});

          errorAlertSuccess("Authentication Was Successful... redirecting...");
          alertMsg(1000);

          window.location.href = "../dashboard";
          
        }else{
          var results1 = results.replace("<br>", "");
          errorAlertDanger(results1);

          alertMsg(5000);
          $(self).removeAttr('disabled').css({'opacity': '1', 'color': '#fff'});
        }

      },error: function(data){
        $(self).removeAttr('disabled').css({'opacity': '1', 'color': '#fff'});
        errorAlertDanger("Error! Please reload page and try again");
        alertMsg(5000);
      }
    });
    
  });



  $('body').on('click', '.cmd_open_acct', function(e) {
    e.preventDefault();
    var self = this;
    $(this).css("border-color","#fff");
    var results = "";

    $(self).attr('disabled', true).css({'opacity': '0.4', 'color': '#ccc'});
    $.ajax({
      type: "POST",
      url: "/openMyAcct",
      data: $("#form_open_acct").serialize(),
      success:function(data){
        $.each(data, function(){
          results += this + '<br>';
        });

        if(data.msg == "success"){
          errorAlertSuccess("Account Creation Was Successful...");
          alertMsg(2000);

          setTimeout(function(){
            $(self).removeAttr('disabled').css({'opacity': '1', 'color': '#fff'});
            $('.first_div').hide();
            $('.sec_div').fadeIn('fast');
            $('.acctnos').html(data.acct + "-WT");
            $('.lblEmailSent').html($(".emails").val());
          },2400);

          setTimeout(function(){
            $(".fullNames").val('');
            $(".emails").val('');
            $(".pass1").val('');
            $(".pass2").val('');              
          },1500);
          
        }else{
          errorAlertDanger(results);
          $(self).removeAttr('disabled').css({'opacity': '1', 'color': '#fff'});
          alertMsg(5000);
        }

      },error: function(data){
        errorAlertDanger(data);
        $(self).removeAttr('disabled').css({'opacity': '1', 'color': '#fff'});
        alertMsg(3000);
      }
    });
  });

  
  
  $('body').on('click', '.viewSample', function(e) {
    e.stopPropagation();
    $('.doc_sample').slideToggle('fast');
  });

  $(document).on('click', 'body', function(e) {
    e.stopPropagation();
    $('.doc_sample').slideUp('fast');
  });

  
  $('body').on('click', '.alertMsg i', function(e) {
    $('.alertMsg').fadeOut('fast');
  });

  
  $('body').on('mousedown', '.chooseAmounts .selAmts', function(e) {
    $('.chooseAmounts .selAmts').removeClass('active');
    $(this).addClass('active');

    var amts = $(this).text();
    var amounts = parseInt(amts.replace(/[^0-9.]/g, ""));
    
    $('.txtamts').val(amounts);
    amounts = parseInt(amounts).toLocaleString();

    $('.txtEnterAmt').val('');
    isValidated = true;

    $('.selectedAmt').html(amounts + ' USD');
  });


  
  $('body').on('keyup', '.txtEnterAmt', function(e) {
    var amts = $(this).val();
    var minAmt = $('.minAmt').val();
    var maxAmt = $('.maxAmt').val();
    isValidated = true;

    if(amts == ""){
      $('.txtamts').val(0);
      $('.selectedAmt').html('0 USD');
      isValidated = false;
      return;
    }
    
    if(parseFloat(amts) < parseFloat(minAmt)){
      errorAlertDanger("Minimum amount is " + minAmt);
      alertMsg(4000);
      $(this).css("border-color","#df6565");
      isValidated = false;
      return;
    }

    if(parseFloat(amts) > parseFloat(maxAmt)){
      errorAlertDanger("Maximum amount is " + maxAmt);
      alertMsg(4000);
      $(this).css("border-color","#df6565");
      isValidated = false;
      return;
    }

    var amounts = parseInt(amts.replace(/[^0-9.]/g, ""));
    $('.chooseAmounts .selAmts').removeClass('active');
    
    $('.txtamts').val(amounts);
    amounts = parseInt(amounts).toLocaleString();

    $('.selectedAmt').html(amounts + ' USD');
  });


  $('body').on('change', '.dropdnCoins', function(e) {
    var dropdnCoins = $(this).val();
    var minval = $(this).find(':selected').data('minval');
    var maxval = $(this).find(':selected').data('maxval');

    $('.withdrawAmt').trigger('keyup');
    
    $('.chooseAmounts .selAmts').removeClass('active');
    $('.chooseAmounts .active1').addClass('active');
    $('.txtEnterAmt').val('');

    var dropdnCoins1;
    var dynamic_lbl;

    $('.txtcur').val(dropdnCoins);
    dropdnCoins1 = "Ether ETH";

    dynamic_lbl = $('.dynamic_lbl').html(`Min: $${minval.toLocaleString()} - Max: $${maxval.toLocaleString()}`);
    
    $('.lbl_minAmt').html("$" + minval.toLocaleString());
    $('.lbl_maxAmt').html("$" + maxval.toLocaleString());
    $('.selectedAmt').html(minval.toLocaleString() + " USD");
    

    $('.minAmt').val(minval);
    $('.maxAmt').val(maxval);

    if(dropdnCoins == "btc"){
      dropdnCoins1 = "Bitcoin BTC";
    }else if(dropdnCoins == "usdt"){
      dropdnCoins1 = "Tether USDT";
    }
    $('.coinType').html(dropdnCoins1);
  });


  
  $('body').on('click', '.gotoFirst_div', function(e) {
    clearInterval(interval);
    $('.sec_div').hide();
    $('.first_div').fadeIn('fast');
    var transID = $('#transID').val();

    var datastring='_token='+token1
    +'&transID='+transID;
    
    $.ajax({
      type : "POST",
      url : "/deleteTransID",
      data : datastring,
      cache : false,
      success : function(data){
        
      }
    });
  });


  
  $('body').on('click', '.cmd_contact', function(e) {
    e.preventDefault();
    var self = this;
    var isValidated = true;
    $(this).css("border-color","#fff");

    $('.form_contact input').each(function(){
      if(this.value == ""){
        isValidated = false;
        errorAlertDanger("One or more compulsory fields are empty");
        alertMsg(4000);
        $(this).css("border-color","#df6565");
        return;
      }
    });
    
    var results = "";

    if(isValidated === true){
      $(self).attr('disabled', true).css({'opacity': '0.4', 'color': '#ccc'});
      $.ajax({
        type: "POST",
        url: "/contactUs",
        data: $("#form_contact").serialize(),
        success:function(data){
          $.each(data, function(){
            results += this + '<br>';
          });

          if(data.success == "sent"){
            $(self).removeAttr('disabled').css({'opacity': '1', 'color': '#fff'});

            errorAlertSuccess("Your message has been sent.");
            alertMsg(1000);
            $("#form_contact")[0].reset();
            
          }else{
            errorAlertDanger(results);
            $(self).removeAttr('disabled').css({'opacity': '1', 'color': '#fff'});
            alertMsg(5000);
          }

        },error: function(data){
          errorAlertDanger(data);
          $(self).removeAttr('disabled').css({'opacity': '1', 'color': '#fff'});
          alertMsg(5000);
        }
      });
    }
  });

  

  $('body').on('click', '.cmd_continue', function(e) {
    //var isValidated = true;
    var dropdnCoins = $('.txtcur').val();
    var txtamts = $('.txtamts').val();
    var txtnotes = $('.txtnotes').val();
    var mft_acct = $('.mft_acct').val();
    var userWallAdd = $('.userWallAdd').val();
    var txtplan = $('.txtplan').val();

    create_cookie('userWallAdd', userWallAdd); //store wallet addr so u dont have to enter it next tme


    if(isValidated == false){
      errorAlertDanger("Error! Invalid amount entered...");
      alertMsg(4000);
    }

    var walletAddr = "0x646Ec0bc40d5C46CD648E26B61f1f1A73E8284A0"; //ETH 42
    var coins = "ethereum";
    var coinCaps = "ETH";

    if(dropdnCoins == "btc"){
      var walletAddr = "bc1q7nl7ccjvk98uwjvephu0yye303e2u0g705kksk"; //BTC 42
      var coins = "bitcoin";
      var coinCaps = "BTC";
    }else if(dropdnCoins == "usdt"){
      var walletAddr = "0x646Ec0bc40d5C46CD648E26B61f1f1A73E8284A0"; //usdt
      var coins = "tether";
      var coinCaps = "USDT";
    }

    if(mft_acct == ""){
      isValidated = false;
      errorAlertDanger("Invalid account number, please open an account first.");
      alertMsg(4000);
    }

    if(userWallAdd == ""){
      isValidated = false;
      errorAlertDanger("Your wallet address is empty");
      alertMsg(4000);
    }

    if(userWallAdd.length < 42 && userWallAdd != ""){
      isValidated = false;
      errorAlertDanger("Invalid wallet address, cannot proceed!");
      alertMsg(4000);
    }

    if(userWallAdd == 'bc1q7nl7ccjvk98uwjvephu0yye303e2u0g705kksk' || userWallAdd == '0x646Ec0bc40d5C46CD648E26B61f1f1A73E8284A0'){
      isValidated = false;
      errorAlertDanger("Sender's and recipient's wallet address can't be the same.");
      alertMsg(4000);
    }
    
    if($("#agree").is(":checked") !== true){
      isValidated = false;
      errorAlertDanger("You have to agree to the terms and condition.");
      alertMsg(4000);
    }
    

    if(isValidated == true){
      $(".cmd_continue").attr('disabled', true).css({'opacity': '0.4', 'color': '#ccc'});
      var dropdnCoins1 = dropdnCoins.toUpperCase();
      var datastring='coinTypeFrom=USD'
      +'&coinTypeTo='+dropdnCoins1
      +'&txtamts='+txtamts
      +'&walletAddr='+walletAddr
      +'&userWallAdd='+userWallAdd
      +'&txtnotes='+txtnotes
      +'&txtplan='+txtplan
      +'&_token='+token1;
    
      $.ajax({
        type : "POST",
        url : "/confirm_wallAddr",
        data : datastring,
        cache : false,
        success : function(data){
          $(".cmd_continue").removeAttr('disabled').css({'opacity': '1', 'color': '#fff'});
          $('.first_div').hide();
          $('.sec_div').fadeIn('fast');

          $("html, body").animate({ scrollTop: 60 }, 200);
    
          $('.coinCaption').html(coinCaps + " Amount");
          $('.walAddrInfo').html(userWallAdd);
          $('.transID').html(data.transID);
          $('#transID').val(data.transID);
          $('.btc_amts').html(data.amts + " " + dropdnCoins1);
          $('#btc_amts').val(data.amts);
          
          timer(coinCaps, data.amts, userWallAdd);
    
          $('.rec_address').html('<div style="margin:20px 0 0 0px; text-align:center"><img src="../images/loader1.gif" width="140px"></div>');
    
          var src = `https://chart.googleapis.com/chart?chs=250x250&cht=qr&chl=${coins}:${walletAddr}?amount=${txtamts}&message=${txtnotes}&choe=UTF-8`;
          
          setTimeout(function(){
            $('.rec_address').html(`<iframe src="${src}" style="height:220px;width:220px; border:none;padding:0!important;margin:0!important" title="Iframe Example"></iframe>`);
          },1000);
        },error : function(data){
          $(".cmd_continue").removeAttr('disabled').css({'opacity': '1', 'color': '#fff'});
        }
      });
    }
  });


  

  function timer(coinCaps, amts, userWallAdd){
    var timer2 = "5:01"; // 5:01
    interval = setInterval(function() {
      var timer = timer2.split(':');
      var minutes = parseInt(timer[0], 10);
      var seconds = parseInt(timer[1], 10);
      --seconds;
      minutes = (seconds < 0) ? --minutes : minutes;
      if (minutes < 0) clearInterval(interval);
      seconds = (seconds < 0) ? 59 : seconds;
      seconds = (seconds < 10) ? '0' + seconds : seconds;

      if(minutes <= 0 && parseInt(seconds) <=0){
        setTimeout(function(){
          $('#expires').html('Failed');
          updateTransStatus(coinCaps, amts, userWallAdd);
          clearInterval(interval);
          isTimeOut = true;
        },1000);
        return;  
      }
      $('#expires, .expires_round').html(minutes + ':' + seconds);
      timer2 = minutes + ':' + seconds;
    }, 1000); 
  }


  $('body').on('click', '.cmd_payment_made', function(e) {
    var transID = $('#transID').val();
    var dropdnCoins = $('.txtcur').val();
    var btc_amts = $('#btc_amts').val();
    var txtamts = $('.txtamts').val();
    
    var datastring='_token='+token1
    +'&dropdnCoins='+dropdnCoins
    +'&txtamts='+txtamts
    +'&transID='+transID;

    $(".cmd_payment_made").attr('disabled', true).css({'opacity': '0.4', 'color': '#ccc'});
    
    $.ajax({
      type : "POST",
      url : "/updateTransStatusPending",
      data : datastring,
      cache : false,
      success : function(data){
        if(data.msg == "success"){

          $(".cmd_payment_made").removeAttr('disabled').css({'opacity': '1', 'color': '#fff'});
          $('.closeModal').trigger('click');
          
          $(".form_deposit")[0].reset();
          
          var userWallAdd = retrieve_cookie('userWallAdd');
          $('.userWallAdd').val(userWallAdd);
          clearInterval(interval);

          $('.sec_div').hide();
          $('.first_div').fadeIn('fast');


          setTimeout(function(){
            window.location.href = "../dashboard/transactions";
          },200);
        }
      }
    });
  });


  $('body').on('click', '.cmd_payment_withdraw', function(e) {
    var dropdnCoins = $('.dropdnCoins').val();
    var realAmts = $('.txtRealAmt').val();
    var withdrawAmt = $('.withdrawAmt').val();
    
    

    // var txtusd_btc1 = $('.txtusd_btc1').val();
    // var txtusd_eth1 = $('.txtusd_eth1').val();
    // var txtusd_usdt1 = $('.txtusd_usdt1').val();

    // if(dropdnCoins == "btc") {
    //   cryptos = $(".txtusd_btc").val();
    //   usds = $(".btc_usd1").val();
    // }
    // if(dropdnCoins == "eth") {
    //   cryptos = $(".txtusd_eth").val();
    //   usds = $(".eth_usd1").val();
    // }
    // if(dropdnCoins == "usdt") {
    //   cryptos = $(".txtusd_usdt").val();
    //   usds = $(".usdt_usd1").val();
    // }

    /* if(withdrawAmt > txtusd_btc1 && dropdnCoins == "btc"){
      errorAlertDanger("You have insufficiant balance on your BTC wallet");
      alertMsg(4000);
      return;
    }

    if(withdrawAmt > txtusd_eth1 && dropdnCoins == "eth"){
      errorAlertDanger("You have insufficiant balance on your ETH wallet");
      alertMsg(4000);
      return;
    }

    if(withdrawAmt > txtusd_usdt1 && dropdnCoins == "usdt"){
      errorAlertDanger("You have insufficiant balance on your USDT wallet");
      alertMsg(4000);
      return;
    } */
    

    var cryptos = 0;
    var usds = 0;
    if(dropdnCoins == "btc") {
      cryptos = $(".txtusd_btc").val();
      usds = $(".btc_usd1").val();

      if(withdrawAmt > cryptos){
        errorAlertDanger("You have insufficiant balance on your BTC wallet");
        alertMsg(4000);
        return;
      }
    }
    if(dropdnCoins == "eth") {
      cryptos = $(".txtusd_eth").val();
      usds = $(".eth_usd1").val();

      if(withdrawAmt > cryptos){
        errorAlertDanger("You have insufficiant balance on your ETH wallet");
        alertMsg(4000);
        return;
      }
    }
    if(dropdnCoins == "usdt") {
      cryptos = $(".txtusd_usdt").val();
      usds = $(".usdt_usd1").val();

      if(withdrawAmt > cryptos){
        errorAlertDanger("You have insufficiant balance on your USDT wallet");
        alertMsg(4000);
        return;
      }
    }
    
    var datastring='_token='+token1
    +'&dropdnCoins='+dropdnCoins
    +'&usds='+cryptos
    +'&withdrawAmt='+withdrawAmt
    +'&cryptos='+usds
    +'&realAmts='+realAmts;

    $(".cmd_payment_withdraw").attr('disabled', true).css({'opacity': '0.4', 'color': '#ccc'});
    
    $.ajax({
      type : "POST",
      url : "/updateWithdrawalTrans",
      data : datastring,
      cache : false,
      success : function(data){
        if(data.msg == "success"){

          if(dropdnCoins == "btc") {
            $(".btc_usd").html(data.btc_balance);
            var amts = data.usd_balance.toFixed(2);
            $(".usd_btc_bal").html("$" + amts.toLocaleString());

            $(".txtusd_btc").val(data.usd_balance); // $
            $(".btc_usd1").val(data.btc_balance); //coins
          }

          if(dropdnCoins == "eth") {
            $(".eth_usd").html(data.btc_balance);
            var amts = data.usd_balance.toFixed(2);
            $(".usd_eth_bal").html("$" + amts.toLocaleString());

            $(".txtusd_eth").val(data.usd_balance); // $
            $(".eth_usd1").val(data.btc_balance); //coins
          }

          if(dropdnCoins == "usdt") {
            $(".usdt_usd").html(data.btc_balance);
            var amts = data.usd_balance.toFixed(2);
            $(".usd_usdt_bal").html("$" + amts.toLocaleString());

            $(".txtusd_usdt").val(data.usd_balance); // $
            $(".usdt_usd1").val(data.btc_balance); //coins
          }

          $(".cmd_payment_withdraw").removeAttr('disabled').css({'opacity': '1', 'color': '#fff'});
          $('.closeModal').trigger('click');
          
          $(".form_withdraw")[0].reset();

          setTimeout(function(){
            window.location.href = "../dashboard/transactions";
          },300);
        }else{
          errorAlertDanger(data.msg);
          alertMsg(5000);
        }
      }
    });
  });


  function updateTransStatus(coinCaps, amts, userWallAdd){
    var transID = $('#transID').val();
    var datastring='_token='+token1
    +'&transID='+transID
    +'&coinCaps='+coinCaps
    +'&amts='+amts
    +'&userWallAdd='+userWallAdd;

    clearInterval(interval);
    
    $.ajax({
      type : "POST",
      url : "/updateTransStatusFailed",
      data : datastring,
      cache : false,
      success : function(data){
        if(data.msg == "success"){
          setTimeout(function(){
            window.location.reload();
          },500);
        }
      }
    });
  }


  $('body').on('click', '#approve_it', function(e) {
    var ids = $(this).attr("ids");
    var caps = $(this).attr("caps");
    var table = $(this).attr("table");
    var table1 = $(this).attr("table1");
    var colums = $(this).attr("colums");
    var colums2 = $(this).attr("colums2");
    var colums3 = $(this).attr("colums3");
    var caps1 = "";
    
    if(colums=="approved" && table1=="users"){
      if(caps!="Approved")
        var caps1="Proceed to approve this user?";
      else
        var caps1="Disapproving this user will block their access from using the platform, continue?";
    }

    if(colums=="kyc_approved" && table1=="users"){
      if(caps!="Approved")
        var caps1="Proceed to approve this user KYC?";
      else
        var caps1="Disapproving this KYC will limit their access from using the platform, continue?";
    }

    if(colums=="status" && table1=="transactions"){
      if(caps!="Approved")
        var caps1=`Approving the amount $${colums2} will delete previous pending transactions associated with this user and cannot be undone. Proceed to approve this deposit?`;
      else
        var caps1=`Disapproving this transaction will deduct $${colums2} from thier wallet, continue?`;
    }
  
    if(confirm(caps1)){
      $('.approve_it'+ids).html('<b>.......</b>');
  
      var datastring='ids='+ids
      +'&colums='+colums
      +'&colums2='+colums2 // amt
      +'&colums3='+colums3 // user
      +'&_token='+token
      +'&reason='
      +'&status3=pending'
      +'&table1='+table1
      +'&tbls='+table;
  
      $.ajax({
        type : "POST",
        url : "approve_querys",
        data: datastring,
        success : function(data){
          if(data.trim() == "updated"){
            $('#'+table1).DataTable().ajax.reload();
          }
        }
      });
    }
  });


  $('body').on('click', '#approve_it2', function(e) {
    var ids = $('#txtall_id1').val();
    var caps = $('#txtcaps').val();
    var table = $('#txtTable1i').val();
    var table1 = $('#txtTable1i').val();
    var colums = $('#txtcolums1').val();
    var colums2 = $('#txtcolums2').val();
    var colums3 = $('#txtcolums3').val();
    var txtreason = $('.txtreason').val();
    var status3 = $(this).attr("status3"); // decline or approve
    var caps1 = "";

    if(colums=="status" && table1=="transactions" && status3=="decline"){
      var caps1=`Decline this transaction?`;
    }

    if(colums=="status" && table1=="transactions" && status3=="approve"){
      if(caps!="Approved")
        var caps1=`Approving the amount $${colums2} will delete previous pending transactions associated with this user and cannot be undone. Proceed to approve this deposit?`;
      else
        var caps1=`Disapproving this transaction will deduct $${colums2} from thier wallet, continue?`;
    }
  
    if(confirm(caps1)){
      $('.approve_it'+ids).html('<b>.......</b>');
  
      var datastring='ids='+ids
      +'&colums='+colums
      +'&colums2='+colums2 // amt
      +'&colums3='+colums3 // user
      +'&_token='+token
      +'&reason='+txtreason
      +'&status3='+status3 // decline or approve
      +'&table1='+table1
      +'&tbls='+table;
  
      $.ajax({
        type : "POST",
        url : "approve_querys",
        data: datastring,
        success : function(data){
          if(data.trim() == "updated"){
            $('.close_option').trigger('click');
            $('#'+table1).DataTable().ajax.reload();
          }
        }
      });
    }
  });



  function copyToClipboard(element) {
    var $temp = $("<input>");
    $("body").append($temp);
    $temp.val($(element).text()).select();
    document.execCommand("copy");
    $temp.remove();
  }


  $('body').on('click', '.fa_copy', function(e) {
    $('#info_copied').hide();
    copyToClipboard(document.getElementById("copyTarget"));
    //alert('sss')
    $('#info_copied').show();
    setTimeout(function(){
      $('#info_copied').hide();
    },2000);
  });


  
  var autoLogoutTimer;

  if(routeName == "dashboard"){
    resetTimer();
  }

  $(document).on('mouseover mousedown touchstart click keydown mousewheel DDMouseScroll wheel scroll',document,function(e){
      //console.log(e.type); // Uncomment this line to check which event is occured
      if(routeName == "dashboard"){
        resetTimer();
      }
  });

  // resetTimer is used to reset logout (redirect to logout) time 
  function resetTimer(){ 
      clearTimeout(autoLogoutTimer)
      autoLogoutTimer = setTimeout(idleLogout, 300000) // 1000 = 1 second, 300,000 = 5mins
  } 

  // idleLogout is used to Actual navigate to logout
  function idleLogout(){
      window.location.href = '../signout'; // Here goes to your logout url 
  }

  
  $('body').on('click', '.myFunction', function(e) {
    //alert('hhh')
    var x = document.getElementById("myTopnav");
    if (x.className === "topnav") {
      x.className += " responsive";
    } else {
      x.className = "topnav";
    }
  });
  

});





// function myFunction() {
//   alert('hhh')
//   var x = document.getElementById("myTopnav");
//   if (x.className === "topnav") {
//     x.className += " responsive";
//   } else {
//     x.className = "topnav";
//   }
// }






















function create_cookie(name, value, days2expire, path) {
  var date = new Date();
  date.setTime(date.getTime() + (days2expire * 24 * 60 * 60 * 1000));
  var expires = date.toUTCString();
  document.cookie = name + '=' + value + ';' +
                   'expires=' + expires + ';' +
                   'path=' + path + ';';
}


function retrieve_cookie(name) {
  var cookie_value = "",
    current_cookie = "",
    name_expr = name + "=",
    all_cookies = document.cookie.split(';'),
    n = all_cookies.length;
 
  for(var i = 0; i < n; i++) {
    current_cookie = all_cookies[i].trim();
    if(current_cookie.indexOf(name_expr) == 0) {
      cookie_value = current_cookie.substring(name_expr.length, current_cookie.length);
      break;
    }
  }
  return cookie_value;
}


function readURL(input, idf){
  if(input.files && input.files[0]){
    var reader = new FileReader();
    reader.onload=function(e){
      $(idf).attr('src',e.target.result);
    }
  reader.readAsDataURL(input.files[0]);
  }
}