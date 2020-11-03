$(document).ready(function () {

  $("#FormUser").bind("submit", function () {

    $.ajax({
      type: $(this).attr("method"),
      url: $(this).attr("action"),
      data: $(this).serializa(),
      success: function () {
        alert("Litos");
      },
      error: function () {
        alert("Mal");
      }
    })

  });

});