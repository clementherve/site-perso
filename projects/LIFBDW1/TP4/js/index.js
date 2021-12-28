//POSTER UN MESSAGE
$("#message-content").on('keypress', (e)=>{
	if(e.which == 13){
		
		let messageContent = $("#message-content").val()

		$.post("php/chat.php", {'action':'post-new-message', 'content':messageContent})
		.done((data)=>{
			data = JSON.parse(data)
			if(data['code'] == 200){
				$("#message-content").val('')
			} else {
				popup(data['text'])
			}
			
			getNewMessage(5)
		})

	}
})


//RECUPERER LES NOUVEAUX MESSAGES
function getNewMessage(max){
	$.post("php/chat.php", {'action':'get-new-messages', 'max':max})
	.done((data)=>{
		$("#chat-thread").html(data)
	})
}
getNewMessage(5)



//POPUP
function popup(text){
	//show
	$("#popup").css({'bottom':'80px'}).text(text)
	$("#popup").on('click', ()=>{
		$("#popup").css({'bottom':'-80px'}).text('')
	})

}


//LONG POLLING
function checkNewMessages(){
	$.ajax({url:"php/longPolling.php", method:"GET", complete: checkNewMessages})
	.done((data)=>{
		getNewMessage(5)
		getActiveUsers()
	})
}
checkNewMessages()


//RECUPERER LES UTILISATEURS ACTIFS
function getActiveUsers(){
	$.post('php/utilisateursConnectes.php')
	.done((data)=>{
		$("#active-users ul").html(data)
	})
}
getActiveUsers()


//MENU TOGGLE
$("#chat-menu").on('click', ()=>{
	if($("#left-panel").css('left') == '-300px'){
		$("#left-panel").css({'left':'0px'})

		if(window.innerWidth < 500){
			$("#right-panel").css({'margin-left':'0px'})
			$("#chat-head").css({'left':'0px'})
		} else {
			$("#chat-head").css({'left':'300px'})
			$("#right-panel").css({'margin-left':'300px'})
		}
		
	} else {
		$("#left-panel").css({'left':'-300px'})
		$("#right-panel").css({'margin-left':'0px'})
		$("#chat-head").css({'left':'0px'})
	}
})