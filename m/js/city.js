var Gilt;

if (!Gilt)      { Gilt = {}; }
if (!Gilt.City) { Gilt.City = {}; }

Gilt.isIE6 = ($.browser.msie && 7 > parseInt($.browser.version, 10));

Gilt.City.currentCity || (Gilt.City.currentCity = null);
Gilt.City.baseURI  || (Gilt.City.baseURI = '');
Gilt.City.assetURI || (Gilt.City.assetURI = '');
Gilt.City.redesign || (Gilt.City.redesign = false);
$(document).ready(function() {
  Gilt.City.assetURI = $('link:first[rel=stylesheet]').attr("href").match(/(.+)\/stylesheets/)[1];
});

Gilt.City.initWelcomePage = function() {
  if (Gilt.isIE6) {
    DD_belatedPNG.fix(".offer_shadow");
    DD_belatedPNG.fix(".label");
  }
};

Gilt.City.initMosaicPage = function(channel_id, store_id) {
  Gilt.City._channelId = channel_id;
  Gilt.City._storeId = store_id;

  if (Gilt.isIE6) {
    DD_belatedPNG.fix(".offer_shadow");
    DD_belatedPNG.fix(".sold_out_overlay");
  }
};

Gilt.City.initOfferPage = function(sale_id, channel_id, store_id) {
  Gilt.City._channelId = channel_id;
  Gilt.City._saleId = sale_id;
  Gilt.City._storeId = store_id;

  $('#offer_buy_button').click(Gilt.City.Checkout.doCheckout);
  $('#packages li.package').click(Gilt.City.selectPackage);
  $('#packages li.package').hover(Gilt.City.Packages.hoverOver, Gilt.City.Packages.hoverOut);

  $('#packages .package_option').click(Gilt.City.selectPackageOption);
  $('#packages .package_option').hover(Gilt.City.PackageOption.hoverOver, Gilt.City.PackageOption.hoverOut);

  $('#packages .package_option_wide').click(Gilt.City.selectPackageOption);
  $('#packages .package_option_wide').hover(Gilt.City.PackageOption.hoverOver, Gilt.City.PackageOption.hoverOut);

  $('.package_redemption_information:not(:first)').hide();
  $('.quantity_selector').change(Gilt.City.Packages.quantityChanged);

  if (Gilt.isIE6) {
    DD_belatedPNG.fix(".ui-icon");
    DD_belatedPNG.fix(".package_option");
    DD_belatedPNG.fix(".package_option_wide");
  }

  if ($.url.param('complete_waitlist') == 1) {
    Gilt.City.Waitlist.completeAddToWaitlist()
  }

  Gilt.City.Waitlist.updateInventory(function() {
    if ($('.package').not('.sold_out,.reserved').length > 0) {
      $('.package').not('.sold_out,.reserved').eq(0).click();
    }
    else {
      $('.package').eq(0).click();
    }

    $('div.package_option_sold_out, div.package_option_reserved').each(function() {
      $(this).css(Gilt.City.PackageOption.Styles.sold_out);
    });
  });

};

Gilt.City.initPreviewPage = function() {
  $('#share_with_a_friend').hover(Gilt.City.Share.hoverOver, Gilt.City.Share.hoverOut);
  $('#share_with_a_friend_pop_out ul li').hover(Gilt.City.Share.itemHoverOver, Gilt.City.Share.itemHoverOut);
  $('#share_email').click(Gilt.City.Share.emailModal);
};

Gilt.City.selectPackage = function() {

  $('#packages li.selected').click(Gilt.City.selectPackage).removeClass('selected');
  $('#package_error_message').html('');

  var offerPackage = Gilt.City.Packages.packageWithId(this.id);
  var packageOption = Gilt.City.PackageOption.packageOptionsByPackageId(this.id);

  if (!offerPackage)
    // Could not find offers
    return;

  $(this).unbind('click');
  $(this).addClass('selected');

  Gilt.City.selectedPackageOption = packageOption;
  
  $('input[name=sku_id]').attr('value', offerPackage.skuId);
  $('input[name=product_id]').attr('value', offerPackage.productId);
  $('input[name=address_guid]').attr('value', packageOption.addressGuid);
  $('input[name=address_street_line1]').attr('value', packageOption.streetLine1);
  $('input[name=address_street_line2]').attr('value', packageOption.streetLine2);
  $('input[name=address_city]').attr('value', packageOption.city);
  $('input[name=address_state]').attr('value', packageOption.state);
  $('input[name=address_postal_code]').attr('value', packageOption.postalCode);
  var quantitySelectorElem = $(this).find('.quantity_selector');
  var newQuantity = (quantitySelectorElem.length == 0) ? 1 : quantitySelectorElem.val();
  $('input[name=quantity]').attr('value', newQuantity);

  $('#packages .package_information').hide();
  $(this).find('.package_information').show();

  $('.package_redemption_information').hide();
  $('#redemption_information_' + offerPackage.packageId).show();

  if ($('#packages li.sold_out.selected, li.reserved.selected').length === 0) {
    Gilt.City.Checkout.changeActionButton(Gilt.City.Checkout.doCheckout, Gilt.Locale.buy_now, 'standard-bevel-large');
  }
  else {
    Gilt.City.Checkout.changeActionButton(Gilt.City.Waitlist.addToWaitlist, Gilt.Locale.add_to_wait_list, 'standard-bevel-large');
  }

  if ($(this).find('.package_option').length > 0) {
    if ($(this).find('.package_option:not(.package_option_sold_out, .package_option_reserved)').length > 0) {
      $(this).find('.package_option:not(.package_option_sold_out, .package_option_reserved):first').click();
    }
    else {
      $(this).find('.package_option:first').click();
    }
  }

  if ($(this).find('.package_option_wide').length > 0) {
    if ($(this).find('.package_option_wide:not(.package_option_sold_out, .package_option_reserved)').length > 0) {
      $(this).find('.package_option_wide:not(.package_option_sold_out, .package_option_reserved):first').click();
    }
    else {
      $(this).find('.package_option_wide:first').click();
    }
  }

  return false;
};

Gilt.City.selectPackageOption = function(ev) {
  if (ev) ev.preventDefault();
  var skuId = $(this).attr('id').replace('package_option_', '');

  var selectedPackageOption = $('#package_options .package_option_selected');
  selectedPackageOption.click(Gilt.City.selectPackageOption);
  // IE6 -!-
  if (selectedPackageOption.hasClass('package_option_sold_out') || selectedPackageOption.hasClass('package_option_reserved')) {
    selectedPackageOption.css(Gilt.City.PackageOption.Styles.sold_out);
  }
  else {
    selectedPackageOption.css(Gilt.City.PackageOption.Styles.normal);
  }
  selectedPackageOption.removeClass('package_option_selected');

  var packageOptionMatch = this.id.match(/^package_option_(.*)$/);
  if (packageOptionMatch) {
    var packageOption = Gilt.City.PackageOption.packageOptionsByPackageOptionId(packageOptionMatch[1]);
    Gilt.City.selectedPackageOption = packageOption;
  }
  
  var packageOption = Gilt.City.PackageOption.packageOptionsByPackageOptionId(skuId);

  $(this).unbind('click');
  $(this).addClass('package_option_selected');

  $('input[name=sku_id]').attr('value', skuId);
  $('input[name=address_guid]').attr('value', packageOption.addressGuid);
  $('input[name=address_street_line1]').attr('value', packageOption.streetLine1);
  $('input[name=address_street_line2]').attr('value', packageOption.streetLine2);
  $('input[name=address_city]').attr('value', packageOption.city);
  $('input[name=address_state]').attr('value', packageOption.state);
  $('input[name=address_postal_code]').attr('value', packageOption.postalCode);
  var quantitySelectorElem = $(this).find('.quantity_selector');
  var newQuantity = (quantitySelectorElem.length == 0) ? 1 : quantitySelectorElem.val();
  $('input[name=quantity]').attr('value', newQuantity);
  
  if ($('#package_options .package_option_sold_out.package_option_selected,.package_option_reserved.package_option_selected').length === 0) {
    // IE6 -!-
    $(this).css(Gilt.City.PackageOption.Styles.selected);
    Gilt.City.Checkout.changeActionButton(Gilt.City.Checkout.doCheckout, Gilt.Locale.buy_now, 'standard-bevel-large');
  }
  else {
    // IE6 -!-
    $(this).css(Gilt.City.PackageOption.Styles.sold_out_selected);
    Gilt.City.Checkout.changeActionButton(Gilt.City.Waitlist.addToWaitlist, Gilt.Locale.add_to_wait_list, 'standard-bevel-large');
  }
}


Gilt.City.Checkout = {
  changeActionButton: function(clickAction, text, classToAdd, disable) {
    if ($('#offer_buttons.ended').length > 0 && text == Gilt.Locale.add_to_wait_list) {
      $('#offer_buy_button').attr('title', 'Sale Ended');
      $('#offer_buy_button').attr('alt', 'Sale Ended');
      $('#offer_buy_button span').html('Sale Ended');

      $('#offer_buy_button').removeClass('standard-bevel-large');
      $('#offer_buy_button').addClass('gray-dialog');

      $('#offer_buy_button').unbind('click');
      $('#offer_buy_button').click(function(ev) {ev.preventDefault();});
      return;
    }

    // Set text
    $('#offer_buy_button').attr('title', text);
    $('#offer_buy_button').attr('alt', text);
    $('#offer_buy_button span').html(text);

    // Set color
    $('#offer_buy_button').removeClass('standard-bevel-large');
    $('#offer_buy_button').removeClass('gray-dialog');
    $('#offer_buy_button').addClass(classToAdd);

    // Set click action
    $('#offer_buy_button').unbind('click');
    $('#offer_buy_button').click(clickAction);
  },

  doCheckout: function(ev) {
    ev.preventDefault();
    if (Gilt.City.SimpleSignup.needToCompleteRegistration()) {
      Gilt.City.SimpleSignup.completeRegistration(Gilt.City.Checkout.doCheckout);
      return;
    }
    if (Gilt.City.Checkout.validateSkuIsSelected()) {
      if (Gilt.Cookies.get("guid") != null && Gilt.Cookies.get("guid") != "") {
        document.location = "/account/completeBbRegistration?return_url="+ encodeURIComponent("/checkout/city?" + $('form[name=buy_form]').serialize());
      } else {
        $('form[name=buy_form]').submit();
      }
      return false;
    }
  },

  validateSkuIsSelected: function() {
    if ($('input[name=sku_id]').attr('value') == '') {
      $('#sku_error_message').html('Please select an offer');
      return false;
    }
    return true;
  }
};

Gilt.City.Inventory = {}

Gilt.City.Inventory.productStatus = function(product_id, callback) {
  $.ajax({
    url: '/inventory_service/product_status',
    type: 'GET',
    data: { product_id: product_id },
    dataType: 'json',
    error: function(xhr, status, error) {
      switch (status) {
        case 'parsererror' :
          callback(product_id, null, "Could not parse:" + xhr.responseText);
          break;
        case 'timeout' :
          callback(product_id, null, 'timeout');
          break;
        case 'error' :
          callback(product_id, null, 'error');
          break;
      }
    },
    success: function(data) {
      if (data.data) {
        callback(product_id, data.data);
      }
      else {
        callback(product_id, null, data.msg);
      }
    }
  })
};

Gilt.City.Packages = {
  _packages: {},

  invalidate: function(pkg) {
    var packageId = pkg.packageId;
    var packageSelector = '#' + pkg.packageId;
    $(packageSelector).addClass('sold_out');
    $(packageSelector).removeClass('selected');
  },

  packageWithId: function(packageId) {
    return Gilt.City.Packages._packages[packageId];
  },

  quantityChanged: function(ev) {
    ev.preventDefault();
    $('input[name=quantity]').val(this.value);
  },

  registerPackage: function(packageId_, skuId_, hasManyOptions_, productId_) {
    Gilt.City.Packages._packages[packageId_] = {
      packageId: packageId_,
      skuId: skuId_,
      hasManyOptions: hasManyOptions_,
      productId: productId_
    };
  },

  hoverOver: function() {
    if ($(this).hasClass('selected')) return;
    $(this).addClass('hover');
  },

  hoverOut: function() {
    $(this).removeClass('hover');
  }

};

Gilt.City.PackageOption = {
  _packageOptions: {},
  _packageOptionsByPackageId: {},

  Styles: {
    hover: { 'background-position': '0 -165px', 'color': '#1a1a1a' },
    normal: { 'background-position': '0 -110px', 'color': '#1a1a1a' },
    selected: { 'background-position': '0 0', 'color': '#efefef' },
    sold_out: { 'background-position': '0 -110px', 'color': '#7D7D7D' },
    sold_out_selected: { 'background-position': '0 -55px', 'color': '#efefef' }
  },

  validate: function(packageOptionElemId) {
    var packageOptionSelector = '#' + packageOptionElemId;
    var packageOptionElem = $(packageOptionSelector);
    // IE6 -!-
    packageOptionElem.removeClass('package_option_reserved');
    packageOptionElem.css(Gilt.City.PackageOption.Styles.normal);
  },

  invalidate: function(packageOptionElemId) {
    var packageOptionSelector = '#' + packageOptionElemId;
    var packageOptionElem = $(packageOptionSelector);
    // IE6 -!-
    packageOptionElem.addClass('package_option_sold_out');
    packageOptionElem.css(Gilt.City.PackageOption.Styles.sold_out);
  },

  hoverOver: function() {
    if ($(this).hasClass('package_option_selected')) return;

    $(this).addClass('package_option_hover');
    // IE6 -!-
    $(this).css(Gilt.City.PackageOption.Styles.hover);
  },

  hoverOut: function() {
    if ($(this).hasClass('package_option_selected')) return;
    $(this).removeClass('package_option_hover');

    // IE6 -!-
    if ($(this).hasClass('package_option_sold_out') || $(this).hasClass('package_option_reserved')) {
      $(this).css(Gilt.City.PackageOption.Styles.sold_out);
    }
    else {
      $(this).css(Gilt.City.PackageOption.Styles.normal);
    }
  },

  registerPackageOption: function(packageOptionId_, packageId_, skuId_, addressGuid_, streetLine1_, streetLine2_, city_, state_, postal_code_, status_) {
    Gilt.City.PackageOption._packageOptions[skuId_] = {
      packageOptionId: packageOptionId_,
      skuId: skuId_,
      addressGuid: addressGuid_,
      streetLine1: streetLine1_,
      streetLine2: streetLine2_,
      city: city_,
      state: state_,
      postalCode: postal_code_,
      status: status_
    };
    Gilt.City.PackageOption._packageOptionsByPackageId[packageId_] = Gilt.City.PackageOption._packageOptions[skuId_];
  },

  packageOptionsByPackageId: function(packageId) {
    return Gilt.City.PackageOption._packageOptionsByPackageId[packageId];
  },

  packageOptionsByPackageOptionId: function(packageOptionId) {
    return Gilt.City.PackageOption._packageOptions[packageOptionId];
  }
  
};

Gilt.City.Share = {

  hoverOut: function() {
    $('#share_with_a_friend_pop_out').hide();
  },

  hoverOver: function() {
    $('#share_with_a_friend_pop_out').show();
  },

  itemHoverOut: function() {
    $(this).removeClass('share_item_hover');
  },

  itemHoverOver: function() {
    $(this).addClass('share_item_hover');
  }

};

Gilt.City.SimpleSignup = {
  completeRegistrationDialog: null,
  completeCampaignRegistrationDialog: null,
  signupCloudoverDialog: null,
  signupFooterFrame: null,

  signupCloudover: function(signupValue, opts) {
    if (null == Gilt.City.SimpleSignup.signupCloudoverDialog) {
      opts = opts || {};
      var url = '/city/signup_cloudover?signup=' + signupValue;
      if (opts.offerId) {
        url = url + '&offer_id=' + opts.offerId;
      }
      if (opts.returnURL) {
        url = url + '&return_url=' + opts.returnURL;
      } else {
        opts.returnURL = document.location.pathname;
      }
      var dialog = $('<div id="signup_cloudover_dialog">').appendTo('body')
      .load(url, function (res) {
        // Handle submit button click (including form validation)
        dialog = Gilt.Util.getDialog('simple_signup_form', {
          dialogClass: 'simple_signup_form',
          position: 'center',
          clickOverlay: false,
          overlayOpacity: "0.70",
          width: '753px',
          show: 'fade',
          hide: 'fade'
        });

        dialog.html($('#signup_cloudover_dialog'));

        $('#signup_cloudover_dialog .close').click(function(ev) {
          ev.preventDefault();
          dialog.dialog('close');
          return false;
        });

        $('#offer_register').click(Gilt.City.SimpleSignup.validateAndSubmitForm(opts.returnURL));
        $('body').append('<img src="' + document.location.protocol + '//pixels.avenue100.com/pixels/landing.png?account=Gilt" width="1" height="1" />');
        $('#city_select').change(function() {
          if ($('#city_select').val() == 'other') {
            $('#zip_code_field').show();
          } else {
            $('#zip_code_field').hide();
          }
        });

        Gilt.City.SimpleSignup.signupCloudoverDialog = dialog;
        Gilt.City.SimpleSignup.signupCloudoverDialog.dialog('open');
      });
    } else {
      Gilt.City.SimpleSignup.signupCloudoverDialog.dialog('open');
    }
  },

  signupFooter: function(signupValue, opts) {
    if (null == Gilt.City.SimpleSignup.signupFooterFrame) {
      opts = opts || {};
      var url = '/city/signup_footer?signup=' + signupValue;
      if (opts.returnURL == null) {
        opts.returnURL = document.location.pathname;
      }
      url = url + '&return_url=' + opts.returnURL;
      var frame = $('<div id="signup_footer">').appendTo('body')
      .load(url, function (res) {
        $('#email_address_input').click(function() {
          if ($('#email_address_input').val() == 'E-mail address') {
            $('#email_address_input').val('');
            $('#email_address_input').css('color', '#1B7497');
          }
        });
        $('#password_input_text').focus(function() {
          $('#password_input_text').hide();
          $('#password_input').show();
          $('#password_input').focus();
        });
        $('#footer_register').click(Gilt.City.SimpleSignup.validateAndSubmitFooter(opts.returnURL));
        $('body').append('<img src="' + document.location.protocol + '//pixels.avenue100.com/pixels/landing.png?account=Gilt" width="1" height="1" />');

        Gilt.City.SimpleSignup.signupFooterFrame = frame;
        $(Gilt.City.SimpleSignup.signupFooterFrame).animate({
          height: 'toggle'
        }, 1000);
      });
    } else {
      $(Gilt.City.SimpleSignup.signupFooterFrame).animate({
        height: 'toggle'
      }, 1000);
    }
    if (Gilt && Gilt.isIE6) {
      DD_belatedPNG.fix("#logo img");
      DD_belatedPNG.fix("#tagline img");
    }
  },

  completeRegistration: function(callback) {
    if (null == Gilt.City.SimpleSignup.completeRegistrationDialog) {
      var dialog = $('<div id="complete_registration_dialog">').appendTo('body')
      .load('/city/dialogs/complete_registration.html', function (res) {
        $('#complete-registration-modal form').submit(function (ev) {
          ev.preventDefault();
          $('#complete_registration_dialog .dialog-footer .sprite').click();
        });
        $('#complete_registration_dialog .dialog-footer .sprite').click(function (ev) {
          ev.preventDefault();
          if (Gilt.City.SimpleSignup.validateCompleteForm()) {
            var opts = {
              'guid' : $.url.param('guid') || Gilt.Cookies.get('simple_signup_guid') || '',
              'guid_hash' : $.url.param('guid_hash') || Gilt.City.SimpleSignup.hash || '',
              'user[password]' : $('#password').val(),
              'user[agree_to_terms]' : 1,
              'sso': 1
            };
            $.post('https://' + window.location.host + '/api/v2/complete_registration', opts, function(data) {
              if (data.success) {
                Gilt.Cookies.clear('complete_registration');
                Gilt.Cookies.clear('simple_signup_guid');
                document.location = data.ssoUrl + "&return_url=" + encodeURIComponent(window.location.pathname);
              }
            }, "json");
          }
        });
        dialog = Gilt.Util.getDialog('complete_registration', {
          dialogClass: 'complete_registration',
          position: 'center',
          clickOverlay: false,
          overlayOpacity: "0.70",
          show: 'fade',
          hide: 'fade'
        });

        dialog.html($('#complete_registration_dialog'));

        $('#continue_shopping_button').click(function(ev) {
          ev.preventDefault();
          dialog.dialog('close');
          return false;
        });

        $('#complete_registration_dialog .close').click(function(ev) {
          ev.preventDefault();
          dialog.dialog('close');
          return false;
        });

        Gilt.City.SimpleSignup.completeRegistrationDialog = dialog;
        Gilt.City.SimpleSignup.completeRegistrationDialog.dialog('open');
      });
    }
    else {
      Gilt.City.SimpleSignup.completeRegistrationDialog.dialog('open');
    }
  },

  needToCompleteRegistration: function() {
    if (Gilt.City.SimpleSignup.completeRegistrationRequired) {
      return true;
    }
    return false;
  },

  validateAndSubmitFooter: function(returnURL) {
    return function(ev, ops) {
      ev.preventDefault();
      if (Gilt.City.SimpleSignup.validateFooter()) {
        $('#footer_register').unbind('click');

        var emailAddress = $('#email_address_input').val();
        var password = $('#password_input').val();
        var agreeToTerms = "1";
        var city_string = (GC.city.id > 0) ? GC.city.id + ":1" : "";

        var params = {
          "pkey" : Gilt.Cookies.get("pkey") || '',
          "user[email_address]": emailAddress,
          "user[password]": password,
          "user[email_preferences][city]": "1",
          "user[cities]": city_string,
          "user[agree_to_terms]": agreeToTerms,
          "user[welcome_message]": true
        }

        $.post('/api/v2/register_simple', params, function(data) {
          if (data.success) {
            Gilt.Cookies.set('t_register_simple', 1, 'session');
            Gilt.Cookies.set('t_register_pkey', Gilt.Cookies.get('pkey'), 'session');
            $.each(data.cookies, function () {
              if ("usermeta" === this.k) {
                Gilt.Cookies.set(this.k, JSON.parse(decodeURIComponent(this.v)));
              } else if ("email" === this.k) {
                Gilt.Cookies.set(this.k, decodeURIComponent(this.v));
              } else {
                Gilt.Cookies.set(this.k, this.v);
              }
            });

            returnURL = returnURL ? returnURL : "/city";

            document.location = Gilt.City.baseURI + decodeURIComponent(returnURL);
          }
          else {
            for (var errNum = 0; errNum < data.msg.length; ++errNum) {
              alert(data.msg[errNum]);
            }
            $('#footer_register').click(Gilt.City.SimpleSignup.validateAndSubmitFooter(returnURL));
          }

          if (ops && ops.callback) {
            ops.callback(data);
          }
        }, "json");
      }
    }
  },

  validateAndSubmitForm: function(returnURL) {
    return function(ev,ops) {
      ev.preventDefault();
      if (Gilt.City.SimpleSignup.validateForm()) {
        $('#offer_register').unbind('click');

        var emailAddress = $('#email_address_input').val();
        var password = $('#password_input').val();
        var agreeToTerms = "1";

        var params = {
          "pkey" : Gilt.Cookies.get("pkey") || '',
          "user[email_address]": emailAddress,
          "user[password]": password,
          "user[email_preferences][city]": "1",
          "user[agree_to_terms]": agreeToTerms,
          "user[welcome_message]": true
        }

        if ($('#city_subscriptions').length > 0) {
          params["user[cities]"] = $('#city_subscriptions').val();
          if ($('#city_select').val() == 'other') {
            params["user[postal_code]"] = $('#zip_code_input').val();
          }
        }
        else {
          var postalCode = ($('#city_select').val() == 'other') ? $('#zip_code_input').val() : $('#city_select').val();
          params["user[postal_code]"] = postalCode;
        }

        var isInvitee = false;

        if ($('#referring_nickname').length > 0) {
          params["user_pending[referring_nickname]"] = $('#referring_nickname').val();
          isInvitee = true;
        }
        if ($('#invitation_id').length > 0) {
          params["user[invitation_id]"] = $('#invitation_id').val();
          isInvitee = true;
        }

        $.post('/api/v2/register_simple', params, function(data) {
          if (data.success) {
            Gilt.Cookies.set('t_register_simple', 1, 'session');
            Gilt.Cookies.set('t_register_pkey', Gilt.Cookies.get('pkey'), 'session');
            Gilt.Cookies.set('city', (postalCode ? $('#city_key_' + postalCode).val() : ''), 15552000); // Approx 6 months
            if(isInvitee) {
              // Set the invitatee registration cookie - this will cause a banner to be displayed when this user signs in
              Gilt.Cookies.set('invitee_registration', 1, 'session');
            }

            // JAPAN-1507: Hack for IE7's cookie limit - ptc (promotion tracking code) shouldn't be chopped off.
            if(data.cookies['ptc'] !== null) {
              Gilt.Cookies.set('ptc', data.cookies['ptc']);
              delete data.cookies['ptc'];
            }

            $.each(data.cookies, function () {
              if ("usermeta" === this.k) {
                Gilt.Cookies.set(this.k, JSON.parse(decodeURIComponent(this.v)));
              } else if ("email" === this.k) {
                Gilt.Cookies.set(this.k, decodeURIComponent(this.v));
              } else {
                Gilt.Cookies.set(this.k, this.v);
              }
            });

            returnURL = returnURL ? returnURL : "/city";

            document.location = Gilt.City.baseURI + decodeURIComponent(returnURL);
          }
          else {
            for (var errNum = 0; errNum < data.msg.length; ++errNum) {
              $('#service_errors').append('<li>' + data.msg[errNum] + '</li>');
            }
            $('#offer_register').click(Gilt.City.SimpleSignup.validateAndSubmitForm(returnURL));
          }
          
          if (ops && ops.callback) {
            ops.callback(data);
          }
        }, "json");
      }
    }
  },

  validateCompleteForm: function() {
    $('#complete-reg-form .error').remove();
    var numErrors = 0;
    if ($('#password').val() === '' || $('#password_confirm').val() === '' || $('#password').val() != $('#password_confirm').val()) {
      $('<div class="error">Password is required and passwords must match</div>').insertAfter('#label_password');
      ++numErrors;
    }
    return (numErrors === 0) ? true : false;
  },

  validateFooter: function() {
    var numErrors = 0, txt;
    var emailValue = $('#email_address_input').val();
    if (emailValue === '') {
      $('#email_address_input').val('E-mail address');
      $('#email_address_input').css('color', 'red');
      ++numErrors;
    } else if (!emailValue.match(/^[A-Z0-9\._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,4}$/i)) {
      $('#email_address_input').val('E-mail address');
      $('#email_address_input').css('color', 'red');
      ++numErrors;
    }

    var passValue = $('#password_input').val();
    $('#password_input_text').focus(function() {
      $('#password_input_text').hide();
      $('#password_input').show();
      $('#password_input').focus();
    });
    if (passValue === '') {
      $('#password_input').hide();
      $('#password_input_text').show();
      $('#password_input_text').val('Password');
      $('#password_input_text').css('color', 'red');
      ++numErrors;
    } else if (passValue.length < 5) {
      $('#password_input').hide();
      $('#password_input_text').show();
      $('#password_input_text').val('At least 5 characters');
      $('#password_input_text').css('color', 'red');
      ++numErrors;
    }

    if (numErrors > 0) return false;
    return true;
  },

  validateForm: function() {
    $('#simple_signup_form .error').text('');
    $('#service_errors').text('');
    $('#agree_terms_field label').removeClass('bad');

    var numErrors = 0, txt;
    var emailValue = $('#email_address_input').val();
    if (emailValue === '') {
      txt = Gilt.Locale.email_is_required;
      ++numErrors;
    } else if (!emailValue.match(/^[A-Z0-9\._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,4}$/i)) {
      txt = Gilt.Locale.email_is_invliad;
      ++numErrors;
    } else {
      txt = '';
    }
    
    $('#email_address_label .error').text(txt);
    
    if($('#password_input').length > 0) {
      var passValue = $('#password_input').val();
      if (passValue === '') {
        txt = Gilt.Locale.password_is_required;
        ++numErrors;
      } else if (passValue.length < 5) {
        txt = Gilt.Locale.password_too_short;
        ++numErrors;
      } else {
        txt = '';
      }
      $('#password_label .error').text(txt);
    }

    if ($('#agree_terms_checkbox').length > 0) {
      if ($('#agree_terms_checkbox:checked').length == 0) {
        txt = 'you must agree to the terms of service';
        ++numErrors;
      } else {
        txt = '';
      }
      $('#agree_terms_field .error').text(txt);
    }

    if ($('#city_select').val() === '') {
      $('#city_label .error').html('<br />you must select a city or \'Other\'');
      ++numErrors;
    } else if ($('#city_select').val() == 'other') {
      if (!/^[0-9]{5}$/.test($('#zip_code_input').val() ) ) {
        var error = $('#zip_code_label .error');
        if (error.size() == 0) {
          error = $('#city_label .error');
          error.html('zip code is required');
        } else {
          error.html('<br />zip code is required');
        }
        
        
        ++numErrors;
      }
    }

    if (numErrors > 0) return false;
    return true;
  },
  
  campaignCloudover: function(callback) {
    if (null == Gilt.City.SimpleSignup.completeCampaignRegistrationDialog) {
      var dialog = $('<div id="complete_campaign_registration_dialog">').appendTo('body')
      .load('/city/dialogs/complete_campaign_signup.html', function (res) {
        dialog = Gilt.Util.getDialog('complete_campaign_registration', {
          dialogClass: 'simple_signup_form',
          width: '592px',
          position: 'center',
          clickOverlay: false,
          overlayOpacity: "0.70",
          show: 'fade',
          hide: 'fade'
        });

        dialog.html($('#complete_campaign_registration_dialog'));

        $('#complete_campaign_registration_dialog .close').click(function(ev) {
          ev.preventDefault();
          dialog.dialog('close');
          return false;
        });

        Gilt.City.SimpleSignup.completeCampaignRegistrationDialog = dialog;
        Gilt.City.SimpleSignup.completeCampaignRegistrationDialog.dialog('open');
      });
    }
    else {
      Gilt.City.SimpleSignup.completeCampaignRegistrationDialog.dialog('open');
    }
  }
};

Gilt.City.Deal = {
  successDialogModal: null,
  successDialog: function(dealName, discountText) {
    if (Gilt.City.Deal.successDialogModal == null) {
      var dialog = $('<div id="deal_success_dialog">').appendTo('body')
      .load('/city/dialogs/deal_success.html', function(res) {
        dialog = Gilt.Util.getDialog('deal_success', {
          dialogClass: 'deal_success',
          width: '592px',
          position: 'center',
          clickOverlay: true,
          overlayOpacity: "0.70",
          show: 'fade',
          hide: 'fade'
        });

        dialog.html($('#deal_success_dialog'));

        $('#deal_success_button').click(function(ev) {
          ev.preventDefault();
          dialog.dialog('close');
          return false;
        });

        Gilt.City.Deal.successDialogModal = dialog;
        $('#discount_text').text(discountText);
        $('#deal_name').text(dealName);
        Gilt.City.Deal.successDialogModal.dialog('open');
      });
    } else {
      Gilt.City.Deal.successDialogModal.dialog('open');
    }
  }
};


Gilt.City.InvitedSignup = (function () {
  var selected_cities = [], available_cities = [],

  validateForm = function() {
    $('.invited_signup #invited_registration_form #service_errors').text('');

    var numErrors = 0;
    var existingMember = $('#invited_registration_form input:radio[name=existing_member]:checked').val();
    if (existingMember != "1" && existingMember != "0") {
      $('.invited_signup #invited_registration_form #service_errors').append('<li>' + Gilt.Locale.invited_signup_error('N') + '</li>');
      ++numErrors;
    }

    var emailValue = $('#email_address').val();
    if (emailValue === '') {
      $('.invited_signup #invited_registration_form #service_errors').append('<li>' + Gilt.Locale.invited_signup_error('E') + '</li>');
      ++numErrors;
    }
    else if (!/^[\w\+\-]+(\.[\w\+\-]+)*@([a-zA-Z0-9\-]+\.)+[a-zA-Z]{2,}$/i.test(emailValue)) {
      $('.invited_signup #invited_registration_form #service_errors').append('<li>' + Gilt.Locale.invited_signup_error('F') + '</li>');
      ++numErrors;
    }

    if ($('#password').val() === '') {
      $('.invited_signup #invited_registration_form #service_errors').append('<li>' + Gilt.Locale.invited_signup_error('P') + '</li>');
      ++numErrors;
    }

    if ($('#agree_terms:checked').length == 0) {
      $('.invited_signup #invited_registration_form #service_errors').append('<li>' + Gilt.Locale.invited_signup_error('T') + '</li>');
      ++numErrors;
    }

    if (numErrors > 0) return false;
    return true;
  },

  disableButton = function() {
    $('#invited_registration_submit').unbind('click');
    $('#invited_registration_submit').click(function(ev2) {
      ev2.preventDefault();
    });
    $('#invited_registration_submit span').html('<img src="/images/city/buttons/ajax-loader.gif" width="20" height="20" alt="*" /> <b>' + Gilt.Locale.please_wait + '</b>');
    $('#invited_registration_submit span').addClass('city_loading');
  },

  enableButton = function() {
    $('#invited_registration_submit span').html(Gilt.Locale.register);
    $('#invited_registration_submit span').removeClass('city_loading');
    $('#invited_registration_submit').unbind('click');
    $('#invited_registration_submit').click(Gilt.City.InvitedSignup.validateAndSubmitForm);
  },

  getParams = function() {
    var params = {};
    var emailAddress = $('#email_address').val();
    var password = $('#password').val();
    var invitationId = $('#invitation_id').val();
    var agreeToTerms = "1";
    var existingMember = $('#invited_registration_form input:radio[name=existing_member]:checked').val();

    if (existingMember == "0") {
      var subscribe = "1";
      // Formatting selected cities to send them to the registration api
      var city_ids = new Array();
      var temp = new Array();
      for (var i in selected_cities) {
        temp = selected_cities[i].split(":");
        //Possible bug zone for ie
        city_ids.push(temp[0]);
      }
      if (city_ids.length > 0) {
        var city_string = city_ids.join(":1,") + ":1";
      } else {
        var city_string = '';
      }
      params["url"] = '/api/v2/register_simple';
      params["data"] = {
        "user[agree_to_terms]": agreeToTerms,
        "user[email_address]": emailAddress,
        "user[email_preferences][city]": subscribe,
        "user[password]": password,
        "user[cities]": city_string,
        "user[invitation_id]": invitationId,
        "user[welcome_message]": true
      }
      params["successFunction"] = handleRegSuccess;
    } else {
      params["url"] = '/api/v2/login';
      params["data"] = {
        "email": emailAddress,
        "password": password
      }
      params["successFunction"] = handleLoginSuccess;
    }
    return params;
  },

  handleRegSuccess = function(data) {
    setCookies(data.cookies, performRedirect)
  },

  handleLoginSuccess = function(data) {
    setCookies(data.cookies, updateEmailPreferences);
  },

  setCookies = function(cookies, callback) {
    $.each(cookies, function () {
      if ("usermeta" === this.k) {
        Gilt.Cookies.set(this.k, JSON.parse(decodeURIComponent(this.v)));
      } else if ("email" === this.k) {
        Gilt.Cookies.set(this.k, decodeURIComponent(this.v));
      } else {
        Gilt.Cookies.set(this.k, this.v);
      }
    });
    callback();
  },

  updateEmailPreferences = function() {
    params = {};
    for (i in selected_cities) {
      params["city_reminders[" + selected_cities[i].split(":")[1] + "]"] = "1";
    }
    $.ajax({
      url: "/account/update_email_preferences_json",
      data: params,
      type: "post",
      dataType: "json",
      error: function() {
        genericError();
      },
      success: function(data) {
        if (data.success) {
          performRedirect();
        } else {
          genericError();
        }
      }
    });
  },

  performRedirect = function() {
    window.location = "http://" + location.host;
  },

  genericError = function() {
    $('.invited_signup #invited_registration_form #service_errors').append('<li>'+ Gilt.Locale.generic_error + '</li>');
    enableButton();
  }

  return {
    validateAndSubmitForm: function(ev) {
      ev.preventDefault();
      if (validateForm()) {
        disableButton();
        available_cities = [];
        selected_cities = [];

        // Get checked city information
        available_cities = $('#available_cities').val().split(" ");
        var city_key = "";
        var temp = [];
        for (var i in available_cities) {
          temp = available_cities[i].split(":");
          //Possible bug zone for ie
          city_key = temp[1];
          if ($('#city_reminders_' + city_key + ':checked') && $('#city_reminders_' + city_key + ':checked').val() == "1") {
            selected_cities.push(available_cities[i]);
          }
        }

        params = getParams();

        $.ajax({
          url: params["url"],
          data: params["data"],
          dataType: "json",
          type: "post",
          error: function() {
            genericError();
          },
          success: function(data) {
            if (data.success) {
              //Possible bug zone for ie
              params["successFunction"](data);
            } else {
              for (var errNum = 0; errNum < data.msg.length; ++errNum) {
                $('.invited_signup #invited_registration_form #service_errors').append('<li>' + data.msg[errNum] + '</li>');
              }
              enableButton();
            }
          }
        });
      }
    }
  }

}());


Gilt.City.Survey = {
  init: function() {
    $('ul.rating li').mouseover(function() {
      Gilt.City.Survey.showText($(this));
      Gilt.City.Survey.starOnCascade($(this),"star_hover");
    }).mouseout(function() {
      Gilt.City.Survey.hideText($(this));
      Gilt.City.Survey.starOffCascade($(this),"star_hover");
    }).mouseup(function() {
      // Find the currently selected item
      var item = $(this);
      var index = Gilt.City.Survey.getItemIndex(item);
      // Set the index
      Gilt.City.Survey.getParent(item).find("input").val("" + index);
      // Show the text
      Gilt.City.Survey.showText(item);
      // Set the stars
      Gilt.City.Survey.starOnCascade(item,"star_on");
    });
      $('div.rating_question').each (function() {
        // Set the rating
        var index = $(this).find('input').val();
        if(index != '') {
          var item = $(this).find('li:eq(' + index + ')');
          // Show the text
          Gilt.City.Survey.showText(item);
          // Set the stars
          Gilt.City.Survey.starOnCascade(item,"star_on");
        }
      });
  },
  getParent : function(item) {
    return item.closest("div.rating_question");
  },
  starOnCascade : function(item, className) {
    item.addClass(className);
    item.prevAll().each(function() {
      $(this).addClass(className);
    });
    item.nextAll().each(function() {
      $(this).removeClass(className);
    });
  },
  getItemIndex : function(item) {
    return item.parent().find('li').index(item);
  },
  starOffCascade : function(item,className) {
    item.parent().children().removeClass(className);
    var parent = this.getParent(item);
    var index = parent.find('input').val();
    if(index >= 0) {
      parent.find("div#rating_text_" + index).show();
    }
  },
  showText : function(item) {
    var parent = this.getParent(item);
    this.hideText(item);
    // Show the text this start corresponds to
    var index = Gilt.City.Survey.getItemIndex(item);
    parent.find("div#rating_text_" + index).show();
  },
  hideText : function(item) {
    var parent = this.getParent(item);
    parent.find("div.rating_text").hide();
  }
}
Gilt.City.SurveyResponse = {
  init: function() {
    $("#invite_form").submit(function(){
        var emails = '';
        $("input.invite").each( function() { if($(this).val() != '') emails += $(this).val() + ',' }  );
        if(emails != '') {
          $.post(
              "/city/account/invite/service/create_invitation" ,
             'email_addresses=' + emails,
             function(data){
               $("#invite_form").hide();
               $("#invite_results").show();
             }
           );
         }
         return false;
     });
     $("#submit_thoughts").click(function(){
        var thoughts = $("textarea[name=thoughts]");
        var email = $("input[name=email]");
        var phone = $("input[name=phone]");
        $("#thoughts_error").hide();
        $("#email_error").hide();
        if(thoughts.val() == '' || thoughts.val() == thoughts.attr('title')) {
          $("#thoughts_error").show();
        } else if(email.val() == '' || email.val() == email.attr('title')) {
          $("#email_error").show();
        } else {
          $.post(
             "/city/survey/" ,
             { filled_survey_guid: $("input[name=filled_survey_guid]").val(), thoughts: thoughts.val(), email: email.val(), phone: phone.val() != phone.attr('title') ? phone.val() : '', submit_thoughts: true },
            function(data){
              $("#thoughts_form").hide();
              $("#thoughts_results").show();
            }
          );
        }
        return false;
      });
    $('input[title], textarea').each(function() {
     if($(this).val() === '') {$(this).val($(this).attr('title'));}

     $(this).focus(function() {
      if($(this).val() === $(this).attr('title')) {$(this).val('');}
     });

     $(this).blur(function() {
      if($(this).val() === '') {$(this).val($(this).attr('title'));}
     });
    });
  }
}

Gilt.City.PromoSignup = {
  promoSignupCloudoverDialog: null,
  ssoURL: null,
  registrationUrl: null,
  modalImageUrl: null,
  urlKey: null,

  initPromoSignup: function(registrationUrl, modalImageUrl, urlKey) {
    $('#offer_rsvp_img').click(Gilt.City.PromoSignup.promoSignupCloudover);
    $('#offer_rsvp_button').click(Gilt.City.PromoSignup.promoSignupCloudover);
    this.registrationUrl = registrationUrl;
    this.modalImageUrl = modalImageUrl;
    this.urlKey = urlKey;
  },

  promoSignupCloudover: function() {
    if (null == Gilt.City.PromoSignup.promoSignupCloudoverDialog) {
      var data = {
        city: GC.city.name,
        promo_tagline: $('#offer_title h1').html(),
        promo_url_key: Gilt.City.PromoSignup.urlKey,
        modal_image_url: Gilt.City.PromoSignup.modalImageUrl
      };
      var dialog = $('<div id="promo_signup_cloudover_dialog">').appendTo('body')
        .load('/city/promo_signup', data, function (res) {
        // Handle submit button click (including form validation)
        dialog = Gilt.Util.getDialog('simple_signup_form', {
          dialogClass: 'simple_signup_form',
          position: 'center',
          clickOverlay: false,
          overlayOpacity: "0.70",
          width: '753px',
          show: 'fade',
          hide: 'fade'
        });

        dialog.html($('#promo_signup_cloudover_dialog'));

        $('.simple_signup_form a.ui-dialog-titlebar-close').click(function(ev) {
          ev.preventDefault();
          dialog.dialog('close');
          if (Gilt.City.PromoSignup.ssoURL != null) {
            document.location = Gilt.City.PromoSignup.ssoURL + "&return_url=" + encodeURIComponent(window.location.pathname);
          } else {
            document.location = Gilt.City.baseURI + window.location.pathname
          }
          return false;
        });

        $('#promo_register').click(Gilt.City.PromoSignup.validateAndRegisterForm);
        $('#promo_rsvp').click(Gilt.City.PromoSignup.validateAndUpdateForm);

        Gilt.City.PromoSignup.promoSignupCloudoverDialog = dialog;
        Gilt.City.PromoSignup.promoSignupCloudoverDialog.dialog('open');
      });
    } else {
      Gilt.City.PromoSignup.promoSignupCloudoverDialog.dialog('open');
    }
  },

  validateAndRegisterForm: function() {
    if (Gilt.City.PromoSignup.validateForm(true)) {
      $('#promo_register').unbind('click');

      var firstName = $('#first_name_input').val();
      var lastName = $('#last_name_input').val();
      var emailAddress = $('#email_address_input').val();
      var password = $('#password_input').val();
      var postalCode = $('#city_select').val();
      var agreeToTerms = "1";

      var params = {
        "pkey" : Gilt.Cookies.get("pkey") || '',
        "user[first_name]": firstName,
        "user[last_name]": lastName,
        "user[email_address]": emailAddress,
        "user[password]": password,
        "user[email_preferences][city]": "1",
        "user[postal_code]": postalCode,
        "user[agree_to_terms]": agreeToTerms,
        "user[welcome_message]": true,
        "sso": 1
      }

      $.getJSON(Gilt.City.PromoSignup.registrationUrl + '?callback=?', params, function(data) {
        if (data.success) {
          $.each(data.cookies, function () {
            if ("usermeta" === this.k) {
              Gilt.Cookies.set(this.k, JSON.parse(decodeURIComponent(this.v)));
            } else if ("email" === this.k) {
              Gilt.Cookies.set(this.k, decodeURIComponent(this.v));
            } else {
              Gilt.Cookies.set(this.k, this.v);
            }
          });
          Gilt.City.PromoSignup.ssoURL = data.ssoUrl;
          Gilt.City.PromoSignup.sendRsvpNotification(firstName, lastName, emailAddress, data.guid, true);
        }
        else {
          for (var errNum = 0; errNum < data.msg.length; ++errNum) {
            $('#service_errors').append('<li>' + data.msg[errNum] + '</li>');
          }
          $('#promo_register').click(Gilt.City.PromoSignup.validateAndRegisterForm);
        }
      }, "json");
    }
  },

  validateAndUpdateForm: function() {
    if (Gilt.City.PromoSignup.validateForm(false) ) {
      $('#promo_rsvp').unbind('click');
      var firstName = $('#first_name_input').val();
      var lastName = $('#last_name_input').val();
      var emailAddress = $('#email_address_input').val();
      var guid = Gilt.Cookies.get("guid");
      Gilt.City.PromoSignup.sendRsvpNotification(firstName, lastName, emailAddress, guid, false);
    }
  },

  validateForm: function(isNewRegistration) {
    $('#simple_signup_form .error').text('');
    $('#service_errors').text('');

    var numErrors = 0;
    var emailValue = $('#email_address_input').val();
    if (emailValue === '') {
      $('#email_address_label .error').text('email address is required');
      ++numErrors;
    }
    else if (!/^[\w\+\-]+(\.[\w\+\-]+)*@([a-zA-Z0-9\-]+\.)+[a-zA-Z]{2,}$/i.test(emailValue)) {
      $('#email_address_label .error').text('is incorrectly formatted');
      ++numErrors;
    }

    if (isNewRegistration && $('#password_input').val() === '') {
      $('#password_label .error').text('password is required');
      ++numErrors;
    }

    if ($('#first_name_input').val() === '') {
      $('#first_name_label .error').text('first name is required');
      ++numErrors;
    }

    if ($('#last_name_input').val() === '') {
      $('#last_name_label .error').text('last name is required');
      ++numErrors;
    }

    if (numErrors > 0) return false;
    return true;
  },
  
  sendRsvpNotification: function(firstName, lastName, emailAddress, userGuid, isNewRegistration) {
    var cityName = $('#city_select').attr('name').replace('city_select_', '');
    if (Gilt.City.PromoSignup.promoSignupCloudoverDialog != null) {
      var rsvpData = {
        first_name: firstName,
        last_name: lastName,
        email_address: emailAddress,
        guid: userGuid,
        city: cityName,
        is_new_member: isNewRegistration != undefined ? isNewRegistration : false,
        promo_tagline: $('#offer_title h1').html(),
        promo_url_key: Gilt.City.PromoSignup.urlKey,
        modal_image_url: Gilt.City.PromoSignup.modalImageUrl
      };
      var dialogContent = $('<div id="promo_signup_cloudover_dialog">').load('/city/promo_rsvp', rsvpData);
      Gilt.City.PromoSignup.promoSignupCloudoverDialog.html(dialogContent);
    } else {
      // not possible, return
      return;
    }
  }
}

Gilt.City.Waitlist = {
  updateInventory: function(callback) {
    if ($('.package.reserved').length === 0 && $('#package_options .package_option_reserved').length === 0) {
      if ($('#offer_buttons.ended').length > 0) {
        $('#offer_buttons').remove();
      }
      callback();
      return;
    }

    var skuIds = [];
    $('.package.reserved').each(function(idx, elem) {
      var elemId = $(elem).find('.waitlist')[0].id;
      skuIds.push(elemId.replace('waitlist_', ''));
    });

    $('.package_option_reserved').each(function(idx, elem) {
      var elemId = elem.id;
      skuIds.push(elemId.replace('package_option_', ''));
    });

    var numSkus = skuIds.length;
    var hasWaitlistedItems = false;

    var waitlistChecker = function(skuId) {
      $.ajax({
        url: '/waitlist_service/notified_user_for_sku',
        type: 'GET',
        data: { user_guid: Gilt.Cookies.get("guid"), sku_id: skuId },
        dataType: 'json',
        success: function(data) {
          if (data && data.data && data.data.notified) {
            if ($('#packages .package.reserved #waitlist_' + skuId).length > 0) {
              $('#packages .package.reserved #waitlist_' + skuId).hide();
              $('span#waitlist_' + skuId).closest('li').removeClass('reserved').addClass('wli');
              hasWaitlistedItems = true;
            }
            else if ($('#package_options #package_option_'+skuId+'.package_option_reserved').length > 0) {
              var packageOptionElem = $('#package_options #package_option_'+skuId+'.package_option_reserved');
              // IE6 -!-
              packageOptionElem.removeClass('package_option_reserved');
              packageOptionElem.css(Gilt.City.PackageOption.Styles.normal);
              var packageElem = packageOptionElem.closest('.package');
              packageElem.removeClass('sold_out');
              packageElem.find('.waitlist').hide();
              hasWaitlistedItems = true;
            }
          }

          --numSkus;

          if (numSkus === 0 && !hasWaitlistedItems && $('.wli').length == 0 && $('#offer_buttons.ended').length > 0) {
            $('#offer_buttons').remove();
          }
          callback();
        }
      })
    };

    for (var idx = 0; idx < skuIds.length; ++idx) {
      var skuId = skuIds[idx];
      waitlistChecker(skuId);
    }
  },

  completeAddToWaitlist: function() {
    var packageId = $.url.param('package_id');
    var quantity = $.url.param('quantity');
    var skuId = $.url.param('sku_id');
    var packageElem = $('#' + packageId);
    packageElem.click();
    packageElem.find('.quantity_selector').val(quantity);
    $('form[name=buy_form]').find('input[name=quantity]').val(quantity);
    $('#package_option_' + skuId).click();
    Gilt.City.Waitlist.addToWaitlist();
  },

  addToWaitlist: function(ev) {
    if (ev) ev.preventDefault();
    var waitlistElement = $(this);
    var packageId = $('li.package.selected').id();
    var quantity = $('form[name=buy_form]').find('input[name=quantity]').val();
    var skuId = $('form[name=buy_form]').find('input[name=sku_id]').val();

    if (Gilt.City.SimpleSignup.needToCompleteRegistration()) {
      Gilt.City.SimpleSignup.completeRegistration(Gilt.City.Waitlist.addToWaitlist);
      return;
    }

    if (!Gilt.Cookies.get("guid")) {
      var dialog = $('<div id="complete_add_to_waitlist_dialog">').appendTo('body')
      .load('/city/dialogs/complete_add_to_waitlist.html', function (res) {
        // Handle submit button click (including form validation)
        dialog = Gilt.Util.getDialog('waitlist_confirmation', {
          dialogClass: 'waitlist_confirmation',
          position: 'center',
          clickOverlay: true,
          overlayOpacity: "0.70",
          show: 'fade',
          hide: 'fade'
        });

        var returnUrl = window.location.pathname + "?package_id=" + packageId + "&sku_id=" + skuId + "&quantity=" + quantity + "&complete_waitlist=1";
        var registerUrl = "/account/register?return_url=" + encodeURIComponent(returnUrl + '&');
        var loginUrl = "/ml?return_url=" + encodeURIComponent(returnUrl);

        dialog.html($('#complete_add_to_waitlist_dialog'));
        dialog.dialog('open');

        $('#wl_login_button').attr('href', loginUrl);
        $('#wl_register_button').attr('href', registerUrl);

        $('#waitlist_confirmation .close').click(function(ev) {
          ev.preventDefault();
          dialog.dialog('close');
          return false;
        });
      });
      dialog.dialog('open');
      return;
    }

    $.getJSON('/waitlist_service/create', { deliver_to: 'e', sale_id: Gilt.City._saleId, store_id: Gilt.City._storeId, channel_id: Gilt.City._channelId, quantity: quantity, sku_id: skuId, user_guid: Gilt.Cookies.get("guid") }, function() {

      $('#waitlist_added').html(
        '<a class="close" href="#">' + Gilt.Locale.close + '</a>\n'+
        '<span id="waitlist_title">' + Gilt.Locale.wait_list_confirmation + '</span>'+
        '<div id="waitlist_message"><h2 id="waitlist_added_title">' + Gilt.Locale.item_added_to_wait_list + '</h2>\n'+
        '<a id="continue_shopping_button" class="sprite standard-bevel-large" href="" title="' + Gilt.Locale.continue_shopping + '" alt="' + Gilt.Locale.continue_shopping + '">'+
        '<div class="sprite-left"></div><div class="sprite-right"></div>'+
        '<span>' + Gilt.Locale.continue_shopping + '</span></a></div>'
      );

      dialog = Gilt.Util.getDialog("waitlist_confirmation", {
        dialogClass: 'waitlist_confirmation',
        position: 'center',
        clickOverlay: false,
        overlayOpacity: "0.70",
        show: 'fade',
        hide: 'fade'
      });

      dialog.html($('#waitlist_added'));
      dialog.dialog('open');

      $('#continue_shopping_button').click(function(ev) {
        ev.preventDefault();
        dialog.dialog('close');
        return false;
      });

      $('a.close').click(function(ev) {
        ev.preventDefault();
        dialog.dialog('close');
        return false;
      });
    }, function() {});
  }
};

// LEGACY
var gg;
if (!gg) { gg = {}; }
gg.site_feedback_set_loading = function(id) {
  $("#" + id).html(Gilt.Locale.submitting_feedback);
};

if (!gg.FixIE) { gg.FixIE = {}; }
gg.FixIE.Sprites = function() {
  $("a.sprite, button.sprite").each(function() {
    var sizingClone = $(this).clone();
    sizingClone.appendTo("body");
    $(this).css({ width: sizingClone.width() });
    sizingClone.remove();
  }).filter("a.sprite-scalable")
      .hover(function(){
        if ($(this).hasClass("sprite-scalable-nodownstate")) {
          $(this).addClass("sprite-scalable-nodownstate-hover");
        } else {
          $(this).addClass("sprite-scalable-hover");
        }
      }, function() {
        $(this)
          .removeClass("sprite-scalable-nodownstate-hover")
          .removeClass("sprite-scalable-hover");
      })
      .mousedown(function() {
        if ($(this).hasClass("sprite-scalable-nodownstate")) {
          $(this).addClass("sprite-scalable-nodownstate-active");
        } else {
          $(this).addClass("sprite-scalable-active");
        }
      })
      .mouseup(function() {
        $(this)
          .removeClass("sprite-scalable-nodownstate-active")
          .removeClass("sprite-scalable-active");
      });
};

Gilt.Layout = {};

Gilt.Layout.Dropdown = {};

Gilt.Layout.Dropdown.show = function (menu) {
  menu = $(menu);
  Gilt.Layout.Dropdown.hideAll();

  menu.addClass('hover');
  menu.find("ul").show(); // new
};

Gilt.Layout.Dropdown.hide = function (menu) {
  menu = $(menu);
  menu.find("ul:visible").hide(); // new
  menu.removeClass('hover');
};

Gilt.Layout.Dropdown.hideAll = function () {
  $("#locale_filter_selected ul:visible, #offer_drop_down ul:visible, #city_drop_down_arrow ul:visible, #city_drop_down ul:visible").hide(); // new
};

Gilt.Layout.init = function () {
  if (Gilt.isIE6) {
    DD_belatedPNG.fix(".tag_line_image");
    DD_belatedPNG.fix("#visit_gilt");
    DD_belatedPNG.fix("#aff_wsj img");
  }
  $("#locale_filter_selected, #offer_drop_down, #city_drop_down_arrow, #city_drop_down").mouseenter(function() {
    if ($(this).find(".drop_down_list").length) {
      Gilt.Layout.Dropdown.show(this);
    }
    if (Gilt.isIE6) {
    	if ($("#locale_filter_selected .hover")) {
            DD_belatedPNG.fix("#offer_drop_down .hover");
        }
        if ($("#offer_drop_down .hover")) {
          DD_belatedPNG.fix("#offer_drop_down .hover");
        }
        if ($("#city_drop_down_arrow .hover")) {
          DD_belatedPNG.fix("#city_drop_down_arrow .hover");
        }
        if ($("#city_drop_down .hover")) {
          DD_belatedPNG.fix("#city_drop_down .hover");
        }
    }

  });
  $("#tag_line_image_link").mouseenter(function() {
    if ($(this).siblings().find(".drop_down_list").length) {
      Gilt.Layout.Dropdown.show($(this).siblings().find(".drop_down_list").parent());
    }
    if (Gilt.isIE6) {
    	if ($("#locale_filter_selected .hover")) {
            DD_belatedPNG.fix("#offer_drop_down .hover");
        }
        if ($("#offer_drop_down .hover")) {
          DD_belatedPNG.fix("#offer_drop_down .hover");
        }
        if ($("#city_drop_down_arrow .hover")) {
          DD_belatedPNG.fix("#city_drop_down_arrow .hover");
        }
        if ($("#city_drop_down .hover")) {
          DD_belatedPNG.fix("#city_drop_down .hover");
        }
    }

  });

  $("#locale_filter_selected, #offer_drop_down, #city_drop_down_arrow, #city_drop_down").mouseleave(function(ev) {
    if (!$(ev.relatedTarget).closest(".drop_down_list").length) {
      Gilt.Layout.Dropdown.hide(this);
    }
  });
  $("#tag_line_image_link").mouseleave(function(ev) {
    if (!$(ev.relatedTarget).closest(".drop_down_list").length) {
      Gilt.Layout.Dropdown.hide($(this).siblings().find(".drop_down_list").parent());
    }
  });

  $('#offers .tile').mouseover(function() {
    $(this).addClass('tile_hover');
  });

  $('#offers .tile').mouseout(function() {
    $(this).removeClass('tile_hover');
  });

  var resizeEvent = function () {
    var width = $(window).width() - 25; // might need a fudge factor, width of scroll bar
    $("li.tab").each(function () {
      var rightSide = $(this).offset().left + $(this).find("div").width();
      $(this).toggleClass("right_align_menu", rightSide > width);
    });
  };
  $(window).resize(resizeEvent);
  resizeEvent();

  $("#admin_bar > a.close").click(function () {
    $("#admin_bar").remove();
    return false;
  });

  var popupData = {
		  width: 731,
		  body: $('<div id="promo_redemption_dialog">'),
		  empty: true
  };

  var promoPopup = new Gilt.City.simplePopup(popupData);

  Gilt.City.launchOrderPromo = function() {
          
          var selectedPackageOption = Gilt.City.selectedPackageOption;
          
          if (selectedPackageOption == null || selectedPackageOption.packageOptionId == null) {
                  return;
          }
          
          if (selectedPackageOption.status != 'F' && selectedPackageOption.status != 'ForSale') {
                  return;
          }
          
          var quantitySelectorElem = $(this).find('.quantity_selector');
          var newQuantity = (quantitySelectorElem.length == 0) ? 1 : quantitySelectorElem.val();
          
          if (newQuantity != null) {
                  newQuantity = 1;
          }
          
          $('#promo_redemption_dialog').text('Loading ...').load('/city/dialogs/promo_order.html',{
            offer_key: Gilt.City.urlKey,
            po_id: selectedPackageOption.packageOptionId,
            quantity: newQuantity
          });
          
          promoPopup.el.children().css({padding:0});
          promoPopup.show();
  };

};

$(Gilt.Layout.init);
