<template>
	<div>
		<h2>Channel {{id}}</h2>
		<ul id="messages">
			<li v-for="message in messages" :key="message.id">{{ message }}</li>
		</ul>
		<form @submit="send">
			<input type="text" v-model="newMessage">
			<button>Send</button>
		</form>


	</div>
</template>

<script>
	export default {

		name: "ChannelComponent",
		props: ["id"],

		data() {

			return {
				messages: [],
				newMessage: ''
			}
		},
		methods: {
			send() {

				axios.post('message/create',
					{
						channelId: this.id,
						userId: window.App.user.id,
						message: this.newMessage
					})
					.then(response => {
						// console.log(response.data);
					})
			}
		},
		watch: {
			id(newId, oldId) {


				window.Echo.leave('channel.' + oldId);
				console.log('leave channel' + oldId);
				window.Echo.private('channel.' + newId)
					.listen('NewMessage', (e) => {/*actions*/
						console.log(e);
					});
			}
			// id(oldId, newId){
			// 	// console.log('old: ' + oldId);
			// 	// console.log('new: ' + newid);
			// 	Echo.leave('channel.' + oldId);
			//
			// 	Echo.channel('channel.' + newId).listen('NewMessage', e => {
			// 		console.log(newId);
			// 		console.log(e);
			// 	});
			// }
		},
		created() {
			console.log(this.id);
			window.Echo.private('channel.' + this.id).listen('NewMessage', e => {
				console.log(this.id);
				console.log(e);
			});

		}
		,
		// beforeDestroy() {
		// 	console.log('destroy' + this.id);
		// 	Echo.leave('channel.' + this.id);
		// }

	}
</script>

<style scoped>
	* {
		margin: 0;
		padding: 0;
		box-sizing: border-box;
	}

	body {
		font: 13px Helvetica, Arial;
	}

	form {
		background: #000;
		padding: 3px;
		position: fixed;
		bottom: 40px;
		width: 80%;
	}

	form input {
		border: 0;
		padding: 10px;
		width: 90%;
		margin-right: .5%;
		background-color: white
	}

	form button {
		width: 9%;
		background: rgb(130, 224, 255);
		border: none;
		padding: 10px;
	}

	#messages {
		list-style-type: none;
		margin: 0;
		padding: 0;
	}

	#messages li {
		padding: 5px 10px;
	}

	#messages li:nth-child(odd) {
		background: #eee;
	}
</style>