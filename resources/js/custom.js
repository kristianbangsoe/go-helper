
$(document).ready(function () {
    $.getJSON( "data-tables/postal-codes-data.json", function( data ) {

        var mount = 0;
        //Search when key up
        $("#registrer #location").keyup(function(){
            var results = [];

            // Retrieve the input field text and reset the count to zero
            var filter = $(this).val();
            if($('#registrer .zip-codes').css('display') == 'none'){
                $("#registrer .zip-codes").show();
            }
           
            // Loop through the post list

            $.each( data, function( key, val ) {
                // Check is posts has been mounted
                if (mount == 0) {

                    // Mount results
                    results.push(`
                    <div id='item-` + key + `' class="item box mb-2" data-name='` + val.navn + `' data-lat='` + val.visueltcenter[0] + `' data-lon='` + val.visueltcenter[1] + `' data-nr='` + val.nr + `'>
                        <p>` + val.navn + `</p>
                        <span>Vælg</span>                                         
                    </div><div></div>
                `);
                };
                
                
                // If the list item does not contain the text phrase i fade it out
                if (val.nr.search(new RegExp(filter, "i")) < 0 || !results === 0) {
                    $("#registrer #item-" + key).hide();

                // Show the list item if the phrase matches and increase the count by 1
                } else {
                    $("#registrer #item-" + key).show();
                }

            });

            // If results not mounted append them to the results-container
            if (mount == 0 ) {
                $( "<div>", {
                    "class": "zip-codes",
                    html: results.join( "" )
                }).appendTo( "#registrer .zip-results" );
            }
            mount = 1;

            $('#registrer .results').on('scroll', function() {
                if($(this).scrollTop() + $(this).innerHeight() >= $(this)[0].scrollHeight) {
                    $(this).addClass('active');
                }else{

                    $(this).removeClass('active');
                }
            })
            $( "#registrer .item" ).click(function() {
                var postnr = $(this).data('nr');
                var city = $(this).data('name');
                var lat= $(this).data('lat'); 
                var lon = $(this).data('lon'); 
                $('#location').val(postnr + " - " + city);
                $('#zip').val(postnr);
                $('#city').val(city);
                $('#lon').val(lat);
                $('#lat').val(lon);
                $(".zip-codes").hide();
            });
           
        });
        

    });
    // Preview profile image 
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            
            reader.onload = function (e) {
                $('.pro-img').attr('src', e.target.result);
            }
            
            reader.readAsDataURL(input.files[0]);
        }
    }
    
    $(".file-input").change(function(){
        readURL(this);
    });


});