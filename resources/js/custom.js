$(document).ready(function(){
//
    $('#search').on('input', function(){

            var search = $(this).val();
            $.ajax({
                url: "/?search="+search,
                dataType: 'json',
                type: 'GET',
                    success: function (data){
                        console.log(data['data']);
                        $.each(data, function (key,val) {
                            $('#table tbody').empty().append('<tr><td style="display: none;">'+val['id']+'</td>'
                            +'<td style="color: #5c5c5c;">'+val['id']+'</td>'
                            +'<td>'+val['id']+'</td>'
                            +'<td>'+val['id']+'</td>'
                            +'</tr>')
                        }
   /*                      $('#table').empty().append('<option value="0" selected>-- SELECT --</option>');
                            $.each(data, function (key,val) {
                            $('#subjectid').append('<option value="'+val['id']+'">'+val['name']+'</option>');
                            }); */

                            $('#table').empty();
                    },
                    error: function(){
                    },

            });
            return false;
     });
//
});