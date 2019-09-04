<script>

    function deploy(projectId, formId) {

        jQuery('#deploy-form-button'.concat(formId)).prop('disabled','disabled');
        jQuery('#deploy-form-button'.concat(formId)).html('<div class="spinner-border spinner-border-sm mr-2" role="status"></div> Processing')
        jQuery.ajax('{{ url('en/kobo/publish') }}', {
            method: "POST",
            data: {
                projectId: projectId,
                formId: formId,
            }
        }).done(function(res) {

            console.log(res);
            location.reload();


        }).fail(function(res) {
            console.log("error!", res);
        }).always(function() {
            jQuery('#deploy-form-button'.concat(formId)).prop('disabled','');
            jQuery('#deploy-form-button'.concat(formId)).html('DEPLOY')
        });

    }

    function share(formId, projectId) {

        jQuery('#buttonShare').prop('disabled','disabled');
        jQuery('#buttonShare').html('<div class="spinner-border spinner-border-sm mr-2" role="status"></div> Processing')
        jQuery.ajax('{{ url('en/kobo/share') }}', {
            method: "POST",
            data: {
                projectId: projectId,
                formId: formId,
            }
        }).done(function(res) {

            console.log(res);
            
        }).fail(function(res) {
            console.log("error!", res);
        }).always(function() {
            jQuery('#buttonShare').prop('disabled','');
            jQuery('#buttonShare').html('SHARE')
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

   
</script>