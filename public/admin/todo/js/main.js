$(function() {
  
    // contact form animations
    $('#todo').click(function() {
      $('#todoForm').fadeToggle();
    })
    $(document).mouseup(function (e) {
      var container = $("#todoForm");
  
      if (!container.is(e.target) // if the target of the click isn't the container...
          && container.has(e.target).length === 0) // ... nor a descendant of the container
      {
          container.fadeOut();
      }
    });
    
  });