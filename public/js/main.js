
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
  