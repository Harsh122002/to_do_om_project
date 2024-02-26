$(document).ready(function() {
     $('create-form').submit(function(e) {
       e.preventDefault();
       var title = $('#title').val();
       var content = $('#content').val();
       $.ajax({
         url: 'save.php',
         type: 'POST',
         data: { title: title, content: content },
         success: function(response) {
           alert('To-Do item created successfully!');
           $('#title').val('');
           $('#content').val('');
           window.location.href = 'list.php'; // Redirect to list.php after successful creation
         },
         error: function(xhr, status, error) {
           console.error('Error creating to-do item:', error);
           alert('Error creating to-do item. Please try again later.');
         }
       });
     });
   });
   