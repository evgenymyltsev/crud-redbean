$(document).ready(function() {
  function saveData() {
    var name = $('#nm').val();
    var email = $('#em').val();
    var phone = $('#hp').val();
    var address = $('#al').val();

    $.ajax({
      url: 'server.php?p=add',
      type: 'POST',
      data: 'nm='+name+'&em='+email+'&hp='+phone+'&al='+address,
      success: function (data){
        viewData();
      }
    });
  }
  $('#saveData').on('click', saveData);

  function viewData() {
    $.ajax({
      type: 'GET',
      url: 'server.php',
      success: function (data) {
        $('tbody').html(data);
      }
    });
  };
  $('body').on('load', viewData());

  function updateData(str) {
    var id = str;
    var name = $('#nm-'+str).val();
    var email = $('#em-'+str).val();
    var phone = $('#hp-'+str).val();
    var address = $('#al-'+str).val();

    $.ajax({
      type: 'POST',
      url: 'server.php?p=edit',
      data: 'nm='+name+'&em='+email+'&hp='+phone+'&al='+address+'&id='+id,
      success: function (data){
        viewData();
      }
    });
  }

  $('#updateData').on('click', updateData($('#updateData').data('id')));
});
