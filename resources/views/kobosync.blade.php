<script>

function deploy(e) {

    e.preventDefault()

    var href = e.target.getAttribute('href');

    jQuery(e.target).prop('disabled','disabled');
    jQuery(e.target).html('<div class="spinner-border spinner-border-sm mr-2" role="status"></div> Processing')
    jQuery.ajax(href, {
        method: "GET",
    }).done(function(res) {

        console.log(res);
        //location.reload();


    }).fail(function(res) {
        console.log("error!", res);
    }).always(function() {
        jQuery(e.target).prop('disabled','');
        jQuery(e.target).html('DEPLOY')
    });

}

// function share(formId, projectId) {

//     jQuery('#buttonShare').prop('disabled','disabled');
//     jQuery('#buttonShare').html('<div class="spinner-border spinner-border-sm mr-2" role="status"></div> Processing')
//     jQuery.ajax(href, {
//         method: "POST",
//         data: {
//             projectId: projectId,
//             formId: formId,
//         }
//     }).done(function(res) {

//         console.log(res);

//     }).fail(function(res) {
//         console.log("error!", res);
//     }).always(function() {
//         jQuery('#buttonShare').prop('disabled','');
//         jQuery('#buttonShare').html('SHARE')
//     });
// }

// function getData(projectId) {

//     jQuery('#get-data-button').prop('disabled','disabled');
//     jQuery('#get-data-button').html('<div class="spinner-border spinner-border-sm mr-2" role="status"></div> Processing')

//     jQuery.ajax(href, {
//         method: "POST",
//         data: {
//             projectId: projectId,
//         }
//     }).done(function(res) {
//         console.log(res)

//     }).fail(function(res) {
//         console.log("error!", res);
//     }).always(function() {
//         jQuery('#get-data-button').prop('disabled','');
//         jQuery('#get-data-button').html('GET DATA')
//     });
// }


</script>