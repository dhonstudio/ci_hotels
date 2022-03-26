<script>
    $('#date-start').datepicker({
        startDate: new Date(),
        autoclose: true,
        todayHighlight: true,
    }).on('changeDate', function (selected) {
        var minDate = new Date(selected.date.valueOf());
        minDate.setDate(minDate.getDate() + 1)
        $('#date-end').datepicker('setStartDate', minDate);
    });

    $('#date-end').datepicker({
        autoclose: true,
        todayHighlight: true,
    })

    $("#total-rooms").keypress(function(e){
        var keyCode = e.which;
        /*
        8 - (backspace)
        32 - (space)
        48-57 - (0-9)Numbers
        */
    
        if ( (keyCode != 8 || keyCode ==32 ) && (keyCode < 48 || keyCode > 57)) { 
        return false;
        }
    });

    $('#total-rooms').keyup(function() {
        var numbers = $(this).val();
        $(this).val(numbers.replace(/\D/, ''));
    });

    function check_availability() {
        // console.log($('#total-room').val())
        if ($('#id_room').val() !== null && $('#date-start').val() != '' && $('#date-end').val() != '' && $('#total-room').val() != '') {
            document.getElementById('check_availability').submit();
        } else {
            alert('Mohon isi detail pengecekan secara lengkap')
        }
    }

    


    // var countDownDate = new Date("2022-03-27 4:00").getTime();

    // // Update the count down every 1 second
    // var x = setInterval(function() {

    //     // Get today's date and time
    //     var now = new Date().getTime();
            
    //     // Find the distance between now and the count down date
    //     var distance = countDownDate - now;
            
    //     // Time calculations for days, hours, minutes and seconds
    //     var days = Math.floor(distance / (1000 * 60 * 60 * 24));
    //     var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
    //     var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
    //     var seconds = Math.floor((distance % (1000 * 60)) / 1000);
            
    //     // Output the result in an element with id="countdown"
    //     document.getElementById("countdown").innerHTML = 
    //         '&nbsp;<b>' + days + '</b> hari</text> ' + 
    //         '<b>' + hours + '</b> jam</text> ' + 
    //         '<b>' + minutes + '</b> menit</text> ' + 
    //         '<b>' + seconds + '</b> detik</text> ';
            
    //     // If the count down is over, write some text 
    //     if (distance < 0) {
    //         clearInterval(x);
    //         document.getElementById("countdown").innerHTML = "EXPIRED";
    //     }
    // }, 1000);
</script>