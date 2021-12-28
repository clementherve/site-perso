<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Console Administrateur</title>
	<link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,500,700" rel="stylesheet">

	<style>
		body{
			margin: 0;
			font-family: Montserrat;
			--bg1: #EEEEEE;
			--bg2: #3f3955;
			--accent1: #2d2741;
			--accent2: #453F5B;
		}
		img{
			width: 100%;
		}
		a{
			text-decoration: none;
			color: inherit;
		}

		#feed {
			display: flex;
		}




		/***************************/
		/***************************/
		#write{
			width: 100%;
		}
		#list{
			width: 320px;
			min-width: 320px;
			max-width: 320px;
			height: 100vh;
			max-height: 100vh;
			overflow-y: auto;
			background-color: var(--bg2)
		}
		#list .article-min{
			text-align: center;
			padding: 10px;
			width: 80%;
			cursor: pointer;
			background-color: white;
			margin: 10px auto;
			font-size: 12px;
			border-radius: 3px;
		}


		#title, #tags, #id, #content{
			width: calc(100% - 30px);
			max-width: calc(100% - 30px);
			min-width: calc(100% - 30px);
			padding: 15px;
			background-color: white;
			border: none;
			outline: none;
			border-bottom: 2px solid var(--bg1);
			margin: 0px;
			resize: none;
		}
		#title{
			font-weight: 700;
		}
		#content{
			min-height: 450px;
		}
		#action-wrap{
			width: 100%;
			display: flex;
		}
		.action{
			background-color: var(--bg1);
			padding: 10px;
			background-color: var(--bg1);
			border-radius: 3px;
			cursor: pointer;
			font-size: 13px;
			margin: 20px;
		}


	</style>
</head>
<body>

	<div id="feed">

		<div id="write">
			<input type="text" id="title" placeholder="Titre">
			<input type="text" id="tags" placeholder="Tags (utiliser des ,)">
			<input type="text" id="id" placeholder="chemin">
			<textarea id="content" placeholder="Contenu"></textarea>

			<div id="action-wrap">
				<!-- <label for="file" class="action">Ajouter un Fichier</label> -->
				<!-- <input type="file" id="file" style="display: none"> -->
				<div do="publish" class="action">Publier</div>
				<label do="draft" class="action" for="isDraft"><input type="checkbox" id="isDraft">Brouillon</label>

				<div do="delete" class="action">Supprimer</div>
			</div>
		</div>

		<div id="list">
			<?php
				include_once("../php/admin.class.php");
				$admin = new admin();
				$admin->showMiniList();
			?>
		</div>

	</div>

	<script>
		$ = (elt) => {
			return document.querySelector(elt)
		}
		makeData = (obj) => {
			let keys = Object.keys(obj),
				dataString = ''

			keys.forEach((k)=>{
				dataString = dataString + k + '=' + obj[k] + '&'
			})

			if(dataString.length > 0){
				return dataString.substr(0, dataString.length-1)
			} else {
				return ''
			}

		}
		request = async (url, method='GET', args, typeRetour='text') => {

			let resp
			args = makeData(args)

			if(method === 'GET'){
				resp = await fetch(url+args)
			} else {

				resp = await fetch(url, {
					method: 'POST',
					headers: {
						'Content-Type':'application/x-www-form-urlencoded',
					},
					body: args
				})

			}

			if(resp.status < 400){

				if(typeRetour === 'text'){
					return await resp.text()
				} else {
					return await resp.json()
				}
			} else {
				console.warn('Fetch error: ' + response.status + ' status code')
			}

		}


		$("#list").addEventListener('click', (e)=>{
			let that = e.target,
				id = that.getAttribute('aid')

			request("php/get-article.php", 'POST', {id:id}, 'JSON')
			.then((resp)=>{
				$('#title').value = resp['title']
				$('#content').value = resp['content']
				$('#tags').value = resp['tags']
				$("#id").value = resp['ID']
				if(resp['is-draft'] === 'true'){
					$("#isDraft").checked = true;
				} else {
					$("#isDraft").checked = false;
				}

			})
		})


		$('#action-wrap').addEventListener('click', (e)=>{

			let that = e.target,
				action = that.getAttribute('do'),
				title = $('#title').value,
				content = $('#content').value,
				tags = $('#tags').value,
				id = $("#id").value,
				isDraft = !($("#isDraft").checked)

			if(action === 'publish'){

				request('php/publish-article.php', 'POST',
					{
						title: title,
						content: content,
						tags: tags,
						id: id,
						'is-draft': false
					},
				'json')
				.then((response)=>{
					alert(response['status'])
					console.log(response)
				})
			} else if(action === 'draft') {
				request('php/publish-article.php', 'POST',
					{
						title: title,
						content: content,
						tags: tags,
						id: id,
						'is-draft': isDraft
					},
				'json')
				.then((response)=>{
					console.log(response)
				})
			} else if(action === 'delete') {
				let ask = confirm("Supprimer ?")
				if(ask){
					request('php/delete-article.php', 'POST', {id: id}, 'json')
					.then((response)=>{
						console.log(response)
					})
				}

			}
		})


	</script>
</body>
</html>
