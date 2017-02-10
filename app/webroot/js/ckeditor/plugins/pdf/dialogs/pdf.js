CKEDITOR.dialog.add( 'pdf', function ( editor )
{
	var lang = editor.lang.pdf;

	function commitValue( videoNode, extraStyles )
	{
		var value=this.getValue();

		if ( !value && this.id=='id' )
			value = generateId();

		//videoNode.setAttribute( this.id, value);

		if ( !value )
			return;
		switch( this.id )
		{
			case 'poster':
				extraStyles.backgroundImage = 'url(' + value + ')';
				break;
			case 'width':
				extraStyles.width = value + 'px';
				break;
			case 'height':
				extraStyles.height = value + 'px';
				break;
		}
	}

	function commitSrc( videoNode, extraStyles, videos )
	{
		var match = this.id.match(/(\w+)(\d)/),
			id = match[1],
			number = parseInt(match[2], 10);

		var video = videos[number] || (videos[number]={});
		video[id] = this.getValue();
	}

	function loadValue( videoNode )
	{
		if ( videoNode )
			this.setValue( videoNode.getAttribute( this.id ) );
		else
		{
			if ( this.id == 'id')
				this.setValue( generateId() );
		}
	}

	function loadSrc( videoNode, videos )
	{
		var match = this.id.match(/(\w+)(\d)/),
			id = match[1],
			number = parseInt(match[2], 10);

		var video = videos[number];
		if (!video)
			return;
		this.setValue( video[ id ] );
	}

	function generateId()
	{
		var now = new Date();
		return 'pdf' + now.getFullYear() + now.getMonth() + now.getDate() + now.getHours() + now.getMinutes() + now.getSeconds();
	}

	// To automatically get the dimensions of the poster image
	var onImgLoadEvent = function()
	{
		// Image is ready.
		var preview = this.previewImage;
		preview.removeListener( 'load', onImgLoadEvent );
		preview.removeListener( 'error', onImgLoadErrorEvent );
		preview.removeListener( 'abort', onImgLoadErrorEvent );

		this.setValueOf( 'info', 'width', preview.$.width );
		this.setValueOf( 'info', 'height', preview.$.height );
	};

	var onImgLoadErrorEvent = function()
	{
		// Error. Image is not loaded.
		var preview = this.previewImage;
		preview.removeListener( 'load', onImgLoadEvent );
		preview.removeListener( 'error', onImgLoadErrorEvent );
		preview.removeListener( 'abort', onImgLoadErrorEvent );
	};

	return {
		title : lang.dialogTitle,
		minWidth : 400,
		minHeight : 200,

		onShow : function()
		{
			// Clear previously saved elements.
			this.fakeImage = this.videoNode = null;
			// To get dimensions of poster image
			this.previewImage = editor.document.createElement( 'img' );

			var fakeImage = this.getSelectedElement();
			if ( fakeImage && fakeImage.data( 'cke-real-element-type' ) && fakeImage.data( 'cke-real-element-type' ) == 'pdf' )
			{
				this.fakeImage = fakeImage;

				var videoNode = editor.restoreRealElement( fakeImage ),
					videos = [],
					sourceList = videoNode.getElementsByTag( 'source', '' );
				if (sourceList.count()==0)
					sourceList = videoNode.getElementsByTag( 'source', 'cke' );

				for ( var i = 0, length = sourceList.count() ; i < length ; i++ )
				{
					var item = sourceList.getItem( i );
					videos.push( {src : item.getAttribute( 'src' ), type: item.getAttribute( 'type' )} );
				}

				this.videoNode = videoNode;

				this.setupContent( videoNode, videos );
			}
			else
				this.setupContent( null, [] );
		},

		onOk : function()
		{
			// If there's no selected element create one. Otherwise, reuse it
			var videoNode = null;
			var innerHtml = '';
			if ( !this.fakeImage )
			{
				videoNode = CKEDITOR.dom.element.createFromHtml( '<cke:div></cke:div>', editor.document );
				//videoNode = CKEDITOR.dom.element.createFromHtml( '<cke:object></cke:object>', editor.document );
				//videoNode = CKEDITOR.dom.element.createFromHtml( '<cke:iframe></cke:iframe>', editor.document );
				
				var extraStyles = {}, videos = [];
				this.commitContent( videoNode, extraStyles, videos );
				if ( videos[0] || videos[0].src ) {
					/* object implementation *
					videoNode.setAttributes(
					{
						src : 'http://localhost' + videos[0].src + '#toolbar=1&scrollbar=1'
					} );
					/* */	
					innerHtml += '[PDF_EMBED|http://localhost' + videos[0].src + '|PDF_EMBED]';
				}
				
				
					
				/* iframe implementation *
				videoNode.setAttributes(
				{
					style : 'border: none;',
					//src : 'http://docs.google.com/viewer?url=' + videos[0].src + '&embedded=true',
					src : 'http://docs.google.com/viewer?url=http://www.presentationfff.org/fff_pdf/spirit/The Spirit as Life Coach Chap4/FFF scheduler/Kiddie-Chapter 4 Scheduler-Spirit as Life Coach.pdf&embedded=true'
				} );
				/* */	
			}
			else
			{
				videoNode = this.videoNode;
			}
			
			/*
			var extraStyles = {}, videos = [];
			this.commitContent( videoNode, extraStyles, videos );
			
			var innerHtml = '', links = '',
				link = lang.linkTemplate || '',
				fallbackTemplate = lang.fallbackTemplate || '';
			for(var i=0; i<videos.length; i++)
			{
				var video = videos[i];
				if ( !video || !video.src )
					continue;
				// JCP innerHtml += '<cke:source src="' + video.src + '" type="' + video.type + '" />';
				innerHtml += 'src="http://docs.google.com/viewer?url=' + video.src + '&embedded=true">';
				// JCP links += link.replace('%src%', video.src).replace('%type%', video.type);
			}
			videoNode.setHtml( innerHtml + fallbackTemplate.replace( '%links%', links ) );
			*/
			
			videoNode.setHtml( innerHtml );


			// Refresh the fake image.
			var newFakeImage = editor.createFakeElement( videoNode, 'cke_pdf', 'pdf', false );
			//newFakeImage.setStyles( extraStyles );
			if ( this.fakeImage )
			{
				newFakeImage.replace( this.fakeImage );
				editor.getSelection().selectElement( newFakeImage );
			}
			else
			{
				// Insert it in a div
				var div = new CKEDITOR.dom.element( 'DIV', editor.document );
				editor.insertElement( div );
				div.append( newFakeImage );
			}
		},
		onHide : function()
		{
			if ( this.previewImage )
			{
				this.previewImage.removeListener( 'load', onImgLoadEvent );
				this.previewImage.removeListener( 'error', onImgLoadErrorEvent );
				this.previewImage.removeListener( 'abort', onImgLoadErrorEvent );
				this.previewImage.remove();
				this.previewImage = null;		// Dialog is closed.
			}
		},

		contents :
		[
			{
				id : 'info',
				elements :
				[
					{
						type : 'hbox',
						widths: [ '33%', '33%', '33%'],
						children : [
							{
								type : 'text',
								id : 'width',
								label : editor.lang.common.width,
								'default' : '100%',
								validate : CKEDITOR.dialog.validate.notEmpty( lang.widthRequired ),
								commit : commitValue,
								setup : loadValue
							},
							{
								type : 'text',
								id : 'height',
								label : editor.lang.common.height,
								'default' : 780,
								validate : CKEDITOR.dialog.validate.notEmpty(lang.heightRequired ),
								commit : commitValue,
								setup : loadValue
							},
							{
								type : 'text',
								id : 'id',
								label : 'Id',
								commit : commitValue,
								setup : loadValue
							}]
					},
					{
						type : 'hbox',
						widths: [ '', '100px', '75px'],
						children : [
							{
								type : 'text',
								id : 'src0',
								label : lang.sourceVideo,
								commit : commitSrc,
								setup : loadSrc
							},
							{
								type : 'button',
								id : 'browse',
								hidden : 'true',
								style : 'display:inline-block;margin-top:10px;',
								filebrowser :
								{
									action : 'Browse',
									target: 'info:src0',
									url: editor.config.filebrowserVideoBrowseUrl || editor.config.filebrowserBrowseUrl
								},
								label : editor.lang.common.browseServer
							},
							{
								id : 'type0',
								label : 'Format',
								type : 'select',
								'default' : 'pdf',
								items :
								[
									[ 'PDF ', 'pdf' ]
								],
								commit : commitSrc,
								setup : loadSrc
							}]
					}
				]
			}

		]
	};
} );