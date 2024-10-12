$(document).ready(function() {
    $('#Persona').keyup(
        function(result) {
            var buscar = $("#Persona").val();
            var _token = $("input[name='_token']").val();
            $.ajax({
                url: "/persona/buscar_persona_ajax",
                data: {
                    buscar: buscar,
                    _token: _token
                },
                dataType: "json",
                type: "POST",
                success: function(data) {
                    result($.map(data, function(item) {
                        return item;
                    }));
                },
                error: function(data) {
                    alert(data);
                }
            });

        });
});