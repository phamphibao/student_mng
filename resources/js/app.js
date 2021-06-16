/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('example-component', require('./components/ExampleComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});

$(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    })
    var user_id = $('#user_current_login').val();
    console.log(user_id);
    $('.select-js').select2();

    loadFile();
    onChangeRoles();
    getMessages();
    sendMessage();

    var channel = Echo.channel('my-chat');
      channel.listen('.chat', function(data) {
        console.log(JSON.stringify(data));
        console.log(JSON.stringify(data['user']));
        var content = $(`
          <li class="message clearfix">
              <div class="${user_id != data['message']['from'] ? 'received' : 'sent'}">
                  <p>${data['message']['content']}</p>
                  <p class="date">${(data['message']['created_at'])}</p>
              </div>
          </li>
        `);
        $('#messages').append(content);
        var objDiv = document.getElementById("message-wrapper");
        objDiv.scrollTop = objDiv.scrollHeight;
      });
});


function loadFile(event) {
    var output = document.getElementById('output');
    try {
        output.src = URL.createObjectURL(event.target.files[0]);
    } catch (error) {
        return 0;
    }
    
    output.onload = function () {
      URL.revokeObjectURL(output.src) // free memory
    }
  }
  
  function onChangeRoles() {
    var roles = $('#roles').val();
    var search_value = '2';
    try {
      if (roles != "") {
        var value = roles.indexOf(search_value);
        if (value >= 0) {
          $('#group-class').slideDown();
        } else {
          $('#group-class').slideUp();
          $('#classes').val('');
        }
      }
    } catch (error) {
      return 0;
    }
  }
  
  
  function getMessages() {
  
    $('.info_user').click(function (e) {
      e.preventDefault();
      $('#messages').html('');
      var user_id = $(this).attr('id');
      $('#messages').attr('data-id',user_id);
    
      $.ajax({
        type: "post",
        url: "/admin/messages",
        data: {
          user_id: user_id,
        },
        // dataType: "json",
        success: function (response) {
            $.each(response, function (key, value) {
              var message = $(`
                <li class="message clearfix">
                    <div class=" ${user_id == response[key]['from'] ? 'received' : 'sent'}">
                        <p>${response[key]['content']}</p>
                        <p class="date">${(response[key]['date'])}</p>
                    </div>
                </li>
              `);
  
              $('#messages').append(message);
              var objDiv = document.getElementById("message-wrapper");
              objDiv.scrollTop = objDiv.scrollHeight;
          });
        }
      });
    });
  }
  
  function sendMessage () {
  
    $('#message-send').on('keydown', function (e) { 
     
      var received = $('#messages').attr('data-id');
      var message = $(this).val();
        if(e.which == 13 && message != "" && received != "" ){
          $(this).val('');
          $.ajax({
            type: "post",
            url: "/admin/send/messages",
            data: {
              received: received,
              message: message
            },
            success: function (response) {
             
            }
          });
        }
    });
  
  }