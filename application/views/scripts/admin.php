<script>
  function add(content_type = 'rooms') {
    if (content_type == 'rooms') {
      $('#id_room').val('')
      $('#roomModalLabel').html('Tambah Tipe Kamar')
      $('#room_name').val('')
      $('#room_slogan').val('')
      $('#room_description').val('')
      $('#room_total').val('')
      $('#room_price').val('')
      document.getElementById('ac').checked = true
      document.getElementById('wifi').checked = true
      document.getElementById('nosmoking').checked = true
      document.getElementById('breakfast').checked = true
      document.getElementById('bed1').checked = true
    } else if (content_type == 'facilitations') {
      $('#id_facilitation').val('')
      $('#fasModalLabel').html('Tambah Fasilitas')
      $('#fas_type').val('')
      $('#fas_class').val('')
      $('#fas_name').val('')
      $('#fas_description').val('')
      $('#fas_hour1').val('08:00')
      $('#fas_hour2').val('16:00')
    }

    $('#photo').attr('required', true)
    $('#photo_sliding').attr('required', true)
  }

  function edit(content_type, e) {
    id      = $(e).data('id')

    if (content_type == 'rooms') {
      content = <?= json_encode($rooms) ?>

      $('#id_room').val(content[id].id_room)
      $('#roomModalLabel').html('Ubah Tipe Kamar')
      $('#room_name').val(content[id].room_name)
      $('#room_slogan').val(content[id].room_slogan)
      $('#room_description').val(content[id].room_description)
      $('#room_total').val(content[id].room_total)
      $('#room_price').val(content[id].room_price)
      if (content[id].ac == 1) document.getElementById('ac').checked = true
      if (content[id].wifi == 1) document.getElementById('wifi').checked = true
      if (content[id].nosmoking == 1) document.getElementById('nosmoking').checked = true
      if (content[id].breakfast == 1) document.getElementById('breakfast').checked = true
      document.getElementById(content[id].bed).checked = true
    }

    $('#photo').removeAttr('required')
    $('#photo_sliding').removeAttr('required')
  }

  function check_value(e) {
    console.log($(e).val())
  }
</script>