jQuery(function () {


jQuery("#s").coolautosuggest({
	url:"/wp-content/plugins/woocommerce-autocomplete/autocomplete.php?chars=", //caminho da sua API
	showThumbnail:true,
        showDescription:true,
  onSelected:function(result){
    // Check if the result is not null
    if(result!=null){
      jQuery("#text5_id").val(result.id); // Get the ID field
      jQuery("#text5_profession").val(result.description); // Get the description
      jQuery(".thumbnail").html('<a href="'+result.link+'"><img src="' + result.thumbnail + '" alt="" />'); // Get the picture thumbnail
    }
    else{
      jQuery("#text5_id").val(""); // Empty the ID field
      jQuery("#text5_profession").val(""); // Empty the description
      jQuery(".thumbnail").html(''); // Empty the picture thumbnail
  }
  }
});
});
