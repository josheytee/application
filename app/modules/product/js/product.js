////tools
//verify if value is in the array
function in_array(value, array)
{
  for (var i in array)
    if ((array[i] + '') === (value + ''))
      return true;
  return false;
}

function ProductTabsManager() {
  var self = this;
  this.product_tabs = [];
  this.tabs_to_preload = [];
  this.current_request;
  this.stack_done = [];
  this.page_reloading = false;
  this.has_error_loading_tabs = false;
  /**
   * Schedule execution of onReady() function for each tab and bind events
   */
  this.init = function () {
    for (var tab_name in this.product_tabs) {
      if (this.product_tabs[tab_name].onReady !== undefined && this.product_tabs[tab_name] !== this.product_tabs['Pack'])
      {
        this.onLoad(tab_name, this.product_tabs[tab_name].onReady);
      }
    }

    $('.shopList.chzn-done').on('change', function () {
      if (self.current_request)
      {
        self.page_reloading = true;
        self.current_request.abort();
      }
    });

    $(window).on('beforeunload', function () {
      self.page_reloading = true;
    });
  };

  this.setTabs = function (tabs) {
    this.product_tabs = tabs;
  };
  /**
   * Execute a callback function when a specific tab has finished loading or right now if the tab has already loaded
   *
   * @param tab_name name of the tab that is checked for loading
   * @param callback_function function to call
   */
  this.onLoad = function (tab_name, callback)
  {
    var container = $('#product-tab-content-' + tab_name);
    // Some containers are not loaded depending on the shop configuration
    if (container.length === 0)
      return;

    // onReady() is always called after the dom has been created for the tab (similar to $(document).ready())
    if (container.hasClass('not-loaded'))
      container.bind('loaded', callback);
//         callback();
    else
      callback();
  };

  this.display = function (tab_name, selected) {
    var tab_selector = $("#product-tab-content-" + tab_name);
    $('#product-tab-content-wait').hide();
    return $.ajax({
//      url: 'http://web.bety.com/AdminProducts?id_product=1&updateproduct&ajax=1&action=Associations',
      url: $('#link-' + tab_name).attr('href') + '&ajax=1' + '&rand=' + +new Date().getTime(),
      async: true,
      cache: false, // cache needs to be set to false or IE will cache the page with outdated product values
//         data: {val: "Hello world"},
//         dataType: 'html',
      timeout: 30000,
      success: function (data)
      {
        tab_selector.html(data).find('.dropdown-toggle').dropdown();
        tab_selector.removeClass('not-loaded');

        if (selected)
        {
          $("#link-" + tab_name).addClass('selected');
          $('#product-tab-content-wait').hide();
          tab_selector.show();
        }
        self.stack_done.push(tab_name);
        tab_selector.trigger('loaded');
      },
      complete: function (data)
      {
        tab_selector.removeClass('loading');
        if (selected)
        {
          tab_selector.trigger('displayed');
        }
      },
      beforeSend: function (data)
      {
        // don't display the loading notification bar
        if (typeof (ajax_running_timeout) !== 'undefined')
          clearTimeout(ajax_running_timeout);
        if (selected) {
          $('#product-tab-content-wait').show();
        }
      },
      error: function (jqXHR, textStatus, errorThrown) {
        alert(textStatus + ':' + errorThrown);
      }
    });
  };
  /**
   * Send an ajax call for each tab in the stack
   *
   * @param array stack contains tab names as strings
   */
  this.displayBulk = function (stack) {
    this.current_request = this.display(stack[0], false);

    if (this.current_request !== undefined)
    {
      this.current_request.complete(function (request, status) {
        var wrong_statuses = new Array('abort', 'error', 'timeout');
        var wrong_status_code = new Array(400, 401, 403, 404, 405, 406, 408, 410, 413, 429, 499, 500, 502, 503, 504);

        if ((in_array(status, wrong_statuses) || in_array(request.status, wrong_status_code)) && !self.page_reloading) {
          var current_tab = '';
          if (request.responseText !== 'undefined' && request.responseText && request.responseText.length) {
            current_tab = $(request.responseText).filter('.product-tab').attr('id').replace('product-', '');
          }

          jAlert((current_tab ? 'Tab : ' + current_tab : '') + ' (' + (request.status ? request.status + ' ' : '') + request.statusText + ')\n' + reload_tab_description, reload_tab_title);
          self.page_reloading = true;
          self.has_error_loading_tabs = true;
          clearTimeout(tabs_running_timeout);
          return false;
        } else if (!self.has_error_loading_tabs && (self.stack_done.length === self.tabs_to_preload.length)) {
          $('[name="submitAddproductAndStay"]').each(function () {
            $(this).prop('disabled', false).find('i').removeClass('process-icon-loading').addClass('process-icon-save');
          });
          $('[name="submitAddproduct"]').each(function () {
            $(this).prop('disabled', false).find('i').removeClass('process-icon-loading').addClass('process-icon-save');
          });
          this.allow_hide_other_languages = true;
          clearTimeout(tabs_running_timeout);
          return false;
        }
        return true;
      });
    }
    /*In order to prevent mod_evasive DOSPageInterval (Default 1s)*/
    var time = 0;
    if (mod_evasive) {
      time = 1000;
    }
    var tabs_running_timeout = setTimeout(function () {
      stack.shift();
      if (stack.length > 0) {
        self.displayBulk(stack);
      }
    }, time);
  };

}
product_tabs = new Array();
product_tabs['Prices'] = new function () {
  this.onReady = function () {
    alert('price tab working');
  };

};
product_tabs['Associations'] = new function () {
  this.onReady = function () {
    alert('Association tab working');
  };

};
var tabs_manager = new ProductTabsManager();
tabs_manager.setTabs(product_tabs);
$(document).ready(function () {
  tabs_manager.init();

});
(function ($) {
  $(document).ready(function () {
    $('#ajaxStatus').hide()
            .ajaxStart(function () {
              $(this).show();
            })
            .ajaxStop(function () {
              $(this).hide();
            });
// Start our ajax request when doAjaxButton is clicked
    $('#doAjaxButton').click(function () {
      $.ajax({
        url: 'ajax.php',
        data: {val: "Hello world"},
        dataType: 'json',
        success: function (data, textStatus, jqXHR) {
          // Data processing code
          $('body').append('Response Value: ' + data.test);
        },
        error: function (jqXHR, textStatus, errorThrown) {
          alert(textStatus + ':' + errorThrown);
        }
      });
    });
  });
})(jQuery);