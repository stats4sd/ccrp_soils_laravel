<script>

    function deploy(projectId, formId) {
        jQuery.ajax('{{ url('en/kobo/publish') }}', {
            method: "POST",
            data: {
                projectId: projectId,
                formId: formId,
            }
        }).done(function(res) {

            console.log(res);
        });

    }

    function getData(projectId) {

        jQuery('#get-data-button').prop('disabled','disabled');
        jQuery('#get-data-button').html('<div class="spinner-border spinner-border-sm mr-2" role="status"></div> Processing')

        jQuery.ajax('{{ url('en/kobo/pull') }}', {
            method: "POST",
            data: {
                projectId: projectId,
            }
        }).done(function(res) {
            console.log(res)

        }).fail(function(res) {
            console.log("error!", res);
        }).always(function() {
            jQuery('#get-data-button').prop('disabled','');
            jQuery('#get-data-button').html('GET DATA')
        });
    }

    function share(projectId, formId) {
        jQuery.ajax('{{ url('en/kobo/share') }}', {
            method: "POST",
            data: {
                projectId: projectId,
                formId: formId,
            }
        }).done(function(res) {

            console.log(res);
        });

    }



</script>