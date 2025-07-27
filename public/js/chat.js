$(document).ready(function(){
	
	(function(){
		var maxChat = 1;
		var socket = io.connect('http://52.62.90.124:3000');
		try{
			socket.emit('init',$('meta[name="current-user"]').attr('value'),$('meta[name="user-id"]').attr('value'));
			socket.on('message',function(payload){
				addmessage(payload);
			})
		}catch(e){			
		}

		$(window).on('beforeunload', function(){
		    socket.close();
		})		
	
		
		function addmessage(payload){
			var chatbox = getChatBoxForDisplayMessage(payload.id,payload.from);
			$('<div class="msg_a">'+payload.message+'</div>').insertBefore(chatbox.find('.msg_wrap').find('.msg_push'));
			chatbox.find('.msg_wrap').find('.msg_body').scrollTop(chatbox.find('.msg_wrap').find('.msg_body')[0].scrollHeight);
				
		}

		$('.IMChat').click(function(){
			//var chatStarter = $(this).parent();		
			var data = $(this).data('params');
			createChatBox(data);		
		});

		$('.chat_head').click(function(){
			$('.chat_body').slideToggle('slow');
		});
		$('.chatbox-minimize').click(function(){		
			$(this).closest(".msg_box").find('.msg_wrap').slideToggle('slow');
		});
		
		$('.chatbox-close').click(function(){
			var id = $(this).closest(".msg_box").attr('chat-id');
			closeChatBox(id);		
		});
		
		$('.chatboxtextarea').focus(function(e){
			chatboxActive($(this).closest('.msg_box'));
		});

		$('.chatboxtextarea').focusout(function(e){
			chatboxActive($(this).closest('.msg_box'),false);
		});
		
		$('.chatboxtextarea').keypress(function(e){
	        if (e.keyCode == 13) {
	        	var msg = $(this).val();
	        	var chatBox = getActiveChatbox();
				$(this).val('');
				if(msg=='') return;
				//$('<div class="msg_b">'+msg+'</div>').insertBefore('.msg_push');
				//$('.msg_body').scrollTop($('.msg_body')[0].scrollHeight);
				//$('<div class="msg_b">'+msg+'</div>').insertBefore($(this).parent().parent().find('.msg_push'));
				//$(this).parent().parent().find('.msg_body').scrollTop($(this).parent().parent().find('.msg_body')[0].scrollHeight);
				$('<div class="msg_b">'+msg+'</div>').insertBefore($(this).closest('.msg_wrap').find('.msg_push'));
				$(this).closest('.msg_wrap').find('.msg_body').scrollTop($(this).closest('.msg_wrap').find('.msg_body')[0].scrollHeight);
				var message = {};
				message.to = chatBox.find(".chatboxtitle").text();
				message.msg = msg;
				socket.emit('send',message);
				return false;
	        }
	    });

	    $('.minimize').click(function(e){
	    	$('.minimize-list').css({left: $(this).position().left});
	    	$('.minimize-list').removeClass("display-hidden");
	    	$(this).removeClass("minimize-close").addClass("minimize-open");
	    	var store = getStore();
	    	displayMinimiseList(store);
			$('.minimize-list').show();
			$('.minimize-block').focus();
			chatboxActive(null,false);
	    });

	    $('.minimize-block').blur(function(e){
	    	$('.minimize').removeClass("minimize-open").addClass("minimize-close");
	    	$(".minimize-list").hide();
	    });

	    $('.minimize-user').mousedown(function(e){
	    	var id = $(this).find(".minimize-user-name").attr('chat-id');
	    	var store = getStore();
	    	store = swapWithLastChat(store,id);
	    	setStore(store);    	
	    	$('.minimize').removeClass("minimize-open").addClass("minimize-close");
	    	$(".minimize-list").hide();
	    	e.preventDefault();
	    	$("#chatbox-"+id).find(".chatboxtextarea").focus();
	    });

	    $('.minimize-close-btn').mousedown(function(e){
	    	$(this).closest(".minimize-user").remove();
	    	return false;    	
	    });

	    function initChat(){
	    	var store = getStore();
	    	var chatBox;
	    	var left = 0;
	    	 $.each(store.chat, function(i, obj) {
	    	 	chatBox = getChatBox(obj.id,obj.name);
	    	 	if(i==0){
	    	 		//chatBox.css({right: 20});
	    	 	}else{
	    	 		chatBox.css({left: left});
	    	 	}    	 	
				chatBox.show();
				//$("#ChatContainer").append(chatBox);
				left = chatBox.position().left-235;
			});
	    	 displayMinimize(store,left+185,true);
	    	 chatboxActive(null,false);
	    }

		function getChatBox(id,name){
	    	var chatBox;
	    	if($("#chatbox-"+id).length){
	    		chatBox = $("#chatbox-"+id);
			}else{
				chatBox = $("#chatbox-hidden").clone(true);
				chatBox.attr("id",'chatbox-'+id);
				chatBox.attr("chat-id",id);
				chatBox.find(".chatboxtitle").html(name)
				chatBox.removeClass("display-hidden");
				$("#ChatContainer").append(chatBox);
			}
			//$(".chat-active").removeClass("chat-active");
			//chatBox.find(".msg_head").addClass("chat-active");		
			//chatboxActive(chatBox);
			chatBox.css({right: 20});
			return chatBox;
	    }

	    function getChatBoxForDisplayMessage(id,name){
	    	var store = getStore();					
			var chatBox;
	    	if($("#chatbox-"+id).length){
	    		chatBox = $("#chatbox-"+id);
	    		if(store.chat.length==0){
	    			chatBox.show();
	    		}
	    		return chatBox;
			}else{
				chatBox = $("#chatbox-hidden").clone(true);
				chatBox.attr("id",'chatbox-'+id);
				chatBox.attr("chat-id",id);
				chatBox.find(".chatboxtitle").html(name);				
				$("#ChatContainer").append(chatBox);				
				if(isChatting(store,id)) {
				} else if (isMinimized(store,id)){
					//add style;					
				}else{
					if(store.chat.length==0){
						chatBox.removeClass("display-hidden");
						store = addToChatList(store,id,name);
					}else{
						store = addToMinimizeList(store,id,name);
						var left = $("#chatbox-"+getLastChat(store).id).position().left;
		    			displayMinimize(store,left-50);
						setStore(store);
					}		    		
		    	}		    	
			}
			return chatBox;
	    }

	    function getActiveChatbox(){
	    	return $(".msg_head.chat_head-active").parent();
	    }
		
		function closeChatBox(id) {
			$("#chatbox-"+id).hide();		
			var store = getStore();
			store=removeFromChatList(store,id);
			moveToChat(store);
			setStore(store);
		}

		function createChatBox(chatStarter) {
			var id = chatStarter.id;
	    	var userName = chatStarter.name;
	    	var store = getStore();
	    	if(isChatting(store,id)){
	    		if ($('#chatbox-'+id).length){
	    			$('#chatbox-'+id).show();
	    		}else{
	    			store = addToChat(store,id,userName);
	    		}
	    	} else if (isMinimized(store,id)){
	    		store = swapWithLastChat(store,id);
	    	}else{
	    		store = addToChat(store,id,userName);
	    	}
	    	setStore(store);
	    	//$(".chatbox-last").removeClass("chatbox-last");
	    	//chatBox.removeClass("display-hidden").addClass("chatbox-last");    	
	    	return false;
	    }        
		
		function swapWithLastChat(store,id){
			var index=getStoreIndex(store.minimize,id);
			$("#chatbox-"+getLastChat(store).id).hide();
			store.minimize.push(getLastChat(store));
			store.chat.splice(store.chat.length-1,1,store.minimize[index]);
			store.minimize.splice(index, 1)
			var lastChat = getLastChat(store);
			chatBox = getChatBox(lastChat.id,lastChat.name);
			restructureChatBoxes(store);
			chatBox.show();
			if(store.minimize.length==0){
				$(".minimize").hide();
				$(".minimize-list").hide();
			}		
			return store;
	    }

	    function moveToChat(store){    	
			if(store.minimize.length>0){
				var chatBox;
				store.chat.push(getFirstMinimizedChat(store));
				store.minimize.splice(0, 1)
				/*
				if($("#chatbox-"+getLastChat(store).id).length){
					chatBox= $("#chatbox-"+getLastChat(store).id);
				}else{
					chatBox = $("#chatbox-hidden").clone(true); 
					chatBox.attr("id",'chatbox-'+getLastChat(store).id);
					chatBox.attr("chat-id",getLastChat(store).id);
					chatBox.find(".chatboxtitle").html("user-"+getLastChat(store).id)
					chatBox.removeClass("display-hidden");
				}
				*/
				chatBox = getChatBox(getLastChat(store).id);
				//$("#ChatContainer").append(chatBox);
				restructureChatBoxes(store);
				chatBox.show();
				if(store.minimize.length==0){
					$(".minimize").hide();
					$(".minimize-list").hide();
				}else{
					$(".minimize .minimize-text").text(store.minimize.length);
				}			
			}else{
				restructureChatBoxes(store);
			}
	    }

	    function restructureChatBoxes(store){
	    	var left;
	    	$.each(store.chat, function(i, obj) {
	    		if(i==0){
	    	 		//$("#chatbox-"+obj.id).css({left:'auto',right:20});
					left = $("#chatbox-"+obj.id).position().left;
	    	 	}else{
	    	 		left = left-235;
	    	 		$("#chatbox-"+obj.id).css({left: left,right:'auto'});
	    	 	}    	 	
			});	
	    }

		function addToChat(store,id,userName){
			/*
			var lastChat;
			var left;
			var chatBox;
			if(store.chat.length>2){
				store.minimize.push(lastChat);
				$('#chatbox-'+lastChat.id).hide();
				store.chat.splice(store.chat.length-1,1)			
			} 
			if(!isChatting(store,id)){
				addToChatList(store,id,userName);
			}
			if ($("#chatbox-"+id).length){
				chatBox = $("#chatbox-"+id);
			}else{
				chatBox = $("#chatbox-hidden").clone(true); 
			}
			
	    	//alert($(".chatbox-last").css('right'););
	    	chatBox.attr("id",'chatbox-'+id);
	    	if (store.chat.length>1){    		
				chatBox.css({left: left, position:'absolute'});
	    	}else{
				chatBox.css({right: 20, position:'absolute'});
	    	}
	    	chatBox.removeClass("display-hidden");
	    	$("#ChatContainer").append(chatBox);
	    	return store;
	    	*/
	    	var chatBox = getChatBox(id,userName);
	    	var lastChat;
	    	var left;    	
			if (store.chat.length==0){
			}else if(store.chat.length<maxChat){
				left = $("#chatbox-"+getLastChat(store).id).position().left -235;
			}else{
				store.minimize.push(getLastChat(store));
				left = $("#chatbox-"+getLastChat(store).id).position().left;
				store.chat.splice(store.chat.length-1,1);			
			}		
			if(store.chat.length==0){
				//chatBox.css({right: 20});
			}else{
				chatBox.css({left: left});
			}		
			//$("#ChatContainer").append(chatBox);
			chatBox.show();
			store =addToChatList(store,id,userName);
			displayMinimize(store,left-50);
			chatBox.find(".chatboxtextarea").focus();
	    	return store;
		}

		function displayMinimize(store,left,mustAdd){
			mustAdd = mustAdd?true:false;
			if(store.minimize.length>0){			
				if(mustAdd || store.minimize.length==1){
					$(".minimize").css({left: left});
					$(".minimize").removeClass("display-hidden minimize-open").addClass("minimize-close");
					$(".minimize").show();			
				}
				$(".minimize .minimize-text").text(store.minimize.length);
			}		
		}

		function displayMinimiseList(store){
			$(".minimize-user-list").empty();
			$.each(store.minimize, function(i, obj) {
				var user = $("#minimize-user").clone(true);
			    user.removeAttr("id");
			    user.find(".minimize-user-text").removeClass("display-hidden");
			    user.find(".minimize-user-name").attr("chat-id",obj.id);
			    user.find(".minimize-user-name").text(obj.name);
			    $(".minimize-user-list").append(user);
			});	
		}

		function chatboxActive(chatBox,active){
			$(".msg_head").removeClass("chat_head-active");
			$(".chatboxtextarea").removeClass("chatboxtextareaselected");
			active = (typeof active === 'undefined') ? true : active;
			if(active){
				chatBox.find(".msg_head").addClass("chat_head-active");
				chatBox.find(".chatboxtextarea").addClass("chatboxtextareaselected");			
			}	
		}
	    
	    function createStore(){
	    	return  {"chat":[],"minimize":[]};
	    }

		function getStore(){
	    	 var store = $.cookie("basket-data");
		     if (store == null) {
		          return createStore();
		     }
		    return JSON.parse(store);
	    }

	    function setStore(store){
			$.cookie("basket-data", JSON.stringify(store),{Path: "/", expires: 1});
	    }

	    function getLastChat(store){
	    	return store.chat[store.chat.length-1];
	    }

	    function getFirstMinimizedChat(store){
	    	return store.minimize[0];
	    }

	    function isChatting(store,id){
			return ($.grep( store.chat, function( n, i ) {
			  return n.id===id;
			})).length>0;
	    }

	    function isMinimized(store,id){
			return ($.grep( store.minimize, function( n, i ) {
			  return n.id===id;
			})).length>0;
	    }
	    
	    function getMinimized(store,id){
			return store.minimize[id];
	    }

	    function addToChatList(store,id,userName){
			store.chat.push(createStoreItem(id,userName))
			return store;
	    }

	    function removeFromChatList(store,id){
	    	store.chat.splice(getStoreIndex(store.chat,id),1);
			return store;
	    }

	    function addToMinimizeList(store,id,userName){
			store.minimize.push(createStoreItem(id,userName))
			return store;
	    }

	    function createStoreItem(id,userName){
	    	//return {id: {name:userName, minimize:isMinimize }};
	    	return {id:id,name:userName};
	    }

	    function getStoreItemById(obj,id){
	    	var item = $.each(obj, function(i, v) {    		
			    if (v.id == id) {
			        return v;
			    }
			});
			return (item.length>0) ? item[0] : null;
	    }

	    function getStoreIndex(obj,id){
	    	var index=-1;
	    	var found=false;
	    	var item = $.each(obj, function(i, v) {    		
	    		index++;
			    if (v.id == id) {
			    	found=true;
			    	return false;
			    }		    
			});	
			return (found) ? index : -1;
	    }
		
		initChat();


	})();


	$('#btnTest').click(function(){ 
		//$.cookie("basket-data", JSON.stringify(getJason()));
		//$.cookie("basket-data", JSON.stringify(createStore()));
		//var x = JSON.parse($.cookie("basket-data"));
		//var x =createStore();
		//var item = getJasonItem(23,"testname23",0);
		//x = addToChatList(x,23,"testname23");
		//alert(x.chat.length);
		//alert(getStoreItemById(x.chat,17));
		//var yahooOnly = getStoreItemById(x.chat,21);
		//alert(getLastChat(x).name);
		//alert(getStoreIndex(x.chat,17));
		//alert('test');
		//alert(getLastChat(x).id);

		//alert(item.keys[0]);
		//for(var key in item){ alert(key); }
		//x.chat.push(item )
		//	x.chat.items.splice(getJasonItem(23,"testname23",0))
		//alert(x.chat[0]['15']['name']);
		//alert(x.chat.hasOwnProperty('15'));
		//alert(Object.keys(x.minimize).length);
		//alert(Object.keys(x.chat).length);

		//y = $.grep(x.chat, function(element, index){
		//	return element.id == 15;
		//});
		//alert(y[0]['name']);
		var x=getStore();
		alert(x.chat.length);
	});

	$('#btnMinimized').click(function(){ 
		var x=getStore();
		//alert(x.minimize.length);

		var user = $(".minimise-user").clone(true);
		alert(user.find(".minimize-user-text").text());
		user.find(".minimise-user-text").removeClass("display-hidden");
		user.find(".minimise-user-name").text("test");
//		$(".minimize-user-list").append(user);


	});

    function getJason1() {
		return  { "chat" :
					[  	
						{id:15,name:'testname15'} , 
			  			{id:16,name:'testname16'} , 
			  			{id:17,name:'testname17'} , 
			  			{id:18,name:'testname18'} , 
			  			{id:19,name:'testname19'} 
			  		],
			  	  "minimize" :
			  	  	[
				  		{id:20, name:'testname20'} , 
				  		{id:21, name:'testname21'} , 
				  		{id:22, name:'testname22'} 
				  	]
				};
	}

	function getJason() {
		return  { "chat" : [{'15': {name:'testname15', minimize:0 }} , 
				  {'16': {name:'testname16', minimize:0 }}, 
				  {'17': {name:'testname17', minimize:0 }}, 
				  {'18': {name:'testname18', minimize:0 }}, 
				  {'19': {name:'testname19', minimize:0 }},], 
				  "minimize" : [{'20': {name:'testname20', minimize:1 }} , 
				  {'21': {name:'testname21', minimize:1 }}, 
				  {'22': {name:'testname22', minimize:1 }},]};				
	}

	 function getJasonItem(id,userName,isMinimize){
	 	return {id:id,name:userName, minimize:isMinimize};
    }
	
});