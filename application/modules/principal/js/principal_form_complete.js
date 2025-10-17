

$(document).ready(function () {
    function split( val ) {
        return val.split( /,\s*/ );
      }
    function extractLast( term ) {
    return split( term ).pop();
    }

    $('input[name="brand"]').autocomplete({
        source: function (request, response){
            $.ajax({
                type: "POST",
                url: base_url + 'category/brands',
                dataType: "json",
                data: {
                    keyword: extractLast( request.term ),
                },
                success: function (data) {
                    response(data);
                }
            });
        },
        search: function() {
            // custom minLength
            var term = extractLast( this.value );
            if ( term.length < 2 ) {
              return false;
            }
          },
        focus: function() {
            // prevent value inserted on focus
            return false;
        },
        select: function( event, ui ) {
            var terms = split( this.value );
            // remove the current input
            terms.pop();
            // add the selected item
            terms.push( ui.item.name );
            // add placeholder to get the comma-and-space at the end
            terms.push( "" );
            this.value = terms.join( ", " );
            return false;
        },
    }).autocomplete( "instance" )._renderItem = function( ul, item ) {
        return $( "<li>" )
          .append( "<div>" + item.name + "</div>" )
          .appendTo( ul );
      };
});