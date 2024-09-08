<!-- <script crossorigin="anonymous" src="https://cdn.virgilsecurity.com/packages/javascript/sdk/4.5.1/virgil-sdk.min.js"></script> -->
<script crossorigin="anonymous" src="<?php echo e(url('/')); ?>/public/virgil/virgil-sdk.min.js"></script>
<input type="hidden" id="VIRGIL_TOKEN" name="VIRGIL_TOKEN" value="<?php echo e(env('VIRGIL_TOKEN')); ?>" />



<!--------------------------------------Funtion output or status modal start-------------------------------------->
    <div class="modal fade availability-modal" id="function_output_modal" tabindex="-1" role="dialog" >
        <div class="modal-dialog">
            <div class="modal-content">
              
                <button type="button" class="close close_btn" data-dismiss="modal">
                    <img src="<?php echo e(url('/')); ?>/public/front/images/close.png" class="img-responsive" alt=""/>
                </button>

                <div class="modal-body" style="text-align: center;">
                    <div class="Availability-form">
                    	<h2><strong>Error!</strong></h2>
                        <h4 id="function_output_msg" style="border-bottom: none;"></h4>
                        <br/>
                        <button class="green-btn close_btn" data-dismiss="modal" id="btn_modal_close">Close</button>
                    </div>
                </div>

            </div>
        </div>
    </div>
<!--------------------------------------Funtion output or status modal end-------------------------------------->

<a href="#function_output_modal" id="btn_open_function_output_modal" data-backdrop="static" data-keyboard="false" data-toggle="modal" class="green-trans-btn" style="display: none;"></a>

<script type="text/javascript">

	function create_card(email)
	{
		showProcessingOverlay();

		var card_data = [];

		/* Virgil Encryption */
		var VIRGIL_TOKEN = $('#VIRGIL_TOKEN').val();

		// generate token
		var api = virgil.API(VIRGIL_TOKEN);

		// generate and save Virgil Key
		var userKey = api.keys.generate();

		// export Virgil key to string
		var exportedKey = userKey.export().toString("base64");
		card_data.push(exportedKey);

		// create Virgil Card
		var userCard = api.cards.create(email, userKey);

		// export Virgil Card to string
		var exportedCard = userCard.export();

		// transmit the Virgil Card to the server
		var _token = "<?php echo e(csrf_token()); ?>";

		$.ajax({
			url      : '<?php echo e(url("/")); ?>/virgil/publish/card',
			type     : 'POST',
			dataType : 'json',
			async    : false,
			data     : {
				_token       : _token,
				exportedCard : exportedCard,
			},
			success : function (res)
			{
				var result = 'success';
				card_data.push(result);
			}
		});

		return card_data;
	}

	var card_id = "<?php echo e(isset($user_data['dump_id']) ? $user_data['dump_id'] : ''); ?>";
	var VIRGIL_TOKEN = $('#VIRGIL_TOKEN').val();
	var api = virgil.API(VIRGIL_TOKEN);


	/*------------------Encrypt & Decrypt Data & Text Starts------------------*/
		// Encrypt Data using above values
		function encrypt(api, text, cards)
	    {
			var enctext = text;

			if( $.trim(text) != '' )
			{
				// encrypt the text using User's cards
				var encdata = api.encryptFor(text, cards);
				var enctext = encdata.toString("base64");
			}
			return enctext;
	    }

	    // Decrypt Data
	    function decrypt(enctext)
	    {
			var text = enctext;

			if( $.trim(enctext) != '' )
			{
				var userkey = "<?php echo e(isset($user_data['dump_session']) ? $user_data['dump_session'] : ''); ?>";//MC4CAQAwBQYDK2VwBCIEIJ8RtSnb3Fp1dyJOCNeQVfHoJv0Kz13gHr20YslUvgFD
				var key     = api.keys.import(userkey);
				var dectext = key.decrypt(enctext);
				text = dectext.toString();
			}
			return text;
	    }
    /*------------------Encrypt & Decrypt Data & Text Ends------------------*/



    /*------------------Encrypt & Decrypt Files Starts------------------*/
    	var fileExtension = ['jpg','jpeg','png','gif','bmp','txt','pdf','csv','doc','docx','xlsx'];

    	function encrypt_file(name, formData)
    	{
    		if( $.inArray( $("#file_"+name).val().split('.').pop().toLowerCase(), fileExtension) == -1 )
    		{
                $("#err_"+name).show();
                $("#err_"+name).html("Please upload valid image/document with valid extension i.e "+fileExtension.join(', '));
                $("#err_"+name).fadeOut(4000);

                $("#file_"+name).focus();
                $("#file_"+name).val('');
                return false;
            }
            else if( $("#file_"+name)[0].files[0].size > 5000000 )
            {
                $("#err_"+name).show();
                $("#err_"+name).html('Max size allowed is 5mb.');
                $("#err_"+name).fadeOut(4000);

                $("#file_"+name).focus();
                $("#file_"+name).val('');
                return false;
            }
            else
            {
            	//return true;
            	var fileObj  = $("#file_"+name)[0].files[0];
	            var fileName = $("#file_"+name).val().split('\\').pop();

	            var fileReader = new FileReader();
	            fileReader.readAsArrayBuffer(fileObj);
	            fileReader.onload = function ()
	            {
	                var imageData  = fileReader.result;
	                var fileBuffer = new Buffer(imageData);

	                api.cards.get(card_id).then(function (cards)
	                {
	                    var uploadedFile  = api.encryptFor(fileBuffer, cards);
	                    var uploadedBlob  = new Blob([uploadedFile]);
	                    var encryptedFile = new File([uploadedBlob], fileName);

	                    formData.append("file_"+name, encryptedFile);
	                })
	                .then(null, function (error)
	                {
	                    $("#btn_open_function_output_modal")[0].click();
	                    $("#function_output_msg").html(error);
	                })
	                .catch(function(error)
	                {
                        $("#btn_open_function_output_modal")[0].click();
	                    $("#function_output_msg").html(error);
					});
	            }
            }
    	}


    	function decrypt_file(name, file, path)
    	{
            var xhr = new XMLHttpRequest();
            // this example with cross-domain issues.
            xhr.open( "GET", path, true );
            
            // Ask for the result as an ArrayBuffer.
            xhr.responseType = "blob";
            xhr.onload = function(e)
            {
				var userkey = "<?php echo e(isset($user_data['dump_session']) ? $user_data['dump_session'] : ''); ?>";
				var key     = api.keys.import(userkey);

				// Obtain a blob: URL for the image data.
				var file      = this.response;
				var mime_type = file.type;

				var fileReader = new FileReader();
				fileReader.readAsArrayBuffer(file);
				fileReader.onload = function ()
				{
					var imageData    = fileReader.result;
					var fileAsBuffer = new Buffer(imageData);

					var decryptedFile = key.decrypt(fileAsBuffer);
					var blob          = new Blob([decryptedFile], { type: mime_type });
					//blob.name = name;
									
					var urlCreator = window.URL || window.webkitURL;
					var imageUrl   = urlCreator.createObjectURL( blob );
					imageUrl.name = name;
					var img        = document.querySelector( "#dec_"+name );
					img.download   = file;
					img.href       = imageUrl;
				}
            };
            xhr.send();
    	}
    /*------------------Encrypt & Decrypt Files Ends------------------*/

</script>