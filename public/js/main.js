// $(document).ready(function () {
//     $('.select-js').select2();

//     onChangeRoles();
  
// });

// function  loadFile(event) { 
//     var output = document.getElementById('output');
//     output.src = URL.createObjectURL(event.target.files[0]);
//     output.onload = function() {
//       URL.revokeObjectURL(output.src) // free memory
//     }
// } 

// function onChangeRoles() {
//   var roles = $('#roles').val();
//   var search_value = '2';
//   console.log(roles);
//   var value = roles.indexOf( search_value);
 
//   if (value >= 0) {
//       $('#group-class').slideDown();
//   }else{
//       $('#group-class').slideUp();
//       $('#classes').val('');  
//   }
// }   